<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "prestamos".
 *
 * @property int $prestamo_id
 * @property int $hoteles_hotel_id
 * @property int $users_user_id
 * @property string $prestamo_fecha
 * @property int $prestamo_numero_empleado
 * @property string $prestamo_nombre_empleado
 * @property string $prestamo_fecha_entrega
 * @property string $prestamo_status
 * @property string $prestamo_comentario
 *
 * @property PrestamoArticulos[] $prestamoArticulos
 * @property Hoteles $hotelesHotel
 * @property User $usersUser
 */
class Prestamos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'prestamos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hoteles_hotel_id', 'users_user_id', 'prestamo_fecha', 'prestamo_numero_empleado', 'prestamo_nombre_empleado', 'prestamo_status'], 'required'],
            [['hoteles_hotel_id', 'users_user_id', 'prestamo_numero_empleado'], 'integer'],
            [['prestamo_fecha', 'prestamo_fecha_entrega'], 'safe'],
            [['prestamo_status'], 'string'],
            [['prestamo_nombre_empleado'], 'string', 'max' => 50],
            [['prestamo_comentario'], 'string', 'max' => 250],
            [['hoteles_hotel_id'], 'exist', 'skipOnError' => true, 'targetClass' => Hoteles::className(), 'targetAttribute' => ['hoteles_hotel_id' => 'hotel_id']],
            [['users_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['users_user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'prestamo_id' => 'ID',
            'hoteles_hotel_id' => 'Hotel',
            'users_user_id' => Yii::t('app','Made By'),
            'usersUser.username' => Yii::t('app','Made By'),
            'prestamo_fecha' => Yii::t('app','Creation Date'),
            'prestamo_numero_empleado' => Yii::t('app','Collaborator No.'),
            'prestamo_nombre_empleado' => Yii::t('app','Collaborator Name'),
            'prestamo_fecha_entrega' => Yii::t('app','Delivery Date'),
            'prestamo_status' => Yii::t('app','Status'),
            'prestamo_comentario' => Yii::t('app','Comment'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrestamoArticulos()
    {
        return $this->hasMany(PrestamoArticulos::className(), ['prestamos_prestamo_id' => 'prestamo_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelesHotel()
    {
        return $this->hasOne(Hoteles::className(), ['hotel_id' => 'hoteles_hotel_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersUser()
    {
        return $this->hasOne(User::className(), ['id' => 'users_user_id']);
    }
}
