<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model frontend\models\User */
/* @var $form yii\widgets\ActiveForm */
$this->title = Yii::t('app', 'Change Password');
?>
<div class="form">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php
    if ($alert != null){
        echo $alert;
    }
    ?>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'confirm_password')->passwordInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('<i class="glyphicon glyphicon-floppy-disk"></i> '.Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
