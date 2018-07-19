<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Transferencias;

/**
 * TransferenciasSearch represents the model behind the search form of `backend\models\Transferencias`.
 */
class TransferenciasSearch extends Transferencias
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['transferencia_id',  ], 'integer'],
            [['hoteles_hotel_id', 'transferencia_destino_id', 'usuarios_usuario_recibe','usuarios_usuario_id','transferencia_status', 'transferencia_comentario_origen', 'transferencia_comentario_destino'], 'safe'],
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
        $query = Transferencias::find();

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
            'transferencia_id' => $this->transferencia_id,
            'transferencia_destino_id' => $this->transferencia_destino_id,
            'usuarios_usuario_recibe' => $this->usuarios_usuario_recibe,
            'usuarios_usuario_id' => $this->usuarios_usuario_id,
            'hoteles_hotel_id' => $this->hoteles_hotel_id,
        ]);


        $query->andFilterWhere(['like', 'transferencia_status', $this->transferencia_status])
            ->andFilterWhere(['like', 'transferencia_comentario_origen', $this->transferencia_comentario_origen])
            ->andFilterWhere(['like', 'transferencia_comentario_destino', $this->transferencia_comentario_destino]);

        return $dataProvider;
    }
}
