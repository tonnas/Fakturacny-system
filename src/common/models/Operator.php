<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * @property integer $id_operator
 * @property string  $name
 * @property number  $valid_from
 * @property number  $valid_to
 */
class Operator extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%OPERATOR}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_OPERATOR','NAME', 'VALID_FROM'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['ID_OPERATOR' => $id]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'NAME'    => 'Meno'
        ];
    }

}