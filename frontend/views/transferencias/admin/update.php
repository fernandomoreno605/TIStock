<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Transferencias */

$this->title = Yii::t('app','Update').': ' . $model->transferencia_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Transfers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->transferencia_id, 'url' => ['view', 'id' => $model->transferencia_id]];
$this->params['breadcrumbs'][] = Yii::t('app','Update');
?>
<div class="transferencias-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_update', [
        'model' => $model,
        'hotelsProvider' => $hotelsProvider,
        'origin' => $origin,
        'destination' => $destination,

    ]) ?>

</div>
