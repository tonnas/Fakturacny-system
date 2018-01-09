<?php
namespace common\models\service;

use Yii;
use yii\db\ActiveRecord;

/**
 * @property integer $id_service
 * @property integer $minutes_in
 * @property integer $minutes_out
 */
class MinuteService extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%MINUTE_SERVICE}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['MINUTES_IN','MINUTES_OUT', 'ID_SERVICE'], 'required'],
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
            'MINUTES_IN'  => 'Minuty v sieti',
            'MINUTES_OUT' => 'Minuty mimo siet',
        ];
    }
}