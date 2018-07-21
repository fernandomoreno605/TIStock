<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Prestamos */

$this->title = Yii::t('app','Update');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Loans'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Loan of').': '.$model->prestamo_nombre_empleado , 'url' => ['view', 'id' => $model->prestamo_id]];
$this->params['breadcrumbs'][] = Yii::t('app','Update');
?>
<div class="prestamos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_deliver', [
        'model' => $model,
    ]) ?>

</div>
