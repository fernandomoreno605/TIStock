<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Transferencias;

/**
 * TransferenciasSearch represents the model behind the search form of `frontend\models\Transferencias`.
 */
class TransferenciasSearch extends Transferencias
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['transferencia_id'], 'integer'],
            [['transferencia_status', 'transferencia_comentario_origen', 'transferencia_comentario_destino','usuarios_usuario_id', 'hoteles_hotel_id', 'transferencia_destino_id', 'usuarios_usuario_recibe'], 'safe'],
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
        $query = Transferencias::find()
        ->where(['transferencias.hoteles_hotel_id' => $_SESSION['current_hotel']]);

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

        $query->joinWith('usuariosUsuario')
            ->joinWith('hotelesHotel');

        // grid filtering conditions
        $query->andFilterWhere([
            'transferencia_id' => $this->transferencia_id,
            //'transferencia_destino_id' => $this->transferencia_destino_id,
        ]);

        $query->andFilterWhere(['like', 'transferencia_status', $this->transferencia_status])
            ->andFilterWhere(['like', 'user.username', $this->usuarios_usuario_id])
            ->andFilterWhere(['like', 'user.username', $this->usuarios_usuario_recibe])
            ->andFilterWhere(['like', 'hoteles.hotel_name', $this->hoteles_hotel_id])
            ->andFilterWhere(['like', 'hoteles.hotel_name', $this->transferencia_destino_id])
            ->andFilterWhere(['like', 'transferencia_comentario_origen', $this->transferencia_comentario_origen])
            ->andFilterWhere(['like', 'transferencia_comentario_destino', $this->transferencia_comentario_destino]);

        return $dataProvider;
    }

    public function searchRecived($params)
{
    $query = Transferencias::find()
        ->where(['transferencias.transferencia_destino_id' => $_SESSION['current_hotel']]);

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

    $query->joinWith('usuariosUsuario')
        ->joinWith('hotelesHotel');

    // grid filtering conditions
    $query->andFilterWhere([
        'transferencia_id' => $this->transferencia_id,
        //'transferencia_destino_id' => $this->transferencia_destino_id,
    ]);

    $query->andFilterWhere(['like', 'transferencia_status', $this->transferencia_status])
        ->andFilterWhere(['like', 'user.username', $this->usuarios_usuario_id])
        ->andFilterWhere(['like', 'user.username', $this->usuarios_usuario_recibe])
        ->andFilterWhere(['like', 'hoteles.hotel_name', $this->hoteles_hotel_id])
        ->andFilterWhere(['like', 'hoteles.hotel_name', $this->transferencia_destino_id])
        ->andFilterWhere(['like', 'transferencia_comentario_origen', $this->transferencia_comentario_origen])
        ->andFilterWhere(['like', 'transferencia_comentario_destino', $this->transferencia_comentario_destino]);

    return $dataProvider;
}

}
