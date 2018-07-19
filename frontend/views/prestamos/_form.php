<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use frontend\models\Productos;
use frontend\models\User;
use yii\helpers\ArrayHelper;

?>

<div class="prestamos-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <?= $form->field($model, 'prestamo_numero_empleado')->textInput() ?>

    <?= $form->field($model, 'prestamo_nombre_empleado')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'prestamo_comentario')->textarea(['rows' => 3]) ?>

    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4><i class="glyphicon glyphicon-shopping-cart"></i> <?=Yii::t('app','Items')?></h4>
            </div>

            <div class="panel-body">
                <?php DynamicFormWidget::begin([
                    'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                    'widgetBody' => '.container-items', // required: css class selector
                    'widgetItem' => '.item', // required: css class
                    'limit' => $count, // the maximum times, an element can be cloned (default 999)
                    'min' => 1, // 0 or 1 (default 1)
                    'insertButton' => '.add-item', // css class
                    'deleteButton' => '.remove-item', // css class
                    'model' => $modelsPrestamosArticulo[0],
                    'formId' => 'dynamic-form',
                    'formFields' => [
                        'productos_product_id',
                        'producto_cantidad',
                    ],
                ]);
                ?>

                <div class="container-items"><!-- widgetContainer -->
                    <?php foreach ($modelsPrestamosArticulo as $i => $modelPrestamoArticulo):?>

                        <div class="item panel panel-default"><!-- widgetBody -->
                            <div class="panel-heading">
                                <h3 class="panel-title pull-left"><?=Yii::t('app','Item')?></h3>
                                <div class="pull-right">
                                    <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                                    <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                                <?php
                                // necessary for update action.
                                if (! $modelPrestamoArticulo->isNewRecord) {

                                    echo Html::activeHiddenInput($modelPrestamoArticulo, "[{$i}]id");
                                }
                                ?>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <?php echo $form->field($modelPrestamoArticulo,"[{$i}]productos_product_id" )->dropDownList(
                                            $dataProvider,[
                                                'prompt' => Yii::t('app','Select Product'),
                                                'onchange' =>
                                                    'var n = getId(this); 
                                                    $.post("index.php?r=productos/quantity&id='.'"+$(this).val(),function(data){
                                                    $("select#prestamoarticulos-"+n+"-producto_cantidad").html(data);
                                                    });
                                                    '
                                            ]
                                        );

                                        ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <?= $form->field($modelPrestamoArticulo, "[{$i}]producto_cantidad")->dropDownList(
                                            [
                                                'prompt'=> Yii::t('app','First Select a Product'),
                                            ]
                                        ) ?>

                                    </div>
                                </div><!-- .row -->
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php DynamicFormWidget::end(); ?>
            </div>
        </div>

    </div>

    <div class="form-group">
        <?= Html::submitButton(' <i class="glyphicon glyphicon-floppy-disk"></i> '.Yii::t('app','Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script type="text/javascript">
    function getId(inputTmp){
        var idSelection = inputTmp.id;
        var regex = /(\d+)/g;
        var soloNumero = idSelection.match(regex);
        return soloNumero;
    }
</script>