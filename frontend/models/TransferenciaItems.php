<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "transferencia_items".
 *
 * @property int $id
 * @property int $transferencias_transferencia_id
 * @property int $productos_producto_id
 * @property int $cantidad
 * @property int $item_status
 * @property Transferencias $transferenciasTransferencia
 * @property Productos $productosProducto
 */
class TransferenciaItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transferencia_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['productos_producto_id', 'cantidad'], 'required'],
            [['transferencias_transferencia_id', 'productos_producto_id', 'cantidad','item_status'], 'integer'],
            [['transferencias_transferencia_id'], 'exist', 'skipOnError' => true, 'targetClass' => Transferencias::className(), 'targetAttribute' => ['transferencias_transferencia_id' => 'transferencia_id']],
            [['productos_producto_id'], 'exist', 'skipOnError' => true, 'targetClass' => Productos::className(), 'targetAttribute' => ['productos_producto_id' => 'product_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'transferencias_transferencia_id' => Yii::t('app','Transfer ID'),
            'productos_producto_id' => Yii::t('app','Product'),
            'cantidad' => Yii::t('app','Quantity'),
            'item_status' => Yii::t('app','Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransferenciasTransferencia()
    {
        return $this->hasOne(Transferencias::className(), ['transferencia_id' => 'transferencias_transferencia_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductosProducto()
    {
        return $this->hasOne(Productos::className(), ['product_id' => 'productos_producto_id']);
    }
}
