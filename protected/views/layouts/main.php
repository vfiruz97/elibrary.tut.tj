<?php
//date_default_timezone_set('Asia/Tashkent');
/* @var $this \yii\web\View */
/* @var $content string */

//use Yii;
use app\models\Comment;
use app\models\Darhost;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use app\forms\Login;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <!-- Main CSS -->
        <?= Html::cssFile('@web/templates/adminlte2/css/main.css') ?>
        <!-- Bootstrap Core CSS -->
        <?= Html::cssFile('@web/templates/adminlte2/css/bootstrap.min.css') ?>
        <!-- MetisMenu CSS -->
        <?= Html::cssFile('@web/templates/adminlte2/css/plugins/metisMenu/metisMenu.min.css') ?>
        <!-- Timeline CSS -->
        <?= Html::cssFile('@web/templates/adminlte2/css/plugins/timeline.css') ?>
        <!-- Notification -->
        <?= Html::cssFile('@web/templates/adminlte2/font-awesome-4.1.0/css/font-awesome.min.css') ?>
        <!-- Font Awesome -->
        <?php //= Html::cssFile('@web/templates/adminlte2/css/plugins/morris.css') ?>
        <!-- Ionicons -->
        <?= Html::cssFile('@web/templates/adminlte2/css/sb-admin-2.css') ?>
        <?= Html::cssFile('@web/templates/adminlte/plugins/toastr/css/toastr.min.css') ?>
        <?= Html::cssFile('@web/templates/adminlte/plugins/Ionicons/css/ionicons.min.css') ?>
        <?php 
        if ( Yii::$app->language  == 'ru-RU' )
            echo Html::cssFile('@web/templates/adminlte2/css/header_ru.css');
        else
            echo Html::cssFile('@web/templates/adminlte2/css/header_tj.css'); ?>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <?= Html::jsFile('@web/templates/adminlte/plugins/html5shiv.min.js') ?>
        <?= Html::jsFile('@web/templates/adminlte/plugins/respond.min.js') ?>
        <![endif]-->

        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>
<div class="visible-xs">
  </span>
