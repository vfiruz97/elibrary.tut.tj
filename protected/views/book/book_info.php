<?php
use yii\helpers\Html;
$postfix='name_tj'; $indexLang= "tj";
if ( 'ru-RU' == Yii::$app->language) { $postfix='name_ru'; $indexLang= "ru"; }
if ( $book):
?>
<div class="row"><hr>
    <style type="text/css">
	    .info_book{
		    display:inline;
	    }
    </style>        
    <?php $language = Yii::$app->language ?>
    <input type='hidden' id="book_id" value='<?= $book->id ?>'>
    <div class="col-lg-12">
        <div class="panel panel-info">
            <div class="panel-heading" align = 'right'>
                <?php if(Yii::$app->user->isGuest) : ?>
                    <a href='/session/logout'>Читать" и "Скачать" - станеть доступен после авторизации</a>
                <?php else : ?>                
                <a onclick="javascript:history.go(-1);return false;" class='btn btn-success'><i class="fa fa-arrow-left" aria-hidden="true"></i> <?= Yii::t('app','Назад') ?></a>
                <a href="read?id=<?= $book->id ?>" target='new' class='read-book btn btn-success'><i class="fa fa-book"></i> <?= Yii::t('app','Читать') ?></a>
                <a href="../<?= $book->path ?>" download target="_blank" class="download btn btn-success" <?php if(Yii::$app->user->isGuest) echo "disabled"; ?> ><i class="fa fa-file-pdf-o"></i> <?= Yii::t('app','Скачать') ?></a> 
                <?php endif; ?>                 
            </div>
            <div class="panel-body">
                
                 <div class="panel panel-info"> 
                   <?php  if ($book->lang_book =='ru') $book->lang_book = Yii::t('app', 'русский'); else $book->lang_book =Yii::t('app', 'таджикский'); ?>
                    <div class="row">                    
                        <div class="col-md-3">
                            <?= Html::img('@web/'.$book->path_photo.' ',['width'=>'200', 'class' => 'thumbnail img-responsive', 'style' => 'margin:5px; width:200', 'alt' => 'loading-image...', 'title' => $book->name_book ]) ?>
                        </div>   
                        <div class="col-md-9" style="">
                            <div class="row">
                                <div class="col-md-12">
                                    <?= "<h3 >$book->name_book</h3>" ?> 
                                </div>  
                                <div class="col-md-12"><br>
                                    <?php 
                                    if ( $indexLang == 'tj')
                                        echo Yii::t('app', 'Категория').": <h4 class='info_book'>$book->category_tj</h4>";
                                    else 
                                        echo Yii::t('app', 'Категория').": <h4 class='info_book'>$book->category_ru</h4>"; ?> 
                                </div> 
                                <div class="col-md-12">
                                    <?php 
                                        if ( $indexLang == 'tj')
                                            echo Yii::t('app', 'Подкатегория').": <h4 class='info_book'>$book->subcategory_tj</h4>";
                                        else
                                            echo Yii::t('app', 'Подкатегория').": <h4 class='info_book'>$book->subcategory_ru</h4>"; ?>
                                </div> 
                                <div class="col-md-12">
                                    <?= Yii::t('app', 'Автор книги').": <h4 class='info_book'>$book->author</h4>" ?> 
                                </div>    
                                <div class="col-md-12">
                                    <?= Yii::t('app', 'Язык книги').": <h4 class='info_book'>$book->lang_book</h4>" ?> 
                                </div> 
                                <div class="col-md-12">
                                    <?= Yii::t('app', 'Просмотрено').": <h4 class='info_book'><code>$view->view</code></h4>" ?> 
                                </div>
                                <div class="col-md-12">
                                    <p align="justify"><i class="fa fa-thumbs-o-up" aria-hidden="true"> <?= round($mark->marks/$mark->iden,1) ?> </i></p> 
                                </div>                        
                            </div>                           
                        </div>   
                                              
                        <div class="col-md-12">
                            <p align="center"><big><?= Yii::t('app', 'Краткое описание') ?> </big></p>
                            <p style="margin:10px;text-indent:50px;" align="justify"> <?= $book->description ?> </p> 
                        </div>                 
                    </div>                     
                </div>
                
            </div>
            <div class="panel-footer">
                <div class="form-group" >
                    <form id="w0" method="post">
                        <input type="hidden" name="_csrf" value="bhrRCmHr24-wfkbzGwOz8NaV4wiSYqzoyIzgUuDlXMIme4teJaaj6ts9dpx_c4O-4M_UXOIO35iq1YsHlLIslQ==">	
                        <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
                        <?= Html::hiddenInput('id', $book->id) ?>
                        <?= Html::hiddenInput('book_id', $book->name_book) ?>
                        <p align="center">
                            <input type="radio" name='mark' value="1" title=" 1 ">
                            <input type="radio" name='mark' value="2" title=" 2 ">
                            <input type="radio" name='mark' value="3" title=" 3 ">
                            <input type="radio" name='mark' value="4" title=" 4 ">
                            <input type="radio" name='mark' value="5" title=" 5 ">
                            <input type="radio" name='mark' value="6" title=" 6 ">
                            <input type="radio" name='mark' value="7" title=" 7 ">
                            <input type="radio" name='mark' value="8" title=" 8 ">
                            <input type="radio" name='mark' value="9" title=" 9 ">
                            <input type="radio" name='mark' value="10" title="10" checked>
                            <?= Html::submitButton(Yii::t('app', 'Оцените!'), ['class'=>'btn btn-outline btn-primary btn-xs', 'style'=>'margin-top:-10px']) ?> 
                        </p>
                    </form>
                </div>
                <div class="form-group">
                    <form id="w0" method="post">
                        <input type="hidden" name="_csrf" value="bhrRCmHr24-wfkbzGwOz8NaV4wiSYqzoyIzgUuDlXMIme4teJaaj6ts9dpx_c4O-4M_UXOIO35iq1YsHlLIslQ==">	
                        <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
                        <?= Html::hiddenInput('id', $book->id) ?>
                        <?= Html::activeTextarea($model_comment, 'comment', ['class'=>'form-control','rows'=>5,'placeholder'=>Yii::t('app', 'Коментарий'), 'value'=>'' , 'required'=>'', 'minlength'=>3 ]) ?>                     
                        <p align='right'><?= Html::submitButton(Yii::t('app', 'Добавить'), ['class' => 'btn btn-link']) ?><i class="fa fa-flickr"></i></p>  
                   </form>
                </div>
                
                <div class="panel panel-default">
                    <div class="panel-body">
                    <?php if ($comment): ?>    
                    <?php foreach ($comment as $key => $comment ): ?>
                        <h5 style="font-size:16px;font-weight:bold;margin-bottom:0px"><?= $comment->username ?></h5>
                        <blockquote>
                            <p style="font-size:14px;margin-bottom:0px"><i><?= $comment->comment ?></i></p>
                        </blockquote>
                    <?php endforeach; ?>  
                    <?php endif; ?> 
                    </div>
                    <!-- /.panel-body -->
                </div>
                                    
            </div>
        </div>
    </div>
</div>
<?php else: ?>
    <div>
    	<p class="text-danger"><?= Yii::t('app', 'Извените по вашему запросу в базе нечего не найдено!') ?></p>
    </div>
<?php endif; ?> 


<script>
window.onload = function(){
     Download(); //Podcategory zavisit ot Category
};
function Download(){  
    $(".download").on('click', function(){    
        var id = $("#book_id").val();
            $.ajax({
                url: '/book/download',
                type: 'GET',
                dataType: 'json',
                data: { id: id }
            });
        });
    };
</script>
