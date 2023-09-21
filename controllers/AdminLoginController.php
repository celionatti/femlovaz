<?php

namespace App\controllers;

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
        $this->currentUser = Users::getCurrentUser();
    }

    /**
     * @throws Exception
     */
    public function login(Request $request, Response $response)
    {
<<<<<<< HEAD
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
                        'conditions' => "email = :email",
                        'bind' => ['email' => $request->post('email')]
                    ]);

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
            }
        }
    }
}
=======
        if($request->isPost()) {
            if($request->post("action") && $request->post("action") === "login") {
                dd($_POST);
            }
        }

        $view = [
            
        ];
        $this->view->render('admin/login', $view);
    }

}
>>>>>>> b9569b51105f966f4255c90230858d70849cf2c9
