<?php
/**
 * Author: Vorisov Firuz power_start@mail.ru
 * Date: 14.09.17
 * Time: 11:20
 */
namespace app\controllers;

use Exception;
use Throwable;
use Yii;
use yii\web\Response;
use yii\data\Pagination;
use app\assets\BookAsset;
use app\models\Book;
use app\models\views\Books;
use app\models\Category;
use app\models\Subcategory;
use app\models\BookView;
use app\models\Comment;
use app\models\Mark;
use app\models\Report;
use app\models\Download;
use app\models\views\Users;

use yii\web\UploadedFile;

class BookController extends BaseController
{
    public function init()
    {
        parent::init();

        BookAsset::register($this->view);
    }
    
    public function actionRead()
    {
        if (Yii::$app->request->isGet) {
            $report = new Report();
            $user = Users::findOne(['id'=> Yii::$app->user->id]);          
            
            if (Yii::$app->request->get('id')) {  
               	$id = htmlspecialchars(Yii::$app->request->get('id'));
               	$book = Books::findOne(['id'=>$id]); 
               	
               	$report->user           = $user->name;
               	$report->faculty_ru     = $user->faculty; 
               	$report->speciality_ru  = $user->speciality;
               	$report->faculty_tj     = $user->faculty;
               	$report->speciality_tj  = $user->speciality;
               	$report->book           = $book->name_book;
               	$report->category_ru    = $book->category_ru;
               	$report->subcategory_ru = $book->subcategory_ru;
               	$report->category_tj    = $book->category_tj;
               	$report->subcategory_tj = $book->subcategory_tj;
               	$report->author         = $book->author;             	
               	$report->created_at_time = Yii::$app->getFormatter()->asDatetime(time());
               	$report->save();
               	
                return $this->redirect('../'.$book->path);
            }
            return "Не найдена";
        }
        return "Не найдена";
    }
    
    public function actionDownload()
    {
        if (Yii::$app->request->isGet) {
            $download = new Download();
            $user = Users::findOne(['id'=> Yii::$app->user->id]);
            
            if (Yii::$app->request->get('id')) {  
               	$id = htmlspecialchars(Yii::$app->request->get('id'));
               	$book = Books::findOne(['id'=>$id]); 
               	
               	$download->user           = $user->name;
               	$download->faculty_ru     = $user->faculty; 
               	$download->speciality_ru  = $user->speciality;
               	$download->faculty_tj     = $user->faculty;
               	$download->speciality_tj  = $user->speciality;
               	$download->book           = $book->name_book;
               	$download->category_ru    = $book->category_ru;
               	if (!empty($book->subcategory_ru) && isset($book->subcategory_ru))
               	    $download->subcategory_ru = $book->subcategory_ru;
           	    else 
           	        $download->subcategory_ru = null;
           	        
               	$download->category_tj    = $book->category_tj;
               	if(!empty($book->subcategory_tj) && isset($book->subcategory_tj))
               	    $download->subcategory_tj = $book->subcategory_tj;
           	    else 
           	        $download->subcategory_tj = null;
           	        
               	$download->author         = $book->author;             	
               	$download->created_at_time = Yii::$app->getFormatter()->asDatetime(time());
               	$download->save();
               	return false;
            }
            return "Не найдена";
        }
        return "Не найдена";
    }
    
