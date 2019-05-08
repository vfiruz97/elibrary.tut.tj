<?php
namespace app\assets;

class CategoryAsset extends BaseAsset
{
    public $css = [
        'adminlte/plugins/datatables/css/dataTables.bootstrap.min.css',
        'adminlte/plugins/ladda-bootstrap/css/ladda-themeless.min.css',
    ];
    
    public $js = [
        'adminlte/plugins/moment/moment.min.js',
        'adminlte/plugins/moment/locale/ru.js',
        
        'adminlte/plugins/datatables/js/jquery.dataTables.min.js',
        'adminlte/plugins/datatables/js/dataTables.bootstrap.min.js',
        'adminlte/plugins/tableHeadFixer.js',
        
        'adminlte/plugins/ladda-bootstrap/js/spin.min.js',
        'adminlte/plugins/ladda-bootstrap/js/ladda.min.js',
        
        'adminlte/plugins/jquery-validation/jquery.validate.min.js',
        'adminlte/plugins/bootbox.min.js',
        'pages/scripts/category.js',
    ];
}
