<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\Productos;
use yii\helpers\ArrayHelper;

?>

<div class="deliver-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'prestamo_status')->dropDownList([ 'delivered' => Yii::t('app','Delivered'), ], ['prompt' => Yii::t('app','Select Status')]) ?>

    <?= $form->field($model, 'prestamo_comentario')->textarea(['maxlength' => true]) ?>

    <?php //$form->field($model, 'rent_delivery_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(' <i class="glyphicon glyphicon-floppy-disk"></i> '.Yii::t('app','Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
