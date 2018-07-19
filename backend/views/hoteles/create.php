<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Hoteles */

$this->title = 'Create Hoteles';
$this->params['breadcrumbs'][] = ['label' => 'Hoteles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hoteles-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
