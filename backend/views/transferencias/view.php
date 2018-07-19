<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\Transferencias */

$this->title = 'To: '.$hotelName;
$this->params['breadcrumbs'][] = ['label' => 'Transferencias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transferencias-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(' <i class="glyphicon glyphicon-open"></i> '.Yii::t('app','Update'), ['update', 'id' => $model->transferencia_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(' <i class="glyphicon glyphicon-trash"></i> '.Yii::t('app','Delete'), ['delete', 'id' => $model->transferencia_id], [
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
            'transferencia_id',
            'usuariosUsuario.username',
            'hotelesHotel.hotel_name',
            'transferenciaDestino.hotel_name',
            'usuariosUsuarioRecibe.username',
            'transferencia_status',
            'transferencia_comentario_origen:ntext',
            'transferencia_comentario_destino:ntext',
        ],
    ]) ?>

    <h3>Transfer Items</h3>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [

            'productosProducto.product_name',
            'cantidad',

        ],
    ]); ?>


</div>
