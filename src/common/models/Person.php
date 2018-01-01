<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 *
 *
 * @property integer $identification_number
 * @property string $username
 * @property string $first_name
 * @property string $last_name
 * @property string $id_address
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
            [['IDENTIFICATION_NUMBER','FIRST_NAME', 'LAST_NAME'], 'required'],
            [['IDENTIFICATION_NUMBER'], 'string','length' => 10,'message' => 'Musis obsahovat 10 cislic, bez lomitka',
            ]
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
            'IDENTIFICATION_NUMBER' => 'Rodné čislo',
            'USERNAME'              => 'Používateľské meno',
            'FIRST_NAME'            => 'Meno',
            'LAST_NAME'             => 'Priezvisko',
        ];
    }

    public function getUsername()
    {
        return $this->hasOne(User::classname(), ['USERNAME' => 'USERNAME']);
    }

    public function getEmail()
    {
        return $this->hasOne(User::classname(), ['USERNAME' => 'USERNAME']);
    }

    public static function findOperatorEmployies($idOperator)
    {
        $models = User::findOperatorEmployees($idOperator);

        $usernames = [];
        foreach ($models as $model) {
            $usernames[] = $model->USERNAME;
        }

        return static::findAll(['USERNAME' => $usernames]);
    }
}