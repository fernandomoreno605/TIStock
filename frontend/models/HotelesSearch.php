<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Hoteles;
use yii\helpers\ArrayHelper;

/**
 * HotelesSearch represents the model behind the search form of `frontend\models\Hoteles`.
 */
class HotelesSearch extends Hoteles
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hotel_id'], 'integer'],
            [['hotel_name', 'hotel_address', 'hotel_phone', 'hotel_status'], 'safe'],
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
        $query = Hoteles::find();

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
            'hotel_id' => $this->hotel_id,
        ]);

        $query->andFilterWhere(['like', 'hotel_name', $this->hotel_name])
            ->andFilterWhere(['like', 'hotel_address', $this->hotel_address])
            ->andFilterWhere(['like', 'hotel_phone', $this->hotel_phone])
            ->andFilterWhere(['like', 'hotel_status', $this->hotel_status]);

        return $dataProvider;
    }

    public function listing(){
        $getHotels = Hoteles::find()
            ->where(['hotel_status'=> 'active'])
            ->all();
        $hotelList = ArrayHelper::map($getHotels,'hotel_id','hotel_name');
        return $hotelList;
    }

    public function getHotelName($id){
        $query = Hoteles::findOne($id);
        $hotelName = $query->hotel_name;

        return $hotelName;
    }

}
