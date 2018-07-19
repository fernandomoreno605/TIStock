<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Productos;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model backend\models\Rentas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="deliver-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'prestamo_status')->dropDownList([ 'delivered' => 'Delivered', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'prestamo_comentario')->textarea(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(' <i class="glyphicon glyphicon-floppy-disk"></i> '.Yii::t('app','Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
