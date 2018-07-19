<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Transferencias */

$this->title = 'Update Transferencias: ' . $model->transferencia_id;
$this->params['breadcrumbs'][] = ['label' => 'Transferencias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->transferencia_id, 'url' => ['view', 'id' => $model->transferencia_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="transferencias-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_update', [
        'model' => $model,
        'hotelsProvider' => $hotelsProvider,
    ]) ?>

</div>
