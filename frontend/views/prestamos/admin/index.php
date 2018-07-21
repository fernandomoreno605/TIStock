<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use frontend\models\PrestamoArticulosSearch;

$this->title = Yii::t('app','Loans');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prestamos-index">

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
                    $searchModel = new PrestamoArticulosSearch();
                    $searchModel ->prestamos_prestamo_id = $model->prestamo_id;
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                    return Yii::$app->controller->renderPartial('admin/_prestamoarticulos',[
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                    ]);
                },
            ],
            [
                'attribute' => 'hoteles_hotel_id',
                'value' => 'hotelesHotel.hotel_name',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => $hotelProvider,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => Yii::t('app', 'Any Hotel')],
                'format' => 'raw'
            ],
            [
                'attribute' => 'users_user_id',
                'value' => 'usersUser.username',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => $userProvider,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => Yii::t('app', 'Any User')],
                'format' => 'raw'
            ],
            'prestamo_nombre_empleado',
            'prestamo_numero_empleado',
            'prestamo_fecha',
            [
                'attribute' => 'prestamo_status',
                'value' => 'prestamo_status',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => $array = array(
                    "on loan" => Yii::t('app', 'On Loan'),
                    "delivered" => Yii::t('app', 'Delivered'),
                ),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => Yii::t('app', 'Any Status')],
                'format' => 'raw'
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
        'panel' => [
            'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-shopping-cart"></i>'.' '.Yii::t('app','Loans').'</h3>',
            'type'=>'default',
            'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> '.Yii::t('app','Reset'), ['index'], ['class' => 'btn btn-default']),
        ],
        'pjax'=>true,
        'pjaxSettings'=>[
        'neverTimeout'=>true,
        ],
    ]); ?>
</div>
