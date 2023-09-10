<?php

namespace App\controllers;

use App\Core\Request;
use App\Core\Response;
use App\Core\Controller;
use App\models\Customers;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;


class AdminCustomersController extends Controller
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
    public function customers(Request $request, Response $response)
    {
        if ($request->get("export") && $request->get("export") === "excel") {
            $this->generate_excel();
        }

        $view = [
            'navigations' => [
                ['label' => 'Dashboard', 'url' => 'admin'],
                ['label' => 'Customers', 'url' => '']
            ],
        ];
        $this->view->render('admin/customers/index', $view);
    }


    /**
     * @throws Exception
     */
    public function show_customers(Request $request, Response $response)
    {
        if ($request->isPost()) {
            $output = '';

            if ($request->post("action") && $request->post("action") === "view-customers") {
                $data = Customers::find();
                $output .= '<table class="table table-striped table-sm table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>Name</th>
                        <th>Othername</th>
                        <th>Phone</th>
                        <th>Decoder Type</th>
                        <th>IUC Number</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>';

                foreach ($data as $key => $row) {
                    $output .= '<tr class="text-center text-scondary">
                    <td>' . $key + 1 . '</td>
                    <td>' . $row->name . '</td>
                    <td>' . $row->othername . '</td>
                    <td>' . $row->phone . '</td>
                    <td>' . $row->decoder_type . '</td>
                    <td>' . $row->iuc_number . '</td>
                    <td>
                    <a href="#" title="View Details" class="text-success infoBtn" id="' . $row->id . '"><i class="bi bi-info-square fs-5"></i></a>&nbsp;&nbsp;

                    <a href="#" title="Edit Details" class="text-primary editBtn" id="' . $row->id . '" data-bs-toggle="modal" data-bs-target="#editCustomer"><i class="bi bi-pencil-square fs-5"></i></a>&nbsp;&nbsp;

                    <a href="#" title="Delete Details" class="text-danger delBtn" id="' . $row->id . '"><i class="bi bi-trash fs-5"></i></a>
                    </td></tr>
                    ';
                }
                $output .= '</tbody></table>';
                $this->json_response($output);
            } else {
                return '<h3 class="text-center text-secondary mt-5">:( No customer present in the database!</h3>';
            }
        }
    }

    public function create_customer(Request $request, Response $response)
    {
        if ($request->isPost()) {
            // Insert new User.
            $user = new Customers();

            if ($request->post("action") && $request->post("action") === "insert") {
                $user->loadData($request->getBody());
                if (empty($user->getErrors())) {
                    $user->save();
                }
            }
        }
    }

    public function edit_customer(Request $request, Response $response)
    {
        if ($request->isPost()) {
            if ($request->post("edit_id")) {
                $id = $request->post("edit_id");

                $params = [
                    'conditions' => "id = :id",
                    'bind' => ['id' => $id]
                ];
                $customer = Customers::findFirst($params);

                $this->json_response($customer);
            }

            if ($request->post("action") && $request->post("action") === "update") {
                $id = $request->post("id");
                $slug = $request->post("slug");

                $params = [
                    'conditions' => "id = :id AND slug = :slug",
                    'bind' => ['id' => $id, 'slug' => $slug]
                ];
                $customer = Customers::findFirst($params);

                if ($customer) {
                    $customer->loadData($request->getBody());
                    if (empty($customer->getErrors())) {
                        $customer->save();
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
                $user = Customers::findFirst($params);

                if ($user) {
                    $user->delete();
                }
            }
        }
    }

    public function details(Request $request, Response $response)
    {
        if ($request->isPost()) {
            if ($request->post("info_id")) {
                $id = $request->post("info_id");

                $params = [
                    'conditions' => "id = :id",
                    'bind' => ['id' => $id]
                ];
                $customer = Customers::findFirst($params);

                if ($customer) {
                    $this->json_response($customer);
                }
            }
        }
    }

    private function generate_excel()
    {
        // Create a new Spreadsheet
        $spreadsheet = new Spreadsheet();
        $worksheet = $spreadsheet->getActiveSheet();

        $data = Customers::find();

            // Define headers
            $worksheet->setCellValue('A1', 'ID');
            $worksheet->setCellValue('B1', 'Slug');
            $worksheet->setCellValue('C1', 'Surname');
            $worksheet->setCellValue('D1', 'Name');
            $worksheet->setCellValue('E1', 'Email');
            $worksheet->setCellValue('F1', 'Phone');

            // Start row for data
            $row = 2;

            // Loop through the database data
            foreach ($data as $row_data) {
                $worksheet->setCellValue('A' . $row, $row_data->id); // ID
                $worksheet->setCellValue('B' . $row, $row_data->slug); // Slug
                $worksheet->setCellValue('C' . $row, $row_data->surname); // Surname
                $worksheet->setCellValue('D' . $row, $row_data->name); // Name
                $worksheet->setCellValue('E' . $row, $row_data->email); // Email
                $worksheet->setCellValue('F' . $row, $row_data->phone); // Phone

                // Increment row counter
                $row++;
            }

            $worksheet->getColumnDimension('A')->setWidth(20);
            $worksheet->getColumnDimension('B')->setWidth(20);
            $worksheet->getColumnDimension('C')->setWidth(25);
            $worksheet->getColumnDimension('D')->setWidth(25);
            $worksheet->getColumnDimension('E')->setWidth(30);
            $worksheet->getColumnDimension('F')->setWidth(25);

            $border = new Border();
            $border->setBorderStyle(Border::BORDER_THIN);

            $worksheet->getStyle('A1:C1')->getBorders()->applyFromArray([
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ]);


            $fill = new Fill();
            $fill->setFillType(Fill::FILL_SOLID);
            $fill->getStartColor()->setARGB('000000'); // Yellow

            $worksheet->getStyle('A1:F1')->getFill()->applyFromArray([
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => '000000',
                ],
            ]);


            $font = new Font();
            $font->setBold(true);
            $font->setColor(new Color(Color::COLOR_WHITE));
            $font->setSize(14);

            $worksheet->getStyle('A1:F1')->getFont()->applyFromArray([
                'bold' => true,
                'color' => [
                    'rgb' => 'FFFFFF',
                ],
                'size' => 14,
            ]);

            // Save the Excel file
            $writer = new Xlsx($spreadsheet);
            $excelFilename = 'users.xlsx'; // Change to your desired file name
            $writer->save($excelFilename);

            // Provide download link
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $excelFilename . '"');
            header('Cache-Control: max-age=0');
            readfile($excelFilename);
    }
}
