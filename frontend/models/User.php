<?php

namespace frontend\models;

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
 * @property string $user_image
 * @property string $user_type
 *
 * @property AuthHotel[] $authHotels
 * @property Prestamos[] $prestamos
 * @property Request[] $requests
 * @property Request[] $requests0
 * @property Transferencias[] $transferencias
 * @property Transferencias[] $transferencias0
 * @property Hoteles $hotelesHotel
 */
class User extends \yii\db\ActiveRecord
{
    public $file;
    public $confirm_password;
    public $password;
    /**
     * {@inheritdoc}
     */
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
            [['file'],'file'],
            [['username', 'first_name', 'last_name', 'colaborator_no', 'hoteles_hotel_id', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at', 'user_type'], 'required'],
            [['colaborator_no', 'hoteles_hotel_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email','confirm_password'], 'string', 'max' => 255],
            [['first_name', 'last_name'], 'string', 'max' => 50],
            [['user_type'], 'string'],
            [['user_image'], 'string', 'max' => 250],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
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
            'username' => Yii::t('app','Username'),
            'first_name' => Yii::t('app','First Name'),
            'last_name' => Yii::t('app','Last Name'),
            'colaborator_no' => Yii::t('app','Collaborator No.'),
            'hoteles_hotel_id' => Yii::t('app','Hotel Name'),
            'auth_key' => 'Auth Key',
            'password_hash' => Yii::t('app','New Password'),
            'password' => Yii::t('app','New Password'),
            'confirm_password' => Yii::t('app','Confirm Password'),
            'password_reset_token' => 'Password Reset Token',
            'email' => Yii::t('app','Email'),
            'status' => Yii::t('app','Status'),
            'created_at' => Yii::t('app','Created Date'),
            'updated_at' => Yii::t('app','Updated Date'),
            'user_image' => Yii::t('app','Image'),
            'file'=>Yii::t('app','Image'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelesHotel()
    {
        return $this->hasOne(Hoteles::className(), ['hotel_id' => 'hoteles_hotel_id']);
    }
    public function getAuthHotels()
    {
        return $this->hasMany(AuthHotel::className(), ['users_user_id' => 'id']);
    }

    public function getPrestamos()
    {
        return $this->hasMany(Prestamos::className(), ['users_user_id' => 'id']);
    }
    public function getRequests()
    {
        return $this->hasMany(Request::className(), ['user_made_id' => 'id']);
    }

    public function getRequests0()
    {
        return $this->hasMany(Request::className(), ['user_acept_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransferencias()
    {
        return $this->hasMany(Transferencias::className(), ['usuarios_usuario_recibe' => 'id']);
    }

    public function getTransferencias0()
    {
        return $this->hasMany(Transferencias::className(), ['usuarios_usuario_id' => 'id']);
    }

}
