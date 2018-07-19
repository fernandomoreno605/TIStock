<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Productos;
use backend\models\Hoteles;
use yii\helpers\ArrayHelper;
use wbraganca\dynamicform\DynamicFormWidget;


/* @var $this yii\web\View */
/* @var $model backend\models\Transferencias */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="transferencias-form">
<?php
    //obtencion de hoteles activos
    $hoteles = Hoteles::find()
        ->where(['hotel_status' => 'active'])
        ->all();
    //el resultado se selecciona el id y se muestra como nombre, con array helper se hace un mapeo
    $resultado = ArrayHelper::map($hoteles, 'hotel_id', 'hotel_name');

    //consultando productos activos
    $activeProductos = Productos::find()
        ->where(['product_status' => 'active'])
        ->all();
    $listaProductos = ArrayHelper::map($activeProductos,'product_id','product_name');
?>
    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <?= $form->field($model, 'transferencia_destino_id')->dropDownList(
    	$resultado,
    	[
    		'prompt'=> 'Select Destiny',
    	]
    ) ?>

    <?= $form->field($model, 'transferencia_comentario_origen')->textarea(['rows' => 3]) ?>

<!-- Start dynamic form -->
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4><i class="glyphicon glyphicon-shopping-cart"></i> Transfer Items</h4>
            </div>
            
            <div class="panel-body">
                 <?php DynamicFormWidget::begin([
                    'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                    'widgetBody' => '.container-items', // required: css class selector
                    'widgetItem' => '.item', // required: css class
                    'limit' => 4, // the maximum times, an element can be cloned (default 999)
                    'min' => 1, // 0 or 1 (default 1)
                    'insertButton' => '.add-item', // css class
                    'deleteButton' => '.remove-item', // css class
                    'model' => $modelsTransItems[0],
                    'formId' => 'dynamic-form',
                    'formFields' => [
                        'productos_producto_id',
                        'cantidad',
                    ],
                ]); ?>

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($modelsTransItems as $i => $modelTransItem): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Item</h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $modelTransItem->isNewRecord) {
                                echo Html::activeHiddenInput($modelTransItem, "[{$i}]id");
                            }
                        ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <?= $form->field($modelTransItem, "[{$i}]productos_producto_id" )->dropDownList(
                                    $listaProductos,
                                    [
                                        'prompt' => 'Select a product',
                                        'onchange' =>
                                            'var n = getId(this); 
                                            $.post("index.php?r=productos/quantity&id='.'"+$(this).val(),function(data){
                                            $("select#transferenciaitems-"+n+"-cantidad").html(data);
                                            });'
                                    ]
                                ) ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($modelTransItem, "[{$i}]cantidad")->dropDownList(
                                            [
                                                'prompt'=> 'First select a product',
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
<!-- End dynamic form -->
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