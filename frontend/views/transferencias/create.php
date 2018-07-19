<?php

use yii\helpers\Html;

$this->title = Yii::t('app','Create Transfer');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Transfers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transferencias-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'hotelsProvider' => $hotelsProvider,
        'count' => $count,
        'dataProvider' => $dataProvider,
        'modelsTransItems' => $modelsTransItems,
    ]) ?>

</div>
