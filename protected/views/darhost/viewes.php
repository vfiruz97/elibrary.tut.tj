<?php

foreach ( $model as $darhost) {
?>
    <div class="alert alert-success alert-dismissable">
        <a href='/darhost/delete?id=<?= $darhost->id ?>' class="close" data-dismiss="alert" aria-hidden="true">
            &times;
        </a>
        <strong>Дархост!</strong> <a href="darhost?id=<?= $darhost->id ?>"><?= $darhost->name_book ?></a>
    </div>
<?php } ?>
