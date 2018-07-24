<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Hoteles */

$this->title = Yii::t('app', 'Update Hoteles: ' . $model->hotel_id, [
    'nameAttribute' => '' . $model->hotel_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Hoteles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->hotel_id, 'url' => ['view', 'id' => $model->hotel_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="hoteles-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