</div>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" >
        <div class="row" style="margin-right:5px;">                         
            
            <!-- /.navbar-top-links -->
            <div class="navbar-header navbar-right">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            <ul class="nav navbar-top-links navbar-right">                 
                <!-- /.dropdown -->
                <li class="dropdown" style="margin-left:20px">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color:gold">
                        <span style="font-size:20px" class="hidden-xs"><?php if( Yii::$app->user->identity ) echo Yii::$app->user->identity; else echo Yii::t('app', 'Войти') ; ?></span>
                        <i class="fa fa fa-user fa-2x"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <?php if(!Yii::$app->user->isGuest) : ?>
                    <ul class="dropdown-menu dropdown-messages" >
                        <li><a href="<?= Url::toRoute('/user/profile') ?>"><i class="fa fa-user fa-fw"></i> <?= Yii::t('app', 'Профиль') ?></a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?= Url::toRoute('session/logout') ?>"><i class="fa fa-sign-out fa-fw"></i><?= Yii::t('app', 'Выход') ?></a>
                        </li>
                    </ul>
                    <?php else : ?>
                    <ul class="dropdown-menu dropdown-messages" >
                        <li><a href="<?= Url::toRoute('session/register') ?>"><i class="fa fa-user fa-fw"></i> <?= Yii::t('app', 'Регистрация') ?></a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?= Url::toRoute('session/logout') ?>"><i class="fa fa-sign-out fa-fw"></i><?= Yii::t('app', 'Войти') ?></a>
                        </li>
                    </ul>
                    <?php endif; ?>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            
            </div><!--/ row---->
            <div class="hidden-xs hidden-sm hidden-md col-lg-12">              
                <p style="height:140px; padding:110px 0 15px" align="right">  
                <?php if (Yii::$app->user->can('updateComment')): ?>             
                    <a title= "Новые коментарии" href="<?= Url::toRoute('/comment') ?>" >                        
                        <sub><i class="fa fa fa-comment fa-2x"></i></sub>
                        <sup><code><?= Comment::find()->where(['status' => 0])->count('id') ?></code></sup>
                    </a>                         
                <?php endif ?>
                <?php if (Yii::$app->user->can('updateComment')): ?>             
                    <a title= "Дархост" href="<?= Url::toRoute('/darhost/view') ?>" >                        
                        <sub><i class="fa fa fa-envelope fa-2x"></i></sub>
                        <sup><code><?= Darhost::find()->where(['status' => 1])->count('id') ?></code></sup>
                    </a>                         
                <?php endif ?>
               </p>   
            </div>
            <div class="hidden-xs hidden-sm hidden-lg col-md-2" >              
                <p style="height:100px" ></p>   
            </div>
            <div class="hidden-xs hidden-md hidden-lg col-sm-2">              
                <p style="height:78px" ></p>   
            </div> 
            </div>
            <!-- /.navbar-header -->

            <div class="navbar-default sidebar position-menu" role="navigation" style="background-color:#0e4c95;"> 
                <div class="sidebar-nav navbar-collapse" >
                <style>                      
                    ul#side-menu a {
                        color:white;
                        font-weight:bold;
                    }  
                    ul#side-menu a:hover {
                        color:black;                        
                    }  
                    li.active > a{
                     color:black!important;
                    } 
                </style>
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                        <form  method="GET" action="/book">
                            <div class="input-group custom-search-form">
                            <?php $search_text = Yii::t('app', 'Поиск...') ?>
                            <?= Html::textInput('name_book_id', null, ['class'=>'form-control', 'placeholder'=>"$search_text"]) ?>
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit"> 
                                        <i class="fa fa-search"> </i>
                                    </button>
                                </span>
                            </div>
                        </form>
                            <!-- /input-group -->
                        </li>
                        <li  style="border:0!important;">
                            <a href="<?= Url::toRoute('/index') ?>"><i class="fa fa-home fa-fw"></i><b> <?= Yii::t('app', 'Главная') ?></b></a>
                        </li>
                        <li  style="border:0!important;">
                            <a href="#"><i class="fa fa-book"></i> <?= Yii::t('app', 'Промышленность') ?> <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?= Url::toRoute('/book?category_book_id=1&subcategory_book_id=1') ?>"> <?= Yii::t('app', 'Легкая промышленность') ?> </a>
                                </li>
                                <li>
                                    <a href="<?= Url::toRoute('/book?category_book_id=1&subcategory_book_id=2') ?>">  <?= Yii::t('app', 'Пищевая промышленность') ?> </a>
                                </li>                               
                                <li>
                                    <a href="<?= Url::toRoute('/book?category_book_id=1&subcategory_book_id=3') ?>">  <?= Yii::t('app', 'другие публикации') ?> </a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li  style="border:0!important;">
                            <a href="<?= Url::toRoute('/book?category_book_id=2') ?>">
                            <i class="fa fa-book fa-fw"></i>  <?= Yii::t('app', 'Технические науки') ?></a>
                        </li>
                        <li  style="border:0!important;">
                            <a href="#"><i class="fa fa-book fa-fw"></i> <?= Yii::t('app', 'Менеджмент') ?> <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?= Url::toRoute('/book?category_book_id=3&subcategory_book_id=4') ?>">  <?= Yii::t('app', 'Международный менеджмент') ?> </a>
                                </li>
                                <li>
                                    <a href="<?= Url::toRoute('/book?category_book_id=3&subcategory_book_id=5') ?>">  <?= Yii::t('app', 'Инвестиционный менеджмент') ?> </a>
                                </li>       
                                <li>
                                    <a href="<?= Url::toRoute('/book?category_book_id=3&subcategory_book_id=6') ?>">  <?= Yii::t('app', 'Маркетинг') ?> </a>
                                </li>                        
                                <li>
                                    <a href="<?= Url::toRoute('/book?category_book_id=3&subcategory_book_id=7') ?>">  <?= Yii::t('app', 'другие публикации') ?> </a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li  style="border:0!important;">
                            <a href="#"><i class="fa fa-book fa-fw"></i>  <?= Yii::t('app', 'Экономика') ?> <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?= Url::toRoute('/book?category_book_id=4&subcategory_book_id=8') ?>"> <?= Yii::t('app', 'Мировая экономика') ?> </a>
                                </li>
                                <li>
                                    <a href="<?= Url::toRoute('/book?category_book_id=4&subcategory_book_id=9') ?>"> <?= Yii::t('app', 'Национальная экономика') ?> </a>
                                </li>                               
                                <li>
                                    <a href="<?= Url::toRoute('/book?category_book_id=4&subcategory_book_id=10') ?>"> <?= Yii::t('app', 'другие публикации') ?> </a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li> 
                        <li style="border:0!important;">
                            <a href="#"><i class="fa fa-book fa-fw"></i> <?= Yii::t('app', 'Точные науки') ?> <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?= Url::toRoute('/book?category_book_id=5&subcategory_book_id=11') ?>"> <?= Yii::t('app', 'Математика') ?> </a>
                                </li>
                                <li>
                                    <a href="<?= Url::toRoute('/book?category_book_id=5&subcategory_book_id=12') ?>"> <?= Yii::t('app', 'Физика') ?> </a>
                                </li>
                                <li>
                                    <a href="<?= Url::toRoute('/book?category_book_id=5&subcategory_book_id=13') ?>"> <?= Yii::t('app', 'Геометрия') ?> </a>
                                </li>
                                <li>
                                    <a href="<?= Url::toRoute('/book?category_book_id=5&subcategory_book_id=14') ?>"> <?= Yii::t('app', 'Биология') ?> </a>
                                </li>
                                <li>
                                    <a href="<?= Url::toRoute('/book?category_book_id=5&subcategory_book_id=15') ?>"> <?= Yii::t('app', 'Химия') ?> </a>
                                </li>
                                <li>
                                    <a href="<?= Url::toRoute('/book?category_book_id=5&subcategory_book_id=30') ?>"> <?= Yii::t('app', 'Компьютерные науки') ?> </a>
                                </li>
                                <li>
                                    <a href="<?= Url::toRoute('/book?category_book_id=5&subcategory_book_id=16') ?>"> <?= Yii::t('app', 'другие публикации') ?> </a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>                                                   
                        <li style="border:0!important;">
                            <a href="#"><i class="fa fa-book fa-fw"></i> <?= Yii::t('app', 'Гуманитарные науки') ?> <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?= Url::toRoute('/book?category_book_id=6&subcategory_book_id=17') ?>"> <?= Yii::t('app', 'Социология') ?> </a>
                                </li>
                                <li>
                                    <a href="<?= Url::toRoute('/book?category_book_id=6&subcategory_book_id=18') ?>"> <?= Yii::t('app', 'Культурология') ?> </a>
                                </li>                                
                                <li>
                                    <a href="<?= Url::toRoute('/book?category_book_id=6&subcategory_book_id=19') ?>"> <?= Yii::t('app', 'Язык') ?> </a>
                                </li>
                                <li>
                                <li>
                                    <a href="<?= Url::toRoute('/book?category_book_id=6&subcategory_book_id=20') ?>"> <?= Yii::t('app', 'Литература') ?> </a>
                                </li>
                                <li>
                                    <a href="<?= Url::toRoute('/book?category_book_id=6&subcategory_book_id=21') ?>"> <?= Yii::t('app', 'История') ?> </a>
                                </li>                                
                                <li>
                                    <a href="<?= Url::toRoute('/book?category_book_id=6&subcategory_book_id=22') ?>"> <?= Yii::t('app', 'Право') ?> </a>
                                </li>
                                <li>
                                    <a href="<?= Url::toRoute('/book?category_book_id=6&subcategory_book_id=23') ?>"> <?= Yii::t('app', 'Религия') ?> </a>
                                </li>
                                <li>
                                    <a href="<?= Url::toRoute('/book?category_book_id=6&subcategory_book_id=24') ?>"> <?= Yii::t('app', 'Естественные науки') ?> </a>
                                </li>
                                <li>
                                    <a href="<?= Url::toRoute('/book?category_book_id=6&subcategory_book_id=25') ?>"> <?= Yii::t('app', 'Концепция') ?> </a>
                                </li>
                                <li>
                                    <a href="<?= Url::toRoute('/book?category_book_id=6&subcategory_book_id=26') ?>"> <?= Yii::t('app', 'другие публикации') ?> </a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>                     
                        <li  style="border:0!important;">
                            <a href="<?= Url::toRoute('/book?category_book_id=7') ?>">
                            <i class="fa fa-book fa-fw"></i> <?= Yii::t('app', 'Художественная литература') ?></a>
                        </li>
                        <li  style="border:0!important;">
                            <a href="<?= Url::toRoute('/book?category_book_id=8') ?>">
                            <i class="fa fa-book fa-fw"></i>  <?= Yii::t('app', 'Политическая литература') ?></a>
                        </li> 
                        <li  style="border:0!important;">
                            <a href="<?= Url::toRoute('/book?category_book_id=10') ?>">
                            <i class="fa fa-book fa-fw"></i>  <?= Yii::t('app', 'Труды Лидера нации') ?></a>
                        </li>   
                        <li  style="border:0!important;">
                            <a href="<?= Url::toRoute('/book?category_book_id=11') ?>">
                            <i class="fa fa-book fa-fw"></i>  <?= Yii::t('app', 'Законы') ?></a>
                        </li>  
                        <li style="border:0!important;">
                            <a href="#"><i class="fa fa-book fa-fw"></i> <?= Yii::t('app', 'Научные диссертации') ?> <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?= Url::toRoute('/book?category_book_id=17&subcategory_book_id=33') ?>"> <?= Yii::t('app', 'Монографии') ?> </a>
                                </li>
                                <li>
                                    <a href="<?= Url::toRoute('/book?category_book_id=17&subcategory_book_id=30') ?>"> <?= Yii::t('app', 'Магистерские диссертации') ?> </a>
                                </li>
                                <li>
                                    <a href="<?= Url::toRoute('/book?category_book_id=17&subcategory_book_id=31') ?>"> <?= Yii::t('app', 'Кандидатские диссертации') ?> </a>
                                </li>
                                <li>
                                    <a href="<?= Url::toRoute('/book?category_book_id=17&subcategory_book_id=32') ?>"> <?= Yii::t('app', 'Докторские диссертации') ?> </a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>   
                        <li  style="border:0!important;">
                            <a href="<?= Url::toRoute('/book?category_book_id=18') ?>">
                            <i class="fa fa-book fa-fw"></i>  <?= Yii::t('app', 'Патенты') ?></a>
                        </li>              
                        <li  style="border:0!important;">
                            <a href="<?= Url::toRoute('/book?category_book_id=12') ?>">
                            <i class="fa fa-book fa-fw"></i>  <?= Yii::t('app', 'Методические пособии') ?></a>
                        </li> 
                        <li>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i> <?= Yii::t('app', 'Рабочие программы (силлабус)') ?> <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                     <a href="<?= Url::toRoute('/silabus?student=11') ?>"> <?= Yii::t('app', 'Для магистров') ?> </a>
                                </li>
                                <li>
                                    <a href="<?= Url::toRoute('/silabus?student=1&course=*') ?>"><?= Yii::t('app', 'Для студенов') ?> <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="<?= Url::toRoute('/silabus?student=1&course=1') ?>"> <?= Yii::t('app', '1-ый курс') ?> </a>
                                        </li>
                                        <li>
                                            <a href="<?= Url::toRoute('/silabus?student=1&course=2') ?>"> <?= Yii::t('app', '2-ой курс') ?> </a>
                                        </li>
                                        <li>
                                            <a href="<?= Url::toRoute('/silabus?student=1&course=3') ?>"> <?= Yii::t('app', '3-ый курс') ?> </a>
                                        </li>
                                        <li>
                                            <a href="<?= Url::toRoute('/silabus?student=1&course=4') ?>"> <?= Yii::t('app', '4-ый курс') ?> </a>
                                        </li>
                                    </ul>
                                    <!-- /.nav-third-level -->
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>                                            
                        <li  style="border:0!important;">
                            <a href="<?= Url::toRoute('/book?category_book_id=14') ?>">
                            <i class="fa fa-book fa-fw"></i> <?= Yii::t('app', 'Журналы') ?></a>
                        </li>
                        <li  style="border:0!important;">
                            <a href="<?= Url::toRoute('/book?category_book_id=15') ?>">
                            <i class="fa fa-book fa-fw"></i> <?= Yii::t('app', 'Газеты') ?></a>
                        </li>
                        <li  style="border:0!important;">
                            <a href="<?= Url::toRoute('/workers') ?>"><i class="fa fa-users fa-fw"></i><b> <?= Yii::t('app', 'Работники библиотеки') ?></b></a>
                        </li>
                        <li  style="border:0!important;">
                            <a href="<?= Url::toRoute('/abiturent') ?>">
                            <i class="fa fa-book fa-fw"></i> <?= Yii::t('app', 'Для абитуриентов') ?></a>
                        </li>                        
                        <li  style="border:0!important;">
                            <?php if (Yii::$app->user->can('readReport')): ?><a href="#"><i class="fa fa-adjust fa-fw"></i> <?= Yii::t('app', 'Отчеты') ?> <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?= Url::toRoute('/report/report-read-book') ?>"> <?= Yii::t('app', 'Отчет читаемости') ?> </a>
                                </li>
                                <li>
                                    <a href="<?= Url::toRoute('/report/download') ?>"> <?= Yii::t('app', 'Отчет скачивания') ?> </a>
                                </li>
                            </ul><?php endif ?>
                            <!-- /.nav-second-level -->
                        </li>                                               
                        <li  style="border:0!important;">
                            <?php if (Yii::$app->user->can('readCategory')): ?><a href="<?= Url::toRoute('/category') ?>"><i class="fa fa-tags fa-fw"></i> <?= Yii::t('app', 'Работа с категориями') ?> </a><?php endif ?>
                        </li> 
                        <li  style="border:0!important;">
                            <?php if (Yii::$app->user->can('readCategory')): ?><a href="<?= Url::toRoute('/silabus/show') ?>"><i class="fa fa-tags fa-fw"></i> <?= Yii::t('app', 'Работа с силабусами') ?> </a><?php endif ?>
                        </li>                        
                        <li  style="border:0!important;">
                            <?php if (Yii::$app->user->can('readBook')): ?><a href="<?= Url::toRoute('/book/show') ?>"><i class="fa fa-list-alt  fa-fw"></i></i> <?= Yii::t('app', 'Работа с книгами') ?> </a><?php endif ?>
                        </li>
                        <li>
                            <?php if (Yii::$app->user->can('readUsers')): ?><a href="<?= Url::toRoute('/user') ?>"><i class="fa fa-users fa-fw"></i> <?= Yii::t('app', 'Пользователи') ?></a><?php endif ?>
                        </li>
                        <li>
                            <?php if (Yii::$app->user->can('readUsers')): ?><a href="<?= Url::toRoute('/from-elibrary') ?>"><i class="fa fa-book fa-fw"></i> <?= Yii::t('app', 'Генерации папки') ?></a><?php endif ?>
                        </li>
                    </ul>
                    <div class="content col-lg-12" style="background-color:#0e4c95;">
                        <?php include "poliznie_sayty.php";?>
                    </div> 
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        <!-- Menu end start maun content -->
        <div id="page-wrapper">
        	<div class="container-fluid">
        	<!--Здесь может контент по сегодняшный расчет-->      
                <div class="row">
                    <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12" style="border-right:1px solid #ddd;">        
                        <section class="content col-lg-12">
                            <?= $content ?>
                        </section>  
                    </div>
                    <div class="col-lg-3 col-md-4 hidden-sm hidden-xs" style="background-color:#0e4c95;color:white">  
                        <div class="dropdown languages" style="background-color:#0e4c95;color:white">
                            <form id="header-language-form">
                                <?= Html::dropDownList('language', Yii::$app->language, Login::$availableLanguages, ['class' => 'form-control input-sm']) ?>
                            </form>
                        </div>                           
                        <section class="content col-lg-12" style="background:#0e4c95;color:white">
                            <?php include "camerical.php";?>
                        </section>  
                    </div>                        
                </div>
            </div>
        <!-- /#page-wrapper -->        
        </div>
    </div>
        
    <!-- /#wrapper -->
    <div class="footer-footer">
        <div class="row">
            <div class="col-lg-12" ><!- Poleznie sayty-->
                <?php include "footer.php";?> 
            </div>
        </div>
    </div>    
     <script type="text/javascript">
            // Список доступных разрешений для пользователя
            var ACL = {
                <?php
                    $auth = Yii::$app->authManager;

                    $availablePermissions = [];
                    foreach ($auth->getPermissionsByUser(Yii::$app->user->getId()) as $name => $permission) {
                        $availablePermissions[] = sprintf('%s: true', $name);
                    }
                    echo join(',', $availablePermissions);
                ?>
            };

            var userCan = function (permission) {
                return ACL.hasOwnProperty(permission) && ACL[permission] === true;
            };

            // i18n
            var MESSAGES = <?= json_encode($this->context->jsTranslations) ?>;

            var t = function (message) {
                return MESSAGES.hasOwnProperty(message) ? MESSAGES[message] : message;
            };
                        
        </script>
    <?= Html::jsFile('@web/templates/adminlte2/js/jquery.js') ?>
    <?= Html::jsFile('@web/templates/adminlte2/js/bootstrap.min.js') ?>
    <!-- Notification -->
    <?= Html::jsFile('@web/templates/adminlte2/js/plugins/metisMenu/metisMenu.min.js') ?>
    <!-- Bootbox -->
    <!-- AdminLTE App -->
    <?= Html::jsFile('@web/templates/adminlte2/js/sb-admin-2.js') ?>    
        <!-- DataTables -->
        <!-- Moment -->
        <?php //= Html::jsFile('@web/templates/adminlte/plugins/moment/moment.min.js') ?>
        <?php //= Html::jsFile('@web/templates/adminlte/plugins/moment/locale/ru.js') ?>
        <!-- Datepicker -->
        <?php //= Html::jsFile('@web/templates/adminlte/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') ?>
        <!-- jQuery Validation -->
        <?php //= Html::jsFile('@web/templates/adminlte/plugins/jquery-validation/jquery.validate.min.js') ?>
        <!-- Ladda for Bootstrap 3 -->
        <?php //= Html::jsFile('@web/templates/adminlte/plugins/ladda-bootstrap/js/spin.min.js') ?>
        <?php //= Html::jsFile('@web/templates/adminlte/plugins/ladda-bootstrap/js/ladda.min.js') ?>
        <!-- Notification -->
        <?= Html::jsFile('@web/templates/adminlte/plugins/toastr/js/toastr.min.js') ?>
       
        <!-- Custom scripts -->
        <?= Html::jsFile('@web/templates/pages/scripts/app.js?v=1504107201') ?>
    
        <script type="text/javascript">
            $.ajaxSetup({
                data: <?= Json::encode([
                    Yii::$app->request->csrfParam => Yii::$app->request->csrfToken,
                ]) ?>
            });
            
            $(document).ready( function(){
               // window.alert( $(window).width() );
                var widthScreen = $(window).width();
                if ( widthScreen < 700 ) {
                    $(".navbar").css('background','none');
                }
                
                $('#header-language-form')
                    .on('change', 'select', function () {
                        var language = $(this).val(),
                            url = window.location.href.toString().split(window.location.host)[1],
                            splittedUrl = url.split('?'),
                            baseUrl = splittedUrl[0],
                            params = splittedUrl[1],
                            queryString = '',
                            paramsSeparator = '';

                        if (params) {
                            var splittedParams = params.split('&');
                            for (var i = 0; i < splittedParams.length; i++) {
                                if (splittedParams[i].split('=')[0] !== 'language'){
                                    queryString += paramsSeparator + splittedParams[i];
                                    paramsSeparator = '&';
                                }
                            }
                        }
                        window.location.href = baseUrl + '?' + queryString + (paramsSeparator + 'language=' + language);
                    });
            });
        </script>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
