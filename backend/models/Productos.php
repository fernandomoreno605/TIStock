<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "productos".
 *
 * @property int $product_id
 * @property int $hoteles_hotel_id
 * @property string $product_name
 * @property string $product_branch
 * @property string $product_provider
 * @property string $product_created_date
 * @property int $product_stock
 * @property string $product_status
 * @property string $product_image
 * @property string $product_serial
 *
 * @property Hoteles $hotelesHotel
 * @property Rentas[] $rentas
 */
class Productos extends \yii\db\ActiveRecord
{
    public $file;

    public static function tableName()
    {
        return 'productos';
    }

    public function rules()
    {
        return [
            [['file'],'file'],
            [['hoteles_hotel_id', 'product_name', 'product_branch', 'product_provider', 'product_created_date', 'product_stock', 'product_status'], 'required'],
            [['hoteles_hotel_id', 'product_stock'], 'integer'],
            [['product_created_date'], 'safe'],
            [['product_status'], 'string'],
            [['product_image', 'product_serial'], 'string', 'max' => 250],
            [['product_name', 'product_branch', 'product_provider'], 'string', 'max' => 50],
            [['hoteles_hotel_id'], 'exist', 'skipOnError' => true, 'targetClass' => Hoteles::className(), 'targetAttribute' => ['hoteles_hotel_id' => 'hotel_id']],

            ['product_stock', 'match', 'pattern' => '/^[0-9]*$/'],
            ['product_stock', 'integer', 'min' => 0, 'max' => 1000000],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'product_id' => 'ID',
            'hotelesHotel.hotel_name' => 'Hotel of belonging' ,
            'hoteles_hotel_id' => 'Hotel of belonging',
            'product_name' => 'Name',
            'product_branch' => 'Brand',
            'product_provider' => 'Provider',
            'product_created_date' => 'Created at',
            'product_stock' => 'Stock',
            'product_status' => 'Status',
            'product_image' => Yii::t('app','Image'),
            'product_serial' => Yii::t('app','Serial'),
            'file'=>Yii::t('app','Image'),
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
    public function getRentas()
    {
        return $this->hasMany(Rentas::className(), ['productos_product_id' => 'product_id']);
    }
}
