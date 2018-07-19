<?php

namespace frontend\models;

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
 * @property TransferenciaItems[] $transferenciaItems
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
            'usuarios_usuario_id' => Yii::t('app','Made By'),
            'usuariosUsuario.username' => Yii::t('app','Made By'),
            'hoteles_hotel_id' => Yii::t('app','Origin'),
            'hotelesHotel.hotel_name'=> Yii::t('app','Origin'),
            'transferencia_destino_id' => Yii::t('app','Destination'),
            'transferenciaDestino.hotel_name' => Yii::t('app','Destination'),
            'usuarios_usuario_recibe' => Yii::t('app','Received By'),
            'usuariosUsuarioRecibe.username' => Yii::t('app','Received By'),
            'transferencia_status' => Yii::t('app','Status'),
            'transferencia_comentario_origen' => Yii::t('app','Comment Origin'),
            'transferencia_comentario_destino' => Yii::t('app','Comment Destination'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransferenciaItems()
    {
        return $this->hasMany(TransferenciaItems::className(), ['transferencias_transferencia_id' => 'transferencia_id']);
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

    public function getUsuario(){
        //return $this->hasOne(User::className(),['id' => ]);
    }
}
