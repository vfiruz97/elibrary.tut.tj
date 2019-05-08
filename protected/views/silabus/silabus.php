<?php

$this->title = Yii::t('app', 'Силлабус');
?>
<div class="row">
    <div class="box">
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                <div class="well well-lg"> 
                    <?php if ($model): ?>    
                    <?php foreach ($model as $key => $silabus ): ?>
                <div class="panel panel-info"> 
                    <div class="row">
                        <div class="col-md-12">
                            <?= "<a target='new_blank' href='../$silabus->path'><h3 align='center'> $silabus->name_silabus </h3></a>" ?> 
                        </div>                 
                    </div>
                </div>
                <?php endforeach; ?>  
                <?php else: ?>
			        <div>
			        	<p class="text-danger"><?= Yii::t('app', 'Извените по вашему запросу в базе нечего не найдено!') ?></p>
			        </div>
			    <?php endif; ?>                     
                </div>
            	</div> 
            </div>
        </div>
    </div>
</div>
