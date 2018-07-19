<?php

/* @var $this \yii\web\View */
/* @var $content string */

use frontend\assets\HomeAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

HomeAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style type="text/css">
        body {
            background: url('../assets/img/background.jpg') no-repeat center;
        }
    </style>

</head>
<body>
<?php $this->beginBody() ?>


<div class="col-md-10 col-md-offset-1">
    <div class="jumbotron">
        <div class="centered">
            <div class="centered">
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </div>
    </div> <!-- end jumbo -->
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
