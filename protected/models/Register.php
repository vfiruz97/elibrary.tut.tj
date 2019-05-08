<?php
/**
 * Author: Vorisov Firuz, power_start@mail.ru
 * Date: 08.11.17
 * Time: 17:20
 */
namespace app\models;

use Yii;
class Register extends Base
{
    public $password;
    public $role;
    public $roleDescription;
    public $auth_key;
    public $captcha;
    public $password_repeat;
    
    public static function tableName()
    {
        return 'users';
    }
    
    public function beforeSave($insert)
    {
        if ($this->password) {
            $this->password_hash = Yii::$app->getSecurity()->generatePasswordHash($this->password);
        }

        return true;       
    }
  
    
    public function rules(){
	    return [
		    [['username', 'gender','name', 'surname', 'password','role','captcha', 'date_of_birth', 'email', 'faculty_id', 'speciality_id' ],'required' , 'message' => Yii::t('app', 'Выполните поле, пожалуйста')],
		    [['username', 'gender','name', 'surname', 'password','role','captcha', 'date_of_birth', 'email', 'speciality_id' ],'safe'],
		    [['username', 'name', 'surname', 'password', 'email'],'trim'],
		    [['email'],'email', 'message' => Yii::t('app', 'Неправильный формат е-майл')],
		    ['username', 'unique', 'message' => Yii::t('app', 'Такой логин уже существует!')],
		    ['password_repeat', 'required'],
		    ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => Yii::t('app', 'Пароль не совпадается')],
		    ['status', 'default', 'value' => 1],
		    ['role', 'default', 'value' => "userRole"],
		    ['captcha', 'captcha', 'captchaAction' => 'index/captcha', 'message' => Yii::t('app', 'Неверный защитный код')],
	    ];
    }
    
   public function attributeLabels()
    {
        return [
            'faculty_id'        => Yii::t('app', 'Факультет'),
            'speciality_id'     => Yii::t('app', 'Специальности'),
            'username'          => Yii::t('app', 'Логин'),
            'password'          => Yii::t('app', 'Пароль'),
            'password_repeat'   => Yii::t('app', 'Подтверждение пароля'),
            'role'              => Yii::t('app', 'Роль'),
            'gender'            => Yii::t('app', 'Пол'),
            'name'              => Yii::t('app', 'Имя'),
            'surname'           => Yii::t('app', 'Фамилия'),
            'date_of_birth'     => Yii::t('app', 'Дата рождения'),
            'email'             => Yii::t('app', 'Электронная почта'),
        ];
    }
    
       
     public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }
    
    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }
    
    public function afterSave($insert, $changedAttributes)
    {
        // Присвоение роли
        $auth = Yii::$app->getAuthManager();

        if ($insert) {
            $role = $auth->getRole($this->role);
            $auth->assign($role, $this->getId());
        }

        parent::afterSave($insert, $changedAttributes);
    }
}
