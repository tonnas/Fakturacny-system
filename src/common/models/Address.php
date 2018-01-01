<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * @property integer $id_address
 * @property integer $id_city
 * @property string $street
 * @property string $street_number
 */
class Address extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ADDRESS}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_CITY','STREET','STREET_NUMBER'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['ID_ADDRESS' => $id]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID_ADDRESS'    => 'Adresa Id',
            'ID_CITY'       => 'Mesto',
            'STREET'        => 'Ulica',
            'STREET_NUMBER' => 'Číslo',
        ];
    }
}