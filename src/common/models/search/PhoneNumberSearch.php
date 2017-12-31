<?php
namespace common\models\search;

use common\models\PhoneNumber;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * CurrencySearch represents the model behind the search form about `app\models\Currency`.
 */
class PhoneNumberSearch extends PhoneNumber
{
    /**
     *
     */
    public function rules()
    {
        return [
            [['PHONE_NUMBER'],'integer'],
            [[ 'PHONE_NUMBER','IDENTIFICATION_NUMBER'], 'safe'],
        ];
    }
    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return Model::scenarios();
    }
    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = PhoneNumber::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
//            'sort' => [
//                'defaultOrder' => [
//                    'CREATED_AT' => SORT_DESC
//                ]
//            ],
        ]);

        $this->load($params);
        if (!$this->validate())
        {
            return $dataProvider;
        }
        $query->andFilterWhere(['like','PHONE_NUMBER', $this->PHONE_NUMBER])
            ->andFilterWhere(['like', 'IDENTIFICATION_NUMBER' , $this->IDENTIFICATION_NUMBER]);

        return $dataProvider;
    }
}