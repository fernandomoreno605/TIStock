<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "hoteles".
 *
 * @property int $hotel_id
 * @property string $hotel_name
 * @property string $hotel_address
 * @property string $hotel_phone
 * @property string $hotel_status
 *
 * @property Productos[] $productos
 * @property Rentas[] $rentas
 * @property User[] $users
 */
class Hoteles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hoteles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hotel_name', 'hotel_address', 'hotel_phone', 'hotel_status'], 'required'],
            ['hotel_name', 'unique', 'targetClass' => '\backend\models\Hoteles', 'message' => 'This name has already been taken.'],
            [['hotel_status'], 'string'],
            [['hotel_name', 'hotel_phone'], 'string', 'max' => 50],
            [['hotel_address'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'hotel_id' => 'ID',
            'hotel_name' => 'Name',
            'hotel_address' => 'Address',
            'hotel_phone' => 'Phone',
            'hotel_status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductos()
    {
        return $this->hasMany(Productos::className(), ['hoteles_hotel_id' => 'hotel_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentas()
    {
        return $this->hasMany(Rentas::className(), ['hoteles_hotel_id' => 'hotel_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['hoteles_hotel_id' => 'hotel_id']);
    }
}
