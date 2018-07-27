<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use frontend\models\CommentsSearch;
use kartik\dialog\Dialog;
$comentariosHotel = new CommentsSearch();

AppAsset::register($this);

?>
<?= Dialog::widget(['overrideYiiConfirm' => true]); ?>

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
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
        if ($_SESSION['user_type'] != 'admin'){
            NavBar::begin([
                'brandLabel' => $_SESSION['current_hotel_name'],
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
        }else{
            NavBar::begin([
                'brandLabel' => '<img src="icons/logo-palace.png" alt="Logo" align="middle">',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
        }
        if (!Yii::$app->user->isGuest){

            $menuItems = [
                ['label' => Yii::t('app','Home'), 'url' => ['/site/index']],
            ];
            $menuItems[] =['label' => Yii::t('app','Products'), 'url' => ['productos/index']];
            if ($_SESSION['user_type'] == 'admin'){
                $menuItems[] =['label' => Yii::t('app','Users'),'url' => ['user/index']];
                $menuItems[] =['label' => Yii::t('app','Hotels'),'url' => ['hoteles/index']];
                $menuItems[] =['label' => Yii::t('app','Transfers'),'url' => ['transferencias/index']];
                $menuItems[] =['label' => Yii::t('app','Requests'),'url' => ['request/index']];
            }else{
                $menuItems[] = ['label' => Yii::t('app','Transfers'),'url' => ['transferencias/index'],
                    'items' =>[
                        ['label'=> Yii::t('app','Received'),'url' => ['transferencias/received']],
                        ['label'=> Yii::t('app','Made'),'url' => ['transferencias/index']],
                    ]];
            }
            $menuItems[]=['label' => Yii::t('app','Loans'),'url' => ['prestamos/index']];
            $menuItems[] ='<li class="dropdown">
                          <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                          <img src="icons/idioma.png" alt="Languaje" width="20" height="20" align="middle">
                                 '.Yii::t('app','Language').' 
                              <span class="caret"></span>
                          </a>
                          <ul id="w8" class="dropdown-menu">
                              <li>
                                  <a>
                                    <span class="language" id="en"><img src="icons/en.png" alt="Languaje" width="20" height="20" align="middle">
                                       '.Yii::t('app','English').'
                                    </span>
                                   </a>
                              </li>
                              <li>
                                  <a>
                                    <span class="language" id="es">
                                        <img src="icons/es.png" alt="Languaje" width="20" height="20" align="middle">
                                         '.Yii::t('app','Spanish').'
                                    </span>
                                  </a>
                              </li>
                          </ul>
                       </li>';
            $menuItems[] = '<li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              <img src="'.$_SESSION['image'].'" class="img-circle" alt="User Image" width="25" height="25" align="middle">
              <span class="hidden-xs">'.$_SESSION['username'].'</span><span class="caret"></span>
            </a>
            <ul id="w9" class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="'.$_SESSION['image'].'"  class="img-circle" alt="User Image" width="150" height="150" align="middle">
                <p align="center">
                  '.$_SESSION['name'].'<br/>
                </p>    
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="index.php?r=user/view&id='.$_SESSION['user_id'].'" class="btn btn-default btn-flat">'.Yii::t('app','Profile').'</a>
                </div>
                <div class="pull-right">'
                .Html::beginForm(['/site/logout'], 'post')
                .Html::submitButton(
                    Yii::t('app','Sign Out'),
                    ['class' => 'btn btn-default btn-flat',
                        'data' => [
                            'confirm' => Yii::t('app','Are you sure you want to sign out?'),
                            'method' => 'post',
                        ]
                    ]
                ).Html::endForm().'
                </div>
              </li>
            </ul>
          </li>';
            $menuItems[] = '<li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                               <span id="number" class="label label-pill label-danger count" style="border-radius:10px;">'.$comentariosHotel->getNotificationsUnseen().'</span>
                               <span class="glyphicon glyphicon-bell" style="font-size:18px;"></span>
                            </a>'.$comentariosHotel->getNotificationsByHotelId().'
                        </li>';
        }
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => $menuItems,
        ]);
        NavBar::end();
    ?>
    <div class="container">
        <div class="hotel-permissions" id="hotel-permissions">
            <div class="pull-right">
                <?php
                    echo $_SESSION['hotel_permissions'];
                ?>
            </div>
        </div>
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <?= date('D-M-Y') ?>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
