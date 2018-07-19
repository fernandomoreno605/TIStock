<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Hoteles;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model backend\models\Productos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="productos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
        $activeHotels = Hoteles::find()
            ->where(['hotel_status' => 'active'])
            ->all();
        //el resultado se selecciona el id y se muestra como nombre, con array helper se hace un mapeo
        $resultado = ArrayHelper::map($activeHotels, 'hotel_id', 'hotel_name');
    ?>

    <?= $form->field($model, 'hoteles_hotel_id')->dropDownList(
            $resultado,[
            'prompt'=>'Select Hotel',
        ]
    )->label('Hotel') ?>

    <?= $form->field($model, 'product_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_branch')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_provider')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_serial')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_stock')->textInput() ?>

    <?= $form->field($model, 'product_status')->dropDownList([ 'active' => 'Active', 'inactive' => 'Inactive', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton(' <i class="glyphicon glyphicon-floppy-disk"></i> '.Yii::t('app','Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
