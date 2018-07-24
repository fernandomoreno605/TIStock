<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use frontend\models\TransferenciaItemsSearch;

$this->title = Yii::t('app','Transfers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transferencias-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= GridView::widget([
        //'resizableColumns'=>true,
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

                    return Yii::$app->controller->renderPartial('admin/_transferenciaitems',[
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                    ]);
                },
            ],
            ['attribute' => 'usuarios_usuario_id',
                'value' => 'usuariosUsuario.username',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => $userProvider,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => Yii::t('app', 'Any User')],
                'format' => 'raw'
            ],
            ['attribute' => 'usuarios_usuario_recibe',
                'value' => 'usuariosUsuarioRecibe.username',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => $userProvider,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => Yii::t('app', 'Any User')],
                'format' => 'raw'
            ],
            ['attribute' => 'hoteles_hotel_id',
                'value' => 'hotelesHotel.hotel_name',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => $hotelProvider,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => Yii::t('app', 'Any Hotel')],
                'format' => 'raw'
            ],
            ['attribute' => 'transferencia_destino_id',
                'value' => 'transferenciaDestino.hotel_name',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => $hotelProvider,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => Yii::t('app', 'Any Hotel')],
                'format' => 'raw'
            ],
            ['attribute' => 'transferencia_status',
                'value' => 'transferencia_status',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => $array = array(
                    "delivered" => Yii::t('app', 'Delivered'),
                    "to deliver" => Yii::t('app', 'To Deliver'),
                ),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => Yii::t('app', 'Any Status')],
                'format' => 'raw'
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
        'pjax'=>true,
        'pjaxSettings'=>[
            'neverTimeout'=>true,
        ],
        'panel' => [
            'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-transfer"></i>'.' '.Yii::t('app','Transfers').'</h3>',
            'type'=>'default',
            'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> '.Yii::t('app','Reset'), ['index'], ['class' => 'btn btn-default']),
        ],
    ]); ?>
</div>