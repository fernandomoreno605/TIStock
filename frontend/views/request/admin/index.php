<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;

$this->title = Yii::t('app', 'Requests');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'user_made_id',
                'value' => 'userMade.username',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => $userProvider,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => Yii::t('app', 'Any User')],
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
                'filterInputOptions' => ['placeholder' => Yii::t('app', 'Any Hotel')],
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
                'filterInputOptions' => ['placeholder' => Yii::t('app', 'Any User')],
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
                'filterInputOptions' => ['placeholder' => Yii::t('app', 'Any Hotel')],
                'format' => 'raw'
            ],
            [
                'attribute' => 'request_status',
                'value' => 'request_status',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => $array = array(
                    "Accepted" => Yii::t('app', 'Accepted'),
                    "On hold" => Yii::t('app', 'On Hold'),
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
            'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-open-file"></i>'.' '.Yii::t('app','Requests').'</h3>',
            'type'=>'default',
            'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> '.Yii::t('app','Create Request'), ['create'], ['class' => 'btn btn-success']),
            'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> '.Yii::t('app','Reset'), ['index'], ['class' => 'btn btn-default']),
        ],
        'pjax'=>true,
        'pjaxSettings'=>[
            'neverTimeout'=>true,
        ],
    ]); ?>
</div>
