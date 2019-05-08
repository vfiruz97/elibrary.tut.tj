<?php
/**
 * Author: Akhmedov Farkhod, a.farkhod@gmail.com
 * Date: 10.08.17
 * Time: 18:52
 */
namespace app\forms;

use Yii;
use yii\base\Model;
use app\models\User;

/**
 * Login form
 */
class Login extends Model
{
    public $username;
    public $password;
    public $language = 'ru-RU';
    public $rememberMe = true;
    public $captcha;

    static public $availableLanguages = [ 'ru-RU' => 'Русский', 'tj-TJ' => 'Тоҷикӣ' ];

    private $_user;

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'username'      => Yii::t('app', 'Логин'),
            'password'      => Yii::t('app', 'Пароль'),
            'language'      => Yii::t('app', 'Язык'),
            'captcha'       => Yii::t('app', 'Защитный код'),
            'rememberMe'    => Yii::t('app', 'Запомнить меня'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password', 'captcha'], 'required', 'message' => Yii::t('app', 'Поле "{attribute}" обязательно для заполнения')],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
            ['captcha', 'captcha', 'captchaAction' => 'index/captcha', 'message' => Yii::t('app', 'Неверный защитный код')],
            [['username', 'password', 'language', 'rememberMe'], 'safe'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user) {
                $this->addError($attribute, Yii::t('app', 'Пользователь не найден'));
            }

            if ($user && !$user->validatePassword($this->password)) {
                $this->addError($attribute, Yii::t('app', 'Неверный пароль'));
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            if (Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0)) {
                Yii::$app->session->set('language', $this->language);

                return true;
            }
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username);
        }
        return $this->_user;
    }
}
