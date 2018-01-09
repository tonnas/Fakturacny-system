<?php
namespace common\models\service;

use Yii;
use yii\db\ActiveRecord;

/**
 * @property integer $id_service
 * @property string $name
 * @property datetime $date_from
 * @property datetime $date_to
 */
class Service extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%SERVICE}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NAME'], 'required'],
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
            'NAME' => 'Nazov sluzby',
            'ID_SERVICE' => 'Identifikacne cislo',
            'DATE_FROM' => 'Vytvorena',
        ];
    }
}