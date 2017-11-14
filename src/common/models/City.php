<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * @property integer $id_city
 * @property integer $municipality
 * @property string $name
 * @property string $psc
 * @property string $obec
 * @property string $district
 * @property string $dposta
 * @property string $post
 * @property integer $okres
 * @property string $region
 */
class City extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%CITY}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_CITY','MUNICIPALITY','NAME','PSC', 'OBEC', 'DISTRICT', 'DPOSTA', 'POST', 'OKRES', 'REGION'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['ID_CITY' => $id]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID_CITY'    => 'Id mesto'
        ];
    }

    public static function getAutocomleteData()
    {
        $cities = self::find()->all();
        $data = [];
        foreach ($cities as $city) {
            $data[] = $city->PSC . ' ' . $city->NAME;
        }

        return $data;
    }
}