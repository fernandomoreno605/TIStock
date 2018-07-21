<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = Yii::t('app', 'Product Assignation');
?>

<div class="transferencias-form">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php
        if ($alert != null){
            echo $alert;
        }
    ?>

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <?php
    echo '<br/><label class="control-label" for="transfer-assignation">'
        .Yii::t('app','Product Assignation').'</label>';
    echo $itemProvider;
    ?>

    <?php ActiveForm::end(); ?>
</div>
<script type="text/javascript">
    function bloqueo(inputTmp) {
        var idSelection = inputTmp.id;
        var str1 = "lista";
        var str2 = "prod";
        var res = str1.concat(idSelection);
        var res2 = str2.concat(idSelection);
        var checkBox = document.getElementById(idSelection);
        if (checkBox.checked == true){
            document.getElementById(res).disabled = true;
            document.getElementById(res2).disabled = true;
        } else {
            document.getElementById(res).disabled = false;
            document.getElementById(res2).disabled = false;
        }
    }
</script>
