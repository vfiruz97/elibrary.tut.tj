<?php
/**
 * Author: Akhmedov Farkhod, a.farkhod@gmail.com
 * Date: 10.08.17
 * Time: 13:34
 */
namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use app\models\refs\HistoryAction;

/**
 * Base model for all models
 */
class Base extends ActiveRecord
{
    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';
    const SCENARIO_DELETE = 'delete';

    const STATUS_DELETED    = 0;
    const STATUS_ACTIVE     = 1;

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->on(self::EVENT_AFTER_INSERT, [$this, 'beforeHistoryWrite'], ['historyAction' => HistoryAction::CREATE]);
        $this->on(self::EVENT_AFTER_UPDATE, [$this, 'beforeHistoryWrite'], ['historyAction' => HistoryAction::UPDATE]);
        $this->on(self::EVENT_BEFORE_DELETE, [$this, 'beforeHistoryWrite'], ['historyAction' => HistoryAction::DELETE]);
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    protected function beforeHistoryWrite($event)
    {
        if (isset($event->data['historyAction'])) {
            $historyAction = $event->data['historyAction'];

            // Обработка non deletable записей
            if ($historyAction == HistoryAction::UPDATE) {
                if ($this->hasAttribute('status') && $this->status == 0) {
                    $historyAction = HistoryAction::DELETE;
                }
            }

            $this->writeHistory($historyAction);
        }
    }

    protected function writeHistory($historyAction)
    {
        /* Реализуется в тех потомках-классах, в которых необходимо записывать историю изменений */
    }

    public function getHistory()
    {
        return false;
    }

    /**
     * @inheritdoc
     */
    public function delete()
    {
        if ($this->hasAttribute('status') && $this->status == self::STATUS_ACTIVE) {
            $this->status = self::STATUS_DELETED;

            return $this->save();
        }

        return false;
    }
    
     public function acces()
    {
        if ($this->hasAttribute('status') && $this->status == self::STATUS_DELETED) {
            $this->status = self::STATUS_ACTIVE;

            return $this->save();
        }

        return false;
    }

    public function deleteFromDatabase()
    {
        return $this->getDb()->createCommand()->delete($this->tableName(), ['id' => $this->getId()])->execute() > 0;
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                if ($this->hasAttribute('created_id')) {
                    $this->created_id = Yii::$app->user->getId();
                }
            }

            return true;
        }
        return false;
    }

    /**
     * @inheritdoc
     */
    public function afterFind()
    {
        if ($this->hasAttribute('created_at')) {
            $this->created_at = date('Y-m-d', $this->created_at);
        }
    }

    public static function find()
    {
        return new CustomQuery(get_called_class());
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getCreatedUser()
    {
        return $this->hasAttribute('created_id') ? $this->hasOne(User::className(), ['id' => 'created_id']) : null;
    }
}

// TODO: реализовать возможность переопределения/расширения в классах потомках
class CustomQuery extends ActiveQuery
{
    public function active()
    {
        $this->andWhere('status = 1');

        return $this;
    }
}
