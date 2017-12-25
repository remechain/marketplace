<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * RequestSearch represents the model behind the search form about `common\models\Request`.
 */
class RequestFinishedSearch extends Request
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_standard_user_account', 'id_type_delivery', 'id_city', 'created_at', 'updated_at'], 'integer'],
            [['address'], 'safe'],
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
         // add conditions that should always apply here

        $query = Request::find()
            ->select('request.*')->where(['id_standard_user_account' => Request::getIdCurentStandardUserAccount()])
            ->andWhere(['status' => 1])
            ->leftJoin('type_delivery', '`request`.`id_type_delivery` = `type_delivery`.`id`')
            ->leftJoin('category_scrap_gost', '`request`.`id_category_scrap_gost` = `category_scrap_gost`.`id`')
            ->leftJoin('category_scrap', '`request`.`id_category_scrap` = `category_scrap`.`id`')
            ->with('idTypeDelivery')
            ->with('idCategoryScrapGost')
            ->with('idCategoryScrap');


        /*$command = $query->createCommand();
        $data = $command->queryAll();
        */
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        //die(var_dump($query));

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_standard_user_account' => $this->id_standard_user_account,
            'id_type_delivery' => $this->id_type_delivery,
            'id_city' => $this->id_city,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'address', $this->address]);

        return $dataProvider;
    }
}
