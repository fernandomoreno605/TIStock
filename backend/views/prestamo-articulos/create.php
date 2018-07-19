<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\PrestamoArticulos */

$this->title = 'Create Prestamo Articulos';
$this->params['breadcrumbs'][] = ['label' => 'Prestamo Articulos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prestamo-articulos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
