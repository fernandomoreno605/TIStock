<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;


/* @var $this yii\web\View */
/* @var $model frontend\models\Transferencias */

$this->title = Yii::t('app','To').': '.$hotelName;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Transfers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transferencias-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>

    <?php
        if ($idHotelDestination == $_SESSION['current_hotel']){
            if ($model->transferencia_status != 'delivered'){
                echo Html::a(' <i class="glyphicon glyphicon-open"></i> '.Yii::t('app','Update'), ['update', 'id' => $model->transferencia_id], ['class' => 'btn btn-primary']);
            }
            echo Html::a(' <i class="glyphicon glyphicon-edit"></i> '.Yii::t('app','Assignation of Items'), ['assign', 'id' => $model->transferencia_id], ['class' => 'btn btn-success']);
        }
        else if ($idHotelOrigin == $_SESSION['current_hotel']){
            if ($model->transferencia_status != 'delivered'){
                echo Html::a(' <i class="glyphicon glyphicon-open"></i> '.Yii::t('app','Update'), ['update', 'id' => $model->transferencia_id], ['class' => 'btn btn-primary']);
            }
            echo Html::a(' <i class="glyphicon glyphicon-trash"></i> '.Yii::t('app','Delete'), ['delete', 'id' => $model->transferencia_id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app','Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]);
        }
    ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'transferencia_id',
            'usuariosUsuario.username',
            'hotelesHotel.hotel_name',
            'transferenciaDestino.hotel_name',
            'usuariosUsuarioRecibe.username',
            'transferencia_status',
            'transferencia_comentario_origen:ntext',
            'transferencia_comentario_destino:ntext',
        ],
    ]) ?>

    <h3><?= Yii::t('app','Transfer Items')?></h3>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'productosProducto.product_name',
            'cantidad',
        ],
    ]); ?>

</div>
