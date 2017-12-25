<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\TargetDevotion;

/**
 * TargetDevotionSearch represents the model behind the search form about `frontend\models\TargetDevotion`.
 */
class TargetDevotionSearch extends TargetDevotion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_request', 'id_object', 'id_business_account', 'status', 'expiration_date', 'id_method_payment', 'clogging'], 'integer'],
            [['prise'], 'number'],
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
        $query = TargetDevotion::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_request' => $this->id_request,
            'id_object' => $this->id_object,
            'id_business_account' => $this->id_business_account,
            'status' => $this->status,
            'prise' => $this->prise,
            'expiration_date' => $this->expiration_date,
            'id_method_payment' => $this->id_method_payment,
            'clogging' => $this->clogging,
        ]);

        return $dataProvider;
    }
}
