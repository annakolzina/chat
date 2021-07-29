<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Messages;
use app\models\People;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MessagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Сообщения';
?>
<div class="messages-index">

    <h1><?= Html::encode($this->title) ?></h1>

 
    <?php
    if(!Yii::$app->user->isGuest){
        $new_mes = new Messages();
        if ($new_mes->load(Yii::$app->request->post())) {
            $new_mes->time_begin = date("Y-m-d H:i:s");
            $new_mes->id_people = Yii::$app->user->getId();
            $new_mes->save();
            $new_mes->text = "";
        }
       echo $this->render('create',
                ['model' => $new_mes]);
    }
        
   ?>
    
    <?php $people = People::find()->where(['id' => Yii::$app->user->getId()])->one();?>
    <?php if($people->role==1){?>
    <a href="<?= Url::toRoute(['messages/index', 'tab'=> 1])?>">Некорректные сообщения</a>

    <?= GridView::widget([
        'rowOptions' => function ($model) {
        $user = People::find()->where(['id' => $model->id_people])->one();
        if($user->role==1){
            $class = 'success';
        }else{
            $class = 'warning'; 
        }
        if($model->block==true)
            $class = 'dark';
         return ['class' => $class];
     },
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',
                'header' => '№'],
            [
                'attribute' => 'id_people',
                'value' => function($model){
                     return $model->people->username;
                }
                ],
            'time_begin:datetime',
            'text:ntext',

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
    ]);?>
    <?php }else{?>
        <?= GridView::widget([
        'rowOptions' => function ($model) {
        $user = People::find()->where(['id' => $model->id_people])->one();
        if($user->role==1){
            $class = 'success';
        }else{
            $class = 'warning'; 
        }
        if($model->block==true)
            $class = 'dark';
         return ['class' => $class];
     },
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',
                'header' => '№'],
            [
                'attribute' => 'id_people',
                'value' => function($model){
                     return $model->people->username;
                }
                ],
            'time_begin:datetime',
            'text:ntext',

        ],
    ]);?>
    <?php }?>
    
    
    


</div>
