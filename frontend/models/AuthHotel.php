<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "auth_hotel".
 *
 * @property int $id
 * @property int $users_user_id
 * @property int $hoteles_hotel_id
 *
 * @property User $usersUser
 * @property Hoteles $hotelesHotel
 */
class AuthHotel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'auth_hotel';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['users_user_id', 'hoteles_hotel_id'], 'required'],
            [['users_user_id', 'hoteles_hotel_id'], 'integer'],
            [['users_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['users_user_id' => 'id']],
            [['hoteles_hotel_id'], 'exist', 'skipOnError' => true, 'targetClass' => Hoteles::className(), 'targetAttribute' => ['hoteles_hotel_id' => 'hotel_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'users_user_id' => 'Users User ID',
            'hoteles_hotel_id' => 'Hotel',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersUser()
    {
        return $this->hasOne(User::className(), ['id' => 'users_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelesHotel()
    {
        return $this->hasOne(Hoteles::className(), ['hotel_id' => 'hoteles_hotel_id']);
    }
}
