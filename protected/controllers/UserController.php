<?php
/**
 * Author: Vorisov Firuz
 * Date: 18.10.17
 * Time: 21:49
 */
namespace app\controllers;

use Yii;
use yii\web\Response;
use app\assets\UserAsset;
use app\models\Faculty;
use app\models\Speciality;
use app\models\User;
use app\models\views\Users;

class UserController extends BaseController
{
    public function init()
    {
        parent::init();
        
        UserAsset::register($this->view);
    }

    public function actionIndex()
    {
        if (Yii::$app->user->can('readUsers')) {
            $faculty = Faculty::find()->all();
            $speciality = Speciality::find()->all();

            return $this->render('index', [
                'faculty'   => $faculty,
                'speciality'   => $speciality,
            ]);
        }
    }
    
    public function actionProfile()
    {
        if (Yii::$app->user->can('readUsers')) {
            $faculty = Faculty::find()->all();
            $speciality = Speciality::find()->all();
            $userId = Yii::$app->user->id;                    
            $user = User::findOne($userId);
            $user->scenario = User::SCENARIO_UPDATE;

            if (Yii::$app->request->isPost) {
                $user->load(Yii::$app->request->post());
                if ( $user->validate())
                    $user->save();
            }

            return $this->render('profile-user', [
                'model'         => $user,
                'faculty'       => $faculty,
                'speciality'    => $speciality,
            ]);
        }
    }
    
    public function actionAux($command = null)
    {
        switch ($command) {            
            case 'update-user':
                if (Yii::$app->user->can('updateUser')) {                    
                    $userId = Yii::$app->request->post('id');                    
                    $user = User::findOne($userId);
                    
                    $faculty = Faculty::find()->all();
                    $speciality = Speciality::find()->where(['faculty_id'=> $user->faculty_id])->all();
                    

                    $auth = Yii::$app->authManager;
                    $roles = $auth->getRoles();

                    return $this->renderPartial('aux/user-form', [
                        'model'         => $user,
                        'roles'         => $roles,
                        'faculty'       => $faculty,
                        'speciality'    => $speciality,
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
                case 'list': // Список пользователей
                    $totalData      =
                    $totalFiltered  = 0;
                    $data           = [];
 
                    if (Yii::$app->user->can('readUsers')) {
                        $columns = [
                            0 => 'id',
                            1 => 'name',
                            2 => 'email',
                            3 => 'date_of_birth',
                            4 => 'faculty',
                            5 => 'speciality',
                            6 => 'created_at',
                        ];

                        $totalData = Users::find()->active()->count('id');

                        $users = Users::find();
                        
                        if (Yii::$app->request->post('show_deleted')) {
                            $show = (int)Yii::$app->request->post('show_deleted');
                            $users->andWhere(['status' => $show]);
                        }
                        
                        // Поиск по ФИО
                        if (Yii::$app->request->post('name')) {
                            $nameUser = htmlspecialchars((string)Yii::$app->request->post('name'));
                            $users->andWhere(['like','name', $nameUser]);
                        }
                        
                        // Поиск по факультету
                        if (Yii::$app->request->post('faculty')) {
                            $facultyId = (int)Yii::$app->request->post('faculty');
                            $users->andWhere(['faculty_id' => $facultyId]);
                        }

                        $totalFiltered = $users->count('id');

                        $order = sprintf('%s %s', $columns[$_POST['order'][0]['column']], $_POST['order'][0]['dir']);

                        $data = $users->orderBy($order)->offset($_POST['start'])->limit($_POST['length'])->all();
                    }

                    $result['draw']             = (int)$_POST['draw'];
                    $result['recordsTotal']     = (int)$totalData;
                    $result['recordsFiltered']  = (int)$totalFiltered;
                    $result['data']             = $data;
                break;
                            
                case 'update':
                    if (Yii::$app->user->can('updateUser')) {
                        $userId = Yii::$app->request->post('id');
                    
                        $user = User::findOne($userId);
                        $user->scenario = User::SCENARIO_UPDATE;

                        if ($user->load(Yii::$app->request->post())) {
                            $result['code'] = $user->validate() && $user->save() ? 1 : 0;
                            $result['messages'] = $user->getErrors();
                        }
                    }
                break;
                
                case 'delete':
                    $userId = Yii::$app->request->post('id');
                    
                    $user = User::findOne($userId);
                    if ($user && Yii::$app->user->can('deleteUser', ['deletableUser' => $user])) {
                        $user->scenario = User::SCENARIO_DELETE;
                        if ( $user->status === 1)                        
                            $result['code'] = $user->delete() ? 1 : 0;
                        else
                            $result['code'] = $user->acces() ? 1 : 0;
                    }
                break;
            }
        }
        
        return $result;
    }
}
