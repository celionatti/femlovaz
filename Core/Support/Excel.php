<?php

declare(strict_types=1);

namespace App\Core\Support;

use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;


class Excel
{
    public $worksheet;
    public $spreadsheet;
    public int $row = 2;
    public $data;

    public function __construct($data)
    {
        // Create a new Spreadsheet
        $this->spreadsheet = new Spreadsheet();
        $this->worksheet = $this->spreadsheet->getActiveSheet();

        $this->data = $data;  
    }

    public function headers_column(string $column, string $value)
    {
        // Define headers
        $this->worksheet->setCellValue($column, $value);
    }

    public function set_data($column, $value)
    {
        $this->row;

        foreach ($this->data as $row_data) {
            $this->headers_column($column, $value);
        }
        $this->row++;
    }

    public function set_width(string $column, int $size)
    {
        $this->worksheet->getColumnDimension($column)->setWidth($size);
    }

    /**
     * @param string $columns = "A1:C1"
     */

    public function border($columns)
    {
        $border = new Border();
        $border->setBorderStyle(Border::BORDER_THIN);

        $this->worksheet->getStyle($columns)->getBorders()->applyFromArray([
            'allBorders' => [
                'borderStyle' => Border::BORDER_THIN,
            ],
        ]);
    }

    public function fill()
    {
        $fill = new Fill();
        $fill->setFillType(Fill::FILL_SOLID);
        $fill->getStartColor()->setARGB('000000'); // Yellow

        $this->worksheet->getStyle('A1:F1')->getFill()->applyFromArray([
            'fillType' => Fill::FILL_SOLID,
            'startColor' => [
                'argb' => '000000',
            ],
        ]);
    }

    public function font()
    {
        $font = new Font();
        $font->setBold(true);
        $font->setColor(new Color(Color::COLOR_WHITE));
        $font->setSize(14);

        $this->worksheet->getStyle('A1:F1')->getFont()->applyFromArray([
            'bold' => true,
            'color' => [
                'rgb' => 'FFFFFF',
            ],
            'size' => 14,
        ]);
    }

    public function save(string $filename)
    {
        // Save the Excel file
        $writer = new Xlsx($this->spreadsheet);
        $excelFilename = $filename; // Change to your desired file name
        $writer->save($excelFilename);

        // Provide download link
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $excelFilename . '"');
        header('Cache-Control: max-age=0');
        readfile($excelFilename);
    }
}
