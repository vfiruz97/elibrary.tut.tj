<?php

/* @var $this yii\web\View */
/* @var $book app\models\Book */

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::t('app', 'Силлабусы');

?>
<div class="row">
    <div class="col-xs-12">     
        <?php if (Yii::$app->user->can('addBook')): ?>
            <p class="text-right"><a class="btn btn-primary" href="<?= Url::toRoute('/silabus/add') ?>"> <?= Yii::t('app', 'Добавить силлабус') ?></a></p>
        <?php endif; ?>   
        <div class="box">
            <div class="box-body">
                <table id="silabus-table" class="table table-bordered table-hover filtered-table">
                    <colgroup>
                        <col span="1" />
                        <col span="1" />
                        <col span="1" />
                        <col span="1" />
                    </colgroup>
                    <thead>
                        <tr>
                            <th> <?= Yii::t('app', 'Название силлабуса') ?> </th>
                            <th> <?= Yii::t('app', 'Курс') ?> </th>
                            <th> <?= Yii::t('app', 'Для') ?> </th>
                            <th> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                        </tr>
                        <tr>
                            <th> <?= Html::textInput('name', null, ['class' => 'input-sm form-control filter', 'placeholder' => Yii::t('app','Поиск...'), 'type' => 'search']) ?> </th>
                            <th> &nbsp; </th>
                            <th> 
                                <select class='input-sm form-control filter' id='show_deleted' name='show_deleted'>
                                    <option value="1"><?= Yii::t('app', 'Непоказать удаленные') ?>  </option>
                                    <option value="null"><?= Yii::t('app', 'Показать удаленные') ?></option>
                                    <option value="0"><?= Yii::t('app', 'Показать все') ?></option>                                    
                                </select>
                            </th>
                            <th> &nbsp; </th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
