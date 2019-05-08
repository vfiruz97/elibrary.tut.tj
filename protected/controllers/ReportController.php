<?php
namespace app\controllers;

use DateTime;
use Yii;
use PhpOffice\PhpSpreadsheet\Cell;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use app\assets\ReportAsset;
use app\models\report\ReportReadBook;
use app\models\report\DownloadBook;

class ReportController extends BaseController
{
    public function init()
    {
        parent::init();

        ReportAsset::register($this->view);
    }

    public function actionReportReadBook()
    {

        if (Yii::$app->user->can('readReport')) {

            $report = new ReportReadBook();

            if (Yii::$app->request->isPost) {
                $report->load(Yii::$app->request->post());
                $report->process();

                return $this->renderPartial('partial/report-book-read', [
                    'report'    => $report,
                ]);
            } else {
                $report->start_date     = (new DateTime('today'))->format('Y-m-d');
                $report->end_date       = (new DateTime('tomorrow'))->format('Y-m-d');
                $report->date_of_report = (new DateTime('today'))->format('Y-m-d');

                return $this->render('report-book-read', [
                    'report'    => $report,
                ]);
            }
        }
    }
    
    public function actionDownload()
    {
        if (Yii::$app->user->can('readReport')) {

            $report = new DownloadBook();

            if (Yii::$app->request->isPost) {
                $report->load(Yii::$app->request->post());
                $report->process();

                return $this->renderPartial('partial/report-book-download', [
                    'report'    => $report,
                ]);
            } else {
                $report->start_date     = (new DateTime('today'))->format('Y-m-d');
                $report->end_date       = (new DateTime('tomorrow'))->format('Y-m-d');
                $report->date_of_report = (new DateTime('today'))->format('Y-m-d');

                return $this->render('report-book-download', [
                    'report'    => $report,
                ]);
            }
        }
    }

    
    public function actionExportToExcel($command = null)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Default styles
        $spreadsheet->getDefaultStyle()->getFont()->setSize(8);
        $spreadsheet->getDefaultStyle()->getAlignment()->setVertical(Alignment::VERTICAL_TOP);

