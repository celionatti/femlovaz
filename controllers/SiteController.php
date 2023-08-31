<?php

namespace App\controllers;

use App\Core\Request;
use App\models\Users;
use App\Core\Response;
use App\Core\Controller;
use App\Core\Support\Csrf;
use App\Core\Support\TwoFactorAuthenticator;

class SiteController extends Controller
{
    public $currentUser;

    public function onConstruct(): void
    {
        $this->view->setLayout('default');
        $this->currentUser = Users::getCurrentUser();
    }

    /**
     * @throws Exception
     */
    public function index(Request $request, Response $response)
    {
        $users = new Users();
        
        if ($request->isPost()) {
            $this->csrf->checkToken();
            $users->setData($request->getBody());
            $users->getData();
            dd($users);
        }

        $view = [
            'errors' => [],
        ];
        $this->view->render('welcome', $view);
    }

}
