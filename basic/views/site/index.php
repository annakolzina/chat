<?php

use yii\helpers\Url;

$this->title = 'Chat';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Добро пожаловать в чат!</h1>
        <?php if(Yii::$app->user->isGuest){?>
            <p><a class="btn btn-lg btn-success" href="<?= Url::toRoute(['people/create'])?>">Регистрация</a></p>
            <p><a class="btn btn-lg btn-warning" href="<?= Url::toRoute(['messages/index'])?>">Смотреть в режиме гостя</a></p>
        <?php }else{?>
            <p><a class="btn btn-lg btn-success" href="<?= Url::toRoute(['messages/index'])?>">Перейти в чат</a></p>
        <?php }?>
    </div>
</div>
