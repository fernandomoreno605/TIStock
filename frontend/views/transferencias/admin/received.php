<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use frontend\models\TransferenciaItemsSearch;

$this->title = Yii::t('app','Transfers Received');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transferencias-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

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

            ['attribute' => 'usuarios_usuario_id',
                'value' => 'usuariosUsuario.username'
            ],
            ['attribute' => 'hoteles_hotel_id',
                'value' => 'hotelesHotel.hotel_name'
            ],
            ['attribute' => 'transferencia_destino_id',
                'value' => 'transferenciaDestino.hotel_name'
            ],
            ['attribute' => 'usuarios_usuario_recibe',
                'value' => 'usuariosUsuarioRecibe.username'
            ],
            'transferencia_status',
            ['class' => 'yii\grid\ActionColumnCustom'],
        ],
        'panel' => [
            'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-import"></i>'.' '.Yii::t('app','Transfers').'</h3>',
            'type'=>'default',
            'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> '.Yii::t('app','Reset'), ['index'], ['class' => 'btn btn-default']),
        ],
        'pjax'=>true,
        'pjaxSettings'=>[
            'neverTimeout'=>true,
        ],

    ]); ?>
</div>
