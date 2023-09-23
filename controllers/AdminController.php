<?php

namespace App\controllers;

use App\Core\Request;
use App\models\Users;
use App\Core\Response;
use App\Core\Controller;


class AdminController extends Controller
{
    public $currentUser;

    public function onConstruct(): void
    {
        $this->view->setLayout('admin');
        $this->currentUser = Users::getCurrentUser();
        authRedirect(['admin'], "/admin/login");
    }

    /**
     * @throws Exception
     */
    public function admin(Request $request, Response $response)
    {
        $view = [
            'navigations' => [
                ['label' => 'Dashboard', 'url' => 'admin']
            ],
        ];
        $this->view->render('admin/dashboard', $view);
    }

    /**
     * @throws Exception
     */
    public function stocks(Request $request, Response $response)
    {
        $view = [
            'navigations' => [
                ['label' => 'Dashboard', 'url' => 'admin'],
                ['label' => 'Stocks', 'url' => '']
            ],
        ];
        $this->view->render('admin/stocks/index', $view);
    }

    /**
     * @throws Exception
     */
    public function inquiries(Request $request, Response $response)
    {
        $view = [
            'navigations' => [
                ['label' => 'Dashboard', 'url' => 'admin'],
                ['label' => 'Inquiries', 'url' => '']
            ],
        ];
        $this->view->render('admin/inquiries/index', $view);
    }

    /**
     * @throws Exception
     */
    public function help_center(Request $request, Response $response)
    {
        $view = [
            'navigations' => [
                ['label' => 'Dashboard', 'url' => 'admin'],
                ['label' => 'Help Center', 'url' => '']
            ],
        ];
        $this->view->render('admin/help-center/index', $view);
    }

    /**
     * @throws Exception
     */
    public function book_keeping(Request $request, Response $response)
    {
        $view = [
            'navigations' => [
                ['label' => 'Dashboard', 'url' => 'admin'],
                ['label' => 'Book Keeping', 'url' => '']
            ],
        ];
        $this->view->render('admin/book-keeping/index', $view);
    }

}