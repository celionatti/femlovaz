<?php

namespace App\controllers;

use App\Core\Request;
use App\Core\Response;
use App\Core\Controller;
use App\models\Customers;
use App\models\Stocks;

class AdminStocksController extends Controller
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
    public function stocks(Request $request, Response $response)
    {
        if ($request->get("export") && $request->get("export") === "excel") {
        }

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
    public function show_stocks(Request $request, Response $response)
    {
        if ($request->isPost()) {
            $output = '';

            if ($request->post("action") && $request->post("action") === "view-stocks") {
                $data = Stocks::find();
                $output .= '<table class="table table-striped table-sm table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>Name</th>
                        <th>price</th>
                        <th>Qty</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>';

                foreach ($data as $key => $row) {
                    $output .= '<tr class="text-center text-scondary">
                    <td>' . $key + 1 . '</td>
                    <td>' . $row->name . '</td>
                    <td>' .'N '. number_format($row->price, 2) . '</td>
                    <td>' . $row->qty . '</td>
                    <td>
                    <a href="#" title="Edit Details" class="text-primary editBtn" id="' . $row->id . '" data-bs-toggle="modal" data-bs-target="#editStock"><i class="bi bi-pencil-square fs-5"></i></a>&nbsp;&nbsp;

                    <a href="#" title="Delete Details" class="text-danger delBtn" id="' . $row->id . '"><i class="bi bi-trash fs-5"></i></a>
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

    public function create_stock(Request $request, Response $response)
    {
        if ($request->isPost()) {
            // Insert new User.
            $user = new Stocks();

            if ($request->post("action") && $request->post("action") === "insert") {
                $user->loadData($request->getBody());
                if (empty($user->getErrors())) {
                    $user->save();
                }
            }
        }
    }

    public function edit_stock(Request $request, Response $response)
    {
        if ($request->isPost()) {
            if ($request->post("edit_id")) {
                $id = $request->post("edit_id");

                $params = [
                    'conditions' => "id = :id",
                    'bind' => ['id' => $id]
                ];
                $stock = Stocks::findFirst($params);

                $this->json_response($stock);
            }

            if ($request->post("action") && $request->post("action") === "update") {
                $id = $request->post("id");
                $slug = $request->post("slug");

                $params = [
                    'conditions' => "id = :id AND slug = :slug",
                    'bind' => ['id' => $id, 'slug' => $slug]
                ];
                $stock = Stocks::findFirst($params);

                if ($stock) {
                    $stock->loadData($request->getBody());
                    if (empty($stock->getErrors())) {
                        $stock->save();
                    }
                }
            }
        }
    }

    public function trash(Request $request, Response $response)
    {
        if ($request->isPost()) {
            if ($request->post("del_id")) {
                $id = $request->post("del_id");

                $params = [
                    'conditions' => "id = :id",
                    'bind' => ['id' => $id]
                ];
                $stock = Stocks::findFirst($params);

                if ($stock) {
                    $stock->delete();
                }
            }
        }
    }

}
