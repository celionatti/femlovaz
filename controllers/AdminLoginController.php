<?php

namespace App\controllers;

use App\Core\Application;
use App\Core\Config;
use App\Core\Request;
use App\models\Users;
use App\Core\Response;
use App\Core\Controller;


class AdminLoginController extends Controller
{
    public $currentUser;

    public function onConstruct(): void
    {
        $this->view->setLayout('admin-auth');
        if($this->currentUser = Users::getCurrentUser()) {
            redirect(Config::get("domain") . "admin");
        }
    }

    /**
     * @throws Exception
     */
    public function login(Request $request, Response $response)
    {
        $view = [];
        $this->view->render('admin/login', $view);
    }

    public function login_access(Request $request, Response $response)
    {
        $user = new Users();
        $isError = true;

        if ($request->isPost()) {
            if ($request->post("action") && $request->post("action") === "login") {
                $user->loadData($request->getBody());
                $user->validateLogin();

                if (empty($user->getErrors())) {
                    //continue with login.
                    $u = Users::findFirst([
                        'conditions' => "email = :email AND acl = :acl",
                        'bind' => ['email' => $request->post('email'), 'acl' => "admin"]
                    ]);

                    if ($u) {
                        $verified = password_verify($request->post('password'), $u->password);
                        if ($verified) {
                            //log the user in
                            $isError = false;
                            $remember = $request->post('remember') == 'on';
                            $u->login($remember);
                            echo (Config::get("domain") . "admin");
                        }
                    }
                }
                if ($isError) {
                    echo (Config::get("domain") . "admin/login");
                    Application::$app->session->setFlash("warning", "Something is wrong with the Email or Password. Please try again.");
                }
            }
        }
    }
}
