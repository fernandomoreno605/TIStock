<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\User */

$this->title = $model->first_name.' '.$model->last_name ;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if ($alert != null){
        echo $alert;
    } ?>

    <p>
        <?= Html::a(' <i class="glyphicon glyphicon-open"></i> '.Yii::t('app', 'Update'), ['update', 'id' => $_SESSION['user_id']], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(' <i class="glyphicon glyphicon-asterisk"></i> '.Yii::t('app', 'Change Password'), ['password'], ['class' => 'btn btn-primary']) ?>
    </p>
    <div class="info">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'username',
                'first_name',
                'last_name',
                'colaborator_no',
                'hoteles_hotel_id',
                'email:email',
            ],
        ]) ?>
    </div>
    <div class="image">
        <?php
            echo '<img src="'.$model->user_image.'" class="user-imagen" alt="User Image" width="350" height="350" align="middle">';
        ?>
    </div>


</div>
