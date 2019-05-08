<?php 
use yii\helpers\Html;
if (isset($alert)) { ?>
    <div class="alert alert-<?php if (isset($alert))  echo $alert; ?>">
        <strong>Муваффақона!</strong> <?= $message; ?>
        <a class="btn btn-lg"  href='/index/' > <?= Yii::t('app', 'Назад') ?></a>
    </div>
<?php } ?>
<div>
    <a class='btn btn-lg btn-success btn-block' href='/from-elibrary/add'> Если вы точно уверен что нет ошибки, нажмите на меня </a>
</div>

<h1>Down Rules for have to attention:</h1>
1.Controller  function Index, Add $model->FromElibrary(Path)<br>

<?php 
$index = 0;
echo getcwd();
echo "<strong>Файлы:</strong> <br>";

if (!empty($files)){
    foreach ($files as $file) 
    {
        $index++;
        echo $index.". ".$file."<br>";
    }
} else {
    echo "Нету. Пустой!";
}
