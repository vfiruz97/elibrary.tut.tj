<?php
namespace app\controllers;

use Yii;
use app\controllers\BaseController;

class AbiturentController extends BaseController
{

    public function actionIndex()
    {
        if ( Yii::$app->language == 'ru-RU' )
            return $this->render('index-ru');
        else
            return $this->render('index-tj');
        
    }
}
