<?php
namespace common\models\service;

use Yii;
use yii\db\ActiveRecord;

/**
 * @property integer $id_service
 * @property integer $inside
 * @property integer $outside
 */
class Package extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%PACKAGE}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_SERVICE', 'MINUTES_IN', 'MINUTES_OUT', 'SMS_IN', 'SMS_OUT', 'MMS_IN', 'MMS_OUT', 'INTERNET'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['ID_SERVICE' => $id]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
        ];
    }
}