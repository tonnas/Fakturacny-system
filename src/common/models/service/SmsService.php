<?php
namespace common\models\service;

use Yii;
use yii\db\ActiveRecord;

/**
 * @property integer $id_service
 * @property integer $inside
 * @property integer $outside
 */
class SmsService extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%SMS_SERVICE}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['INSIDE','OUTSIDE', 'ID_SERVICE'], 'required'],
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
            'INSIDE'  => 'Minuty v sieti',
            'OUTSIDE' => 'Minuty mimo siet',
        ];
    }
}