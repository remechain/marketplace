<?php
/* @var $modelCompany frontend\models\Company */

namespace frontend\models;


use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ObjectSearch represents the model behind the search form about `frontend\models\Object`.
 */
class ObjectSearch extends Object
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_company', 'phone', 'id_city', 'created_at', 'updated_at', 'id_status', 'id_type_object'], 'integer'],
            [['name', 'email', 'site'], 'safe'],
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
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $company = Company::find()->where(['id' => $params['id']])->andWhere(['id_business_user_account' => Company::getCurrentIdBusinessUserAccount()])->one() ;

        $query = Object::find()->where(['id_company' => $company->id]);

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
            'id_company' => $this->id_company,
            'phone' => $this->phone,
            'id_city' => $this->id_city,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'id_status' => $this->id_status,
            'id_type_object' => $this->id_type_object,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'site', $this->site]);

        return $dataProvider;
    }
}
