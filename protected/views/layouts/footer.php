<?php 
use yii\helpers\Html;

?>
<style>
.imfoot {
    display:inline-block;
    width:65px;
    margin:2px 10px;
    top:0px;
}
</style>
<p align="center">
    <a href='http://www.tut.tj' target='new'>
        <?= Html::img("@web/templates/images/footer/tut.png", [ "class" => "img-responsive imfoot", "alt"=>"logo"]) ?>
    </a>
    <a href='http://www.elibrary.tut.tj' target='new'>
        <?= Html::img("@web/templates/images/footer/library.jpg", [ "class" => "img-responsive imfoot", 'style' =>'width:105px', "alt"=>"logo"]) ?>
    </a>
    
    <a href='http://www.tut.tj' target='new'>
        <?= Html::img("@web/templates/images/footer/ob.png", [ "class" => "img-responsive imfoot", "alt"=>"logo"]) ?>
    </a>
    <a href='http://www.tut.tj' target='new'>
        <?= Html::img("@web/templates/images/footer/javonon.png", [ "class" => "img-responsive imfoot", "alt"=>"logo"]) ?>
    </a>
    <a href='http://www.tut.tj' target='new'>
        <?= Html::img("@web/templates/images/footer/erasmus.png", [ "class" => "img-responsive imfoot", "alt"=>"logo"]) ?>
    </a>
    <a href='http://www.tut.tj' target='new'>
        <?= Html::img("@web/templates/images/footer/eco.png", [ "class" => "img-responsive imfoot", "alt"=>"logo"]) ?>
    </a>
    <a href='http://www.tut.tj' target='new'>
        <?= Html::img("@web/templates/images/footer/cisco.png", [ "class" => "img-responsive imfoot", "alt"=>"logo"]) ?>
    </a>
    <a href='http://www.upc.tj' target='new'>
        <?= Html::img("@web/templates/images/footer/upc.png", [ "class" => "img-responsive imfoot", "alt"=>"logo", 'title'=>"Сайт разработчиков"]) ?>
    </a>
     <p align="center" style="right:0px;bottom:0px;"><b>
      Library.tut.tj &copy; 2017 </b></p>
</p>
