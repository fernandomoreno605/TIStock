<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\RequestSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="request-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'request_id') ?>

    <?= $form->field($model, 'user_made_id') ?>

    <?= $form->field($model, 'hotel_made_id') ?>

    <?= $form->field($model, 'user_acept_id') ?>

    <?= $form->field($model, 'hotel_acept_id') ?>

    <?php // echo $form->field($model, 'request_details') ?>

    <?php // echo $form->field($model, 'request_status') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
