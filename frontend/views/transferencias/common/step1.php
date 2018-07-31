<?php
/**
 * Created by PhpStorm.
 * User: Fernando
 * Date: 28/07/2018
 * Time: 09:33 AM
 */
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use kartik\export\ExportMenu;
?>
<div id="div-grid" class="productos-grid" >
    <h1>1. Seleccionar productos a transferir</h1>
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
                </center>
            </div>';
    }
    ?>
</div>

