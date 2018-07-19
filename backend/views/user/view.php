<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
//use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(' <i class="glyphicon glyphicon-open"></i> '.Yii::t('app','Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

        <?= Html::a(' <i class="glyphicon glyphicon-asterisk"></i> '.Yii::t('app','Change Password'), ['password', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

        <?= Html::a(' <i class="glyphicon glyphicon-trash"></i> '.Yii::t('app','Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'username',
            'first_name',
            'last_name',
            'colaborator_no',
            'hotelesHotel.hotel_name',
            'email:email',
            //'status',
        ],
    ]) ?>
    <h3>Permissions to this user:</h3>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['attribute' => 'hoteles_hotel_id',
                'value' => 'hotelesHotel.hotel_name',
            ],
/*
            ['attribute' => 'users_user_id',
                'value' => 'usersUser.username'
            ],
*/
        ],
    ]); ?>
</div>
