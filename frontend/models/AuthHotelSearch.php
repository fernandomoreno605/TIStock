<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\AuthHotel;
use frontend\models\Hoteles;
class AuthHotelSearch extends AuthHotel
{
    public function rules()
    {
        return [
            [['id', 'users_user_id', 'hoteles_hotel_id'], 'integer'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = AuthHotel::find();

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
    public function permissionsList($id){
        $query = AuthHotel::find()
            ->where(['users_user_id' => $id])
            ->asArray()
            ->all();
        $list = '';
        foreach ($query as $hotel) {
            $dataHotel = Hoteles::findOne(['hotel_id' => $hotel['hoteles_hotel_id']]);
            $list= $list.'<span class="hotel" id="'.$hotel['hoteles_hotel_id'].'"><button class="btn btn-default btn-flat">'.$dataHotel->hotel_name.'</button></span>';
        }
        return $list;
    }
}
