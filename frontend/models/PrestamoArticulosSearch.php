<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\PrestamoArticulos;

/**
 * PrestamoArticulosSearch represents the model behind the search form of `frontend\models\PrestamoArticulos`.
 */
class PrestamoArticulosSearch extends PrestamoArticulos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'prestamos_prestamo_id', 'productos_product_id', 'producto_cantidad'], 'integer'],
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
        $query = PrestamoArticulos::find();

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
            'prestamos_prestamo_id' => $this->prestamos_prestamo_id,
            'productos_product_id' => $this->productos_product_id,
            'producto_cantidad' => $this->producto_cantidad,
        ]);

        return $dataProvider;
    }
}
