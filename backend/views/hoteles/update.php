<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Hoteles */

$this->title = 'Update Hoteles: ' . $model->hotel_name;
$this->params['breadcrumbs'][] = ['label' => 'Hoteles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->hotel_name, 'url' => ['view', 'id' => $model->hotel_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="hoteles-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
