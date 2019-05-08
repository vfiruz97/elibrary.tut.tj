<?php
/**
 * Author: Akhmedov Farkhod, a.farkhod@gmail.com
 * Date: 10.08.17
 * Time: 11:21
 */
namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id Идентификатор пользователя
 * @property integer $organization_id Организация
 * @property string $username Логин
 * @property string $auth_key
 * @property string $password Пароль
 * @property string $password_hash Хеш пароля
 * @property integer $status Статус пользователя
 * @property string $name Имя пользователя
 * @property string $surname Фамилия пользователя
 * @property string $phone Телефон пользователя
 * @property string $position Должность
 * @property integer $created_at
 * @property integer $updated_at
 */
class User extends Base implements IdentityInterface
{
    public $password;
    public $repeat_password;
    public $auth_key;
    public $role;
    public $roleDescription;
    public $deletable = true;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    public function scenarios()
    {
        return [
            self::SCENARIO_UPDATE => ['username', 'password', 'repeat_password', 'gender', 'name', 'surname', 'date_of_birth', 'email', 'faculty_id', 'speciality_id'],
            self::SCENARIO_DELETE => ['status'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'faculty_id'        => Yii::t('app', 'Факультет'),
            'speciality_id'     => Yii::t('app', 'Специальности'),
            'username'          => Yii::t('app', 'Логин'),
            'password'          => Yii::t('app', 'Пароль'),
            'repeat_password'   => Yii::t('app', 'Повторить пароль'),
            'role'              => Yii::t('app', 'Роль'),
            'gender'            => Yii::t('app', 'Пол'),
            'name'              => Yii::t('app', 'Имя'),
            'surname'           => Yii::t('app', 'Фамилия'),
            'date_of_birth'     => Yii::t('app', 'Дата рождения'),
            'email'             => Yii::t('app', 'Электронная почта'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->generateAuthKey();
            }

            if ($this->password) {
                $this->password_hash = Yii::$app->getSecurity()->generatePasswordHash($this->password);
            }

            return true;
        }
        return false;
    }

    /**
     * @inheritdoc
     */
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

    /**
     * @inheritdoc
     */
    public function afterFind()
    {
        parent::afterFind();

        $this->password         =
        $this->repeat_password  = null;

        if (!$this->role) {
            $auth = Yii::$app->getAuthManager();

            // Список ролей к которым принадлежит пользователь
            $assignments = $auth->getAssignments($this->getId());
            if (!empty($assignments)) {
                // Текущая роль пользователя
                $assignment = array_shift($assignments);

                $role = $auth->getRole($assignment->roleName);

                $this->role             = $role->name;
                $this->roleDescription  = $role->description;
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'gender', 'name', 'surname', 'date_of_birth', 'email', 'faculty_id', 'speciality_id'], 'required', 'on' => self::SCENARIO_UPDATE],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }
    
    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }
    
    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
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
    
    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function __toString() {
        return sprintf('%s %s', $this->name, $this->surname);
    }
}
