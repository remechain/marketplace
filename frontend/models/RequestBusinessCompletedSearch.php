<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use yii\db\Query;

/**
 * RequestSearch represents the model behind the search form about `common\models\Request`.
 */
class RequestBusinessCompletedSearch extends Request
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
        $subQuery = (new Query())->select('id_request')->
        from('target_devotion')->
        where(['id_business_account' => Company::getCurrentIdBusinessUserAccount()])->
        andWhere(['status' => Yii::$app->params['TargetDevotionStatus']['3']])->
        orWhere(['status' => Yii::$app->params['TargetDevotionStatus']['4']]);

        $query = new ActiveQuery(new Request);
        $query = $query->select('*')->from('request')->where(['IN','id' ,$subQuery]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        //die($query->createCommand()->getRawSql());
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
