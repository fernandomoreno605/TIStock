<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use kartik\export\ExportMenu;


$this->title = Yii::t('app','Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>

<span>
    <a id="1" class="view" style="display: none"><button class="btn btn-default"><i class="glyphicon glyphicon-th-list"></i> List</button></a>
    <a id="2" class="view" ><button class="btn btn-default"><i class="glyphicon glyphicon-th"></i> Grid</button></a>
</span>
<div id="div-list" class="productos-index">


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions'=>function($model){
            if ($model ->product_status !='active') {

                return ['class' => 'danger'];
            }
        },
        'columns' => [
            'product_name',
            ['attribute' => 'hoteles_hotel_id',
                'value' => 'hotelesHotel.hotel_name'
            ],
            'product_branch',
            'product_provider',
            //'product_created_date',
            'product_stock',
            'product_status',
            //'product_serial',
            //'product_image',
            ['class' => 'yii\grid\ActionColumn'],
        ],
        'pjax'=>true,
        'pjaxSettings'=>[
            'neverTimeout'=>true,
        ],
        'panel' => [
            'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-barcode"></i>'.' '.Yii::t('app','Products').'</h3>',
            'type'=>'default',
            'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> '.Yii::t('app','Create Product'), ['create'], ['class' => 'btn btn-success']),
            'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> '.Yii::t('app','Reset'), ['index'], ['class' => 'btn btn-default']),
        ],
    ]); ?>
</div>

<div id="div-grid" class="productos-grid" style="display:none">
    <?php
        foreach ($productList as $product){
            echo '
            <div class="ofert">
                <center>
                    <h3>'.$product['product_name'].'</h3>
                    <br>
                    <h4>Stock: 4</h4>
                    <img src="'.$product['product_image'].'" alt="product" class="images" onclick="location=\'index.php?r=productos%2Fview&amp;id='.$product['product_id'].'\'" height="191">
                    <br>
                    '.Html::a(' <i class="glyphicon glyphicon-open"></i> '.Yii::t('app','View'), ['view', 'id' => $product['product_id']], ['class' => 'btn btn-primary']).'
                    '.Html::a(' <i class="glyphicon glyphicon-open"></i> '.Yii::t('app','Update'), ['update', 'id' => $product['product_id']], ['class' => 'btn btn-primary']).'
                     '.Html::a(' <i class="glyphicon glyphicon-trash"></i> '.Yii::t('app','Delete'), ['delete', 'id' => $product['product_id']], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]).'			
                </center>
            </div>';
        }
    ?>
</div>

