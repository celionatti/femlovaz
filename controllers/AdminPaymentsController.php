<?php

namespace App\controllers;

use App\Core\Request;
use App\Core\Response;
use App\Core\Controller;
use App\Core\Support\Helpers\TimeFormat;
use App\models\Customers;
use App\models\Sales;
use App\models\Stocks;

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

        $view = [
            'navigations' => [
                ['label' => 'Dashboard', 'url' => 'admin'],
                ['label' => 'Payments', 'url' => 'admin/payments'],
                ['label' => 'Sales', 'url' => '']
            ],
            'stocks' => Stocks::find(),
        ];
        $this->view->render('admin/payments/sales/index', $view);
    }

     /**
     * @throws Exception
     */
    public function show_sales(Request $request, Response $response)
    {
        if ($request->isPost()) {
            $output = '';

            if ($request->post("action") && $request->post("action") === "view-sales") {
                $data = Sales::find();
                $output .= '<table class="table table-striped table-sm table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>Name</th>
                        <th>Amount</th>
                        <th>Qty</th>
                        <th>Payment Method</th>
                        <th>Note</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>';

                foreach ($data as $key => $row) {
                    $output .= '<tr class="text-center text-scondary">
                    <td>' . $key + 1 . '</td>
                    <td>' . $row->name . '</td>
                    <td>' .'N '. number_format($row->amount, 2) . '</td>
                    <td>' . $row->qty . '</td>
                    <td>' . $row->payment_method . '</td>
                    <td>' . $row->note . '</td>
                    <td>' . TimeFormat::DateOne($row->created_at) . '</td>
                    <td>' . $row->status . '</td>
                    <td>
                    <a href="#" title="Edit Sale" class="text-primary editBtn" id="' . $row->id . '" data-bs-toggle="modal" data-bs-target="#editSale"><i class="bi bi-pencil-square fs-5"></i></a>&nbsp;&nbsp;

                    <a href="#" title="Delete Sale" class="text-danger delBtn" id="' . $row->id . '"><i class="bi bi-trash fs-5"></i></a>
                    </td></tr>
                    ';
                }
                $output .= '</tbody></table>';
                $this->json_response($output);
            } else {
                return '<h3 class="text-center text-secondary mt-5">:( No stock present in the database!</h3>';
            }
        }
    }

    public function create_sale(Request $request, Response $response)
    {
        if ($request->isPost()) {
            // Insert new Sales.
            $sale = new Sales();

            if ($request->post("action") && $request->post("action") === "insert") {
                $sale->loadData($request->getBody());
                if (empty($sale->getErrors())) {
                    $sale->save();
                }
            }
        }
    }

    public function edit_sale(Request $request, Response $response)
    {
        if ($request->isPost()) {
            if ($request->post("edit_id")) {
                $id = $request->post("edit_id");

                $params = [
                    'conditions' => "id = :id",
                    'bind' => ['id' => $id]
                ];
                $sale = Sales::findFirst($params);

                $this->json_response($sale);
            }

            if ($request->post("action") && $request->post("action") === "update") {
                $id = $request->post("id");
                $slug = $request->post("slug");

                $params = [
                    'conditions' => "id = :id AND slug = :slug",
                    'bind' => ['id' => $id, 'slug' => $slug]
                ];
                $sale = Sales::findFirst($params);

                if ($sale) {
                    $sale->loadData($request->getBody());
                    if (empty($sale->getErrors())) {
                        $sale->save();
                    }
                }
            }
        }
    }

    public function trash_sale(Request $request, Response $response)
    {
        if ($request->isPost()) {
            if ($request->post("del_id")) {
                $id = $request->post("del_id");

                $params = [
                    'conditions' => "id = :id",
                    'bind' => ['id' => $id]
                ];
                $sale = Sales::findFirst($params);

                if ($sale) {
                    $sale->delete();
                }
            }
        }
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
