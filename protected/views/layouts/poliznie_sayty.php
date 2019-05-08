<?php
    use yii\helpers\Html;
?>
<style>
    div.poleznie-sayty > a {
        color:white;        
    }
</style>
<div class="hidden-xs poleznie-sayty" style="background-color:#0e4c95; color:white;">
<i><b><?= Yii::t('app', 'Полезные сайты:') ?></i></b><br>

<a target='new_blank' href='http://www.tut.tj' >www.tut.tj</a><br>
<a target='new_blank' href='http://www.kmt.tj'>www.kmt.tj</a><br>
<a target='new_blank' href='http://www.gpbt.tj'>www.gpbt.tj</a><br>
<a target='new_blank' href='http://www.lanbook.ru'>www.lanbook.ru</a><br>
<a target='new_blank' href='http://www.twirpx.com'>www.twirpx.com</a><br>
<a target='new_blank' href='http://www.isuct.ru'>www.isuct.ru</a><br>
<a target='new_blank' href='http://www.eapatis.com'>www.eapatis.com</a><br>

<a href='http://www.upc.tj' target='new'><?= Html::img("@web/templates/images/footer/upc.png", ["class" => "img-responsive imfoot", "alt"=>"logo", 'title'=>"Сайт разработчиков группа UP",'style'=>"width:35px;margin:0px"]) ?><span style="color:white; font-size:10px;">@cайт разработчиков UPC</span><br>www.upc.tj
</a>
</div>
