<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

$this->title = Yii::t('app','Loan of').': '.$model->prestamo_nombre_empleado;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Loans'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prestamos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php
            if ($model->prestamo_status != 'delivered'){
                echo Html::a(' <i class="glyphicon glyphicon-open"></i> '.Yii::t('app','Update'), ['update', 'id' => $model->prestamo_id], ['class' => 'btn btn-primary']);
            }
        ?>
        <?= Html::a(' <i class="glyphicon glyphicon-trash"></i> '.Yii::t('app','Delete'), ['delete', 'id' => $model->prestamo_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app','Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'prestamo_id',
            'usersUser.username',
            'prestamo_fecha',
            'prestamo_numero_empleado',
            'prestamo_nombre_empleado',
            'prestamo_fecha_entrega',
            'prestamo_status',
            'hotelesHotel.hotel_name',
            'prestamo_comentario',
        ],
    ]) ?>

    <h3><?=Yii::t('app','Items on Loan')?></h3>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [

            'productosProduct.product_name',
            'producto_cantidad',

        ],
    ]); ?>

</div>
