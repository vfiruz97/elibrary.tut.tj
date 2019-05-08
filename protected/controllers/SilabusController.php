<?php
/**
 * Author: Vorisov Firuz power_start@mail.ru
 * Date: 05.12.17
 * Time: 11:20
 */
namespace app\controllers;

use Exception;
use Throwable;
use Yii;
use yii\web\Response;
use yii\data\Pagination;
use app\assets\SilabusAsset;
use app\models\Silabus;
use yii\web\UploadedFile;

class SilabusController extends BaseController
{
    public function init()
    {
        parent::init();
        SilabusAsset::register($this->view);
    }
    
    public function actionIndex()
    {
        $query = Silabus::find()->active(); 
        
        if (Yii::$app->request->isGet) {
            if ( Yii::$app->request->get("course") ) {
                $course = Yii::$app->request->get("course");
                $query->andWhere(['course' => $course]);
            }
            if (Yii::$app->request->get("student")) {
                $student= Yii::$app->request->get("student");
                if ( $student == 11) $student=0;
                $query->andWhere(['student' => $student]); 
            }	  
        }   
        $model = $query->select("id, name_silabus, path, course, student")->all();
        
        return $this->render('silabus', [
            'model' => $model, 
        ]);        
        
    }
    
    public function actionShow()
    {
        if (Yii::$app->user->can('readBook')) {
            $silabus = Silabus::find()->all();

            return $this->render('index', [
                'silabus' => $silabus,
            ]);
        }
    }
    
    public function actionAdd()
    {
        if (Yii::$app->user->can('addBook')) {
            $model = new Silabus(['scenario' => Silabus::SCENARIO_CREATE]);            
            
           // $curdir = getcwd(); Найди деректорию            
            
            if( $model->load(Yii::$app->request->post())) {
                $poles    = Yii::$app->request->post('Silabus');
                $filename = htmlspecialchars($poles['name_silabus']);
                if ($filename !== "" ) {
                    $model->file_book = UploadedFile::getInstance( $model, 'file_book');
                    if (!empty($model->file_book->baseName)) {
                        $model->path = 'database/silabus/'. $model->file_book->baseName . '.'. $model->file_book->extension;  
                    }                     
                }
                if ( $model->validate() ) {                        
                    $model->save(false);
                    $model->file_book->saveAS('database/silabus/'.$model->file_book->baseName . '.'. $model->file_book->extension );
                    return $this->redirect(['silabus/show']);
                }
                else
                    return $this->render('silabus-form', [
                        'model'   => $model,
                    ]);         
            }
            else 
            {
                return $this->render('silabus-form', [
                    'model' => $model,
                ]);
            }
        }
    }
    
    public function actionUpdate()
    {
        if (Yii::$app->user->can('updateBook')) {
        
           $bookId = Yii::$app->request->get('id');
           $model = Silabus::findOne($bookId);
            
           $model->scenario = Silabus::SCENARIO_UPDATE;  
           // $curdir = getcwd(); Найди деректорию            
            
            if( $model->load(Yii::$app->request->post())) {                     
               
                $poles =  Yii::$app->request->post('Silabus');
                $filename = htmlspecialchars($poles['name_silabus']);
                if ($filename !== "" ) {
                    $model->file_book = UploadedFile::getInstance( $model, 'file_book');
                    if (!empty($model->file_book->baseName)) {                        
                        $model->file_book->saveAS('database/silabus/'.$model->file_book->baseName . '.'. $model->file_book->extension );
                        $model->path = 'database/silabus/'. $model->file_book->baseName . '.'. $model->file_book->extension;
                    }                   
                }
                if ( $model->validate() ) {
                    $model->save(false);
                    return $this->redirect(['silabus/show']);
                }
                else
                    return $this->render('silabus-form', [
                        'model' => $model,
                    ]);         
            }
            else 
            {
                return $this->render('silabus-form', [
                    'model' => $model,
                ]);
            }
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
 
                    if (Yii::$app->user->can('readBook')) {
                        $columns = [
                            0 => 'id',
                            1 => 'course',
                            2 => 'student',
                            3 => 'name_silabus',
                            4 => 'path',
                            5 => 'created_at',
                        ];

                        $totalData = Silabus::find()->active()->count('id');

                        $silabus = Silabus::find();
                        
                        if (Yii::$app->request->post('show_deleted')) {
                            $show = (int)Yii::$app->request->post('show_deleted');
                            $silabus->andWhere(['status' => $show]);
                        }
                        
                        // Поиск по Названия
                        if (Yii::$app->request->post('name')) {
                            $filename = htmlspecialchars((string)Yii::$app->request->post('name'));
                            $silabus->andWhere(['like','name_silabus', $filename]);
                        }

                        $totalFiltered = $silabus->count('id');

                        $order = sprintf('%s %s', $columns[$_POST['order'][0]['column']], $_POST['order'][0]['dir']);

                        $data = $silabus->orderBy($order)->offset($_POST['start'])->limit($_POST['length'])->all();
                    }

                    $result['draw']             = (int)$_POST['draw'];
                    $result['recordsTotal']     = (int)$totalData;
                    $result['recordsFiltered']  = (int)$totalFiltered;
                    $result['data']             = $data;
                break;
                
                case 'delete':
                    $silabusId = Yii::$app->request->post('id');
                    
                    $silabus = Silabus::findOne($silabusId);
                    $silabus->scenario = Silabus::SCENARIO_DELETE;
                    if ($silabus && Yii::$app->user->can('deleteBook')) {
                        if ( $silabus->status === 1)                        
                            $result['code'] = $silabus->delete() ? 1 : 0;
                        else
                            $result['code'] = $silabus->acces() ? 1 : 0;
                    }
                break;
            }
        }
        
        return $result;
    }
}
