<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;


class Permission extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%PERMISSION}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_PERMISSION', 'ROLE_NAME', 'NAME'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['ID_PERMISSION' => $id]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'NAME' => 'Meno prava',
        ];
    }
}
