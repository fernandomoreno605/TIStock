<?php

use yii\helpers\Html;
use yii\grid\GridView;

?>
<div class="transferencia-items-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'productosProducto.product_name',
            'cantidad',

        ],
    ]); ?>
</div>

