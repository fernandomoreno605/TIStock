<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Hoteles */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hoteles-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'hotel_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hotel_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hotel_phone')->textInput(['maxlength' => 10,'onkeypress' => 'return valida(event)']) ?>

    <?= $form->field($model, 'hotel_status')->dropDownList([ 'active' => 'Active', 'inactive' => 'Inactive', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton(' <i class="glyphicon glyphicon-floppy-disk"></i> '.Yii::t('app','Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
