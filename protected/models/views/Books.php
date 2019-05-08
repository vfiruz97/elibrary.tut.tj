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
class Books extends Base
{

    public $category_book_id;
    public $subcategory_book_id;
    public $lang_book_id;
    public $name_book_id;
    public $name_author;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vw_book';
    }
}
