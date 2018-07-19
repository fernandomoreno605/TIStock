<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Prestamos */

$this->title = 'Update Prestamos: ' . $model->prestamo_id;
$this->params['breadcrumbs'][] = ['label' => 'Prestamos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->prestamo_id, 'url' => ['view', 'id' => $model->prestamo_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="prestamos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_deliver', [
        'model' => $model,
    ]) ?>

</div>
