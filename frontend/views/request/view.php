<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Request */

$this->title = $name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Requests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if ($alert != null){
        echo $alert;
    } ?>

    <p>
        <?php
            if ($_SESSION['current_hotel'] == $model->hotel_made_id){
                echo Html::a(' <i class="glyphicon glyphicon-open"></i> '.Yii::t('app', 'Update'), ['update', 'id' => $model->request_id], ['class' => 'btn btn-primary']);
                echo Html::a(' <i class="glyphicon glyphicon-trash"></i> '.Yii::t('app', 'Delete'), ['delete', 'id' => $model->request_id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ]);
            }else if ($model->request_status != 'Accepted'){
                echo Html::a(' <i class="glyphicon glyphicon-ok"></i> '.Yii::t('app', 'Accept'), ['accept', 'id' => $model->request_id], [
                    'class' => 'btn btn-primary',
                    'data' => [
                        'confirm' => Yii::t('app', 'Are you sure you want to accept this request?'),
                        'method' => 'post',
                    ],
                ]);
            }
        ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'userMade.username',
            'hotelMade.hotel_name',
            'userAcept.username',
            'hotelAcept.hotel_name',
            'request_details',
            'request_status',
        ],
    ]) ?>

</div>
