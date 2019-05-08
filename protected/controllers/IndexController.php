<?php
/**
 * Author: Akhmedov Farkhod, a.farkhod@gmail.com
 * Date: 08.08.17
 * Time: 10:58
 */
namespace app\controllers;

use Yii;
use app\assets\IndexAsset;
use app\models\views\Books;

class IndexController extends BaseController
{
    public function init()
    {
        parent::init();
        
        indexAsset::register($this->view);
    }

    public function actionIndex()
    {   
        $books = Books::find()->all();
        
        if ( Yii::$app->language == 'ru-RU' )
            return $this->render('index-ru',['books' => $books,]);
        else
            return $this->render('index-tj',['books' => $books,]);
        
    }
}
