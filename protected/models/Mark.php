<?php
/**
 * Author: Vorisov Firuz, power_start@mail.ru
 * Date: 23.11.17
 * Time: 16:04
 */
namespace app\models;

use app\models\Base;

class Mark extends Base
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mark';
    }
}