<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\BlogPages;

/**
 * BlogPagesSearch represents the model behind the search form about `backend\models\BlogPages`.
 */
class BlogPagesSearch extends BlogPages
{
    public $category_blog_name;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_category_blog', 'active', 'created_at', 'updated_at'], 'integer'],
            [['preview_img', 'title', 'content'], 'safe'],
            [['name'], 'safe'],
            [['category_blog_name'],'safe'],
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
        $query = BlogPages::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        //Добавляем правила сортировки
        $dataProvider->setSort([
            'attributes' => [
                'id',
                'name',
                'title',
                'category_blog_name' => [
                    'asc' => ['category_blog.name' => SORT_ASC],
                    'desc' => ['category_blog.name' => SORT_DESC],
                    'label' => 'Country Name'
                ]
            ]
        ]);

        if (!($this->load($params) && $this->validate())) {
            /**
             * Жадная загрузка данных модели
             * для работы сортировки.
             */
            $query->joinWith(['idCategoryBlog']);
            return $dataProvider;
        }


        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_category_blog' => $this->id_category_blog,
            'active' => $this->active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'preview_img', $this->preview_img])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content]);


        $query->joinWith(['idCategoryBlog' => function ($q) {
            $q->andFilterWhere(['like', 'category_blog.name', $this->category_blog_name]);
        }]);
        return $dataProvider;
    }
}
