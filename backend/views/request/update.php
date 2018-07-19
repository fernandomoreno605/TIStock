<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Request */

$this->title = Yii::t('app', 'Update Request: ' . $model->request_id, [
    'nameAttribute' => '' . $model->request_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Requests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->request_id, 'url' => ['view', 'id' => $model->request_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="request-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
