<?php
/**
 * Author: Vorisov Firuz, power_start@mail.ru
 * Date: 05.12.17
 * Time: 15:19
 */
namespace app\assets;

class SilabusAsset extends BaseAsset
{
    public $css = [
        'adminlte/plugins/datatables/css/dataTables.bootstrap.min.css',
        'adminlte/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css',
        'adminlte/plugins/ladda-bootstrap/css/ladda-themeless.min.css',
    ];

    public $js = [
        'adminlte/plugins/moment/moment.min.js',
        'adminlte/plugins/moment/locale/ru.js',
        'adminlte/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js',
        
        'adminlte/plugins/datatables/js/jquery.dataTables.min.js',
        'adminlte/plugins/datatables/js/dataTables.bootstrap.min.js',
        'adminlte/plugins/tableHeadFixer.js',
        
        'adminlte/plugins/ladda-bootstrap/js/spin.min.js',
        'adminlte/plugins/ladda-bootstrap/js/ladda.min.js',
        
        'adminlte/plugins/jquery-validation/jquery.validate.min.js',
        'adminlte/plugins/bootbox.min.js',
        'pages/scripts/silabus.js',
    ];
}
