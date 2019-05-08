<?php

/* @var $this yii\web\View */
/* @var $organizations app\models\Organization */

use yii\helpers\ArrayHelper;
use yii\helpers\Html;

$this->title = Yii::t('app', 'Пользователи');

?>
<div class="row">
        <div class="box">
            <div class="box-body">
                <table id="users-table" class="table table-bordered table-hover filtered-table">
                    <colgroup>
                        <col span="1" />
                        <col span="1" />
                        <col span="1" />
                        <col span="1" />
                        <col span="1" />
                    </colgroup>
                    <thead>
                        <tr>
                            <th> <?= Yii::t('app', 'ФИО') ?></th>
                            <th> <?= Yii::t('app', 'Факультет') ?></th>
                            <th> <?= Yii::t('app', 'Специальности') ?></th>
                            <th> <?= Yii::t('app', 'Электронная почта') ?></th>
                            <th> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                        </tr>
                        <tr>
                            <th> <?= Html::textInput('name-user', null, ['class' => 'input-sm form-control filter', 'placeholder' => Yii::t('app', 'Поиск...'), 'type' => 'search']) ?> </th>
                            <th> <?= Html::dropDownList('faculty', null, ArrayHelper::map($faculty, 'id', 'short_name'), [ 'name' => 'faculty', 'class' => 'input-sm form-control filter', 'prompt' => '']) ?> 
                            </th>
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
            
        <?php if (Yii::$app->user->can('updateUser')): ?>
            <div id="update-user-modal" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"><?= Yii::t('app', 'Редактировать пользователя') ?></h4>
                        </div>
                        <div class="modal-body"><form id="update-user-form"></form></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><?= Yii::t('app', 'Закрыть') ?></button>
                            <button type="button" id="update-user" class="btn btn-success ladda-button" data-style="zoom-out">
                                <span class="ladda-label"><?= Yii::t('app', 'Изменить') ?></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
</div>
