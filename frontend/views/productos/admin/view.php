<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\dialog\Dialog;

$this->title = $model->product_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="productos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="option-buttons">
        <?= Dialog::widget(['overrideYiiConfirm' => true]); ?>
        <?= Html::a(' <i class="glyphicon glyphicon-open"></i> '.Yii::t('app','Update'), ['update', 'id' => $model->product_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(' <i class="glyphicon glyphicon-trash"></i> '.Yii::t('app','Delete'), ['delete', 'id' => $model->product_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app','Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="info-custom">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                //'product_id',
                'hotelesHotel.hotel_name',
                'product_name',
                'product_branch',
                'product_provider',
                'product_serial',
                'product_created_date',
                'product_stock',
                'product_status',
                'product_image',
            ],
        ]) ?>
    </div>
    <div class="product-image-info">
        <?php
            echo '<img src="'.$model->product_image.'" class="user-image" alt="User Image" width="300" height="300" align="middle">';
        ?>
    </div>
</div>
