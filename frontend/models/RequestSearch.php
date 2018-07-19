<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Request;

/**
 * RequestSearch represents the model behind the search form of `frontend\models\Request`.
 */
class RequestSearch extends Request
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['request_id', 'user_made_id', 'hotel_made_id', 'user_acept_id', 'hotel_acept_id'], 'integer'],
            [['request_details', 'request_status'], 'safe'],
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
        $query = Request::find()
            ->where(['hotel_made_id' => $_SESSION['current_hotel']]);

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
            'request_id' => $this->request_id,
            'user_made_id' => $this->user_made_id,
            'hotel_made_id' => $this->hotel_made_id,
            'user_acept_id' => $this->user_acept_id,
            'hotel_acept_id' => $this->hotel_acept_id,
        ]);

        $query->andFilterWhere(['like', 'request_details', $this->request_details]);
        $query->andFilterWhere(['like', 'request_status', $this->request_status]);

        return $dataProvider;
    }
}
