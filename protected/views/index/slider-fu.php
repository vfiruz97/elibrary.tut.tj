<?php 
use yii\helpers\Html;
?>
<style>
marquee>div {
    position:reletive;
    display:inline-block;
    margin:5px;  
    margin-bottom:0px; 
    height:299px;
    border:6px outset #ddd;
}
<?php print_r($books) ?>
</style>
<div class="row" style="border-top:4px groove #ddd;border-bottom:4px ridge #ddd;"> 
    <marquee onmouseover="this.stop();" onmouseout="this.start();" behavior="alternate">
        <div>
           <a href="#"><?= Html::img("@web/templates/images/slider/1.jpg", ["width"=>"200", "height"=>"290", "class"=>"thumbnail", "title"=>"45"]) ?></a>
        </div>
        <div>
            <a href="#"><?= Html::img("@web/templates/images/slider/2.jpg", ["width"=>"200", "height"=>"290", "class"=>"thumbnail", "title"=>"45"]) ?></a>  
        </div>
        <div>
            <a href="#"><?= Html::img("@web/templates/images/slider/3.jpg", ["width"=>"200", "height"=>"290", "class"=>"thumbnail", "title"=>"45"]) ?></a>
        </div>
        <div>
            <a href="#"><?= Html::img("@web/templates/images/slider/4.jpg", ["width"=>"200", "height"=>"290", "class"=>"thumbnail", "title"=>"45"]) ?></a>
        </div>
        <div>
            <a href="#"><?= Html::img("@web/templates/images/slider/5.jpg", ["width"=>"200", "height"=>"290", "class"=>"thumbnail", "title"=>"45"]) ?></a>
        </div>
        <div>
            <a href="#"><?= Html::img("@web/templates/images/slider/6.jpg", ["width"=>"200", "height"=>"290", "class"=>"thumbnail", "title"=>"45"]) ?></a>
        </div>
        <div>
            <a href="#"><?= Html::img("@web/templates/images/slider/7.jpg", ["width"=>"200", "height"=>"290", "class"=>"thumbnail", "title"=>"45"]) ?></a>
        </div>
        <div>
            <a href="#"><?= Html::img("@web/templates/images/slider/8.jpg", ["width"=>"200", "height"=>"290", "class"=>"thumbnail", "title"=>"45"]) ?></a>
        </div>
        <div>
            <a href="#"><?= Html::img("@web/templates/images/slider/9.jpg", ["width"=>"200", "height"=>"290", "class"=>"thumbnail", "title"=>"45"]) ?></a>
        </div>
        <div>
            <a href="#"><?= Html::img("@web/templates/images/slider/10.jpg", ["width"=>"200", "height"=>"290", "class"=>"thumbnail", "title"=>"45"]) ?></a>
        </div>
        <div>
            <a href="#"><?= Html::img("@web/templates/images/slider/11.jpg", ["width"=>"200", "height"=>"290", "class"=>"thumbnail", "title"=>"45"]) ?></a>
        </div>
        
        <div>
            <a href="#"><?= Html::img("@web/templates/images/slider/5.jpg", ["width"=>"200", "height"=>"290", "class"=>"thumbnail", "title"=>"45"]) ?></a>
        </div>
    </marquee>
</div>
