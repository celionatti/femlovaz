<?php

namespace App\controllers;

use App\Core\Request;
use App\Core\Response;
use App\models\Stocks;
use App\Core\Controller;
use App\Core\Support\Helpers\TimeFormat;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;

class AdminStocksController extends Controller
{
    public $currentUser;

    public function onConstruct(): void
    {
        $this->view->setLayout('admin');
        authRedirect(['admin'], "/admin/login");
        // $this->currentUser = Users::getCurrentUser();
    }

    /**
     * @throws Exception
     */
    public function stocks(Request $request, Response $response)
    {
        if ($request->get("export") && $request->get("export") === "excel") {
            $this->generate_excel();
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

    private function generate_excel()
    {
        // Create a new Spreadsheet
        $spreadsheet = new Spreadsheet();
        $worksheet = $spreadsheet->getActiveSheet();

        $data = Stocks::find();

            // Define headers
            $worksheet->setCellValue('A1', 'Name');
            $worksheet->setCellValue('B1', 'Price');
            $worksheet->setCellValue('C1', 'Qty');
            $worksheet->setCellValue('D1', 'Status');
            $worksheet->setCellValue('E1', 'Date');

            // Start row for data
            $row = 2;

            // Loop through the database data
            foreach ($data as $row_data) {
                $worksheet->setCellValue('A' . $row, $row_data->name); // Name
                $worksheet->setCellValue('B' . $row, $row_data->price); // Price
                $worksheet->setCellValue('C' . $row, $row_data->qty); // Qty
                $worksheet->setCellValue('D' . $row, $row_data->status); // Status
                $worksheet->setCellValue('E' . $row, TimeFormat::DateTwo($row_data->created_at)); // Date

                // Increment row counter
                $row++;
            }

            $worksheet->getColumnDimension('A')->setWidth(20);
            $worksheet->getColumnDimension('B')->setWidth(25);
            $worksheet->getColumnDimension('C')->setWidth(20);
            $worksheet->getColumnDimension('D')->setWidth(20);
            $worksheet->getColumnDimension('E')->setWidth(20);

            $border = new Border();
            $border->setBorderStyle(Border::BORDER_THIN);

            $worksheet->getStyle('A1:E1')->getBorders()->applyFromArray([
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ]);


            $fill = new Fill();
            $fill->setFillType(Fill::FILL_SOLID);
            $fill->getStartColor()->setARGB('000000'); // Yellow

            $worksheet->getStyle('A1:E1')->getFill()->applyFromArray([
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => '000000',
                ],
            ]);


            $font = new Font();
            $font->setBold(true);
            $font->setColor(new Color(Color::COLOR_WHITE));
            $font->setSize(14);

            $worksheet->getStyle('A1:E1')->getFont()->applyFromArray([
                'bold' => true,
                'color' => [
                    'rgb' => 'FFFFFF',
                ],
                'size' => 14,
            ]);

            // Save the Excel file
            $writer = new Xlsx($spreadsheet);
            $excelFilename = 'stocks.xlsx'; // Change to your desired file name
            $writer->save($excelFilename);

            // Provide download link
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $excelFilename . '"');
            header('Cache-Control: max-age=0');
            readfile($excelFilename);
    }

}
