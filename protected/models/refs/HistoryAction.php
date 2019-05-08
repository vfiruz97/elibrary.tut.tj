<?php
/**
 * Author: Akhmedov Farkhod, a.farkhod@gmail.com
 * Date: 13.09.17
 * Time: 09:56
 */
namespace app\models\refs;

use app\models\Base;

/**
 * HistoryAction model
 * 
 * @property integer $id Идентификатор действия
 * @property string $name Наименование
 * @property string $alias Псевдоним
 */
class HistoryAction extends Base
{
    const CREATE = 1;
    const UPDATE = 2;
    const DELETE = 3;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ref_history_actions';
    }

    public function __toString() {
        return (string)$this->name;
    }
}
