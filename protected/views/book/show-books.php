<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
$this->title = Yii::t('app', 'Книги');
$postfix='name_tj'; $indexLang= "tj";
if ( 'ru-RU' == Yii::$app->language) { $postfix='name_ru'; $indexLang= "ru"; }
?>
<style type="text/css">
	.info_book{
		display:inline;
	}
</style>
<div class="row">
    <div class="box">
        <div class="box-body">
            <form id="book-search-form" method="GET" action="/book/">
                <?php //= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">                        
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><?= Yii::t('app', 'Категория') ?></label>
                                    <?= Html::activeDropDownList($models, 'category_book_id', ArrayHelper::map($category, 'id', $postfix), ['class' => 'form-control', 'prompt' => '', 'name'=>'category_book_id']) ?>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><?= Yii::t('app', 'Подкатегория') ?></label>
                                    <?= Html::activeDropDownList($models, 'subcategory_book_id', ArrayHelper::map($subcategory, 'id', $postfix), ['class' => 'form-control', 'prompt' => '', 'name'=>'subcategory_book_id']) ?>
                                </div>
                            </div>  
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><?= Yii::t('app', 'Язык книги') ?></label>
                                    <?= Html::activeDropDownList($models, 'lang_book_id', [
						                ''      => Yii::t('app', 'Показать все'),
						                'tj'	=> Yii::t('app', 'таджикский'),
						                'ru'    => Yii::t('app', 'русский'),
						            ], ['class' => 'form-control', 'name'=>'lang_book_id']) ?>
                                </div>
                            </div> 
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><?= Yii::t('app', 'Автор книги') ?></label>
                                    <?= Html::activeTextInput($models, 'name_author', ['class' => 'form-control', 'placeholder'=> Yii::t('app', 'Автор книги'), 'name'=>'name_author']) ?>
                                </div>
                            </div> 
                        </div>                            
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-md-12" >
                                <div class="form-group input-group">
                                    <?= Html::activeTextInput($models, 'name_book_id', ['class' => 'form-control','name'=>'name_book_id', 'placeholder'=> Yii::t('app', 'Поиск...') ]) ?>
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="submit"><?= Yii::t('app','Поиск') ?> <i class="fa fa-search"> </i>
                                        </button>
                                    </span>
                                    <span class="input-group-btn">
                                        <a href='/darhost/' class="btn btn-default"><?= Yii::t('app','Дархост') ?>
                                        </a>
                                    </span>
                                </div>
                                <a href='/from-elibrary/search' style="float:right;margin:0px;padding:0px;"><?= Yii::t('app','Поиск книги из дополнительный ДБ E-library') ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-md-12">
                <div class="well well-lg">
                    <div id="book-result">   
                    <?php if ($model): ?>    
                    <?php foreach ($model as $key => $book ): ?>
                <div class="panel panel-info"> 
                   <?php  if ($book->lang_book =='ru') $book->lang_book = Yii::t('app', 'русский'); else $book->lang_book =Yii::t('app', 'таджикский'); ?>
                    <div class="row">                    
                        <div class="col-md-3"><?= "<a href='/book/book-info?id=$book->id'>" ?>
                            <?= Html::img('@web/'.$book->path_photo.' ',['width'=>'200', 'class' => 'thumbnail img-responsive', 'style' => 'margin:5px; width:200', 'alt' => 'loading-image...', 'title' => $book->name_book ]) ?>
                        </div>   
                        <div class="col-md-9" style="">
                            <div class="row">
                                <div class="col-md-12">
                                    <?= "<h3 align='center'> $book->name_book</a></h3>" ?> 
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
                            </div>                           
                        </div>                  
                    </div>
                </div>
                <?php endforeach; ?>  
                <?php else: ?>
			        <div>
			        	<p class="text-danger"><?= Yii::t('app', 'Извените по вашему запросу в базе нечего не найдено!') ?></p>
			        </div>
			    <?php endif; ?>                     
                </div>
            	</div> 
                <div class="text-center"> 
                    <?= LinkPager::widget(['pagination' => $pages,]); ?> 
                </div>
            </div>
        </div>
    </div>
</div>
