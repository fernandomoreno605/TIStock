<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use backend\models\Comments;

    $unseen = 0;
    $notifications = '<ul id="w8" class="dropdown-menu">';
    $query = Comments::find()
        ->where(['hoteles_hotel_id' =>$_SESSION['current_hotel'] ])
        ->asArray()
        ->all();
    foreach ($query as $item) {
        if ($item['comment_status'] == 0){
            $unseen++;
            $notifications = $notifications.'
            <li class="alert alert-info alert-dismissable">
                <button id="'.$item['id_comment'].'" type="button" class="close" data-dismiss="alert">×</button>            
                <a class="notification" id="'.$item['id_comment'].'" href="'.$item['url'].'"><strong>'
                    .$item['coment_subjet'].'
                </strong><br />
                <small><em>
                '.$item['comment_text'].'
                </em></small>
                </a>
            </li>';
        }else{
            $notifications = $notifications.'
            <li class=" alert-dismissable">
                <button id="'.$item['id_comment'].'" type="button" class="close" data-dismiss="alert">×</button>            
                <a class="notification" id="'.$item['id_comment'].'" href="'.$item['url'].'"><strong>'
                    .$item['coment_subjet'].'
                </strong><br />
                <small><em>
                '.$item['comment_text'].'
                </em></small>
                </a>
            </li>';
        }
    }
    $notifications = $notifications.'</ul>';

AppAsset::register($this);
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
</head>
<?php //Pjax::begin(); ?>

<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php

    NavBar::begin([
        'brandLabel' => 'System Management',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = ['label' => 'Hotels', 'url' => ['/hoteles/index']];
        $menuItems[] = ['label'=> 'Users','url' => ['/user/index']];
        $menuItems[] = ['label' => 'Products', 'url' => ['/productos/index']];
        $menuItems[] = ['label' => 'Requests', 'url' => ['/request/index']];
        $menuItems[] = ['label' => 'Loans','url' => ['/prestamos/index']];
        $menuItems[] = ['label' => 'Transfers','url' => ['/transferencias/index']];
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
        $menuItems[] = '<li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                               <span id="number" class="label label-pill label-danger count" style="border-radius:10px;">'.$unseen.'</span>
                               <span class="glyphicon glyphicon-bell" style="font-size:18px;"></span>
                            </a>'.$notifications.'
                        </li>';

    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>
    <div class="container">

        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>

</div>
</footer>

<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>

<!--
<script language="javascript">
    var timestamp = null;
    function cargar_push()
    {
        alert('Pagina cargada');
        $.ajax({
            async:	true,
            type: "POST",
            url: "notification/httpush.php",
            data: "&timestamp="+timestamp,
            dataType:"html",
            success: function(data)
            {
                var json    	   = eval("(" + data + ")");
                timestamp 		   = json.timestamp;
                id        		   = json.id;
                commenttext        = json.comment_text;
                status      	   = json.comment_status;
                tipo      	       = json.comment_subject;

                if(timestamp != null)
                {
                    $.ajax({
                        async:	true,
                        type: "POST",
                        url: "main.php",
                        data: "",
                        dataType:"html",
                        success: function(data)
                        {
                            $('#respuesta').html(data);
                        }
                    });
                }
                setTimeout('cargar_push()',1000);

            }
        });
    }

    $(document).ready(function()
    {
        cargar_push();
    });
</script>
-->