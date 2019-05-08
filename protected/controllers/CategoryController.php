<?php
/**
 * Author: Vorisov Firuz, power_start@mail.ru
 * Date: 19.11.17
 * Time: 19:25
 */
namespace app\controllers;

use Exception;
use Throwable;
use Yii;
use yii\web\Response;
use app\assets\CategoryAsset;
use app\models\Category;
use app\models\Subcategory;
use app\models\views\Subcatigories;

class CategoryController extends BaseController
{
    public function init()
    {
        parent::init();

        CategoryAsset::register($this->view);
    }

    public function actionIndex()
    {
        if (Yii::$app->user->can('readCategory'))
            return $this->render('index');
    }
    
    public function actionSubcategory()
    {
        if (Yii::$app->user->can('readCategory'))
            $category = Category::find()->active()->all();
            return $this->render('subcategory', [
                'category'  => $category,
            ]);
    }

    public function actionAux($command = null)
    {
        switch ($command) {
            case 'info':
                if (Yii::$app->user->can('readCategory')) {
                    $categoryId = Yii::$app->request->post('id');

                    $category = Category::findOne($categoryId);

                    return $this->renderPartial('aux/info', [
                        'category' => $category,
                    ]);
                }
            break;

            case 'create-category':
                if (Yii::$app->user->can('readCategory')) {
                    $category = new Category();
                    
                    return $this->renderPartial('aux/category-form', [
                        'model' => $category,
                    ]);
                }
            break;
            
            case 'create-subcategory':
                if (Yii::$app->user->can('readCategory')) {
                    $subcategory = new Subcategory();
                    $category = Category::find()->active()->all();
                    
                    return $this->renderPartial('aux/subcategory-form', [
                        'model'     => $subcategory,
                        'category'  => $category
                    ]);
                }
            break;

            case 'update-category':
                if (Yii::$app->user->can('readCategory')) {
                    $categoryId = Yii::$app->request->post('id');

                    $category = Category::findOne($categoryId);

                    return $this->renderPartial('aux/category-form', [
                        'model' => $category,
                    ]);
                }
            break;
            
            case 'update-subcategory':
                if (Yii::$app->user->can('readCategory')) {
                    $category = Category::find()->active()->all();
                    $subcategoryId = Yii::$app->request->post('id');
                    $subcategory = Subcategory::findOne($subcategoryId);

                    return $this->renderPartial('aux/subcategory-form', [
                        'model'     => $subcategory,
                        'category'  => $category
                    ]);
                }
            break;
        }
    }

    public function actionAjax($command = null)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $result['code'] = 0;

        if (Yii::$app->request->isAjax) {
            switch ($command) {
                case 'list': 
                    $totalData      =
                    $totalFiltered  = 0;
                    $data           = [];

                    if (Yii::$app->user->can('readCategory')) {
                        $columns = [
                            0 => 'id',
                            1 => 'name_ru',
                            2 => 'name_tj',
                            3 => 'created_at',
                        ];                       

                        $totalData = Category::find()->active()->count('id');
                        
                        $category = Category::find();
                        
                        if (Yii::$app->request->post('show_deleted')) {
                            $show = (int)Yii::$app->request->post('show_deleted');
                            $category->andWhere(['status' => $show]);
                        }
                       
                        $totalFiltered = $category->count('id');

                        $order = sprintf('%s %s', $columns[$_POST['order'][0]['column']], $_POST['order'][0]['dir']);

                        $data = $category->orderBy($order)->offset($_POST['start'])->limit($_POST['length'])->all();
                    }

                    $result['draw']             = (int)$_POST['draw'];
                    $result['recordsTotal']     = (int)$totalData;
                    $result['recordsFiltered']  = (int)$totalFiltered;
                    $result['data']             = $data;
                break;
                
                case 'list-subcategory': 
                    $totalData      =
                    $totalFiltered  = 0;
                    $data           = [];

                    if (Yii::$app->user->can('readCategory')) {
                        $columns = [
                            0 => 'id',
                            1 => 'category_ru',
                            2 => 'name_ru',
                            3 => 'name_tj',
                        ];                       

                        $totalData = Subcatigories::find()->active()->count('id');
                        
                        $category = Subcatigories::find();
                        
                        if (Yii::$app->request->post('show_deleted')) {
                            $show = (int)Yii::$app->request->post('show_deleted');
                            $category->andWhere(['status' => $show]);
                        }
                        
                        if (Yii::$app->request->post('category')) {
                            $categoryId = (int)Yii::$app->request->post('category');
                            $category->andWhere(['category_id' => $categoryId]);
                        }
                       
                        $totalFiltered = $category->count('id');

                        $order = sprintf('%s %s', $columns[$_POST['order'][0]['column']], $_POST['order'][0]['dir']);

                        $data = $category->orderBy($order)->offset($_POST['start'])->limit($_POST['length'])->all();
                    }

                    $result['draw']             = (int)$_POST['draw'];
                    $result['recordsTotal']     = (int)$totalData;
                    $result['recordsFiltered']  = (int)$totalFiltered;
                    $result['data']             = $data;
                break;

                case 'create':
                    if (Yii::$app->user->can('addCategory')) {
                        $category = new Category(['scenario' => Category::SCENARIO_CREATE]);

                        if ($category->load(Yii::$app->request->post())) {
                            $result['code'] = $category->validate() && $category->save() ? 1 : 0;
                        }
                    }
                break;

                case 'update':
                    if (Yii::$app->user->can('updateCategory')) {
                        $categoryId = Yii::$app->request->post('id');

                        $category = Category::findOne($categoryId);
                        $category->scenario = Category::SCENARIO_UPDATE;

                        if ($category->load(Yii::$app->request->post())) {
                            $result['code'] = $category->validate() && $category->save() ? 1 : 0;
                        }
                    }
                break;

                case 'delete':
                    $categoryId = Yii::$app->request->post('id');
                    $category = Category::findOne($categoryId);
                    
                    $category->scenario = Category::SCENARIO_DELETE;
                    if ($category && Yii::$app->user->can('deleteCategory')) {
                        if ( $category->status === 1)                        
                            $result['code'] = $category->delete() ? 1 : 0;
                        else
                            $result['code'] = $category->acces() ? 1 : 0;              
                    }
                break;
                
                case 'create-subcategory':
                    if (Yii::$app->user->can('addCategory')) {
                        $category = new Subcategory(['scenario' => Subcategory::SCENARIO_CREATE]);

                        if ($category->load(Yii::$app->request->post())) {
                            $result['code'] = $category->validate() && $category->save() ? 1 : 0;
                        }
                    }
                break;

                case 'update-subcategory':
                    if (Yii::$app->user->can('updateCategory')) {
                        $categoryId = Yii::$app->request->post('id');

                        $category = Subcategory::findOne($categoryId);
                        $category->scenario = Subcategory::SCENARIO_UPDATE;

                        if ($category->load(Yii::$app->request->post())) {
                            $result['code'] = $category->validate() && $category->save() ? 1 : 0;
                        }
                    }
                break;

                case 'delete-subcategory':
                    $categoryId = Yii::$app->request->post('id');
                    $category = Subcategory::findOne($categoryId);
                    
                    $category->scenario = Subcategory::SCENARIO_DELETE;
                    if ($category && Yii::$app->user->can('deleteCategory')) {
                        if ( $category->status === 1)                        
                            $result['code'] = $category->delete() ? 1 : 0;
                        else
                            $result['code'] = $category->acces() ? 1 : 0;              
                    }
                break;
            }
        }

        return $result;
    }
}
