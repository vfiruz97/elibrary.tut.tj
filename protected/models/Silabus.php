<?php
/**
 * Author: Vorisov Firuz, power_start@mail.ru
 * Date: 05.12.17
 * Time: 17:20
 */
namespace app\models;
use Yii;

class Silabus extends Base
{
    public $file_book;
    
    public static function tableName()
    {
        return 'silabus';
    }
    
    public function scenarios()
    {
        return [
            self::SCENARIO_CREATE => ['course', 'student', 'name_silabus', 'path', 'file_book'],
            self::SCENARIO_UPDATE => ['course', 'student', 'name_silabus', 'path'],
            self::SCENARIO_DELETE => ['status'],
        ];
    }
   
  
    
    public function rules(){
	    return [
	        ['name_silabus', 'unique', 'message'=> Yii::t('app', 'Такой силлабус уже добавлен')],
		    ['status', 'default', 'value' => 1],
		    [['course', 'student', 'name_silabus', 'path'], 'required', 'message'=> Yii::t('app', "Необходимо заполнить")],
		    [['file_book'], 'file', 'skipOnEmpty' => false, 'extensions' => 'pdf, txt, docx, doc'],    
		    ['name_silabus','string','length' => [2, 99], 'tooShort' =>Yii::t('app', 'Очень мало'), 'tooLong' => Yii::t('app', 'Очень много')], 	    ];
    }
    
   public function attributeLabels()
    {
        return [
            'name_silabus'  => Yii::t('app', 'Название силлабуса'),
            'course'        => Yii::t('app', 'Курс'),
            'student'       => Yii::t('app', 'Силлабус для'),
            'path'          => Yii::t('app', 'Загрузите силлабусу'),
        ];
    }
   
}
