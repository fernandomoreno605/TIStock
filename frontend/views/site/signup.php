<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use backend\models\Hoteles;
use yii\helpers\ArrayHelper;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'first_name')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'last_name')->textInput() ?>

                <?= $form->field($model, 'colaborator_no')->textInput() ?>

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

                <?= $form->field($model, 'username')->textInput() ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
