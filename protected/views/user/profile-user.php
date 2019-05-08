<?php
/* @var $this yii\web\View */
/* @var $model app\models\User */

use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::t('app', 'Профиль');
?>

<div class="col-lg-12">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3><?= $this->title ?></h3>
        </div>
        <div class="panel-body">
        <form id="update-user-form" method="POST">
            
            <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
            <?= Html::hiddenInput('id', $model->getId()) ?>
            <?php foreach ($model->getErrors() as $key => $value)
                $error[$key]= $value[0]; ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label"><?= $model->getAttributeLabel('name') ?></label>
                        <?= Html::activeTextInput($model, 'name', ['class' => 'form-control', 'placeholder' => $model->getAttributeLabel('name')]) ?>
                        <?php if (!empty($model->getErrors('name')))  
                            echo '<div class="help-block" style="color:red">'. $error['name'] .'</div>'; ?>
                    </div>

                    <div class="form-group">
                        <label class="control-label"><?= $model->getAttributeLabel('surname') ?></label>
                        <?= Html::activeTextInput($model, 'surname', ['class' => 'form-control', 'placeholder' => $model->getAttributeLabel('surname')]) ?>
                        <?php if (!empty($model->getErrors('surname')))  
                            echo '<div class="help-block" style="color:red">'. $error['surname'] .'</div>'; ?>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label"><?= $model->getAttributeLabel('email') ?></label>
                        <?= Html::activeTextInput($model, 'email', ['class' => 'form-control', 'placeholder' => $model->getAttributeLabel('email')]) ?>
                        <?php if (!empty($model->getErrors('email')))  
                            echo '<div class="help-block" style="color:red">'. $error['email'] .'</div>'; ?>
                    </div>
                </div> 
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label"><?= $model->getAttributeLabel('date_of_birth') ?> <small style="color:#ddd"><?= Yii::t('app', '(гггг-мм-дд)') ?></small></label>
                        <div class="input-group date date-picker">
                            <?= Html::activeTextInput($model, 'date_of_birth', ["pattern"=>"[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])"]) ?>
                            <?php if (!empty($model->getErrors('date_of_birth')))  
                            echo '<div class="help-block" style="color:red">'. $error['date_of_birth'] .'</div>'; ?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label"><?= $model->getAttributeLabel('gender') ?></label>
                        <?= Html::activeDropDownList($model, 'gender', [
                            ''          => '',
                            'male'      => Yii::t('app', 'Мужской'),
                            'female'    => Yii::t('app', 'Женский'),
                        ], ['class' => 'form-control']) ?>
                    </div>
                    <?php if (!empty($model->getErrors('gender')))  
                            echo '<div class="help-block" style="color:red">'. $error['gender'] .'</div>'; ?>
                </div>
            </div>
            <hr/>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label"><?= $model->getAttributeLabel('faculty_id') ?></label>
                        <?= Html::activeDropDownList($model, 'faculty_id', ArrayHelper::map($faculty, 'id', 'full_name'), ['class' => 'form-control', 'prompt' => '']) ?>
                        <?php if (!empty($model->getErrors('faculty_id')))  
                            echo '<div class="help-block" style="color:red">'. $error['faculty_id'] .'</div>'; ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label"><?= $model->getAttributeLabel('speciality_id') ?></label>
                        <?= Html::activeDropDownList($model, 'speciality_id', ArrayHelper::map($speciality, 'id', 'short_name'), ['class' => 'form-control', 'prompt' => '']) ?>
                        <?php if (!empty($model->getErrors('speciality_id')))  
                            echo '<div class="help-block" style="color:red">'. $error['speciality_id'] .'</div>'; ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label"><?= $model->getAttributeLabel('username') ?></label>
                        <?= Html::activeTextInput($model, 'username', ['class' => 'form-control', 'placeholder' => $model->getAttributeLabel('username')]) ?>
                        <?php if (!empty($model->getErrors('username')))  
                            echo '<div class="help-block" style="color:red">'. $error['username'] .'</div>'; ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label"><?= $model->getAttributeLabel('password') ?></label>
                        <?= Html::activePasswordInput($model, 'password', ['class' => 'form-control', 'placeholder' => $model->getAttributeLabel('password')]) ?>
                        <?php if (!empty($model->getErrors('password')))  
                            echo '<div class="help-block" style="color:red">'. $error['password'] .'</div>'; ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label"><?= $model->getAttributeLabel('repeat_password') ?></label>
                        <?= Html::activePasswordInput($model, 'repeat_password', ['class' => 'form-control', 'placeholder' => $model->getAttributeLabel('repeat_password')]) ?>
                        <?php if (!empty($model->getErrors('repeat_password')))  
                            echo '<div class="help-block" style="color:red">'. $error['repeat_password'] .'</div>'; ?>
                    </div>
                </div>
            </div>
              
        </div>
        <div class="panel-footer">
            <div class='row'>
                <div class="col-md-4 col-md-offset-2 col-sm-offset-2 col-sm-4 col-xs-4 col-lg-4 col-xs-offset-2">
                    <div class="form-group">
                        <?= Html::submitButton(Yii::t('app', 'Изменить'), ['class' => 'btn btn-lg btn-success btn-block']) ?><br>
                    </div>
                </div>
                <div class="col-md-4 col-ms-4 col-xs-4 col-lg-4">
                    <div class="form-group">
                        <a style="color:white;margin-left:20px" class="btn btn-lg btn-primary btn-block" href="<?= Url::toRoute('/index') ?>"> <?= Yii::t('app', 'Назад') ?></a>
                    </div>
                </div>
            </div>
        </div>
    </form> 
    </div>
</div>
