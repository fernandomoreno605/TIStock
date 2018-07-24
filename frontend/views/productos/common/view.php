<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Productos */

$this->title = $model->product_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="productos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="option-buttons">
        <?= Html::a(' <i class="glyphicon glyphicon-open"></i> '.Yii::t('app','Update'), ['update', 'id' => $model->product_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(' <i class="glyphicon glyphicon-trash"></i> '.Yii::t('app','Delete'), ['delete', 'id' => $model->product_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="info-custom">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                //'product_id',
                'product_name',
                'product_branch',
                'product_provider',
                'product_serial',
                'product_created_date',
                'product_stock',
                'product_status',
                'product_image',
                'hotelesHotel.hotel_name',
            ],
        ]) ?>
    </div>
    <div class="product-image-info">
        <?php
            echo '<img src="'.$model->product_image.'" class="user-image" alt="User Image" width="350" height="350" align="middle">';
        ?>
    </div>

</div>
