<?php

namespace App\controllers;

use App\Core\Request;
use App\Core\Response;
use App\Core\Controller;
use App\models\Customers;


class AdminPaymentsController extends Controller
{
    public $currentUser;

    public function onConstruct(): void
    {
        $this->view->setLayout('admin');
        // $this->currentUser = Users::getCurrentUser();
    }

    /**
     * @throws Exception
     */
    public function payments(Request $request, Response $response)
    {
        $view = [
            'navigations' => [
                ['label' => 'Dashboard', 'url' => 'admin'],
                ['label' => 'Payments', 'url' => 'admin/payments'],
                ['label' => 'Sales', 'url' => '']
            ],
        ];
        $this->view->render('admin/payments/index', $view);
    }

    /**
     * Sales Payment Section.
     * 
     * This section handles all sales Payment controllers.
     */


    /**
     * @throws Exception
     */
    public function sales(Request $request, Response $response)
    {
         /**
         * Generate Excel file, for sales details
         */
        if ($request->get("export") && $request->get("export") === "excel") {
        }

        /**
         * Get all stocks available.
         */

        $view = [
            'navigations' => [
                ['label' => 'Dashboard', 'url' => 'admin'],
                ['label' => 'Payments', 'url' => 'admin/payments'],
                ['label' => 'Sales', 'url' => '']
            ],
        ];
        $this->view->render('admin/payments/sales/index', $view);
    }


    /**
     * Subscriptions Payment Section.
     * 
     * This section handles all subscription Payment controllers.
     */

     /**
     * @throws Exception
     */
    public function subscriptions(Request $request, Response $response)
    {
        /**
         * Generate Excel file, for subscriptions details
         */
        if ($request->get("export") && $request->get("export") === "excel") {
        }

        $view = [
            'navigations' => [
                ['label' => 'Dashboard', 'url' => 'admin'],
                ['label' => 'Payments', 'url' => 'admin/payments'],
                ['label' => 'Subscriptions', 'url' => '']
            ],
        ];
        $this->view->render('admin/payments/subscriptions/index', $view);
    }
}
