<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Request */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="request-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_acept_id')->textInput() ?>

    <?= $form->field($model, 'hotel_acept_id')->textInput() ?>

    <?= $form->field($model, 'request_details')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'request_status')->dropDownList([ 'Accepted' => 'Accepted', 'On hold' => 'On hold', '' => '', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
