<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Prestamos */

$this->title = Yii::t('app','Create Loan');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Loans'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prestamos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'count' => $count,
        'dataProvider' => $dataProvider,
        'modelsPrestamosArticulo' => $modelsPrestamosArticulo,
    ]) ?>

</div>
