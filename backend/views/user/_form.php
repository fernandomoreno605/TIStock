<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Hoteles;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */

$query = Hoteles::find()
    ->where(['hotel_status' => 'active'])
    ->all();

$hotels_list = ArrayHelper::map($query, 'hotel_id','hotel_name');
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'colaborator_no')->textInput() ?>

    <?= $form->field($model, 'hoteles_hotel_id')->dropDownList($hotels_list,
        ['prompt' => 'Choose a hotel' ]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password_hash')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_type')->dropDownList([ 'admin' => 'Admin','common' => 'Common' ], ['prompt' => 'Choose a type of user']) ?>

    <?php  //$form->field($model,'permissions')->checkboxList($hotelList)  ?>

    <?= $hotelList ?>

    <div class="form-group">
        <?= Html::submitButton(' <i class="glyphicon glyphicon-floppy-disk"></i> '.Yii::t('app','Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
