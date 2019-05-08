<?php
/**
 * Author: Akhmedov Farkhod, a.farkhod@gmail.com
 * Date: 10.08.17
 * Time: 15:59
 */
namespace app\components\behaviors;

use Yii;
use yii\base\ActionFilter;

/**
 * AccessControl provides basic controller access protection
 */
class AccessControl extends ActionFilter
{
    /**
     * Rules for access to controller
     *
     * @var array
     */
    public $rules = [];

    /**
     * @inheritdoc
     */
    public function beforeAction($action)
    {
      /*  if (Yii::$app->user->isGuest) {
           if ($action->controller->id != 'session' && $action->id != 'login'  && $action->id != 'captcha') {
                $this->loginRequired();
                return false;
            }
        } */
        
       /* if (Yii::$app->user->isGuest) {
           if ($action->controller->id == 'book' && $action->id == 'readas'  && $action->id != 'captcha') {
                $this->loginRequired();
                return false;
            }
        }*/

        return parent::beforeAction($action);
    }
    
    /**
     * @return bool forces user login
     */
    protected function loginRequired()
    {
        Yii::$app->user->logout();
        Yii::$app->user->loginRequired();
    }
}
