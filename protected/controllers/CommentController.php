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
use app\models\Comment;

class CommentController extends BaseController
{
    public function init()
    {
        parent::init();        
        CommentAsset::register($this->view);
    }

    public function actionIndex()
    {
        if (Yii::$app->user->can('updateComment')) {

            return $this->render('index');
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
 
                    if (Yii::$app->user->can('updateComment')) {
                        $columns = [
                            0 => 'id',
                            1 => 'username',
                            2 => 'comment',
                        ];

                        $totalData = Comment::find()->active()->count('id');
                        
                        $comment = Comment::find();
                        $comment->andWhere(['status' => 0]);

                        $totalFiltered = $comment->count('id');

                        $order = sprintf('%s %s', $columns[$_POST['order'][0]['column']], $_POST['order'][0]['dir']);

                        $data = $comment->orderBy($order)->offset($_POST['start'])->limit($_POST['length'])->all();
                    }

                    $result['draw']             = (int)$_POST['draw'];
                    $result['recordsTotal']     = (int)$totalData;
                    $result['recordsFiltered']  = (int)$totalFiltered;
                    $result['data']             = $data;
                break;
                
                case 'access':
                    $commentId = Yii::$app->request->post('id');
                    
                    $comment = Comment::findOne($commentId);
                    if ($comment && Yii::$app->user->can('deleteComment')) {
                            $result['code'] = $comment->acces() ? 1 : 0;
                    }
                break;
                
                case 'delete':
                    $commentId = Yii::$app->request->post('id');
                   
                    $comment = Comment::findOne($commentId);
                    if ($comment && Yii::$app->user->can('deleteComment')) {
                            $result['code'] = $comment->deleteFromDatabase() ? 1 : 0;
                    }
                break;
            }
        }
        
        return $result;
    }
}
