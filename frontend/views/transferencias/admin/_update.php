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
        if ($origin == $_SESSION['current_hotel']){
            echo $form->field($model, 'transferencia_destino_id')->dropDownList(
                $hotelsProvider,
                [
                    'prompt'=> Yii::t('app','Select Destiny'),
                ]
            );
            echo $form->field($model, 'transferencia_comentario_origen')->textarea(['rows' => 3]);

        }
        if ($destination == $_SESSION['current_hotel']){
            echo $form->field($model, 'transferencia_comentario_destino')->textarea(['rows' => 3]);
            echo $form->field($model, 'transferencia_status')->dropDownList([ 'delivered' => Yii::t('app','Delivered'), ], ['prompt' => 'Select Status']);
        }
    ?>

    <div class="form-group">
        <?= Html::submitButton(' <i class="glyphicon glyphicon-floppy-disk"></i> '.Yii::t('app','Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>


</div>
