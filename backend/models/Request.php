<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "request".
 *
 * @property int $request_id
 * @property int $user_made_id
 * @property int $hotel_made_id
 * @property int $user_acept_id
 * @property int $hotel_acept_id
 * @property string $request_details
 * @property string $request_status
 *
 * @property User $userMade
 * @property Hoteles $hotelMade
 * @property User $userAcept
 * @property Hoteles $hotelAcept
 */
class Request extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_made_id', 'hotel_made_id', 'request_details', 'request_status'], 'required'],
            [['user_made_id', 'hotel_made_id', 'user_acept_id', 'hotel_acept_id'], 'integer'],
            [['request_status'], 'string'],
            [['request_details'], 'string', 'max' => 250],
            [['user_made_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_made_id' => 'id']],
            [['hotel_made_id'], 'exist', 'skipOnError' => true, 'targetClass' => Hoteles::className(), 'targetAttribute' => ['hotel_made_id' => 'hotel_id']],
            [['user_acept_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_acept_id' => 'id']],
            [['hotel_acept_id'], 'exist', 'skipOnError' => true, 'targetClass' => Hoteles::className(), 'targetAttribute' => ['hotel_acept_id' => 'hotel_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'request_id' => Yii::t('app', 'ID'),
            'user_made_id' => Yii::t('app', 'Made By'),
            'userMade.username' => Yii::t('app', 'Made By'),
            'hotel_made_id' => Yii::t('app', 'Made In'),
            'hotelMade.hotel_name' => Yii::t('app', 'Made In'),
            'user_acept_id' => Yii::t('app', 'User Accept'),
            'userAcept.username' => Yii::t('app', 'User Accept'),
            'hotelAcept.hotel_name' => Yii::t('app', 'Hotel Accept'),
            'request_details' => Yii::t('app', 'Details'),
            'request_status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserMade()
    {
        return $this->hasOne(User::className(), ['id' => 'user_made_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelMade()
    {
        return $this->hasOne(Hoteles::className(), ['hotel_id' => 'hotel_made_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserAcept()
    {
        return $this->hasOne(User::className(), ['id' => 'user_acept_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelAcept()
    {
        return $this->hasOne(Hoteles::className(), ['hotel_id' => 'hotel_acept_id']);
    }
}
