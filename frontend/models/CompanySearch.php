<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * CompanySearch represents the model behind the search form about `backend\models\Company`.
 */
class CompanySearch extends Company
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'inn', 'id_type_company', 'id_type_license', 'id_status', 'count_factory', 'count_platform', 'created_at', 'updated_at', 'id_business_user_account'], 'integer'],
            [['name'], 'safe'],
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
        $query = Company::find()->where(['id_business_user_account' => Company::getCurrentIdBusinessUserAccount()]);

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
            'inn' => $this->inn,
            'id_type_company' => $this->id_type_company,
            'id_type_license' => $this->id_type_license,
            'id_status' => $this->id_status,
            'count_factory' => $this->count_factory,
            'count_platform' => $this->count_platform,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'id_business_user_account' => $this->id_business_user_account,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
