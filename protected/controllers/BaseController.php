<?php
/**
 * Author: Akhmedov Farkhod, a.farkhod@gmail.com
 * Date: 08.08.17
 * Time: 10:58
 */
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\components\behaviors\AccessControl;
use app\forms\Login;

/**
 * Base controller for all controllers
 */
class BaseController extends Controller
{
    public $jsTranslations = [];

    public function init()
    {
        parent::init();
        
        if (Yii::$app->request->getQueryParam('language')) {
            $language = Yii::$app->request->getQueryParam('language');
            if (array_key_exists($language, Login::$availableLanguages)) {
                Yii::$app->session->set('language', $language);
            }
        }

        Yii::$app->language = Yii::$app->session->get('language');

        $messageSource = Yii::$app->i18n->getMessageSource('app');
        foreach ($messageSource->fileMap as $category => $categoryFile) {
            if ($category == 'app/js') {
                $path = Yii::getAlias('@app/messages') . '/' . Yii::$app->language . '/' . $categoryFile;
                if (file_exists($path)) {
                    $this->jsTranslations = include $path;
                }
            }
        }
    }

    public function behaviors()
    {
        return [
            'acl' => [
                'class' => AccessControl::className(),
                'rules' => $this->getAccessRules(),
            ],
        ];
    }
    
    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
            ],
        ];
    }
    /**
     * Returns access rules for the standard access control behavior.
     *
     * @see AccessControl
     * @return array the access permissions
     */
    protected function getAccessRules()
    {
        return [];
    }
}
