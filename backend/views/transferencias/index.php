<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use backend\models\TransferenciaItemsSearch;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\TransferenciasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transfers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transferencias-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'kartik\grid\ExpandRowColumn',
                'value' => function($model,$key,$index,$column){
                    return GridView::ROW_COLLAPSED;
                },
                'detail' => function($model,$key,$index,$column){
                    $searchModel = new TransferenciaItemsSearch();
                    $searchModel ->transferencias_transferencia_id = $model->transferencia_id;
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                    return Yii::$app->controller->renderPartial('_transferenciaitems',[
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                    ]);
                },
            ],

            [
                'attribute' => 'usuarios_usuario_id',
                'value' => 'usuariosUsuario.username',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => $userProvider,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Any user'],
                'format' => 'raw'
            ],
            ['attribute' => 'hoteles_hotel_id',
                'value' => 'hotelesHotel.hotel_name',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => $hotelProvider,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Any hotel'],
                'format' => 'raw'

            ],
            ['attribute' => 'transferencia_destino_id',
                'value' => 'transferenciaDestino.hotel_name',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => $hotelProvider,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Any hotel'],
                'format' => 'raw'

            ],
            ['attribute' => 'usuarios_usuario_recibe',
                'value' => 'usuariosUsuarioRecibe.username',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => $userProvider,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Any user'],
                'format' => 'raw'
            ],

            //'transferencia_status',
            //'transferencia_comentario_origen:ntext',
            //'transferencia_comentario_destino:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'panel' => [
            'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-transfer"></i>'.' '.Yii::t('app','Transfers').'</h3>',
            'type'=>'default',
            //'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> '.Yii::t('app','Create Transfer'), ['create'], ['class' => 'btn btn-success']),
            'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> '.Yii::t('app','Reset'), ['index'], ['class' => 'btn btn-default']),
        ],

        'pjax'=>true,
        'pjaxSettings'=>[
            'neverTimeout'=>true,
        ],

    ]); ?>
</div>
