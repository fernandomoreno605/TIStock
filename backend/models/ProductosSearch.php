<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Productos;


/**
 * ProductosSearch represents the model behind the search form of `backend\models\Productos`.
 */
class ProductosSearch extends Productos
{
    public $globalSearch;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'product_stock'], 'integer'],
            [['hoteles_hotel_id','globalSearch','product_name', 'product_branch', 'product_provider', 'product_created_date', 'product_status'], 'safe'],
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
        $query = Productos::find()
            ->orderBy('hoteles_hotel_id');
        //$query->joinWith('hotelesHotel');
        // add conditions that should always apply here
        // the pagination is set here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 10],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            //'product_id' => $this->product_id,
            'hoteles_hotel_id' => $this->hoteles_hotel_id,
            'product_created_date' => $this->product_created_date,
            'product_stock' => $this->product_stock,
        ]);

        $query->andFilterWhere(['like', 'product_name', $this->product_name])
            ->andFilterWhere(['like', 'product_branch', $this->product_branch])
            ->andFilterWhere(['like', 'product_provider', $this->product_provider])
            //->andFilterWhere(['like', 'hoteles.hotel_name', $this->hoteles_hotel_id])
            ->andFilterWhere(['like', 'product_status', $this->product_status]);

        return $dataProvider;
    }
}
