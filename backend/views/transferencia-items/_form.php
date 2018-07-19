<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TransferenciaItems */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transferencia-items-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'transferencias_transferencia_id')->textInput() ?>

    <?= $form->field($model, 'productos_producto_id')->textInput() ?>

    <?= $form->field($model, 'cantidad')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
