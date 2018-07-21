<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\Hoteles;
use yii\helpers\ArrayHelper;

?>

<div class="productos-form">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'hoteles_hotel_id')->dropDownList(
        $hotelProvider,[
            'prompt'=>Yii::t('app', 'Select Hotel'),
        ]
    ) ?>

    <?= $form->field($model, 'product_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_branch')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_provider')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_stock')->textInput() ?>

    <?= $form->field($model, 'product_serial')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_status')->dropDownList([ 'active' => 'Active', 'inactive' => 'Inactive', ], ['prompt' => '']) ?>

    <?= $form->field($model,'file')->fileInput() ?>


    <div class="form-group">
        <?= Html::submitButton(' <i class="glyphicon glyphicon-floppy-disk"></i> '.Yii::t('app','Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
