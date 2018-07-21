<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Prestamos;
use frontend\models\User;

/**
 * PrestamosSearch represents the model behind the search form of `frontend\models\Prestamos`.
 */
class PrestamosSearch extends Prestamos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['prestamo_id', 'hoteles_hotel_id', 'prestamo_numero_empleado'], 'integer'],
            [['prestamo_fecha', 'prestamo_nombre_empleado', 'prestamo_fecha_entrega', 'prestamo_status', 'prestamo_comentario', 'users_user_id'], 'safe'],
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
        if ($_SESSION['user_type'] != 'admin'){
            $query = Prestamos::find()
                ->where(['Prestamos.hoteles_hotel_id' => $_SESSION['current_hotel']])
                ->joinWith('usersUser');
        }else{
            $query = Prestamos::find();
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


        //$query->joinWith('usersUser');

        // grid filtering conditions
        $query->andFilterWhere([
            'prestamo_id' => $this->prestamo_id,
            'hoteles_hotel_id' => $this->hoteles_hotel_id,
            'users_user_id' => $this->users_user_id,
            'prestamo_fecha' => $this->prestamo_fecha,
            'prestamo_numero_empleado' => $this->prestamo_numero_empleado,
            'prestamo_fecha_entrega' => $this->prestamo_fecha_entrega,
        ]);

        $query->andFilterWhere(['like', 'prestamo_nombre_empleado', $this->prestamo_nombre_empleado])
            ->andFilterWhere(['like', 'prestamo_status', $this->prestamo_status])
            ->andFilterWhere(['like', 'prestamo_comentario', $this->prestamo_comentario]);
            //->andFilterWhere(['like', 'user.username', $this->users_user_id]);

        return $dataProvider;
    }
}
