<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Prestamos;

/**
 * PrestamosSearch represents the model behind the search form of `backend\models\Prestamos`.
 */
class PrestamosSearch extends Prestamos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['prestamo_id', 'prestamo_numero_empleado'], 'integer'],
            [['users_user_id','hoteles_hotel_id','prestamo_fecha', 'prestamo_nombre_empleado', 'prestamo_fecha_entrega', 'prestamo_status', 'prestamo_comentario'], 'safe'],
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
        $query = Prestamos::find();

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
            'hoteles_hotel_id' => $this->hoteles_hotel_id,
            'users_user_id' => $this->users_user_id,
            'prestamo_id' => $this->prestamo_id,
            'prestamo_fecha' => $this->prestamo_fecha,
            'prestamo_numero_empleado' => $this->prestamo_numero_empleado,
            'prestamo_fecha_entrega' => $this->prestamo_fecha_entrega,
        ]);

        $query->andFilterWhere(['like', 'prestamo_nombre_empleado', $this->prestamo_nombre_empleado])
            ->andFilterWhere(['like', 'prestamo_status', $this->prestamo_status])
            ->andFilterWhere(['like', 'prestamo_comentario', $this->prestamo_comentario]);

        return $dataProvider;
    }
}
