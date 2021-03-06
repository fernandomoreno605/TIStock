<?php

use yii\helpers\Html;

$this->title = Yii::t('app','Create Product');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="productos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'hotelProvider' => $hotelProvider,
    ]) ?>

</div>
