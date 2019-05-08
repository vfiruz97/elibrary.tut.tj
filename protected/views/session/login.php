<?php

/* @var $this yii\web\View */
/* @var $form app\form\Login */
use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\helpers\Url;
use app\forms\Login;

$this->title = Yii::t('app', 'Авторизация');
?>
<div style="margin-top:8px;"></div>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= $this->title ?></h3>
                </div>
                <div class="panel-body">
                 <p class="login-box-msg"><?= Html::encode($this->title) ?></p>

                <?php if ($form->hasErrors()): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php foreach ($form->getErrors() as $field => $errors): ?>
                                <?php foreach ($errors as $error): ?><li><?= $error ?></li><?php endforeach; ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                    <form id="login-form" action="/session/login" method="post" role="form">
                        <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
                        <fieldset>
                            <div class="form-group">
                                <?= Html::activeTextInput($form, 'username', ['class' => 'form-control', 'placeholder' => $form->getAttributeLabel('username')]) ?>
                            </div>
                            <div class="form-group">
                               <?= Html::activePasswordInput($form, 'password', ['class' => 'form-control', 'placeholder' => $form->getAttributeLabel('password')]) ?>
                            </div>
							<div class="form-group">
								<label class="control-label"><?= $form->getAttributeLabel('language') ?></label>
								<?= Html::activeDropDownList($form, 'language', Login::$availableLanguages, ['class' => 'form-control']) ?>
							</div>
							<div class="form-group captcha">
                                <?= Captcha::widget([
                                    'model' => $form,
                                    'attribute' => 'captcha',
                                    'captchaAction' => 'index/captcha',
                                    'template' => '<div class="panel panel-default"><div class="panel-body">{input} <div class="text-center">{image}</div></div></div>',
                                    'options' => ['autocomplete' => 'off', 'class' => 'form-control'],
                                ]) ?>
                            </div>
                                <div class="row">
                                    <div class="col-xs-8">
                                        <div class="checkbox icheck">
                                            <?= Html::activeCheckbox($form, 'rememberMe') ?>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="checkbox icheck">
                                            <a href="<?= Url::toRoute(['/session/register','language'=> Yii::$app->language ]) ?>"><?= Yii::t('app','Регистрация') ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Change this to a button or input when using this as a form -->
							 <div class="form-group" style="margin:5px;">
						        <?= Html::submitButton(Yii::t('app', 'Войти'), ['class' => 'btn btn-lg btn-success btn-block', 'name' => 'login-button']) ?>
						    </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
