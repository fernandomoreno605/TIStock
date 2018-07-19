<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TransferenciaItemsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transferencia Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transferencia-items-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Transferencia Items', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'transferencias_transferencia_id',
            'productos_producto_id',
            'cantidad',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
