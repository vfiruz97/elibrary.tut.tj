<?php

/* @var $this yii\web\View */
/* @var $model app\models\Book */

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

    if(isset($subcategory_id)) {
        echo "<input type='hidden' id='subcategory_id' value='". $subcategory_id ."' />";
    } 
    else 
        echo "<input type='hidden' id='subcategory_id' value='0' />";
?>
<div class="panel   panel-primary"> <!--panel-green-->
    <div class="panel-heading">
        <h4><?= $model->isNewRecord ? Yii::t('app', 'Добавить книгу') : Yii::t('app', 'Изменить книгу') ?></h4>
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
                        <label class="control-label"><?= $model->getAttributeLabel('category_id') ?></label>
                        <?= Html::activeDropDownList( $model, 'category_id', ArrayHelper::map($category, 'id', 'name_ru'), ['id' => 'faculty','class' => 'input-sm form-control', 'prompt' => '']) ?>
                        <?php if (!empty($model->getErrors('category_id')))  
                            echo '<div class="help-block" style="color:red">'. $error['category_id'] .'</div>'; ?>
                    </div>                    
                    <div class="form-group">
                        <label class="control-label"><?= $model->getAttributeLabel('name_book') ?></label>
                        <?= Html::activeTextInput($model, 'name_book', ['class' => 'form-control', 'placeholder' => $model->getAttributeLabel('name_book')]) ?>
                        <?php if (!empty($model->getErrors('name_book')))  
                            echo '<div class="help-block" style="color:red">'. $error['name_book'] .'</div>'; ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= $model->getAttributeLabel('author') ?></label>
                        <?= Html::activeTextInput($model, 'author', ['class' => 'form-control', 'placeholder' => $model->getAttributeLabel('author')]) ?>
                        <?php if (!empty($model->getErrors('author')))  
                            echo '<div class="help-block" style="color:red">'. $error['author'] .'</div>'; ?>
                    </div>
                </div>                
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label"><?= $model->getAttributeLabel('subcategory_id') ?></label>
                        <select class='input-sm form-control filter' id='subcategory' name='subcategory_id'>
                            <option value="0">Выберите подкaтегории</option>
                            <?php foreach ($subcategory as $key){
                                echo "<option value='".$key->id."' class='".$key->category_id."' hidden>".$key->name_ru."</option>";
                            }?>
                        </select>
                        <?php if (!empty($model->getErrors('subcategory_id')))  
                            echo '<div class="help-block" style="color:red">'. $error['subcategory_id'] .'</div>'; ?>
                    </div>  
                    <div class="form-group">
                        <label class="control-label"><?= $model->getAttributeLabel('lang_book') ?></label>
                        <?= Html::activeDropDownList($model, 'lang_book', [
                            ''      => '',
                            'ru'    => Yii::t('app', 'русский'),
                            'tj'    => Yii::t('app', 'таджикский'),
                        ], ['class' => 'form-control']) ?>
                        <?php if (!empty($model->getErrors('lang_book')))  
                            echo '<div class="help-block" style="color:red">'. $error['lang_book'] .'</div>'; ?>
                    </div> 
                </div>
            </div>
            <div class="row">                
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label"><?= $model->getAttributeLabel('description') ?></label>
                        <?= Html::activeTextarea($model, 'description', ['class' => 'form-control', 'rows'=>7, 'placeholder' => $model->getAttributeLabel('description')]) ?>
                        <?php if (!empty($model->getErrors('description')))  
                            echo '<div class="help-block" style="color:red">'. $error['description'] .'</div>'; ?>
                    </div>
                </div>                
            </div>
            <hr/>
            <div class="row">
                <div class="col-md-4">       
                    <div class="form-group">
                        <?= Html::img('@web/'.$model->path_photo.'',['width'=>'250', 'height'=>'250', 'class' => 'thumbnail img-responsive', 'style' => 'margin:0px;', 'id' => 'image', 'alt' => 'no photo']); ?>
                        
                        <?php if(!$model->isNewRecord) echo "<a class='btn text-center' style='min-width:250px;' target='new_blank' href='../". $model->path ."'>". $model->name_book."</a>"; ?>
                    </div>        
                </div> 
                <div class="col-md-6">        
                    <div class="form-group">
                        <label class="control-label"><?= $model->getAttributeLabel('path') ?></label>
                        <input type="hidden" name="Book[file_book]" value=""><input type="file" id="book-path" name="Book[file_book]" aria-required="true" accept=".doc, .docx, .pdf, .txt">
                        <?php if (!empty($model->getErrors('file_book')))  
                            echo '<div class="help-block" style="color:red">'. $error['file_book'] .'</div>'; ?>
                    </div>        
                    <div class="form-group">
                        <label class="control-label"><?= $model->getAttributeLabel('path_photo') ?></label>
                        <input type="hidden" name="Book[picture]" value=""><input type="file" id="book-path_photo" name="Book[picture]" aria-required="true" accept="image/*,image/jpeg">
                        <?php if (!empty($model->getErrors('picture')))  
                            echo '<div class="help-block" style="color:red">'. $error['picture'] .'</div>'; ?>
                    </div>        
                </div>  
            </div>            
            <hr/>                
            <div class="col-md-12">
                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Добавить') : Yii::t('app', 'Изменить'), ['class' => 'btn btn-primary']) ?>                
                    <a style="color:white;width:85px" class="btn btn-primary" href="<?= Url::toRoute('/book/show') ?>"> <?= Yii::t('app', 'Назад') ?></a>
                </div>
            </div> 

        </form>
    </div>
</div>


<script>
window.onload = function(){
    HideShow();//Podcategory zavisit ot Category
    setTimeout(Subcategory,100);
}
function HideShow(){
    var faculty = $(".input-sm").val();    
    $("#faculty").on('change', function(){
        $("#subcategory>option").attr('hidden','true'); 
        $('.'+$("#faculty").val()).removeAttr('hidden');
        $("#subcategory").val(0);        
    });
    $("#subcategory").on('click', function(){
        $('.'+ $("#faculty").val()).removeAttr('hidden');       
    });
    $("#book-path_photo").on('change', function(){
        if ( this.files && this.files[0] ) 
        {
            var obj = new FileReader();
            obj.onload = function(data){
                image.src = data.target.result;
            }  
            obj.readAsDataURL(this.files[0]);      
        }   
    });
}
function Subcategory() {
    var subcategory_id = $('#subcategory_id').val();
        $("#subcategory").val( subcategory_id );
}
</script>
