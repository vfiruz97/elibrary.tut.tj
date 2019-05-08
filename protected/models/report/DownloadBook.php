<?php
namespace app\models\report;

use stdClass;
use Yii;
use yii\base\Model;
use yii\db\Query as DbQuery;
use app\models\Base;
use app\models\Download;

class DownloadBook extends Base
{
    // Начало периода
    public $start_date;
    // Окончание периода
    public $end_date;
    // Дата отчета
    public $date_of_report;
    // Индикатор успешной обработки отчета
    public $processed = false;
    // Результирующий набор данных
    public $data = [];
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['start_date', 'end_date', 'date_of_report'], 'required'],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'start_date'    => Yii::t('app', 'От даты'),
            'end_date'      => Yii::t('app', 'До даты'),
            'date_of_report'=> Yii::t('app', 'Дата отчета'),
        ];
    }

    public function process()
    {
        if ($this->validate()) {
            $this->processed = true;

            $report = (new DbQuery())->from(Download::tableName())->where('created_at_time BETWEEN :startDate AND :endDate AND status = 1', [
                    ':startDate' => $this->start_date,
                    ':endDate'   => $this->end_date,
                ])->orderBy('id');


            if ($report->count()) {
                foreach ($report->all() as $report) {

                    $row = $this->_createRow();

                    $row->user              = $report['user'];
                    $row->faculty_ru        = $report['faculty_ru'];
                    $row->faculty_tj        = $report['faculty_tj'];
                    $row->speciality_ru     = $report['speciality_ru'];
                    $row->speciality_tj     = $report['speciality_tj'];
                    $row->book              = $report['book'];
                    $row->category_ru       = $report['category_ru'];
                    $row->category_tj       = $report['category_tj'];
                    $row->subcategory_ru    = $report['subcategory_ru'];
                    $row->subcategory_tj    = $report['subcategory_tj'];
                    $row->author            = $report['author'];
                    $row->created_at_time   = $report['created_at_time'];

                    $this->data[] = $row;
                }
            }
        }
    }

    public function hasData()
    {
        return !empty($this->data);
    }

    private function _createRow()
    {
        $blank = new stdClass();

        $blank->user            = null;
        $blank->faculty_ru      = null;
        $blank->faculty_tj      = null;
        $blank->speciality_ru   = null;
        $blank->speciality_tj   = null; 
        $blank->book            = null;
        $blank->category_ru     = null;
        $blank->category_tj     = null;
        $blank->subcategory_ru  = null;
        $blank->subcategory_tj  = null;
        $blank->author          = null;
        $blank->created_at_time = null;

        return $blank;
    }

}
