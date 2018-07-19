<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Prestamos */

$this->title = 'Register new loan';
$this->params['breadcrumbs'][] = ['label' => 'Loans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prestamos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelsPrestamosArticulo' => $modelsPrestamosArticulo,
    ]) ?>

</div>
