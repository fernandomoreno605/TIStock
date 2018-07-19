<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "comments".
 *
 * @property int $id_comment
 * @property int $hoteles_hotel_id
 * @property string $coment_subjet
 * @property string $comment_text
 * @property int $comment_status
 * @property string $timestamp
 * @property string $url
 */
class Comments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hoteles_hotel_id','coment_subjet', 'comment_text', 'comment_status', 'timestamp'], 'required'],
            [['hoteles_hotel_id','comment_status'], 'integer'],
            [['timestamp'], 'safe'],
            [['coment_subjet', 'comment_text','url'], 'string', 'max' => 250],
            [['hoteles_hotel_id'], 'exist', 'skipOnError' => true, 'targetClass' => Hoteles::className(), 'targetAttribute' => ['hoteles_hotel_id' => 'hotel_id']],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_comment' => Yii::t('app', 'Id Comment'),
            'coment_subjet' => Yii::t('app', 'Coment Subjet'),
            'hoteles_hotel_id' => Yii::t('app', 'Hoteles Hotel ID'),
            'comment_text' => Yii::t('app', 'Comment Text'),
            'comment_status' => Yii::t('app', 'Comment Status'),
            'timestamp' => Yii::t('app', 'Timestamp'),
            'url' => Yii::t('app', 'Url'),
        ];
    }
}
