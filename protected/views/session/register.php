<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;
use yii\captcha\Captcha;
use yii\widgets\ActiveForm;
if (isset($a)) echo $a;
$this->title = Yii::t('app', 'Регистрация');

if(isset($speciality_id)) {
    echo "<input type='hidden' id='speciality_id' value='". $speciality_id ."' />";
} 
else 
    echo "<input type='hidden' id='speciality_id' value='0' />";
?>
<div style="margin-top:8px;"></div>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= $this->title ?></h3>
                </div>
                <div class="panel-body">
                <div class="col-md-12">
                <?php
                    $form = ActiveForm::begin([
                        'id' => 'register-form',
                        'options' => ['class' => 'form-horizontal'],
                    ]) ?>
                    <?php 
                        foreach ($model->getErrors() as $key => $value)
                            $error[$key]= $value[0]; ?>
                        <?= $form->field($model, 'name') ?>
                        <?= $form->field($model, 'surname') ?>
                        
                        <div class="form-group">
                            <label class="control-label"><?= $model->getAttributeLabel('faculty_id') ?></label>
                            <?= Html::activeDropDownList( $model, 'faculty_id', ArrayHelper::map($faculty, 'id', 'full_name'), ['id' => 'faculty','class' => 'input-sm form-control', 'prompt' => '']) ?>
                                <?php
                                    if (!empty($model->getErrors('faculty_id')))  
                                        echo '<div class="help-block" style="color:red">'. $error['faculty_id'] .'</div>';  
                                ?>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label"><?= $model->getAttributeLabel('speciality_id') ?></label>
                           <select class='input-sm form-control filter' id='speciality' name='speciality_id'>
                                <option value=" "><?= Yii::t('app', 'выберите специалности') ?></option>
                                <?php foreach ($speciality as $key){
                                    echo "<option value='".$key->id."' class='".$key->faculty_id."' hidden>".$key->short_name."</option>";
                                }?>
                            </select>
                                <?php
                                    if (!empty($model->getErrors('speciality_id')))  
                                        echo '<div class="help-block" style="color:red">'. $error['speciality_id'] .'</div>';  
                                ?>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label"><?= $model->getAttributeLabel('gender') ?></label>
                            <?= Html::activeDropDownList($model, 'gender', [
                                ''          => '',
                                'male'      => Yii::t('app', 'Мужской'),
                                'female'    => Yii::t('app', 'Женский'),
                            ], ['class' => 'form-control']) ?>
                            <?php
                                if (!empty($model->getErrors('gender')))  
                                    echo '<div class="help-block" style="color:red">'. $error['gender'] .'</div>';  
                            ?>
                        </div>
                        
                        <div class="form-group">
                            <div class= "col-md-12">
                                <?= $form->field($model,'date_of_birth')->widget(DatePicker::className(),[
                                    'dateFormat' => "dd-MM-yyyy", 
                                    'language' => 'ru', 'clientOptions' => [] ]) ?>                           
                            </div>
                        </div>
                        
                        <?= $form->field($model, 'email') ?>
                        <?= $form->field($model, 'username') ?>                            
                        <?= $form->field($model, 'password')->input('password') ?>
                        <?= $form->field($model, 'password_repeat')->input('password') ?>
                        
                        <div class="form-group captcha">                        
                            <?= Captcha::widget([
                                'model' => $model,
                                'attribute' => 'captcha',
                                'captchaAction' => 'index/captcha',
                                'template' => '<div class="panel panel-default"><div class="panel-body">{input} <div class="text-center">{image}</div></div></div>',
                                'options' => ['autocomplete' => 'off', 'class' => 'form-control'],
                            ]) ?>
                        <?php
                            if (!empty($model->getErrors('captcha')))  
                                echo '<div class="help-block" style="color:red">'. $error['captcha'] .'</div>';  
                        ?>
                        </div>
                        <div class='row'>
                            <div class="col-md-4 col-md-offset-2 col-sm-offset-2 col-sm-4 col-xs-4 col-lg-4 col-xs-offset-2">
                                <div class="form-group">
                                    <?= Html::submitButton(Yii::t('app', 'Регистрация'), ['class' => 'btn btn-lg btn-success btn-block']) ?><br>
                                </div>
                            </div>
                            <div class="col-md-4 col-ms-4 col-xs-4 col-lg-4">
                                <div class="form-group">
                                    <a style="color:white;margin-left:20px" class="btn btn-lg btn-primary btn-block" href="<?= Url::toRoute('/session/login') ?>"> <?= Yii::t('app', 'Назад') ?></a>
                                </div>
                            </div>
                        </div>       
                <?php ActiveForm::end() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
window.onload = function(){
    HideShow();//Spesialnostii zavisit ot Faculty
    setTimeout(Speciality,100);
}
function HideShow(){
    var faculty = $(".input-sm").val();    
    $("#faculty").on('change', function(){
        $("#speciality>option").attr('hidden','true'); 
        $('.'+$("#faculty").val()).removeAttr('hidden'); 
        $("#speciality").val(' ');       
    });    
    $("#speciality").on('click', function(){
        $('.'+ $("#faculty").val()).removeAttr('hidden');       
    });    
}
function Speciality() {
    var speciality_id = $('#speciality_id').val();
    $("#speciality").val( speciality_id );
}
</script>
