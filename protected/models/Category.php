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
class Category extends Base
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }
    
    public function scenarios()
    {
        return [
            self::SCENARIO_CREATE => ['name_ru', 'name_tj'],
            self::SCENARIO_UPDATE => ['name_ru', 'name_tj'],
            self::SCENARIO_DELETE => ['status'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name_ru'   => Yii::t('app', 'Название категории на русском'),
            'name_tj'   => Yii::t('app', 'Номи категорияхо ба тоҷикӣ'),
        ];
    }
    
    public function rules()
    {
        return [
            [['name_ru', 'name_tj'], 'required', 'on' => self::SCENARIO_CREATE],
            [['name_ru', 'name_tj'], 'required', 'on' => self::SCENARIO_UPDATE],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }
    
     public function getSubcategories()
    {
        return $this->hasMany(Subcategory::className(), ['category_id' => 'id'])->where('status = 1');
    }
}
