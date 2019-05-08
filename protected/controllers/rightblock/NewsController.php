<?php
namespace app\controllers\rightblock;

use Yii;
use app\controllers\BaseController;

class NewsController extends BaseController
{

    public function actionParcham()
    {
            return $this->render('parcham');
        
    }
    
    public function actionAsarho()
    {
            return $this->render('asarho');
        
    }
    
    public function actionGuzorish()
    {
            return $this->render('guzorish');
        
    }
    
    public function actionGuzorish1()
    {
            return $this->render('guzorish1');
        
    }
}
