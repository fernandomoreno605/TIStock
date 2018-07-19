<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $model backend\models\Prestamos */

$this->title = 'Loan Details of: '.$model->prestamo_nombre_empleado;
$this->params['breadcrumbs'][] = ['label' => 'Loans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prestamos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php
            if($model->prestamo_status == 'en prestamo'){
            echo Html::a(' <i class="glyphicon glyphicon-open"></i> '.Yii::t('app','Update'), ['update', 'id' => $model->prestamo_id], ['class' => 'btn btn-primary']);
            }
 
        ?>
        <?= Html::a(' <i class="glyphicon glyphicon-trash"></i> '.Yii::t('app','Delete'), ['delete', 'id' => $model->prestamo_id], [
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
            'usersUser.username',
            'hotelesHotel.hotel_name',
            'prestamo_fecha',
            'prestamo_numero_empleado',
            'prestamo_nombre_empleado',
            'prestamo_fecha_entrega',
            'prestamo_status',
            'prestamo_comentario',
        ],
    ]) ?>
    <h3>Loan Items</h3>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            
            'productosProduct.product_name',
            'producto_cantidad',

        ],
    ]); ?>

</div>
