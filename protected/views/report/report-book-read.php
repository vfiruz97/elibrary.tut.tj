<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;

$this->title = Yii::t('app', 'Отчеты');
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-body">
                <form id="book-report-search-form" method="POST">
                    <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>

                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-4 col-sm-4">
                                    <div class="form-group">
                                        <label class="control-label"><?= $report->getAttributeLabel('start_date') ?></label>
                                        <div class="input-group date-picker">
                                            <?= Html::activeTextInput($report, 'start_date', ['class' => 'input-sm form-control', 'readonly' => 'readonly']) ?>
                                            <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-4">
                                    <div class="form-group">
                                        <label class="control-label"><?= $report->getAttributeLabel('end_date') ?></label>
                                        <div class="input-group date-picker">
                                            <?= Html::activeTextInput($report, 'end_date', ['class' => 'input-sm form-control', 'readonly' => 'readonly']) ?>
                                            <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-4">
                                    <div class="form-group">
                                        <label class="control-label"><?= $report->getAttributeLabel('date_of_report') ?></label>
                                        <div class="input-group date-picker">
                                            <?= Html::activeTextInput($report, 'date_of_report', ['class' => 'input-sm form-control', 'readonly' => 'readonly']) ?>
                                            <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <button type="button" class="btn btn-sm btn-primary search ladda-button" data-style="zoom-out">
                                <span class="ladda-label"><i class="fa fa-fw fa-search"></i> <?= Yii::t('app', 'Поиск') ?></span>
                            </button>
                            <button type="button" class="btn btn-sm btn-default reset"><?= Yii::t('app', 'Очистить') ?></button>
                        </div>
                    </div>
                </form>

                <div id="book-report-result"></div>
            </div>
        </div>
    </div>
</div>
