<?php
namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
/**
 * CurrencySearch represents the model behind the search form about `app\models\Currency`.
 */
class PersonSearch extends Person
{
    /**
     *
     */
    public function rules()
    {
        return [
            [['IDENTIFICATION_NUMBER'],'integer'],
            [[ 'FIRST_NAME', 'LAST_NAME', 'STREET', 'POST_CODE', 'CITY'], 'safe'],
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
        $query = Person::find();
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
        $query->andFilterWhere(['like','IDENTIFICATION_NUMBER', $this->IDENTIFICATION_NUMBER])
            ->andFilterWhere(['like', 'FIRST_NAME', $this->FIRST_NAME])
            ->andFilterWhere(['like', 'LAST_NAME', $this->LAST_NAME])
            ->andFilterWhere(['like', 'CITY', $this->CITY])
            ->andFilterWhere(['like', 'POST_CODE', $this->POST_CODE])
            ->andFilterWhere(['like', 'STREET', $this->STREET]);

        return $dataProvider;
    }
}