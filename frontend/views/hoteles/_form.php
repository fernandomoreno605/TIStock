<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Hoteles */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hoteles-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'hotel_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hotel_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hotel_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hotel_status')->dropDownList([ 'active' => 'Active', 'inactive' => 'Inactive', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
