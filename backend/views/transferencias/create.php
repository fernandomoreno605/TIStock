<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Transferencias */

$this->title = 'Create a transfer';
$this->params['breadcrumbs'][] = ['label' => 'Transfers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transferencias-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelsTransItems' => $modelsTransItems,

    ]) ?>

</div>
