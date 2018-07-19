<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AuthHotel;

/**
 * AuthHotelSearch represents the model behind the search form of `backend\models\AuthHotel`.
 */
class AuthHotelSearch extends AuthHotel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'users_user_id', 'hoteles_hotel_id'], 'integer'],
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


    public function searchByUserId($id){
        $query = AuthHotel::find()
            ->where(['users_user_id' => $id])
            ->all();
        return $query;
    }
    public function search($params)
    {
        $query = AuthHotel::find();

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
            'users_user_id' => $this->users_user_id,
            'hoteles_hotel_id' => $this->hoteles_hotel_id,
        ]);

        return $dataProvider;
    }
}
