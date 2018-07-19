<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\RequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Requests');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'request_id',
            [
                'attribute' => 'user_made_id',
                'value' => 'userMade.username',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => $userProvider,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Any user'],
                'format' => 'raw'

            ],
            [
                'attribute' => 'hotel_made_id',
                'value' => 'hotelMade.hotel_name',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => $hotelProvider,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Any hotel'],
                'format' => 'raw'

            ],
            [
                'attribute' => 'user_acept_id',
                'value' => 'userAcept.username',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => $userProvider,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Any user'],
                'format' => 'raw'
            ],
            [
                'attribute' => 'hotel_acept_id',
                'value' => 'hotelAcept.hotel_name',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => $hotelProvider,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Any hotel'],
                'format' => 'raw'

            ],
            //'request_details',
            'request_status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'panel' => [
            'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-tag"></i>'.' '.Yii::t('app','Requests').'</h3>',
            'type'=>'default',
            'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> '.Yii::t('app','Reset'), ['index'], ['class' => 'btn btn-default']),
        ],
        'pjax'=>true,
        'pjaxSettings'=>[
            'neverTimeout'=>true,
        ],

    ]); ?>
</div>
