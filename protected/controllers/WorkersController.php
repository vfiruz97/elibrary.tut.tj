<?php
namespace app\controllers;
use Yii;

class WorkersController extends BaseController
{

    public function actionIndex()
    {   
        if ( Yii::$app->language == 'ru-RU' )
            return $this->render('index');
        else
            return $this->render('index');
        
    }
}
