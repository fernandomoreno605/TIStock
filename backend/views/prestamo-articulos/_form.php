<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PrestamoArticulos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="prestamo-articulos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'prestamos_prestamo_id')->textInput() ?>

    <?= $form->field($model, 'productos_product_id')->textInput() ?>

    <?= $form->field($model, 'producto_cantidad')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
