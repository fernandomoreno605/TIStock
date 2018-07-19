<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PrestamosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="prestamos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'prestamo_id') ?>

    <?= $form->field($model, 'hoteles_hotel_id') ?>

    <?= $form->field($model, 'prestamo_fecha') ?>

    <?= $form->field($model, 'prestamo_numero_empleado') ?>

    <?= $form->field($model, 'prestamo_nombre_empleado') ?>

    <?php // echo $form->field($model, 'prestamo_fecha_entrega') ?>

    <?php // echo $form->field($model, 'prestamo_status') ?>

    <?php // echo $form->field($model, 'prestamo_comentario') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
