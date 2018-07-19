<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Productos */

$this->title = $model->product_name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="productos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(' <i class="glyphicon glyphicon-open"></i> '.Yii::t('app','Update'), ['update', 'id' => $model->product_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(' <i class="glyphicon glyphicon-trash"></i> '.Yii::t('app','Delete'), ['delete', 'id' => $model->product_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'hotelesHotel.hotel_name',
            'product_name',
            'product_branch',
            'product_provider',
            'product_created_date',
            'product_stock',
            'product_status',
        ],
    ]) ?>

</div>
