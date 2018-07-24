<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
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
            'username',
            'first_name',
            'last_name',
            'colaborator_no',
            'email:email',
            [
                'attribute' => 'user_type',
                'value' => 'user_type',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => $array = array(
                    "admin" => Yii::t('app', 'Admin'),
                    "common" => Yii::t('app', 'Common'),
                ),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Any status'],
                'format' => 'raw'

            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
        'pjax'=>true,
        'pjaxSettings'=>[
            'neverTimeout'=>true,
        ],
        'panel' => [
            'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-barcode"></i>'.' '.Yii::t('app','Users').'</h3>',
            'type'=>'default',
            'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> '.Yii::t('app','Create User'), ['create'], ['class' => 'btn btn-success']),
            'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> '.Yii::t('app','Reset'), ['index'], ['class' => 'btn btn-default']),
        ],

    ]); ?>
</div>
