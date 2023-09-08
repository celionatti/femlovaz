<?php

namespace App\controllers;

use App\Core\Request;
use App\models\Users;
use App\Core\Response;
use App\Core\Controller;


class AdminUsersController extends Controller
{
    public $currentUser;

    public function onConstruct(): void
    {
        $this->view->setLayout('admin');
        $this->currentUser = Users::getCurrentUser();
    }

    /**
     * @throws Exception
     */
    public function users(Request $request, Response $response)
    {
        $view = [
            'navigations' => [
                ['label' => 'Dashboard', 'url' => 'admin'],
                ['label' => 'Users', 'url' => '']
            ],
        ];
        $this->view->render('admin/users/index', $view);
    }


    /**
     * @throws Exception
     */
    public function show_users(Request $request, Response $response)
    {
        if ($request->isPost()) {
            $output = '';

            if ($request->post("action") && $request->post("action") === "view-users") {
                $data = Users::find();
                $output .= '<table class="table table-striped table-sm table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>Surname</th>
                        <th>Name</th>
                        <th>E-mail</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>';

                foreach ($data as $key => $row) {
                    $output .= '<tr class="text-center text-scondary">
                    <td>' . $key + 1 . '</td>
                    <td>' . $row->surname . '</td>
                    <td>' . $row->name . '</td>
                    <td>' . $row->email . '</td>
                    <td>' . $row->phone . '</td>
                    <td>
                    <a href="#" title="View Details" class="text-success infoBtn" id="' . $row->id . '"><i class="bi bi-info-square fs-5"></i></a>&nbsp;&nbsp;

                    <a href="#" title="Edit Details" class="text-primary editBtn" id="' . $row->id . '" data-bs-toggle="modal" data-bs-target="#editUser"><i class="bi bi-pencil-square fs-5"></i></a>&nbsp;&nbsp;

                    <a href="#" title="Delete Details" class="text-danger delBtn" id="' . $row->id . '"><i class="bi bi-trash fs-5"></i></a>
                    </td></tr>
                    ';
                }
                $output .= '</tbody></table>';
                $this->json_response($output);
                // return $output;
            } else {
                return '<h3 class="text-center text-secondary mt-5">:( No user present in the database!</h3>';
            }

            // Insert new User.
            if ($request->post("action") && $request->post("action") === "insert") {
                dd($_POST);
            }
        }
    }

    public function create_user(Request $request, Response $response)
    {
        if ($request->isPost()) {
            // Insert new User.
            $user = new Users();

            if ($request->post("action") && $request->post("action") === "insert") {
                $user->loadData($request->getBody());
                if (empty($user->getErrors())) {
                    $user->save();
                }
            }
        }
    }

    public function edit_user(Request $request, Response $response)
    {
        if ($request->isPost()) {
            if ($request->post("edit_id")) {
                $id = $request->post("edit_id");

                $params = [
                    'conditions' => "id = :id",
                    'bind' => ['id' => $id]
                ];
                $user = Users::findFirst($params);

                $this->json_response($user);
            }

            if ($request->post("action") && $request->post("action") === "update") {
                $id = $request->post("id");
                $slug = $request->post("slug");

                $params = [
                    'conditions' => "id = :id AND slug = :slug",
                    'bind' => ['id' => $id, 'slug' => $slug]
                ];
                $user = Users::findFirst($params);

                if ($user) {
                    $user->loadData($request->getBody());
                    if (empty($user->getErrors())) {
                        $user->save();
                    }
                }
            }
        }
    }

    public function trash(Request $request, Response $response)
    {
        if($request->isPost()){
            if ($request->post("del_id")) {
                $id = $request->post("del_id");
                dd($id);

                $params = [
                    'conditions' => "id = :id",
                    'bind' => ['id' => $id]
                ];
                $user = Users::findFirst($params);
                dd($user);

                // $this->json_response($user);
            }
        }
    }
}
