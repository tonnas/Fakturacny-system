<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Query;


class Role extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ROLE}}';
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
        return static::findOne(['NAME' => $id]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'NAME' => 'Meno'
        ];
    }

    public static function getPermissions($role)
    {
        return Permission::findAll(['ROLE_NAME' => $role]);
    }
}
