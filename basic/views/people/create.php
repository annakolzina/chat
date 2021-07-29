<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\People */

$this->title = 'Создание пользователя';
?>
<div class="people-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
