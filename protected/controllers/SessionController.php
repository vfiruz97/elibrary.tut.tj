<?php
/**
 * Author: Akhmedov Farkhod, a.farkhod@gmail.com
 * Date: 10.08.17
 * Time: 17:25
 */
namespace app\controllers;

use Yii;
use app\assets\RegisterAsset;
use yii\web\Response;
use app\models\Register;
use app\models\Faculty;
use app\models\Speciality;
use app\models\User;
use app\forms\Login as LoginForm;

/**
 * Session controller
 */
class SessionController extends BaseController
{
    public $layout = 'login';
    public $language = 'ru-RU';

    /**
     * Login action
     */
    
    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
            ],
        ];
    }
    
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        
        $language = Yii::$app->request->isPost ? $_POST['Login']['language'] : Yii::$app->request->getQueryParam('language');
        if (array_key_exists($language, LoginForm::$availableLanguages)) {
            Yii::$app->language = $language;
        }

        $form = new LoginForm();
        $form->language = $language ? $language : $form->language;
        $this->language = $form->language;
        
        if ($form->load(Yii::$app->request->post()) && $form->login()) {
            return $this->goHome();
        } else {
            return $this->render('login', [
                'form' => $form,
            ]);
        }
    }
    
    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        
        return $this->runAction('login');
    }
    
    public function actionRegister( )
    {   
        $language = Yii::$app->request->get('language');
        if(empty($language)) $language= $this->language;
        RegisterAsset::register($this->view);
        $faculty = Faculty::find()->all();
        $speciality = Speciality::find()->all();

        $auth = Yii::$app->authManager;
        $roles = $auth->getRoles();
        
        $model = new Register();
        
        if ( $model->load(Yii::$app->request->post()) ) {
            $speciality_id = Yii::$app->request->post('speciality_id');
            $model->speciality_id  = $speciality_id;
          //  if(empty( $model->speciality_id ))
             //   $model->speciality_id   = 1;
            $model->role            = "userRole";
            $model->created_at      = time();
            $model->updated_at      = time();
            if ($model->validate()){
                $model->save(false);
                return $this->redirect(['session/login']);
            }
            else
                return $this->render('register', [
                    'model'         => $model,
                    'faculty'       => $faculty,
                    'speciality'    => $speciality,
                    'roles'         => $roles,
                    'language'      => $language,
                    'speciality_id' => $speciality_id
                ]);
        }
        
        return $this->render('register', [
            'model'         => $model,
            'faculty'       => $faculty,
            'speciality'    => $speciality,
            'roles'         => $roles,
            'language'      => $language,
        ]);
    }
}
