<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TransferenciaItemsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="transferencia-items-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'productos_producto_id',
            'productosProducto.product_name',
            'cantidad',
        ],
    ]); ?>

</div>

