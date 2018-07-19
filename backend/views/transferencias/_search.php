<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TransferenciasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transferencias-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'transferencia_id') ?>

    <?= $form->field($model, 'usuarios_usuario_id') ?>

    <?= $form->field($model, 'hoteles_hotel_id') ?>

    <?= $form->field($model, 'transferencia_destino_id') ?>

    <?= $form->field($model, 'usuarios_usuario_recibe') ?>

    <?php // echo $form->field($model, 'transferencia_status') ?>

    <?php // echo $form->field($model, 'transferencia_comentario_origen') ?>

    <?php // echo $form->field($model, 'transferencia_comentario_destino') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
