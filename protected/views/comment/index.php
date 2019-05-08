<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

$this->title = Yii::t('app', 'Новые комментарии');

?>
<div class="row">
    <div class="box">
        <div class="box-body">
            <table id="comments-table" class="table table-bordered table-hover filtered-table">
                <colgroup>
                    <col span="1" />
                    <col span="1" />
                    <col span="1" width='80' />
                </colgroup>
                <thead>
                    <tr>
                        <th> <?= Yii::t('app', 'ФИО') ?> </th>
                        <th> <?= Yii::t('app', 'Комментарий') ?> </th>
                        <th> &nbsp; </th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
