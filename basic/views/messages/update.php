<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Messages */

$this->title = 'Изменение сообщения: ' . $model->id;
?>
<div class="messages-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'tab' => 1,
    ]) ?>

</div>
