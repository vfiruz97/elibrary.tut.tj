<?php
namespace app\controllers\rightblock;

use Yii;
use app\controllers\BaseController;

class PrezidentController extends BaseController
{

    public function actionIndex()
    {
            return $this->render('index');
        
    }
}
