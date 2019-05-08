<?php 
namespace app\models;

use yii\base\Model;
use app\models\Base;

class FromElibrary extends Base
{
    public $name_book_id;

    public static function tableName()
    {
        return 'generate_books';
    }

    public function rules()
    {
        return [
            [['name_book', 'path'], 'required'], 
        ];
    }
        
	public function FromElibrary( $path ) {
	    $files = array();
        $errors = "";
        
        $extensions = array('txt','php','pdf','html',);        
        
        if(!realpath($path)) {
	        $errors .= "Неправильный путь: $path <br>";
        } else {
	         if($handle = opendir($path)){
		        if($handle) {			
			        while(false !== ($file= readdir($handle))){
				        if ($file != '.' && $file != "..") {
					        if (!isset(pathinfo($file)['extension'])) {
						        $errors .= "Тут неправильные файлы - {$file}  (не иммеет расширение может это папка?) <br>";
					        } else {						
					            if (in_array(pathinfo($file)['extension'], $extensions)) {
						            array_push($files, $file ); 
					            }
					        }
				        }
			        }
		        } else {
			        $errors .= "Неоткроется данный путь: $path <br>";			
		        }
		        closedir($handle);	
	        }
        }
        if (!empty($errors)) {
            $error = array(); 
            array_push($error, $errors );  
            return $error; 
        }
        return $files;
	}

}
