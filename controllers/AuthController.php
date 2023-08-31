<?php

namespace App\controllers;

use App\Core\Request;
use App\models\Users;
use App\Core\Response;
use App\Core\Controller;
use App\Core\Application;
use App\Core\Support\Csrf;
use App\Core\Support\Helpers\Token;
use App\Core\Support\Helpers\Bcrypt;

class AuthController extends Controller
{
    public function onConstruct(): void
    {
        $this->view->setLayout('auth');
    }

    /**
     * @throws Exception
     */
    public function register(Request $request, Response $response)
    {
        $user = new Users();

        if ($request->isPost()) {
            $user->loadData($request->getBody());

            if ($user->save()) {
                Application::$app->session->setFlash("success", "{$user->username} Account Created successfully");
                redirect('/login');
            }
        }

        $view = [
            'errors' => $user->getErrors(),
            'user' => $user,
        ];
        $this->view->render('auth/register', $view);
    }

    /**
     * @throws Exception
     */
    public function login(Request $request, Response $response)
    {
        $user = new Users();
        $isError = true;

        if ($request->isPost()) {
            $user->loadData($request->getBody());
            $user->validateLogin();

            if (empty($user->getErrors())) {
                //continue with the login process
                $u = Users::findFirst(
                    [
                        'conditions' => "email = :email",
                        'bind' => ['email' => $request->post('email')]
                    ]
                );

                if ($u) {
                    $verified = password_verify($request->post('password'), $u->password);
                    if ($verified) {
                        //log the user in
                        $isError = false;
                        $remember = $request->post('remember') == 'on';
                        $u->login($remember);
                        redirect('/');
                    }
                }
            }
            if ($isError) {
                $user->setError('email', 'Something is wrong with the Email or Password. Please try again.');
                $user->setError('password', '');
            }
        }

        $view = [
            'errors' => $user->getErrors(),
            'user' => $user,
        ];
        $this->view->render('auth/login', $view);
    }

    public function logout(Request $request, Response $response)
    {
        if ($request->isPost()) {
            if (Application::$app->currentUser) {
                Application::$app->currentUser->logout();
            }
            redirect('/');
        }
    }

    public function forgot_password(Request $request, Response $response)
    {
        if ($request->isPost()) {
            Csrf::check_csrf();

            $params = [
                'columns' => "token",
                'conditions' => "email = :email",
                'bind' => ['email' => $request->post('email')],
                'limit' => 1
            ];

            $user = Users::findFirst($params);
            if ($user) {

                $verifiedToken = password_verify($request->post('token'), $user->token);
                if($verifiedToken) {
                    $rand_id = Token::randomString('64');
                    $token = Bcrypt::hashPassword(Token::randomString('10'));
                    $user = $request->post('email');
                    $this->session->set("token", Token::generateOTP('15'));
                    $ses = time();
                    redirect("/change_password?rand_id={$rand_id}&token={$token}&user={$user}&ses={$ses}");
                }
            }
        }

        $view = [
            'errors' => [],
        ];

        $this->view->render("auth/forgot_password", $view);
    }

    public function change_password(Request $request, Response $response)
    {
        $email = $request->get("user");

        if(! $this->session->exists("token"))
            abort(Response::NOT_ACCEPTABLE);

        $current_time = time();
        $time_left = 60 * 15;

        if($request->get("ses") + $time_left <= $current_time) {
            $this->session->remove("token");
            Application::$app->session->setFlash("success", "Request Expired, Try again.");
            redirect("/login");
        }

        $params = [
            'conditions' => "email = :email",
            'bind' => ['email' => $email],
            'limit' => 1
        ];

        $user = Users::FindFirst($params);

        if($request->isPatch()) {
            if($user) {
                $user->loadData($request->getBody());
                $user->validateChangePasswordAuth();

                if ($user->save()) {
                    $this->session->remove("token");
                    Application::$app->session->setFlash("success", "Your password has been changed successfully");
                    redirect('/login');
                }
            }
        }

        $view = [
            'errors' => $user->getErrors(),
        ];

        $this->view->render("auth/change_password", $view);
    }
}