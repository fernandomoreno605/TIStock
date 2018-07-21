<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Productos */

$this->title = Yii::t('app','Create Product').' Admin mode';
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
