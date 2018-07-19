<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TransferenciaItems */

$this->title = 'Update Transferencia Items: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Transferencia Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="transferencia-items-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
