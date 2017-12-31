<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * @property string $phone_number
 * @property integer $identification_number
 */
class PhoneNumber extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%PHONE_NUMBER}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IDENTIFICATION_NUMBER','PHONE_NUMBER'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['PHONE_NUMBER' => $id]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PHONE_NUMBER' => 'Telefónne číslo',
        ];
    }
}