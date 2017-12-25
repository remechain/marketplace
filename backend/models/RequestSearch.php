<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Request;

/**
 * RequestSearch represents the model behind the search form about `backend\models\Request`.
 */
class RequestSearch extends Request
{
    public $type_delivery_name;
    public $type_scrap_gost_name;
    public $category_scrap_gost_name;
    public $category_scrap_name;
    public $method_payment_name;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_standard_user_account', 'id_type_delivery', 'id_city', 'id_category_scrap', 'id_category_scrap_gost', 'id_type_scrap_gost', 'id_method_payment', 'dismantling', 'category_by_gost', 'created_at', 'updated_at'], 'integer'],
            [['address'], 'safe'],
            [['desired_price', 'mass'], 'number'],

            [['type_scrap_gost_name','category_scrap_gost_name',
                'category_scrap_name','method_payment_name','type_delivery_name'],'safe'],
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
        $query = Request::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        //Добавляем правила сортировки для Вид металлолома по ГОСТ
        $dataProvider->setSort([
            'attributes' => [
                'id',
                'id_standard_user_account',
                'id_type_delivery',
                'type_delivery_name' => [
                    'asc' => ['type_delivery.name' => SORT_ASC],
                    'desc' => ['type_delivery.name' => SORT_DESC],
                ],
                'id_city',
                'address',
                'type_scrap_gost_name' => [
                    'asc' => ['type_scrap_gost.name' => SORT_ASC],
                    'desc' => ['type_scrap_gost.name' => SORT_DESC],
                ],
                'category_scrap_gost_name' => [
                    'asc' => ['category_scrap_gost.name' => SORT_ASC],
                    'desc' => ['category_scrap_gost.name' => SORT_DESC],
                ],
                'category_scrap_name' => [
                    'asc' => ['category_scrap.name' => SORT_ASC],
                    'desc' => ['category_scrap.name' => SORT_DESC],
                ],
                'method_payment_name' => [
                    'asc' => ['method_payment.name' => SORT_ASC],
                    'desc' => ['method_payment.name' => SORT_DESC],
                ],
                'desired_price',
                'dismantling',
                'mass',
                'category_by_gost',
                'created_at',
                'updated_at',


            ]
        ]);


        if (!($this->load($params) && $this->validate())) {
            /**
             * Жадная загрузка данных моделей
             * для работы сортировки.
             */
            $query->joinWith(['idTypeDelivery']);
            $query->joinWith(['idTypeScrapGost']);
            $query->joinWith(['idCategoryScrapGost']);
            $query->joinWith(['idCategoryScrap']);
            $query->joinWith(['idMethodPayment']);
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_standard_user_account' => $this->id_standard_user_account,
            'id_type_delivery' => $this->id_type_delivery,
            'id_city' => $this->id_city,
            'id_category_scrap' => $this->id_category_scrap,
            'id_category_scrap_gost' => $this->id_category_scrap_gost,
            'id_type_scrap_gost' => $this->id_type_scrap_gost,
            'id_method_payment' => $this->id_method_payment,
            'desired_price' => $this->desired_price,
            'dismantling' => $this->dismantling,
            'mass' => $this->mass,
            'category_by_gost' => $this->category_by_gost,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'address', $this->address]);


        $query->joinWith(['idTypeDelivery' => function ($q) {
            $q->andFilterWhere(['like', 'type_delivery.name', $this->type_delivery_name ]);
        }]);
        $query->joinWith(['idTypeScrapGost' => function ($q) {
            $q->andFilterWhere(['like', 'type_scrap_gost.name', $this->type_scrap_gost_name ]);
        }]);
        $query->joinWith(['idCategoryScrapGost' => function ($q) {
            $q ->andFilterWhere(['like', 'category_scrap_gost.name', $this->category_scrap_gost_name ]);
        }]);
        $query->joinWith(['idCategoryScrap' => function ($q) {
            $q->andFilterWhere(['like', 'category_scrap.name', $this->category_scrap_name ]);
        }]);
        $query->joinWith(['idMethodPayment' => function ($q) {
            $q->andFilterWhere(['like', 'method_payment.name', $this->method_payment_name ]);
        }]);

        return $dataProvider;
    }
}
