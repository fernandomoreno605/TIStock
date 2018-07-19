<?php

use yii\helpers\Html;
use kartik\grid\GridView;

$this->title = 'Hotels';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hoteles-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            [
//                'class' => 'yii\grid\CheckboxColumn',
                // you may configure additional properties here
//            ],
            'hotel_name',
            'hotel_address',
            'hotel_phone',
            'hotel_status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'panel' => [
            'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-tower"></i>'.' '.Yii::t('app','Hotels').'</h3>',
            'type'=>'default',
            'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> '.Yii::t('app','Create Hotel'), ['create'], ['class' => 'btn btn-success']),
            'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> '.Yii::t('app','Reset'), ['index'], ['class' => 'btn btn-default']),
        ],

        'pjax'=>true,
        'pjaxSettings'=>[
            'neverTimeout'=>true,
        ],
    ]); ?>
</div>
