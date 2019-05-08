<?php
/**
 * Author: Vorisov Firuz, power_start@mail.ru
 * Date: 13.11.17
 * Time: 16:04
 */
namespace app\models\views;

use app\models\Base;

/**
 * Users view
 */
class Subcatigories extends Base
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vw_subcategory';
    }
}
