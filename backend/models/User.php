<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $first_name
 * @property string $last_name
 * @property int $colaborator_no
 * @property int $hoteles_hotel_id
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string $user_type
 *
 * @property Rentas[] $rentas
 * @property Hoteles $hotelesHotel
 */
class User extends \yii\db\ActiveRecord
{
    public $permissions;
    public $password;
    public $confirm_password;
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'first_name', 'last_name', 'colaborator_no', 'hoteles_hotel_id', 'password_hash', 'email'], 'required'],
            [['colaborator_no', 'hoteles_hotel_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['first_name', 'last_name'], 'string', 'max' => 50],
            [['auth_key'], 'string', 'max' => 32],
            [['user_type'],'string'],
            [['username'], 'unique'],
            [['colaborator_no'], 'unique'],
            [['email'], 'unique'],
            ['email', 'trim'],
            ['email', 'email'],
            [['password_reset_token'], 'unique'],
            [['hoteles_hotel_id'], 'exist', 'skipOnError' => true, 'targetClass' => Hoteles::className(), 'targetAttribute' => ['hoteles_hotel_id' => 'hotel_id']],

            ['password', 'string', 'min' => 6],
            ['confirm_password', 'string', 'min' => 6],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'colaborator_no' => 'Collaborator Number',
            'hoteles_hotel_id' => 'Hotel',
            'hotelesHotel.hotel_name' => 'Hotel',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_type' => 'User type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentas()
    {
        return $this->hasMany(Rentas::className(), ['users_user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelesHotel()
    {
        return $this->hasOne(Hoteles::className(), ['hotel_id' => 'hoteles_hotel_id']);
    }
}
