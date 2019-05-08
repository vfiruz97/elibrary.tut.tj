<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<?php if (isset($report) && $report->hasErrors()): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($report->getErrors() as $field => $errors): ?>
                <?php foreach ($errors as $error): ?><li><?= $error ?></li><?php endforeach; ?>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<?php if (isset($report) && $report->processed): ?>
    <?php if (!$report->hasData()): ?>
        <div class="alert alert-warning"><?= Yii::t('app', 'Нет требуемого') ?></div>
    <?php else: ?>
        <p >
            <button type="button" class="btn btn-sm btn-success book-report-export-to-excel" data-target="<?= Url::toRoute('/report/export-to-excel?command=report-read-book') ?>"><i class="fa fa-fw fa-lg fa-file-excel-o"></i> <?= Yii::t('app', 'Выгрузить в Excel') ?></button>
        </p>

        <table id="book-report-table" class="table table-bordered  report-table">
            <colgroup>
                <col width="50"/>
                <col width="200">
                <col width="200"/>
                <col width="200"/>
                <col width="200"/>
                <col width="200"/>
                <col width="100"/>
                <col width="100"/>
                <col width="100"/>
                <col width="100"/>
                <col width="100"/>
                <col width="100"/>
                <col width="100"/>
                <col width="100"/>
            </colgroup>
            <thead>
                <tr style="background:#5497e0;color:white; vertical-align:middle;height:80px;">
                    <th> № </th>
                    <th> <?= Yii::t('app', 'ФИО студента') ?> </th>
                    <th> <?= Yii::t('app', 'Факультет') ?> </th>
                    <th> <?= Yii::t('app', 'Специальности') ?> </th>
                    <th> <?= Yii::t('app', 'Названия книга') ?> </th>
                    <th> <?= Yii::t('app', 'Категория') ?> </th>
                    <th> <?= Yii::t('app', 'Подкатегория') ?> </th>                  
                    <th> <?= Yii::t('app', 'Автор книги') ?> </th>
                    <th> <?= Yii::t('app', 'Дата время') ?> </th>
                </tr>
            </thead>
            <tbody>
                <?php $organization = $district = null; ?>
                <?php foreach ($report->data as $index => $row): ?>

                    <tr>
                        <td><?= ++$index; ?></td>
                        <td><?= $row->user ?></td>
                        <td><?= $row->faculty_ru ?></td>
                       <!-- <td ><?= $row->faculty_tj ?></td> -->
                        <td><?= $row->speciality_ru ?></td>
                        <!-- <td ><?= $row->speciality_tj ?></td> -->
                        <td><?= $row->book ?></td>
                        <td><?= $row->category_ru ?></td>
                       <!--  <td ><?= $row->category_tj ?></td> -->
                        <td><?= $row->subcategory_ru ?></td>
                        <!-- <td ><?= $row->subcategory_tj ?></td> -->
                        <td><?= $row->author ?></td>
                        <td><?= $row->created_at_time ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
<?php endif; ?>
