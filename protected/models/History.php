<?php
/**
 * Author: Akhmedov Farkhod, a.farkhod@gmail.com
 * Date: 13.09.17
 * Time: 11:10
 */
namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use app\models\refs\HistoryAction;

/**
 * Base model for all history models
 */
class History extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'history_created_at',
                'updatedAtAttribute' => false,
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                if ($this->hasAttribute('history_created_id')) {
                    $this->history_created_id = Yii::$app->user->getId();
                }
            }

            return true;
        }
        return false;
    }

    public function getCreatedAtPretty()
    {
        return date('Y-m-d', $this->created_at);
    }

    public function getHistoryCreatedAtPretty()
    {
        return date('Y-m-d H:i', $this->history_created_at);
    }

    public function getHistoryAction()
    {
        return $this->hasOne(HistoryAction::className(), ['id' => 'history_action_id']);
    }

    public function getCreatedUser()
    {
        return $this->hasAttribute('history_created_id') ? $this->hasOne(User::className(), ['id' => 'history_created_id']) : null;
    }

    public function __toString() {
        return (string)$this->historyAction;
    }
}
