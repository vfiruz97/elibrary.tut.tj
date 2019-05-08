<?php
/*
* photo derictory @web/templates/images/right-blocks/...
*/
use yii\helpers\Html;

?>
<br>
    <div class="prezident" style="border-bottom:1px solid white">
	    <a href="/rightblock/prezident">
		    <?= Html::img('@web/templates/images/right-blocks/prezident.jpg', [ 'class' => 'thumbnail img-responsive', 'style'=>'margin:0px']) ?>
		    <div align='center' style="color:white;font-weight:bold">Китоб дар радифи Модар ва Ватан арзандатарин муқаддасот ба ҳисоб меравад.</div>
		   
	    </a>
	 </div>
	 <div style="margin-bottom:15px">
        <?php if ( Yii::$app->language == "ru-RU" ) {
            echo Html::img('@web/templates/images/right-blocks/logo(ru).gif', [ 'class' => 'img-responsive', 'alt' => "E-library.tut", 'title'=>"E-library.tut" ,'style'=>'margin:0px']);
        } else {
            echo Html::img('@web/templates/images/right-blocks/logo(tj).gif', [ 'class' => 'img-responsive', 'alt' => "E-library.tut", 'title'=>"E-library.tut" ,'style'=>'margin:0px']);
        } ?>
    </div> 
	 <div class="prezident">
	    <a href="/rightblock/news/parcham">
		    <?= Html::img('@web/templates/images/right-blocks/parcham.jpg', [ 'class' => 'thumbnail img-responsive', 'style'=>'margin:0px']) ?>
		    <div align='center' style="font-weight:bold;color:white;">«ПАРЧАМ – РАМЗИ ИСТИҚЛОЛИЯТ!»</div>
		    <hr/>
	    </a>
	 </div>
	 <div class="prezident">
	    <a href="/rightblock/news/asarho">
		    <?= Html::img('@web/templates/images/right-blocks/namoish.jpg', [ 'class' => 'thumbnail img-responsive', 'style'=>'margin:0px']) ?>
		    <div align='center' style="font-weight:bold;color:white;">Намоиши асарҳои Асосгузори Сулҳу Ваҳдати Миллӣ...</div>
		    <hr/>
	    </a>
	 </div>
	 <div class="prezident">
	    <a href="/rightblock/news/guzorish">
		    <?= Html::img('@web/templates/images/right-blocks/guzorish.jpg', [ 'class' => 'thumbnail img-responsive', 'style'=>'margin:0px']) ?>
		    <div align='center' style="font-weight:bold;color:white;">Гузориш таҳти унвони «Роҳандозии равандҳои инноватсионӣ...</div>
		    <hr/>
	    </a>
	 </div>
	 <div class="prezident">
	    <a href="/rightblock/news/guzorish1">
		    <?= Html::img('@web/templates/images/right-blocks/guzorish1.jpg', [ 'class' => 'thumbnail img-responsive', 'style'=>'margin:0px']) ?>
		    <div align='center' style="font-weight:bold;color:white;">Гузориши ҷараёни ташкил ва баргузории семинар таҳти унвони...</div>
		    <hr/>
	    </a>
	 </div>
