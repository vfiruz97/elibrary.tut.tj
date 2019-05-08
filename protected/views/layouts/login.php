<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <!-- Bootstrap 3.3.7 -->
        <?= Html::cssFile('@web/templates/adminlte/plugins/bootstrap/css/bootstrap.min.css') ?>
        <!-- Font Awesome -->
        <?= Html::cssFile('@web/templates/adminlte/plugins/font-awesome/css/font-awesome.min.css') ?>
        <!-- Ionicons -->
        <?= Html::cssFile('@web/templates/adminlte/plugins/Ionicons/css/ionicons.min.css') ?>
        <!-- iCheck -->
        <?= Html::cssFile('@web/templates/adminlte/plugins/iCheck/square/blue.css') ?>
        <!-- Theme style -->
        <?= Html::cssFile('@web/templates/adminlte/css/AdminLTE.min.css') ?>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <?= Html::jsFile('@web/templates/adminlte/plugins/html5shiv.min.js') ?>
        <?= Html::jsFile('@web/templates/adminlte/plugins/respond.min.js') ?>
        <![endif]-->

        <!-- Google Font -->
        <?= Html::cssFile('@web/templates/adminlte/css/font.min.css') ?>

        <!-- Custom styles -->
        <?= Html::cssFile('@web/templates/pages/css/default.css?v=1504438247') ?>
        <style>
            .login-page .header {
                background-color: #fff;
                border-bottom: 3px solid #888;
            }
            .login-page .header h4 {
                text-transform: uppercase;
            }
            .login-page .header .national-emblem {
                height: 50px;
                margin: 4px;
            }        
        </style>
        <?php $this->head() ?>
        <style>
            .login-page {
                background-color: rgba(205, 215, 215, 0.25);
            }
        </style>
    </head>
    <body class="hold-transition login-page">
        <?php $this->beginBody() ?>
            <div class="row header">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12 text-center"><h4><strong><?= Yii::t('app','Электронная библиотека Технологического Университета Таджикистана') ?></strong></h4></div>
                    </div>                    
                </div>
            </div>
            <!---->
            <div class="row" style="background-color:rgba(205, 215, 215, 0.8);border-bottom: 3px solid #888;">
                <div class="col-md-4 text-center">
                    <h4><?= Yii::t('app','Разработано') ?></h4>
                    <a align='center' href='http://www.upc.tj' target='new'><?= Html::img("@web/templates/images/footer/upc.png", ["alt"=>"UPC", 'title'=>"Сайт разработчиков группа UPC",'style'=>"width:115px;"]) ?><br>www.upc.tj</a>
                </div>
                <div class="col-md-4 text-center">
                    <a href='http://www.tut.tj' target='new'>
                        <?= Html::img("@web/templates/images/footer/tut.png", ["alt"=>"TUT",'style'=>"width:115px;" ]) ?></a>
                </div>
                <div class="col-md-4 text-center">
                    <h4><?= Yii::t('app',' ') ?></h4>
                    <a href='http://www.elibrary.tut.tj' target='new'>
<?= Html::img("@web/templates/images/footer/library.jpg", ['style' =>'width:125px', "alt"=>"E-library"]) ?> </a>
                </div>
            </div> 
            <div class='row'>
                <?= $content ?>
            </div>           
        <?php $this->endBody() ?>

        <!-- jQuery 3 -->
        <?= Html::jsFile('@web/templates/adminlte/plugins/jquery/jquery.min.js') ?>
        <!-- Bootstrap 3.3.7 -->
        <?= Html::jsFile('@web/templates/adminlte/plugins/bootstrap/js/bootstrap.min.js') ?>
        <!-- jQuery Validation -->
        <?= Html::jsFile('@web/templates/adminlte/plugins/jquery-validation/jquery.validate.min.js') ?>
        <!-- iCheck -->
        <?= Html::jsFile('@web/templates/adminlte/plugins/iCheck/icheck.min.js') ?>
        <!-- Custom scripts -->
        <?= Html::jsFile('@web/templates/pages/scripts/app.js') ?>
        <!-- Backstretch -->
        <?= Html::jsFile('@web/templates/adminlte/plugins/jquery.backstretch.min.js') ?>
        <script type="text/javascript">
            $(function () {
                $('input').iCheck({
                    checkboxClass   : 'icheckbox_square-blue',
                    radioClass      : 'iradio_square-blue',
                    increaseArea    : '20%' // optional
                });

                $('#login-form').validate({
                    rules: {
                        'Login[username]': 'required',
                        'Login[password]': 'required',
                        'Login[captcha]': 'required',
                    },
                    messages: {
                        'Login[username]': '<?= Yii::t('app', 'Введите логин') ?>',
                        'Login[password]': '<?= Yii::t('app', 'Введите пароль') ?>',
                        'Login[captcha]': '<?= Yii::t('app', 'Введите защитный код') ?>',
                    }
                });

                $('#login-language')
                    .on('change', function () {
                        location.href = location.pathname + '?language=' + $(this).val();
                    });
                    
                $('.login-page').backstretch([
                    '<?=  Yii::getAlias('@web/templates/images/login/1.jpg') ?>',
                    '<?=  Yii::getAlias('@web/templates/images/login/2.jpg') ?>',
                    '<?=  Yii::getAlias('@web/templates/images/login/3.jpg') ?>',
                    '<?=  Yii::getAlias('@web/templates/images/login/4.jpg') ?>',
                    '<?=  Yii::getAlias('@web/templates/images/login/5.jpg') ?>',
                    '<?=  Yii::getAlias('@web/templates/images/login/6.jpg') ?>'
                ], {
                    fade: 1000,
                    duration: 8000
                });
            });
        </script>
    </body>
</html>
<?php $this->endPage() ?>
