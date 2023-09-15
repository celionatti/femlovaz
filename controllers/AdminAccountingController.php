<?php

namespace App\controllers;

use App\Core\Request;
use App\models\Flows;
use App\Core\Response;
use App\Core\Controller;
use App\models\Transactions;
use App\Core\Support\Helpers\TimeFormat;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;

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
        if ($request->get("export") && $request->get("export") === "excel") {
            $this->generate_excel();
        }
        
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
                    <td>' . TimeFormat::DateTwo($row->created_at) . '</td>
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

    private function generate_excel()
    {
        // Create a new Spreadsheet
        $spreadsheet = new Spreadsheet();
        $worksheet = $spreadsheet->getActiveSheet();

        $data = Flows::find();

            // Define headers
            $worksheet->setCellValue('A1', 'ID');
            $worksheet->setCellValue('B1', 'Amount');
            $worksheet->setCellValue('C1', 'Details');
            $worksheet->setCellValue('D1', 'Type');
            $worksheet->setCellValue('E1', 'Status');
            $worksheet->setCellValue('F1', 'Date');

            // Start row for data
            $row = 2;

            // Loop through the database data
            foreach ($data as $row_data) {
                $worksheet->setCellValue('A' . $row, $row_data->flow_id); // Flow ID
                $worksheet->setCellValue('B' . $row, $row_data->amount); // Amount
                $worksheet->setCellValue('C' . $row, $row_data->details); // Details
                $worksheet->setCellValue('D' . $row, $row_data->flow_type); // Flow Type
                $worksheet->setCellValue('E' . $row, $row_data->status); // Status
                $worksheet->setCellValue('F' . $row, TimeFormat::DateTwo($row_data->created_at)); // Date

                // Increment row counter
                $row++;
            }

            $worksheet->getColumnDimension('A')->setWidth(30);
            $worksheet->getColumnDimension('B')->setWidth(25);
            $worksheet->getColumnDimension('C')->setWidth(30);
            $worksheet->getColumnDimension('D')->setWidth(20);
            $worksheet->getColumnDimension('E')->setWidth(20);
            $worksheet->getColumnDimension('F')->setWidth(20);

            $border = new Border();
            $border->setBorderStyle(Border::BORDER_THIN);

            $worksheet->getStyle('A1:F1')->getBorders()->applyFromArray([
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
            $excelFilename = 'book-keeping.xlsx'; // Change to your desired file name
            $writer->save($excelFilename);

            // Provide download link
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $excelFilename . '"');
            header('Cache-Control: max-age=0');
            readfile($excelFilename);
    }

}
