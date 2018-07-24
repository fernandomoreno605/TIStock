<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->hotel_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Hoteles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hoteles-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(' <i class="glyphicon glyphicon-open"></i> '.Yii::t('app', 'Update'), ['update', 'id' => $model->hotel_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(' <i class="glyphicon glyphicon-trash"></i> '.Yii::t('app', 'Delete'), ['delete', 'id' => $model->hotel_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'hotel_id',
            'hotel_name',
            'hotel_address',
            'hotel_phone',
            'hotel_status',
        ],
    ]) ?>

</div>
