<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * @property integer $id_office
 * @property integer $id_address
 */
class Office extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%OFFICE}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_ADDRESS'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['ID_OFFICE' => $id]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID_OFFICE' => 'Pobočka'
        ];
    }

    public static function getOperatorOfficies($idOperator)
    {
        $officies = self::find()->all();
        $data = [];
        foreach ($officies as $office) {
            $address = Address::findIdentity($office->ID_ADDRESS);
            $city    = City::findIdentity($address->ID_CITY);
            $data[$office->ID_OFFICE] = $city->PSC . $city->NAME . ', ' . $address->STREET . ' ' . $address->STREET_NUMBER;
        }

        return $data;
    }

    public static function getOperatorOfficeCount($idOperator)
    {
        return static::find()
            ->select(['COUNT(*) AS cnt'])
//            ->where(['ID_OPERATOR' => $idOperator])
            ->count();
    }

    public static function getCity($idAddress)
    {
        $address = Address::findIdentity($idAddress);
        $city    = City::findIdentity($address->ID_CITY);

        if (isset($city->PSC)) {
            return $city->PSC . ' ' . $city->NAME;
        }

        return NULL;
    }

    public static function getStreet($idAddress)
    {
        $address = Address::findIdentity($idAddress);

        if (isset($address->STREET)) {
            return $address->STREET . ' ' . $address->STREET_NUMBER;
        }

        return NULL;
    }
}