<?php
/**
 * Author: Vorisov Firuz, power_start@mail.ru
 * Date: 23.11.17
 * Time: 16:04
 */
namespace app\models;

use app\models\Base;
use Yii;

class Darhost extends Base
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'darhost';
    }
    
    public function attributeLabels()
    {
        return [
            'name_book'     => Yii::t('app', 'Название книги'),
            'author_book'   => Yii::t('app', 'Автор книги'),
            'year_of_print' => Yii::t('app', 'Дата издание'),
            'username'      => Yii::t('app', 'ФИО'),
            'email'         => Yii::t('app', 'Электронная почта'),
            'phone'         => Yii::t('app', 'Номер телефона'),
        ];
    }
    
    public function rules()
    {
        return [
            [['name_book', 'author_book', 'year_of_print', 'username', 'email', 'phone'], 'safe', ],
        ];
    }
}
