<?php

/* @var $this yii\web\View */
/* @var $model app\models\Silabus */

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="panel   panel-primary"> <!--panel-green-->
    <div class="panel-heading">
        <h4><?= $model->isNewRecord ? Yii::t('app', 'Добавить силлабус') : Yii::t('app', 'Изменить силлабус') ?></h4>
    </div>
        <div class="panel-body">
            <form id="w0" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_csrf" value="bhrRCmHr24-wfkbzGwOz8NaV4wiSYqzoyIzgUuDlXMIme4teJaaj6ts9dpx_c4O-4M_UXOIO35iq1YsHlLIslQ==">	

            <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
            <?= Html::hiddenInput('id', $model->getId()) ?>
            <?php foreach ($model->getErrors() as $key => $value)
                $error[$key]= $value[0]; ?>

            <div class="row">
                <div class="col-md-6">                   
                    <div class="form-group">
                        <label class="control-label"><?= $model->getAttributeLabel('name_silabus') ?></label>
                        <?= Html::activeTextInput($model, 'name_silabus', ['class' => 'form-control', 'placeholder' => $model->getAttributeLabel('name_silabus')]) ?>
                        <?php if (!empty($model->getErrors('name_silabus')))  
                            echo '<div class="help-block" style="color:red">'. $error['name_silabus'] .'</div>'; ?>
                    </div>
                </div>                
                <div class="col-md-6"> 
                    <div class="form-group">
                        <label class="control-label"><?= $model->getAttributeLabel('student') ?></label>
                        <?= Html::activeDropDownList($model, 'student', [
                            ''      => '',
                            '1'    => Yii::t('app', 'студентов'),
                            '0'    => Yii::t('app', 'магистров'),
                        ], ['class' => 'form-control']) ?>
                        <?php if (!empty($model->getErrors('student')))  
                            echo '<div class="help-block" style="color:red">'. $error['student'] .'</div>'; ?>
                    </div> 
                </div>
                <div class="col-md-2"> 
                    <div class="form-group">
                        <label class="control-label"><?= $model->getAttributeLabel('course') ?></label>
                        <?= Html::activeDropDownList($model, 'course', [
                            ''  => '',
                            '1' => 1,
                            '2' => 2,
                            '3' => 3,
                            '4' => 4,
                        ], ['class' => 'form-control']) ?>
                        <?php if (!empty($model->getErrors('course')))  
                            echo '<div class="help-block" style="color:red">'. $error['course'] .'</div>'; ?>
                    </div> 
                </div>
                <div class="col-md-6">        
                    <div class="form-group">
                        <label class="control-label"><?= $model->getAttributeLabel('path') ?></label>
                        <input type="hidden" name="Silabus[file_book]" value=""><input type="file" id="book-path" name="Silabus[file_book]" aria-required="true" accept=".doc, .docx, .pdf, .txt">
                        <?php if (!empty($model->getErrors('file_book')))  
                            echo '<div class="help-block" style="color:red">'. $error['file_book'] .'</div>'; ?>
                    </div>        
                </div> 
                <div class="col-md-4">       
                    <div class="form-group">                        
                        <?php if(!$model->isNewRecord) echo "<a class='btn text-center' style='min-width:250px;' target='new_blank' href='../". $model->path ."'>". $model->name_silabus."</a>"; ?>
                    </div>        
                </div>  
            </div>            
            <hr/>                
            <div class="col-md-12">
                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Добавить') : Yii::t('app', 'Изменить'), ['class' => 'btn btn-primary']) ?>                
                    <a style="color:white;width:85px" class="btn btn-primary" href="<?= Url::toRoute('/silabus/show') ?>"> <?= Yii::t('app', 'Назад') ?></a>
                </div>
            </div> 

        </form>
    </div>
</div>
