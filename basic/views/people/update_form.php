<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
?>

<div class="people-form">

    <?php $form = ActiveForm::begin(); ?>
   
     <?= $form->field($model, 'role')->widget(Select2::classname(), [
        'data' => $all_roles,
        'options' => ['placeholder' => 'выберите из списка'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]);
    ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>