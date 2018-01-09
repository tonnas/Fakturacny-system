<?php
namespace common\models\search;

use common\models\Office;
use common\models\service\Service;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * CurrencySearch represents the model behind the search form about `app\models\Currency`.
 */
class ServiceSearch extends Service
{
    /**
     *
     */
    public function rules()
    {
        return [
            [['ID_SERVICE', 'NAME', 'DATE_FROM'],'safe'],
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
        $query = Service::find();
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
        $query->andFilterWhere(['like','ID_SERVICE', $this->ID_SERVICE])
            ->andFilterWhere(['like','NAME', $this->NAME])
            ->andFilterWhere(['like','DATE_FROM', $this->DATE_FROM]);

        return $dataProvider;
    }
}