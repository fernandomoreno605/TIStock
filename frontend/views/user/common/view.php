<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->first_name.' '.$model->last_name ;
?>
<div class="user-view">
    <?php
        if (isset($alert)){
            echo $alert;
        }
    ?>
    <div class="image">
        <?php
        echo '<img src="'.$model->user_image.'" class="img-user" alt="User Image" width="350" height="350" align="middle">';
        ?>
    </div>
    <h1 class="username"><?= Html::encode($this->title) ?></h1>
    <p class="option-buttons">
        <?= Html::a(' <i class="glyphicon glyphicon-open"></i> '.Yii::t('app', 'Update'), ['update', 'id' => $_SESSION['user_id']], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(' <i class="glyphicon glyphicon-asterisk"></i> '.Yii::t('app', 'Change Password'), ['password', 'id' => $_SESSION['user_id']], ['class' => 'btn btn-primary']) ?>
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
</div>
