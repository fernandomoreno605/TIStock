<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "transferencias".
 *
 * @property int $transferencia_id
 * @property int $usuarios_usuario_id
 * @property int $hoteles_hotel_id
 * @property int $transferencia_destino_id
 * @property int $usuarios_usuario_recibe
 * @property string $transferencia_status
 * @property string $transferencia_comentario_origen
 * @property string $transferencia_comentario_destino
 *
 * @property Hoteles $hotelesHotel
 * @property Hoteles $transferenciaDestino
 * @property User $usuariosUsuarioRecibe
 * @property User $usuariosUsuario
 */
class Transferencias extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transferencias';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usuarios_usuario_id', 'hoteles_hotel_id', 'transferencia_destino_id', 'transferencia_status'], 'required'],
            [['usuarios_usuario_id', 'hoteles_hotel_id', 'transferencia_destino_id', 'usuarios_usuario_recibe'], 'integer'],
            [['transferencia_status', 'transferencia_comentario_origen', 'transferencia_comentario_destino'], 'string'],
            [['hoteles_hotel_id'], 'exist', 'skipOnError' => true, 'targetClass' => Hoteles::className(), 'targetAttribute' => ['hoteles_hotel_id' => 'hotel_id']],
            [['transferencia_destino_id'], 'exist', 'skipOnError' => true, 'targetClass' => Hoteles::className(), 'targetAttribute' => ['transferencia_destino_id' => 'hotel_id']],
            [['usuarios_usuario_recibe'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['usuarios_usuario_recibe' => 'id']],
            [['usuarios_usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['usuarios_usuario_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'transferencia_id' => 'ID',
            'usuarios_usuario_id' => 'Made by',
            'usuariosUsuario.username' => 'Made by',
            'hoteles_hotel_id' => 'Origin',
            'hotelesHotel.hotel_name' => 'Origin',
            'transferencia_destino_id' => 'Destiny',
            'transferenciaDestino.hotel_name' => 'Destination',
            'usuarios_usuario_recibe' => 'User receives',
            'usuariosUsuarioRecibe.username' => 'Received By',
            'usuariosUsuarioRecibe.first_name' => 'User receives',
            'transferencia_status' => 'status',
            'transferencia_comentario_origen' => 'Comment Origin',
            'transferencia_comentario_destino' => 'Comment Destination',
        ];
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
    public function getTransferenciaDestino()
    {
        return $this->hasOne(Hoteles::className(), ['hotel_id' => 'transferencia_destino_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuariosUsuarioRecibe()
    {
        return $this->hasOne(User::className(), ['id' => 'usuarios_usuario_recibe']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuariosUsuario()
    {
        return $this->hasOne(User::className(), ['id' => 'usuarios_usuario_id']);
    }
}
