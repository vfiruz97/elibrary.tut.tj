<?php
/**
 * Author: Vorisov Firuz
 * Date: 18.10.17
 * Time: 21:49
 */
namespace app\controllers;

use Yii;
use yii\web\Response;
use app\assets\CommentAsset;
use app\models\Darhost;

class DarhostController extends BaseController
{
    public function init()
    {
        parent::init();        
        CommentAsset::register($this->view);
    }
    
    public function actionIndex()
    {
        if (Yii::$app->user->can('createDarhost')) {
            $model = new Darhost();
            if (Yii::$app->request->isPost) 
            {                  
                
                if ($model->load(Yii::$app->request->post())) {
                    if($model->save()){
                        $alert  = "success";
                        $message ="<strong>Муваффақона</strong> дархости Шумо ирсол шуд.";
                        return $this->render('index', [
                            'model' => $model, 
                            'alert' => $alert,
                            'message'=>$message,
                        ]);
                    } else {
                        $alert  = "danger";
                        $message="Дархости Шумо ирсол нашуд.";
                        return $this->render('index', [
                            'model' => $model, 
                            'alert' => $alert,
                            'message'   => $message
                        ]);
                    }                    
                }
            }            
        }
        
        return $this->render('index', [
            'model' => $model,        
        ]);
    }
    
    public function actionView()
    {
        if (Yii::$app->user->can('createDarhost')) {
            $model = Darhost::find()->where(['status' => 1])->all();
                    
            return $this->render('viewes', [
                'model' => $model,        
            ]);
        }
    }
    
    public function actionDarhost()
    {
        $darhostId = Yii::$app->request->get('id');
        $model = Darhost::findOne($darhostId);
                    
        return $this->render('index', [
            'model' => $model,        
        ]);
    }
    
    public function actionDelete()
    {
        $darhostId = Yii::$app->request->get('id');
        $model = Darhost::findOne($darhostId);
        
        $model->status = 0;
        $model->save();        
                    
        return $this->redirect(['darhost/view']);
    }
}
