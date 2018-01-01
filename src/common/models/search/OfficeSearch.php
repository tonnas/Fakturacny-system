<?php
namespace common\models\search;

use common\models\Office;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * CurrencySearch represents the model behind the search form about `app\models\Currency`.
 */
class OfficeSearch extends Office
{
    /**
     *
     */
    public function rules()
    {
        return [
            [['ID_ADDRESS'],'safe'],
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
        $query = Office::find();
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
        $query->andFilterWhere(['like','ID_ADDRESS', $this->ID_ADDRESS]);

        return $dataProvider;
    }
}