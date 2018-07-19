<?php

namespace frontend\models;
use yii\helpers\Html;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\TransferenciaItems;
use yii\helpers\ArrayHelper;
use frontend\models\Productos;
/**
 * TransferenciaItemsSearch represents the model behind the search form of `frontend\models\TransferenciaItems`.
 */
class TransferenciaItemsSearch extends TransferenciaItems
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'transferencias_transferencia_id', 'productos_producto_id', 'cantidad'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = TransferenciaItems::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'transferencias_transferencia_id' => $this->transferencias_transferencia_id,
            'productos_producto_id' => $this->productos_producto_id,
            'cantidad' => $this->cantidad,
        ]);

        return $dataProvider;
    }
    public function searchItemsByTransferId($id){

        $query = TransferenciaItems::find()
            ->where(['transferencias_transferencia_id' => $id])
            ->asArray()
            ->all();

        $getTransfer = Transferencias::findOne(['transferencia_id' => $id]);

        $hotelProduct = Productos::find()
            ->where(['hoteles_hotel_id' => $getTransfer->transferencia_destino_id])
            ->asArray()
            ->all();

        $productList = '';
        foreach ($hotelProduct as $producto){
            $productList = $productList.'
                <option value="'.$producto['product_id'].'">'.$producto['product_name'].'</option>                                
            ';
        }

        $asing = null;
        $i = 0;
        foreach ($query as $item){
            if ($item['item_status'] != 1){
                $actualProduct = Productos::findOne(['product_id' => $item['productos_producto_id']]);
                $asing = $asing.'
            <div class="row">
                <div class="col-sm-4">
                   <select id="prodbox'.$item['productos_producto_id'].'" class="form-control" name="Transferencias[producto_origen][]">
                       <option value="'.$item['productos_producto_id'].'" >'.$actualProduct->product_name.'</option>
                   </select> 
                </div>
                <div class="col-sm-2">
                    <label>'.Yii::t('app','Assign To:').'</label>
                </div>
                <div class="col-sm-3">
                <select id="listabox'.$item['productos_producto_id'].'" class="form-control" name="Transferencias[producto_destino][]" aria-required="true" aria-invalid="true">
                    <option value="">'.Yii::t('app','Select Product').'</option>
                 '
                    .$productList.
                    '                
                </select>
                </div>
                <label>Or</label>
                <label>
                    <input value="'.$item['productos_producto_id'].'" name="Transferencias[nuevo_producto][]" type="checkbox" id="box'.$item['productos_producto_id'].'" onclick="bloqueo(this)">                     
                    '.Yii::t('app','Add as a New Product').'
                </label>
            </div>
            <div class="help-block"></div>';
            }
        }
        if ($asing != null){
            $asing = $asing.'
            <div class="form-group">
            '.Html::submitButton(' <i class="glyphicon glyphicon-floppy-disk"></i> '.Yii::t('app','Save'), ['class' => 'btn btn-success']).'
            </div>';
        }
        if ($asing == null){
            $asing = '<div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>'.Yii::t('app','Good Job').'!</strong> '.Yii::t('app','You don\'t have products to assign').'
            </div>';
        }
        return $asing;
    }
}

