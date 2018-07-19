<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TransferenciaItems;

/**
 * TransferenciaItemsSearch represents the model behind the search form of `backend\models\TransferenciaItems`.
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
}
