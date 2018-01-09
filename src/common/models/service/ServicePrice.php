<?php
namespace common\models\service;

use Yii;
use yii\db\ActiveRecord;

/**
 * @property integer $id_service
 * @property integer $amount
 * @property date $date_from
 * @property date $date_to
 */
class ServicePrice extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%SERVICE_PRICE}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['AMOUNT', 'ID_SERVICE'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['DATE_FROM' => $id]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'AMOUNT'    => 'Ciastka',
            'DATE_FROM' => 'Vytvorene',
        ];
    }
}