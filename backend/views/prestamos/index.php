<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use backend\models\PrestamoArticulosSearch;
use backend\models\User;
use backend\models\Hoteles;
use yii\helpers\ArrayHelper;
use kartik\editable\Editable;
//use dosamigos\datepicker\DatePicker;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\PrestamosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Loans';
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

                            return Yii::$app->controller->renderPartial('_prestamoarticulos',[
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
                'filterInputOptions' => ['placeholder' => 'Any hotel'],
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
                'filterInputOptions' => ['placeholder' => 'Any user'],
                'format' => 'raw'
            ],
            'prestamo_numero_empleado',
            'prestamo_nombre_empleado',
            //'prestamo_fecha_entrega',
            'prestamo_status',
            //'prestamo_comentario',

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'panel' => [
            'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-shopping-cart"></i>'.' '.Yii::t('app','Loans').'</h3>',
            'type'=>'default',
            //'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> '.Yii::t('app','Create Loan'), ['create'], ['class' => 'btn btn-success']),
            'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> '.Yii::t('app','Reset'), ['index'], ['class' => 'btn btn-default']),
        ],
        'pjax'=>true,
        'pjaxSettings'=>[
        'neverTimeout'=>true,
        ],

    ]); ?>
</div>
