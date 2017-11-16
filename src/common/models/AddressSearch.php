<?php
namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * CurrencySearch represents the model behind the search form about `app\models\Currency`.
 */
class AddressSearch extends Address
{
    public $username;
    public $email;

    /**
     *
     */
    public function rules()
    {
        return [
            [['ID_ADDRESS'],'integer'],
            [[ 'ID_ADDRESS','ID_CITY','STREET','STREET_NUMBER'], 'safe'],
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
        $query = Address::find();
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
        $query->andFilterWhere(['like','ID_ADDRESS'   , $this->ID_ADDRESS])
            ->andFilterWhere(['like', 'ID_CITY'       , $this->ID_CITY])
            ->andFilterWhere(['like', 'STREET'        , $this->STREET])
            ->andFilterWhere(['like', 'STREET_NUMBER' , $this->STREET_NUMBER]);

        return $dataProvider;
    }
}