<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ProductosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="productos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="busqueda">
        <?php
            $icon = Html::tag('i','',['class'=>'glyphicon glyphicon-search']);
            echo Html::submitButton($icon, ['class' => 'btn btn-default' ]);
        ?>
        <?= $form->field($model, 'globalSearch')->label("") ?>

    </div>

    <?php //$form->field($model, 'hoteles_hotel_id') ?>

    <?php //$form->field($model, 'product_name') ?>

    <?php //$form->field($model, 'product_branch') ?>

    <?php //$form->field($model, 'product_provider') ?>

    <?php // echo $form->field($model, 'product_created_date') ?>

    <?php // echo $form->field($model, 'product_stock') ?>

    <?php // echo $form->field($model, 'product_status') ?>

    <div class="form-group">
        <?php //Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
