<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "prestamo_articulos".
 *
 * @property int $id
 * @property int $prestamos_prestamo_id
 * @property int $productos_product_id
 * @property int $producto_cantidad
 *
 * @property Prestamos $prestamosPrestamo
 * @property Productos $productosProduct
 */
class PrestamoArticulos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'prestamo_articulos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'productos_product_id', 'producto_cantidad'], 'required'],
            [['prestamos_prestamo_id', 'productos_product_id', 'producto_cantidad'], 'integer'],
            [['prestamos_prestamo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Prestamos::className(), 'targetAttribute' => ['prestamos_prestamo_id' => 'prestamo_id']],
            [['productos_product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Productos::className(), 'targetAttribute' => ['productos_product_id' => 'product_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'prestamos_prestamo_id' => Yii::t('app','Loans ID'),
            'productos_product_id' => Yii::t('app','Product'),
            'producto_cantidad' => Yii::t('app','Quantity'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrestamosPrestamo()
    {
        return $this->hasOne(Prestamos::className(), ['prestamo_id' => 'prestamos_prestamo_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductosProduct()
    {
        return $this->hasOne(Productos::className(), ['product_id' => 'productos_product_id']);
    }
}
