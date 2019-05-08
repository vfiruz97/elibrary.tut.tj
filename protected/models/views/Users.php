<?php
/**
 * Author: Vorisov Firuz, power_start@mail.ru
 * Date: 10.11.17
 * Time: 16:04
 */
namespace app\models\views;

use app\models\Base;

/**
 * Users view
 */
class Users extends Base
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vw_users';
    }
}
