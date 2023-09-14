<?php

namespace App\controllers;

use App\Core\Request;
use App\Core\Response;
use App\Core\Controller;
use App\Core\Support\Helpers\TimeFormat;
use App\models\Flows;
use App\models\Transactions;

class AdminAccountingController extends Controller
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
    public function book_keeping(Request $request, Response $response)
    {
        $view = [
            'navigations' => [
                ['label' => 'Dashboard', 'url' => 'admin'],
                ['label' => 'Accounting', 'url' => ''],
            ],
            'transOpts' => [
                "credit" => "Credit (Inwards)",
                "debit" => "Debit (Expenses)"
            ],
        ];
        $this->view->render('admin/accounting/index', $view);
    }

    /**
     * Inwards Accounting Section.
     * 
     * This section handles all Inwards Accounting controllers.
     */


     /**
     * @throws Exception
     */
    public function show_all(Request $request, Response $response)
    {
        if ($request->isPost()) {
            $output = '';

            if ($request->post("action") && $request->post("action") === "view-flows") {
                $data = Flows::find();
                $output .= '<table class="table table-striped table-sm table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>Date</th>
                        <th>Flow ID</th>
                        <th>Flow Type</th>
                        <th>Amount</th>
                        <th>Details</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>';

                foreach ($data as $key => $row) {
                    $output .= '<tr class="text-center text-scondary">
                    <td>' . $key + 1 . '</td>
                    <td>' . TimeFormat::DateOne($row->created_at) . '</td>
                    <td>' . $row->flow_id . '</td>
                    <td class="text-capitalize '.statusMode($row->flow_type).'">' . $row->flow_type . '<i class="'. flowIcon($row->flow_type).'"></i></td>
                    <td class="'.statusMode($row->flow_type).'">' .'N '. number_format($row->amount, 2) . '</td>
                    <td>' . $row->details . '</td>
                    <td class="text-capitalize '.statusMode($row->status).'">' . $row->status . '</td>
                    <td>
                    <a href="#" title="Edit Flow" class="text-primary editBtn" id="' . $row->id . '" data-bs-toggle="modal" data-bs-target="#editFlow"><i class="bi bi-pencil-square fs-5"></i></a>&nbsp;&nbsp;

                    <a href="#" title="Delete Flow" class="text-danger delBtn" id="' . $row->id . '"><i class="bi bi-trash fs-5"></i></a>
                    </td></tr>
                    ';
                }
                $output .= '</tbody></table>';
                $this->json_response($output);
            } else {
                return '<h3 class="text-center text-secondary mt-5">:( No flow present in the database!</h3>';
            }
        }
    }

    public function create_flow(Request $request, Response $response)
    {
        if ($request->isPost()) {
            // Insert new Flow.
            $flow = new Flows();

            if ($request->post("action") && $request->post("action") === "insert") {
                $flow->loadData($request->getBody());
                if (empty($flow->getErrors())) {
                    $flow->save();
                }
            }
        }
    }

    public function edit_flow(Request $request, Response $response)
    {
        if ($request->isPost()) {
            if ($request->post("edit_id")) {
                $id = $request->post("edit_id");

                $params = [
                    'conditions' => "id = :id",
                    'bind' => ['id' => $id]
                ];
                $flow = Flows::findFirst($params);

                $this->json_response($flow);
            }

            if ($request->post("action") && $request->post("action") === "update") {
                $id = $request->post("id");
                $flow_id = $request->post("flow_id");

                $params = [
                    'conditions' => "id = :id AND flow_id = :flow_id",
                    'bind' => ['id' => $id, 'flow_id' => $flow_id]
                ];
                $flow = Flows::findFirst($params);

                if ($flow) {
                    $flow->loadData($request->getBody());
                    if (empty($flow->getErrors())) {
                        $flow->save();
                    }
                }
            }
        }
    }

    public function trash_flow(Request $request, Response $response)
    {
        if ($request->isPost()) {
            if ($request->post("del_id")) {
                $id = $request->post("del_id");

                $params = [
                    'conditions' => "id = :id",
                    'bind' => ['id' => $id]
                ];
                $flow = Flows::findFirst($params);

                if ($flow) {
                    $flow->delete();
                }
            }
        }
    }

}
