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