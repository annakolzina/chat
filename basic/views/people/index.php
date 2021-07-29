<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Пользователи';
?>
<div class="people-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить пользователя', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',
                'header' => '№'],

            'username',
            'name',
            'email:email',
            [
                'attribute' => 'role',
                'value' => function($model){
                    return $model->roles->value;
                }
                ],

            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Ред.',
                'template' => '{update}',
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['update', 'id' => $model->id]);
                    }
                ]
            ],
        ],
    ]); ?>


</div>
