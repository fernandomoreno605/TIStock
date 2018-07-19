<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\TransferenciasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transferencias-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <?php
        echo $form->field($model, 'transferencia_destino_id')->dropDownList(
            $hotelsProvider,
            [
                'prompt'=> 'Select Destiny',
            ]
        );
        echo $form->field($model, 'transferencia_comentario_origen')->textarea(['rows' => 3]);

    ?>

    <div class="form-group">
        <?= Html::submitButton(' <i class="glyphicon glyphicon-floppy-disk"></i> '.Yii::t('app','Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>


</div>

