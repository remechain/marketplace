<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CategoryScrap;

/**
 * SearchCategoryScrap represents the model behind the search form about `common\models\CategoryScrap`.
 */
class SearchCategoryScrap extends CategoryScrap
{
    public $type_scrap_gost_name;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_type_scrap_gost'], 'integer'],
            [['name'], 'safe'],

            [['type_scrap_gost_name'],'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
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
        $query = CategoryScrap::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        //Добавляем правила сортировки
        $dataProvider->setSort([
            'attributes' => [
                'id',
                'name',
                'type_scrap_gost_name' => [
                    'asc' => ['type_scrap_gost.name' => SORT_ASC],
                    'desc' => ['type_scrap_gost.name' => SORT_DESC],
                    'label' => 'Country Name'
                ]
            ]
        ]);

        if (!($this->load($params) && $this->validate())) {
            /**
             * Жадная загрузка данных модели Вид мет-ма
             * для работы сортировки.
             */
            $query->joinWith(['idTypeScrapGost']);
            return $dataProvider;
        }
        /*$this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }*/

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_type_scrap_gost' => $this->id_type_scrap_gost,
        ]);

        $query->andFilterWhere(['like', 'category_scrap.name', $this->name]);

        $query->joinWith(['idTypeScrapGost' => function ($q) {
            $q->andFilterWhere(['like', 'type_scrap_gost.name', $this->type_scrap_gost_name ]);
        }]);

        return $dataProvider;
    }
}
