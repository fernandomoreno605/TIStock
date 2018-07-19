<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\TransferenciaItems */

$this->title = 'Create Transferencia Items';
$this->params['breadcrumbs'][] = ['label' => 'Transferencia Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transferencia-items-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
