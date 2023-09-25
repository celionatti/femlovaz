<?php

namespace App\controllers;

use App\Core\Request;
use App\models\Sales;
use App\models\Users;
use App\Core\Response;
use App\models\Stocks;
use App\Core\Controller;
use App\models\Subscriptions;
use App\Core\Support\Helpers\TimeFormat;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;

class AdminPaymentsController extends Controller
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
    public function payments(Request $request, Response $response)
    {
        $view = [
            'navigations' => [
                ['label' => 'Dashboard', 'url' => 'admin'],
                ['label' => 'Payments', 'url' => ''],
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
            $this->generate_excel_sales();
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
                    <td class="text-capitalize">' . $row->name . '</td>
                    <td>' . 'N ' . number_format($row->amount, 2) . '</td>
                    <td>' . $row->qty . '</td>
                    <td class="text-capitalize">' . $row->payment_method . '</td>
                    <td>' . $row->note . '</td>
                    <td>' . TimeFormat::DateOne($row->created_at) . '</td>
                    <td class="text-capitalize ' . statusMode($row->status) . '">' . $row->status . '</td>
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
                    $stock = Stocks::findFirst([
                        'condition' => "name = :name",
                        'bind' => ['name' => $sale->name]
                    ]);
                    dd($stock);

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

                $params = [
                    'conditions' => "id = :id",
                    'bind' => ['id' => $id]
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
            $this->generate_excel_subscriptions();
        }

        $view = [
            'navigations' => [
                ['label' => 'Dashboard', 'url' => 'admin'],
                ['label' => 'Payments', 'url' => 'admin/payments'],
                ['label' => 'Subscriptions', 'url' => '']
            ],
            'decoderOpts' => [
                Subscriptions::DECODER_DSTV => "Dstv",
                Subscriptions::DECODER_GOTV => "Gotv",
                Subscriptions::DECODER_FREE_TO_AIR => "Free To Air"
            ],
        ];
        $this->view->render('admin/payments/subscriptions/index', $view);
    }

    /**
     * @throws Exception
     */
    public function show_subscriptions(Request $request, Response $response)
    {
        if ($request->isPost()) {
            $output = '';

            if ($request->post("action") && $request->post("action") === "view-subscriptions") {
                $data = Subscriptions::find();
                $output .= '<table class="table table-striped table-sm table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>Transaction ID</th>
                        <th>Amount</th>
                        <th>Name</th>
                        <th>IUC Number</th>
                        <th>Decoder Type</th>
                        <th>Payment Method</th>
                        <th>Note</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>';

                foreach ($data as $key => $row) {
                    $output .= '<tr class="text-center text-secondary">
                    <td>' . $key + 1 . '</td>
                    <td>' . $row->transaction_id . '</td>
                    <td>' . 'N ' . number_format($row->amount, 2) . '</td>
                    <td class="text-capitalize">' . $row->name . '</td>
                    <td>' . $row->iuc_number . '</td>
                    <td class="text-capitalize">' . $row->decoder_type . '</td>
                    <td class="text-capitalize">' . $row->payment_method . '</td>
                    <td>' . $row->note . '</td>
                    <td>' . TimeFormat::DateOne($row->created_at) . '</td>
                    <td class="text-capitalize ' . statusMode($row->status) . '">' . $row->status . '</td>
                    <td>
                    <a href="#" title="Edit Subscription" class="text-primary editBtn" id="' . $row->id . '" data-bs-toggle="modal" data-bs-target="#editSubscription"><i class="bi bi-pencil-square fs-5"></i></a>&nbsp;&nbsp;

                    <a href="#" title="Delete Subscription" class="text-danger delBtn" id="' . $row->id . '"><i class="bi bi-trash fs-5"></i></a>
                    </td></tr>
                    ';
                }
                $output .= '</tbody></table>';
                $this->json_response($output);
            } else {
                return '<h3 class="text-center text-secondary mt-5">:( No subscription present in the database!</h3>';
            }
        }
    }

    public function create_subscription(Request $request, Response $response)
    {
        if ($request->isPost()) {
            // Insert new Sales.
            $subscription = new Subscriptions();

            if ($request->post("action") && $request->post("action") === "insert") {
                $subscription->loadData($request->getBody());
                if (empty($subscription->getErrors())) {
                    $subscription->save();
                }
            }
        }
    }

    public function edit_subscription(Request $request, Response $response)
    {
        if ($request->isPost()) {
            if ($request->post("edit_id")) {
                $id = $request->post("edit_id");

                $params = [
                    'conditions' => "id = :id",
                    'bind' => ['id' => $id]
                ];
                $subscription = Subscriptions::findFirst($params);

                $this->json_response($subscription);
            }

            if ($request->post("action") && $request->post("action") === "update") {
                $id = $request->post("id");

                $params = [
                    'conditions' => "id = :id",
                    'bind' => ['id' => $id]
                ];
                $subscription = Subscriptions::findFirst($params);

                if ($subscription) {
                    $subscription->loadData($request->getBody());
                    if (empty($subscription->getErrors())) {
                        $subscription->save();
                    }
                }
            }
        }
    }

    public function trash_subscription(Request $request, Response $response)
    {
        if ($request->isPost()) {
            if ($request->post("del_id")) {
                $id = $request->post("del_id");

                $params = [
                    'conditions' => "id = :id",
                    'bind' => ['id' => $id]
                ];
                $subscription = Subscriptions::findFirst($params);

                if ($subscription) {
                    $subscription->delete();
                }
            }
        }
    }

    private function generate_excel_subscriptions()
    {
        // Create a new Spreadsheet
        $spreadsheet = new Spreadsheet();
        $worksheet = $spreadsheet->getActiveSheet();

        $data = Subscriptions::find();

        // Define headers
        $worksheet->setCellValue('A1', 'Name');
        $worksheet->setCellValue('B1', 'Amount');
        $worksheet->setCellValue('C1', 'IUC Number');
        $worksheet->setCellValue('D1', 'Decoder Type');
        $worksheet->setCellValue('E1', 'Payment Method');
        $worksheet->setCellValue('F1', 'Note');
        $worksheet->setCellValue('G1', 'Status');
        $worksheet->setCellValue('H1', 'Transaction ID');

        // Start row for data
        $row = 2;

        // Loop through the database data
        foreach ($data as $row_data) {
            $worksheet->setCellValue('A' . $row, $row_data->name); // Name
            $worksheet->setCellValue('B' . $row, $row_data->amount); // Amount
            $worksheet->setCellValue('C' . $row, $row_data->iuc_number); // IUC Method
            $worksheet->setCellValue('D' . $row, $row_data->decoder_type); // Decoder Type
            $worksheet->setCellValue('E' . $row, $row_data->payment_method); // Payment Method
            $worksheet->setCellValue('F' . $row, $row_data->note); // Note
            $worksheet->setCellValue('G' . $row, $row_data->status); // Status
            $worksheet->setCellValue('H' . $row, $row_data->transaction_id); // Transaction ID

            // Increment row counter
            $row++;
        }

        $worksheet->getColumnDimension('A')->setWidth(20);
        $worksheet->getColumnDimension('B')->setWidth(25);
        $worksheet->getColumnDimension('C')->setWidth(20);
        $worksheet->getColumnDimension('D')->setWidth(25);
        $worksheet->getColumnDimension('E')->setWidth(20);
        $worksheet->getColumnDimension('F')->setWidth(30);
        $worksheet->getColumnDimension('G')->setWidth(20);
        $worksheet->getColumnDimension('H')->setWidth(30);

        $border = new Border();
        $border->setBorderStyle(Border::BORDER_THIN);

        $worksheet->getStyle('A1:H1')->getBorders()->applyFromArray([
            'allBorders' => [
                'borderStyle' => Border::BORDER_THIN,
            ],
        ]);


        $fill = new Fill();
        $fill->setFillType(Fill::FILL_SOLID);
        $fill->getStartColor()->setARGB('000000'); // Yellow

        $worksheet->getStyle('A1:H1')->getFill()->applyFromArray([
            'fillType' => Fill::FILL_SOLID,
            'startColor' => [
                'argb' => '000000',
            ],
        ]);


        $font = new Font();
        $font->setBold(true);
        $font->setColor(new Color(Color::COLOR_WHITE));
        $font->setSize(14);

        $worksheet->getStyle('A1:H1')->getFont()->applyFromArray([
            'bold' => true,
            'color' => [
                'rgb' => 'FFFFFF',
            ],
            'size' => 14,
        ]);

        // Save the Excel file
        $writer = new Xlsx($spreadsheet);
        $excelFilename = 'subscriptions.xlsx'; // Change to your desired file name
        $writer->save($excelFilename);

        // Provide download link
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $excelFilename . '"');
        header('Cache-Control: max-age=0');
        readfile($excelFilename);
    }

    private function generate_excel_sales()
    {
        // Create a new Spreadsheet
        $spreadsheet = new Spreadsheet();
        $worksheet = $spreadsheet->getActiveSheet();

        $data = Sales::find();

        // Define headers
        $worksheet->setCellValue('A1', 'Name');
        $worksheet->setCellValue('B1', 'Amount');
        $worksheet->setCellValue('C1', 'Qty');
        $worksheet->setCellValue('D1', 'Payment Method');
        $worksheet->setCellValue('E1', 'Note');

        // Start row for data
        $row = 2;

        // Loop through the database data
        foreach ($data as $row_data) {
            $worksheet->setCellValue('A' . $row, $row_data->name); // Name
            $worksheet->setCellValue('B' . $row, $row_data->amount); // Amount
            $worksheet->setCellValue('C' . $row, $row_data->qty); // Qty
            $worksheet->setCellValue('D' . $row, $row_data->payment_method); // Payment Method
            $worksheet->setCellValue('E' . $row, $row_data->note); // Note

            // Increment row counter
            $row++;
        }

        $worksheet->getColumnDimension('A')->setWidth(20);
        $worksheet->getColumnDimension('B')->setWidth(20);
        $worksheet->getColumnDimension('C')->setWidth(20);
        $worksheet->getColumnDimension('D')->setWidth(25);
        $worksheet->getColumnDimension('E')->setWidth(30);

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
        $excelFilename = 'sales.xlsx'; // Change to your desired file name
        $writer->save($excelFilename);

        // Provide download link
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $excelFilename . '"');
        header('Cache-Control: max-age=0');
        readfile($excelFilename);
    }
}
