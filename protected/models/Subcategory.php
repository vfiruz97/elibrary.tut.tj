<?php
/**
 * Author: Vorisov Firuz, power_start@mail.ru
 * Date: 13.11.17
 * Time: 16:04
 */
namespace app\models;

use Yii;
use app\models\Base;

/**
 * Users view
 */
class Subcategory extends Base
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subcategory';
    }
    
    public function scenarios()
    {
        return [
            self::SCENARIO_CREATE => ['category_id', 'name_ru', 'name_tj'],
            self::SCENARIO_UPDATE => ['category_id', 'name_ru', 'name_tj'],
            self::SCENARIO_DELETE => ['status'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'category_id'   => Yii::t('app', 'Категория'),
            'name_ru'       => Yii::t('app', 'Название подкатегории на русском'),
            'name_tj'       => Yii::t('app', 'Номи зеркатегорияҳо'),
        ];
    }
    
    public function rules()
    {
        return [
            [['category_id', 'name_ru', 'name_tj'], 'required', 'on' => self::SCENARIO_CREATE],
            [['category_id', 'name_ru', 'name_tj'], 'required', 'on' => self::SCENARIO_UPDATE],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }
}
