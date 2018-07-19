<?php

use yii\helpers\Html;
use yii\grid\GridView;


?>
<div class="prestamo-articulos-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'productosProduct.product_name',
            'producto_cantidad',
        ],
    ]); ?>
</div>