    public function actionIndex()
    {
        $category = Category::find()->active()->all();
        $subcategory = Subcategory::find()->active()->all();
        $search = new Books();

        if (Yii::$app->request->isGet) {
           	$search->name_book_id 	    = htmlspecialchars(Yii::$app->request->get('name_book_id'));
           	$search->name_book_id 	    = trim($search->name_book_id);
           	$search->name_author 	    = htmlspecialchars(Yii::$app->request->get('name_author'));
           	$search->name_author 	    = trim($search->name_author);
	   		$search->category_book_id 	= htmlspecialchars(Yii::$app->request->get('category_book_id'));
	        $search->subcategory_book_id = htmlspecialchars(Yii::$app->request->get('subcategory_book_id'));  
	    }elseif (Yii::$app->request->isPost) {
            $search->category_book_id 	= Yii::$app->request->post('Books')['category_book_id']; 
            $search->subcategory_book_id = Yii::$app->request->post('Books')['subcategory_book_id'];   
            $search->lang_book_id 	= htmlspecialchars(Yii::$app->request->post('Books')['lang_book_id']); 
            $search->name_book_id 	= htmlspecialchars(Yii::$app->request->post('Books')['name_book_id']);  
            $search->name_book_id 	= trim($search->name_book_id); 
            $search->name_author 	= htmlspecialchars(Yii::$app->request->post('Books')['name_author']);  
            $search->name_author 	= trim($search->name_author);      
        }
        else {
	        $search->category_book_id 	=   1;
	        $search->subcategory_book_id = 1;	    
	    }

        $query = Books::find()->active(); 
        //Поиск по категории 
        if ($search->category_book_id)
        	$query->andWhere(['category_id' => $search->category_book_id]);
        //Поиск по подкатегории
        if ($search->subcategory_book_id)
        	$query->andWhere(['subcategory_id' => $search->subcategory_book_id]);
        //Поиск по язык книги
        if ($search->lang_book_id)
        	$query->andWhere(['lang_book' => $search->lang_book_id ]);
        //Поиск по названые книги
        if ($search->name_author)
        	$query->andWhere(['like', 'author', $search->name_author]);    
    	//Поиск по автор книги
        if ($search->name_book_id)
        	$query->andWhere(['like', 'name_book', $search->name_book_id]);  
        
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => Yii::$app->params['pagination']]);
        $pages->pageSizeParam = false;
        $model = $query->select("id, category_ru, category_tj, subcategory_ru, subcategory_tj, author, name_book, lang_book, path_photo")
        ->offset($pages->offset)
        ->limit($pages->limit)
        ->all();
        
        return $this->render('show-books', [
            'model'         => $model, 
            'category'      => $category,
            'subcategory'   => $subcategory,
            'pages'         => $pages,
            'models'        => $search,
        ]);        
    }
    

    public function actionBookInfo()
    {
        $model_comment = new Comment();
         
        if(Yii::$app->request->isPost) {
            if( Yii::$app->request->post('Comment') ) {
                $model_comment->username = Yii::$app->user->identity;
                $model_comment->comment  = htmlspecialchars( Yii::$app->request->post('Comment')['comment']);
                $model_comment->book_id  = Yii::$app->request->post('id');
                $model_comment->status  = 0;
                $model_comment->save();            
            }
            if( Yii::$app->request->post('mark') ) {
                $mark   = Mark::find()->where(['book_id'=> Yii::$app->request->post('book_id')])->active()->one();
                $mark->marks += Yii::$app->request->post('mark');
                $mark->iden  += 1;
                $mark->save();            
            }
        $bookId = htmlspecialchars(Yii::$app->request->post('id'));
        }
    		
    	if(Yii::$app->request->isGet)
    		$bookId = htmlspecialchars(Yii::$app->request->get('id'));
    		
		$book 	= Books::find()->where(['id'=> $bookId])->active()->one();		
		$view   = BookView::find()->where(['book_id' => $book->name_book ])->one();
		$view->view += 1;  $view->save();
		$comment = Comment::find()->where(['book_id' => $book->id])->orderBy(['id'=>SORT_DESC])->limit(20)->all();
    	$mark   = Mark::find()->where(['book_id'=> $book->name_book])->active()->one();
    	return $this->render('book_info', [
			'book'	=> $book,
			'view'  => $view,
			'comment' => $comment,
			'model_comment' => $model_comment,
			'mark'  => $mark,
		]);
    }
    
    public function actionShow()
    {
        if (Yii::$app->user->can('readBook')) {
            $category = Category::find()->all();

            return $this->render('index', [
                'category' => $category,
            ]);
        }
    }
    
    public function actionAdd()
    {
        if (Yii::$app->user->can('addBook')) {
            $category = Category::find()->all();
            $subcategory = Subcategory::find()->all();
            $mark = new Mark();
            $view = new BookView();
            $model = new Book(['scenario' => Book::SCENARIO_CREATE]);            
            
           // $curdir = getcwd(); Найди деректорию            
            
            if( $model->load(Yii::$app->request->post())) {
                $subcategory_id             = Yii::$app->request->post('subcategory_id');
              //  if ($subcategory_id)                 
                    $model->subcategory_id  = htmlspecialchars($subcategory_id);
                $poles                      = Yii::$app->request->post('Book');
                $filename = htmlspecialchars($poles['name_book']);
                if ($filename !== "" ) {
                    $model->file_book = UploadedFile::getInstance( $model, 'file_book');
                    $model->picture = UploadedFile::getInstance( $model, 'picture');
                    if (!empty($model->file_book->baseName) && !empty($model->picture->baseName)) {
                        $model->path = 'database/ebooks/'. $model->file_book->baseName . '.'. $model->file_book->extension;
                        $model->path_photo = 'database/photoes/'. $model->picture->baseName . '.'. $model->picture->extension;  
                    }                     
                }
                if ( $model->validate() ) {
                
                    $view->book_id  = $model->name_book;
                    $view->view     =1;
                    
                    $mark->book_id  = $model->name_book;
                    $mark->username = Yii::$app->user->identity;
                    $mark->iden     = 1;
                    $mark->marks    = 10;
                        
                    $model->save(false);
                    $view->save();
                    $mark->save();
                    $model->file_book->saveAS('database/ebooks/'.$model->file_book->baseName . '.'. $model->file_book->extension );
                    $model->picture->saveAS('database/photoes/'. $model->picture->baseName .'.'. $model->picture->extension );
                    return $this->redirect(['book/show']);
                }
                else
                    return $this->render('book-form', [
                        'model'         => $model,
                        'category'      => $category,
                        'subcategory'   => $subcategory,
                        'subcategory_id' => $subcategory_id,
                    ]);         
            }
            else 
            {
                return $this->render('book-form', [
                    'model'         => $model,
                    'category'      => $category,
                    'subcategory'   => $subcategory,
                ]);
            }
        }
    }
    
    public function actionUpdate()
    {
        if (Yii::$app->user->can('updateBook')) {
            $category = Category::find()->all();
            $subcategory = Subcategory::find()->all();
        
           $bookId = Yii::$app->request->get('id');
           $model = Book::findOne($bookId);  
           $view = BookView::find()->where(['book_id' => $model->name_book])->one();
           $mark = Mark::find()->where(['book_id' => $model->name_book])->one();
            
           $model->scenario = Book::SCENARIO_UPDATE;       
           $subcategory_id  = $model->subcategory_id;
           // $curdir = getcwd(); Найди деректорию            
            
            if( $model->load(Yii::$app->request->post())) {
                $subcategory_id  = Yii::$app->request->post('subcategory_id');
              //  if ($subcategory_id)                 
                    $model->subcategory_id  = htmlspecialchars($subcategory_id);                     
               
                $poles =  Yii::$app->request->post('Book');
                $filename = htmlspecialchars($poles['name_book']);
                if ($filename !== "" ) {
                    $model->file_book = UploadedFile::getInstance( $model, 'file_book');
                    $model->picture = UploadedFile::getInstance( $model, 'picture');
                    if (!empty($model->file_book->baseName)) {                        
                        $model->file_book->saveAS('database/ebooks/'.$model->file_book->baseName . '.'. $model->file_book->extension );
                        $model->path = 'database/ebooks/'. $model->file_book->baseName . '.'. $model->file_book->extension;
                    } 
                    if (!empty($model->picture->baseName)) {
                        $model->picture->saveAS('database/photoes/'. $model->picture->baseName .'.'. $model->picture->extension );
                        $model->path_photo = 'database/photoes/'. $model->picture->baseName . '.'. $model->picture->extension; 
                    }                    
                }
                if ( $model->validate() ) {
                    $view->book_id  = $model->name_book;
                    
                    $mark->book_id  = $model->name_book;
                    $mark->username = Yii::$app->user->identity;
                    
                    $model->save(false);
                    $view->save();
                    $mark->save();
                    return $this->redirect(['book/show']);
                }
                else
                    return $this->render('book-form', [
                        'model' => $model,
                        'category'      => $category,
                        'subcategory'   => $subcategory,
                        'subcategory_id' => $subcategory_id,
                    ]);         
            }
            else 
            {
                return $this->render('book-form', [
                    'model' => $model,
                    'category'      => $category,
                    'subcategory'   => $subcategory,
                    'subcategory_id' => $subcategory_id,
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
                case 'list': // Список книги
                    $totalData      =
                    $totalFiltered  = 0;
                    $data           = [];
 
                    if (Yii::$app->user->can('readBook')) {
                        $columns = [
                            0 => 'id',
                            1 => 'category_ru',
                            2 => 'subcategory_ru',
                            3 => 'author',
                            4 => 'name_book',
                            5 => 'created_at',
                        ];

                        $totalData = Books::find()->active()->count('id');

                        $books = Books::find();
                        
                        if (Yii::$app->request->post('show_deleted')) {
                            $show = (int)Yii::$app->request->post('show_deleted');
                            $books->andWhere(['status' => $show]);
                        }
                        
                        // Поиск по Названия
                        if (Yii::$app->request->post('name')) {
                            $filename = htmlspecialchars((string)Yii::$app->request->post('name'));
                            $books->andWhere(['like','name_book', $filename]);
                        }
                        
                        // Поиск по категория
                        if (Yii::$app->request->post('category')) {
                            $categoryId = (int)Yii::$app->request->post('category');
                            $books->andWhere(['category_id' => $categoryId]);
                        }

                        $totalFiltered = $books->count('id');

                        $order = sprintf('%s %s', $columns[$_POST['order'][0]['column']], $_POST['order'][0]['dir']);

                        $data = $books->orderBy($order)->offset($_POST['start'])->limit($_POST['length'])->all();
                    }

                    $result['draw']             = (int)$_POST['draw'];
                    $result['recordsTotal']     = (int)$totalData;
                    $result['recordsFiltered']  = (int)$totalFiltered;
                    $result['data']             = $data;
                break;
                
                case 'delete':
                    $bookId = Yii::$app->request->post('id');
                    
                    $book = Book::findOne($bookId);
                    $book->scenario = Book::SCENARIO_DELETE;
                    if ($book && Yii::$app->user->can('deleteBook')) {
                        if ( $book->status === 1)                        
                            $result['code'] = $book->delete() ? 1 : 0;
                        else
                            $result['code'] = $book->acces() ? 1 : 0;
                    }
                break;
            }
        }
        
        return $result;
    }
}
