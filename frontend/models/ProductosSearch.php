<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Productos;
use frontend\models\User;
use yii\helpers\ArrayHelper;

/**
 * ProductosSearch represents the model behind the search form of `frontend\models\Productos`.
 */
class ProductosSearch extends Productos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'hoteles_hotel_id', 'product_stock'], 'integer'],
            [['product_name', 'product_branch', 'product_provider', 'product_created_date', 'product_status'], 'safe'],
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
        if ($_SESSION['user_type'] == 'admin'){
            $query = Productos::find();
        }else{
            $query = Productos::find()
                ->where(['hoteles_hotel_id'=> $_SESSION['current_hotel']]);
        }

        // add conditions that should always apply here

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
            'product_id' => $this->product_id,
            'hoteles_hotel_id' => $this->hoteles_hotel_id,
            'product_created_date' => $this->product_created_date,
            'product_stock' => $this->product_stock,
        ]);

        $query->andFilterWhere(['like', 'product_name', $this->product_name])
            ->andFilterWhere(['like', 'product_branch', $this->product_branch])
            ->andFilterWhere(['like', 'product_provider', $this->product_provider])
            ->andFilterWhere(['like', 'product_status', $this->product_status]);

        return $dataProvider;
    }
    public function searchBy(){

        $activeProducts = Productos::find()
            ->where(['product_status' => 'active'])
            ->andWhere(['hoteles_hotel_id' => $_SESSION['current_hotel']])
            ->all();
        $productsList = ArrayHelper::map($activeProducts,'product_id','product_name');

        return $productsList;
    }
    public function countActive(){
        $activeProducts = Productos::find()
            ->where(['product_status' => 'active'])
            ->andWhere(['hoteles_hotel_id' => $_SESSION['current_hotel']])
            ->count();

        return $activeProducts;
    }
    public function productsAsArray(){
        if ($_SESSION['user_type'] == 'admin'){
            $query = Productos::find()
                ->where(['product_status' => 'active'])
                ->asArray()
                ->all();
        }else{
            $query = Productos::find()
                ->where(['product_status' => 'active'])
                ->andWhere(['hoteles_hotel_id' => $_SESSION['current_hotel']])
                ->asArray()
                ->all();
        }
        return $query;
    }
}
