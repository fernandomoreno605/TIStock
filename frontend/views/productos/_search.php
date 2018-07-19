<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ProductosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="productos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'product_id') ?>

    <?= $form->field($model, 'hoteles_hotel_id') ?>

    <?= $form->field($model, 'product_name') ?>

    <?= $form->field($model, 'product_branch') ?>

    <?= $form->field($model, 'product_provider') ?>

    <?php // echo $form->field($model, 'product_created_date') ?>

    <?php // echo $form->field($model, 'product_stock') ?>

    <?php // echo $form->field($model, 'product_status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
