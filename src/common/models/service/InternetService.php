<?php
namespace common\models\service;

use Yii;
use yii\db\ActiveRecord;

/**
 * @property integer $id_service
 * @property integer $data_MB
 */
class InternetService extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%INTERNET_SERVICE}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['DATA_MB', 'ID_SERVICE'], 'required'],
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
            'DATA_MB' => 'Data',
        ];
    }
}