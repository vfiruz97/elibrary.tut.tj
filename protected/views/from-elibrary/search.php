<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
$this->title = Yii::t('app', 'Книги');
?>
<div class="row">
    <div class="box">
        <div class="box-body">
            <form id="book-search-form" method="GET">
                <div class="panel panel-default">                        
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
                                <a href='/book' style="float:right;margin:0px;padding:0px;"><?= Yii::t('app','Расширенный поиск книг') ?></a>
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
                    <div class="alert alert-success alert-dismissable">
                        <a class="close" data-dismiss="alert" aria-hidden="true">
                            &times;
                        </a>
                        <a target='new' href='/<?= $book->path ?>'><?= $book->name_book ?></a>
                    </div>
                    <?php endforeach; ?>  
                <?php else: ?>
			        <div>
			        	<p class="text-danger"><?= Yii::t('app', 'Извените по вашему запросу в базе нечего не найдено!') ?></p>
			        </div>
			    <?php endif; ?>
            	</div> 
                <div class="text-center"> 
                    <?= LinkPager::widget(['pagination' => $pages,]); ?> 
                </div>
            </div>
        </div>
    </div>
</div>
