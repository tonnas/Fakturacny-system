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

    public static function getOperatorNumbers($operator)
    {
        $numbers = self::find()->where(['IDENTIFICATION_NUMBER' => NULL])->all();
        $data = [];
        foreach ($numbers as $number) {
            $data[$number->PHONE_NUMBER] = $number->PHONE_NUMBER;
        }

        return $data;
    }

    public static function getOperatorNumbersCount($idOperator)
    {
        return static::find()
            ->select(['COUNT(*) AS cnt'])
//            ->where(['ID_OPERATOR' => $idOperator])
            ->count();
    }
}