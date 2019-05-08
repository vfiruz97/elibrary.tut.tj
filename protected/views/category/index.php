<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::t('app', 'Категория');
?>
<div class="row">
    <div class="col-xs-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#category-tab" data-toggle="tab"><?= Yii::t('app', 'Категория') ?></a></li>
                <?php if (Yii::$app->user->can('readCategory')): ?>
                    <li><a href="<?= Url::toRoute('/category/subcategory') ?>"><?= Yii::t('app', 'Подкатегория') ?></a></li>
                <?php endif; ?>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="category-tab">
                    <?php if (Yii::$app->user->can('readCategory')): ?>
                        <p style="margin-top:5px" class="text-right"><button class="btn btn-primary" data-toggle="modal" data-target="#create-category-modal"><?= Yii::t('app', 'Добавить') ?></button></p>

                        <div id="create-category-modal" class="modal fade" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title"><?= Yii::t('app', 'Добавить данные по категорию') ?></h4>
                                    </div>
                                    <div class="modal-body"><form id="create-category-form" class="form-horizontal category-form category-form-container"></form></div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal"><?= Yii::t('app', 'Закрыть') ?></button>
                                        <button type="button" id="create-category" class="btn btn-success ladda-button" data-style="zoom-out">
                                            <span class="ladda-label"><?= Yii::t('app', 'Добавить') ?></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <table id="category-table" class="table table-bordered table-condensed table-hover filtered-table">
                        <colgroup>
                            <col/>
                            <col/>
                            <col/>
                            <col/>
                            <col width="120"/>
                        </colgroup>
                        <thead>
                            <tr>
                                <th> <?= Yii::t('app', 'ID') ?> </th>
                                <th> <?= Yii::t('app', 'Название категории на русском') ?> </th>
                                <th> <?= Yii::t('app', 'Номи категория ба тоҷикӣ') ?> </th>
                                <th> <?= Yii::t('app', 'Дата регистрации') ?> </th>
                                <th> &nbsp; </th>
                            </tr>
                            <tr>
                                <th> &nbsp; </th>
                                <th> &nbsp; </th>
                                <th> &nbsp; </th>
                                <th> 
                                    <select class="input-sm form-control filter" id="show_deleted" name="show_deleted">
                                        <option value="1"><?= Yii::t('app', 'Непоказать удаленные') ?></option>
                                        <option value="null"><?= Yii::t('app', 'Показать удаленные') ?></option>
                                        <option value="0"><?= Yii::t('app', 'Показать все') ?></option>                                    
                                    </select>
                                </th>
                                <th> &nbsp; </th>                                
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>

                    <?php if (Yii::$app->user->can('updateCategory')): ?>
                        <div id="update-category-modal" class="modal fade" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title"><?= Yii::t('app', 'Изменить данные по категорию') ?></h4>
                                    </div>
                                    <div class="modal-body"><form id="update-category-form" class="form-horizontal category-form category-form-container"></form></div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal"><?= Yii::t('app', 'Закрыть') ?></button>
                                        <button type="button" id="update-category" class="btn btn-success ladda-button" data-style="zoom-out">
                                            <span class="ladda-label"><?= Yii::t('app', 'Изменить') ?></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
