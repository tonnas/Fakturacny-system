<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * @property integer $employee_number
 * @property integer $id_office
 * @property integer $identification_number
 * @property integer $valid_from
 * @property integer $valid_to
 */
class Employee extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%EMPLOYEE}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['EMPLOYEE_NUMBER', 'ID_OFFICE', 'IDENTIFICATION_NUMBER', 'VALID_FROM', 'VALID_TO'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['EMPLOYEE_NUMBER' => $id]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'EMPLOYEE_NUMBER' => 'Cislo zamestnanca'
        ];
    }
}