        switch ($command) {            
            case 'report-read-book':
                $report = new ReportReadBook();
                $report->load(Yii::$app->request->post());

                $report->process();
                if ($report->processed) {
                    // Генерация отчета
                    $spreadsheet->getProperties()->setTitle(Yii::t('app', 'Отчеты'));

                    $sheet
                        ->mergeCells('A1:I1');

                    $sheet->getStyle('A1:I2')->getFont()->setBold(true);
                    $sheet->getStyle('A1:I2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                    $sheet->getStyle('A1:I2')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
                    $sheet->getStyle("A1:I2")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('003366');
                    $sheet->getStyle('A1:I2')->getFont()->setBold(true)->getColor()->setRGB('ffffff');
                    
                    $sheet->getColumnDimension('A')->setWidth(4);
                    $sheet->getColumnDimension('B')->setWidth(25);
                    $sheet->getColumnDimension('C')->setWidth(20);
                    $sheet->getColumnDimension('D')->setWidth(15);
                    $sheet->getColumnDimension('E')->setWidth(15);
                    $sheet->getColumnDimension('F')->setWidth(15);
                    $sheet->getColumnDimension('G')->setWidth(15);
                    $sheet->getColumnDimension('H')->setWidth(15);
                    $sheet->getColumnDimension('I')->setWidth(15);
                    $sheet->getRowDimension(1)->setRowHeight(20);
                    $sheet->getRowDimension(2)->setRowHeight(40);

                    $sheet
                        ->setCellValue('A1', Yii::t('app', 'Отчет за '). $report->date_of_report)
                        
                        ->setCellValue('A2', '№')
                        ->setCellValue('B2', Yii::t('app', 'ФИО студента'))
                        ->setCellValue('C2', Yii::t('app', 'Факультет'))
                        ->setCellValue('D2', Yii::t('app', 'Специальности'))
                        ->setCellValue('E2', Yii::t('app', 'Названия книга'))
                        ->setCellValue('F2', Yii::t('app', 'Категория'))
                        ->setCellValue('G2', Yii::t('app', 'Подкатегория'))
                        ->setCellValue('H2', Yii::t('app', 'Автор книги'))
                        ->setCellValue('I2', Yii::t('app', 'Дата время'));

                    if ($report->hasData()) {
                        $rowIndex = 3;
                        foreach ($report->data as $index => $row) {             
                            $sheet
                                ->setCellValue("A${rowIndex}", ++$index)
                                ->setCellValue("B${rowIndex}", $row->user)
                                ->setCellValue("C${rowIndex}", $row->faculty_ru)
                                ->setCellValue("D${rowIndex}", $row->speciality_ru)
                                ->setCellValue("E${rowIndex}", $row->book)
                                ->setCellValue("F${rowIndex}", $row->category_ru)
                                ->setCellValue("G${rowIndex}", $row->subcategory_ru)
                                ->setCellValue("H${rowIndex}", $row->author)
                                ->setCellValue("I${rowIndex}", $row->created_at_time);

                            $rowIndex++;
                        }

                        $rowIndex--;
                        $sheet->getStyle("A1:I${rowIndex}")->getAlignment()->setWrapText(true);
                        $sheet
                            ->getStyle("A1:I${rowIndex}")
                            ->applyFromArray([
                                'borders' => [
                                    'allborders' => [
                                        'style' => Border::BORDER_THIN,
                                        'color' => [
                                            'rgb' => '000000',
                                        ],
                                    ],
                                ],
                            ]);
                    }
                }
            break;
            
            case 'download':
                $report = new DownloadBook();
                $report->load(Yii::$app->request->post());

                $report->process();
                if ($report->processed) {
                    // Генерация отчета
                    $spreadsheet->getProperties()->setTitle(Yii::t('app', 'Отчеты'));

                    $sheet
                        ->mergeCells('A1:I1');

                    $sheet->getStyle('A1:I2')->getFont()->setBold(true);
                    $sheet->getStyle('A1:I2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                    $sheet->getStyle('A1:I2')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
                    $sheet->getStyle("A1:I2")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('003366');
                    $sheet->getStyle('A1:I2')->getFont()->setBold(true)->getColor()->setRGB('ffffff');
                    
                    $sheet->getColumnDimension('A')->setWidth(4);
                    $sheet->getColumnDimension('B')->setWidth(25);
                    $sheet->getColumnDimension('C')->setWidth(20);
                    $sheet->getColumnDimension('D')->setWidth(15);
                    $sheet->getColumnDimension('E')->setWidth(15);
                    $sheet->getColumnDimension('F')->setWidth(15);
                    $sheet->getColumnDimension('G')->setWidth(15);
                    $sheet->getColumnDimension('H')->setWidth(15);
                    $sheet->getColumnDimension('I')->setWidth(15);
                    $sheet->getRowDimension(1)->setRowHeight(20);
                    $sheet->getRowDimension(2)->setRowHeight(40);

                    $sheet
                        ->setCellValue('A1', Yii::t('app', 'Отчет за '). $report->date_of_report)
                        
                        ->setCellValue('A2', '№')
                        ->setCellValue('B2', Yii::t('app', 'ФИО студента'))
                        ->setCellValue('C2', Yii::t('app', 'Факультет'))
                        ->setCellValue('D2', Yii::t('app', 'Специальности'))
                        ->setCellValue('E2', Yii::t('app', 'Названия книга'))
                        ->setCellValue('F2', Yii::t('app', 'Категория'))
                        ->setCellValue('G2', Yii::t('app', 'Подкатегория'))
                        ->setCellValue('H2', Yii::t('app', 'Автор книги'))
                        ->setCellValue('I2', Yii::t('app', 'Дата время'));

                    if ($report->hasData()) {
                        $rowIndex = 3;
                        foreach ($report->data as $index => $row) {             
                            $sheet
                                ->setCellValue("A${rowIndex}", ++$index)
                                ->setCellValue("B${rowIndex}", $row->user)
                                ->setCellValue("C${rowIndex}", $row->faculty_ru)
                                ->setCellValue("D${rowIndex}", $row->speciality_ru)
                                ->setCellValue("E${rowIndex}", $row->book)
                                ->setCellValue("F${rowIndex}", $row->category_ru)
                                ->setCellValue("G${rowIndex}", $row->subcategory_ru)
                                ->setCellValue("H${rowIndex}", $row->author)
                                ->setCellValue("I${rowIndex}", $row->created_at_time);

                            $rowIndex++;
                        }

                        $rowIndex--;
                        $sheet->getStyle("A1:I${rowIndex}")->getAlignment()->setWrapText(true);
                        $sheet
                            ->getStyle("A1:I${rowIndex}")
                            ->applyFromArray([
                                'borders' => [
                                    'allborders' => [
                                        'style' => Border::BORDER_THIN,
                                        'color' => [
                                            'rgb' => '000000',
                                        ],
                                    ],
                                ],
                            ]);
                    }
                }
            break;

        }

        // Redirect output to a client’s web browser (Xls)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $command . '.xls"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xls');
        $writer->save('php://output');
        exit;
    }
}
