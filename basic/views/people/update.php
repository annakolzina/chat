<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\People */

$this->title = 'Изменение прав дступа: ' . $model->name;
?>
<div class="people-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('update_form', [
        'model' => $model,
        'all_roles' => $all_roles,
    ]) ?>

</div>
