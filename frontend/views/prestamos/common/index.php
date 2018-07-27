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
        'rowOptions'=>function($model){
            if ($model ->prestamo_status !='on loan') {

                return ['class' => 'success'];
            }
        },
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

                    return Yii::$app->controller->renderPartial('common/_prestamoarticulos',[
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                    ]);
                },
            ],

            [
                'attribute' => 'users_user_id',
                'value' => 'usersUser.username'
            ],
            'prestamo_nombre_empleado',
            'prestamo_numero_empleado',
            'prestamo_fecha',
            'prestamo_status',
            'hotelesHotel.hotel_name',
            ['class' => 'yii\grid\ActionColumn'],
        ],
        'panel' => [
            'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-shopping-cart"></i>'.' '.Yii::t('app','Loans').'</h3>',
            'type'=>'default',
            'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> '.Yii::t('app','Create Loan'), ['create'], ['class' => 'btn btn-success']),
            'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> '.Yii::t('app','Reset'), ['index'], ['class' => 'btn btn-default']),
        ],
        'pjax'=>true,
        'pjaxSettings'=>[
        'neverTimeout'=>true,
        ],
    ]); ?>
</div>
