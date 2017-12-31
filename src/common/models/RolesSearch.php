<?php
namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * CurrencySearch represents the model behind the search form about `app\models\Currency`.
 */
class RolesSearch extends Role
{
    public $username;
    public $email;

    /**
     *
     */
    public function rules()
    {
        return [
            [[ 'NAME'], 'safe'],
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
        $query = Role::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
//            'sort' => [
//                'defaultOrder' => [
//                    'CREATED_AT' => SORT_DESC
//                ]
//            ],
        ]);
//        $dataProvider->sort->attributes['username'] = [
//            // The tables are the ones our relation are configured to
//            // in my case they are prefixed with "tbl_"
//            'asc' => ['USERNAME' => SORT_ASC],
//            'desc' => ['USERNAME' => SORT_DESC],
//        ];
//        $dataProvider->sort->attributes['email'] = [
//            // The tables are the ones our relation are configured to
//            // in my case they are prefixed with "tbl_"
//            'asc' => ['EMAIL' => SORT_ASC],
//            'desc' => ['EMAIL' => SORT_DESC],
//        ];
//        $this->load($params);
//        if (!$this->validate())
//        {
//            return $dataProvider;
//        }
//
//        $query->andFilterWhere(['like','IDENTIFICATION_NUMBER', $this->IDENTIFICATION_NUMBER])
//            ->andFilterWhere(['like', 'FIRST_NAME'            , $this->FIRST_NAME])
//            ->andFilterWhere(['like', 'LAST_NAME'             , $this->LAST_NAME])
//            ->andFilterWhere(['like', 'ID_ADDRESS'            , $this->ID_ADDRESS])
//            ->andFilterWhere(['like', 'EMAIL'                 , $this->email])
//            ->andFilterWhere(['like', 'USERNAME'              , $this->username]);

        return $dataProvider;
    }
}