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
            [['ID_OFFICE', 'id_address'], 'required'],
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
}