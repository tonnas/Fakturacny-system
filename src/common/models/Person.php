<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 *
 *
 * @property integer $identification_number
 * @property integer $id_user
 * @property string $first_name
 * @property string $last_name
 * @property string $street
 * @property string $post_code
 * @property string $city
 */
class Person extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%PERSON}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IDENTIFICATION_NUMBER', 'ID_USER', 'FIRST_NAME', 'LAST_NAME'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['IDENTIFICATION_NUMBER' => $id]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'IDENTIFICATION_NUMBER' => 'Identifikacne cislo',
            'ID_USER' => 'User id',
            'FIRST_NAME' => 'Meno',
            'LAST_NAME' => 'Priezvisko',
        ];
    }

    public static function getAllPersons()
    {

    }
}