<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PrestamoArticulosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Prestamo Articulos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prestamo-articulos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Prestamo Articulos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'prestamos_prestamo_id',
            'productos_product_id',
            'producto_cantidad',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
