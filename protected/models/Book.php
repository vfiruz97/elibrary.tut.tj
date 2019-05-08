<?php
/**
 * Author: Vorisov Firuz, power_start@mail.ru
 * Date: 11.11.17
 * Time: 17:20
 */
namespace app\models;

use Yii;
class Book extends Base
{
    public $file_book;
    public $picture;
    
    public static function tableName()
    {
        return 'book';
    }
    public function scenarios()
    {
        return [
            self::SCENARIO_CREATE => ['category_id', 'author', 'description', 'name_book', 'path', 'path_photo', 'file_book', 'picture', 'lang_book'],
            self::SCENARIO_UPDATE => ['category_id', 'author', 'description', 'name_book', 'lang_book'],
            self::SCENARIO_DELETE => ['status'],
        ];
    }
   
  
    
    public function rules(){
	    return [
	        ['name_book', 'unique', 'message'=> Yii::t('app', 'Такая книга уже добавлена')],
		    ['status', 'default', 'value' => 1],
		    [['path', 'category_id' , 'subcategory_id','author','description','name_book','path_photo', 'lang_book'], 'required'],
		    [['file_book'], 'file', 'skipOnEmpty' => false, 'extensions' => 'pdf, txt, docx, doc'],
		    [['picture'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],		    
		    ['author', 'string', 'length' => [2, 99], 'tooShort' => Yii::t('app', 'Очень мало'), 'tooLong' => Yii::t('app', 'Очень много')],
		    ['name_book', 'string', 'length' => [2, 99] , 'tooShort' => Yii::t('app', 'Очень мало'), 'tooLong' => Yii::t('app', 'Очень много')],
		    ['path', 'string', 'length' => [2, 149], 'tooShort' => Yii::t('app', 'Очень мало'), 'tooLong' => Yii::t('app', 'Очень много')],
		    ['path_photo', 'string', 'length' => [2, 149], 'tooShort' => Yii::t('app', 'Очень мало'), 'tooLong' => Yii::t('app', 'Очень много')],
		    ['description', 'string', 'min' => 20, 'tooShort' => Yii::t('app', 'Очень мало'), 'tooLong' => Yii::t('app', 'Очень много')],
		    
	    ];
    }
    
   public function attributeLabels()
    {
        return [
            'category_id'       => Yii::t('app', 'Категория'),
            'subcategory_id'    => Yii::t('app', 'Подкатегория'),
            'author'            => Yii::t('app', 'Автор книги'),
            'description'       => Yii::t('app', 'Краткое описание'),
            'name_book'         => Yii::t('app', 'Название книги'),
            'lang_book'         => Yii::t('app', 'Язык книги'),
            'path'              => Yii::t('app', 'Загрузите книгу'),
            'path_photo'        => Yii::t('app', 'Загрузите картинку'),
        ];
    }
   
}
