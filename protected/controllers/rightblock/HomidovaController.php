<?php
namespace app\controllers\rightblock;

use Yii;
use app\controllers\BaseController;

class HomidovaController extends BaseController
{

    public function actionIndex()
    {
        if ( Yii::$app->language == 'ru-RU' )
            return $this->render('index-ru');
        else
            return $this->render('index-tj');
        
    }
}
