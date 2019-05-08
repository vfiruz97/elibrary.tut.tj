<?php
namespace app\controllers;
use app\models\FromElibrary;
use Yii;
use Exception;
use Throwable;
use yii\web\Response;
use yii\data\Pagination;

class FromElibraryController extends BaseController 
{

	public function actionIndex() {
	    $model = new FromElibrary();
	    $files = $model->FromElibrary("/home/firuz/library/database/books/");
	    	    
		return $this->render('index', [
		    'files' => $files,
		]);
	}
	
	public function actionAdd() {
	    $model = new FromElibrary();
	    $files = $model->FromElibrary("/home/firuz/library/database/books/");
	    
         Yii::$app->db->createCommand("DELETE FROM generate_books")->execute();
         if (!empty($files)) {
            foreach ($files as $file) {
                $model = new FromElibrary();
                $model->name_book   = $file;
                $model->path        = 'database/books/'.$file;
               // $model->save();
                if (!$model->validate() or !$model->save()) {                    
                    $alert  = "danger";
                    $message="Китобҳо дохил нашуданд ба хазинаи иловагӣ.";
                } else {
                    $alert  = "success";
                    $message ="Китобҳо дохил шуданд ба хазинаи иловагӣ.";
                }
            }                
        } else {
            $alert  = "danger";
            $message="Китоб вуҷуд надорад.";
        }
	    
		return $this->render('index', [
		    'files' => $files,
		    'alert' => $alert,
            'message'   => $message
		]);
	}
	
	public function actionSearch() {
	    $model = new FromElibrary();
	    
	    if (Yii::$app->request->isGet) {
            $model->name_book_id	= htmlspecialchars(Yii::$app->request->get('name_book_id'));  
            $model->name_book_id 	= trim($model->name_book_id);     
        }
	    $query = FromElibrary::find()->active(); 
	    //Поиск по названые книги
	    if ($model->name_book_id)
        	$query->andWhere(['like', 'name_book', $model->name_book_id]); 
        	
    	$countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => Yii::$app->params['pagination']]);
        $pages->pageSizeParam = false;
        $models = $query->select("id, name_book, path ")
        ->offset($pages->offset)
        ->limit($pages->limit)
        ->all();
        	 
		return $this->render('search', [
		    'models' => $model,
		    'model' => $models,
		    'pages' => $pages,
		]);
	}
}
