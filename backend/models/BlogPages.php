<?php

namespace backend\models;

use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "blog_pages".
 *
 * @property integer $id
 * @property string $preview_img
 * @property string $title
 * @property string $content
 * @property integer $id_category_blog
 * @property integer $active
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property CategoryBlog $idCategoryBlog
 */
class BlogPages extends \yii\db\ActiveRecord
{
    const SCENARIO_UPDATE = 'update';
    const SCENARIO_CREATE = 'create';

    public $file;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog_pages';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content', 'id_category_blog', 'lid_text'], 'required'],
            [['content'], 'string'],
            [['id_category_blog', 'active', 'created_at', 'updated_at'], 'integer'],
            [['preview_img', 'title','lid_text'], 'string', 'max' => 255],
            [['id_category_blog'], 'exist', 'skipOnError' => true, 'targetClass' => CategoryBlog::className(), 'targetAttribute' => ['id_category_blog' => 'id']],

            [['file'], 'file', 'extensions'=>'jpg, gif, png','skipOnEmpty' => false,'on' => self::SCENARIO_CREATE],
            [['file'], 'file', 'extensions'=>'jpg, gif, png','on' => self::SCENARIO_UPDATE],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'preview_img' => 'Изображение на превью',
            'file' => 'Изображение на превью',
            'title' => 'Заголовок статьи',
            'content' => 'Контент',
            'id_category_blog' => 'Категория',
            'active' => 'Показать| скрыть',
            'created_at' => 'Созданно',
            'updated_at' => 'Обновнено',
            'lid_text' => 'Лид текст',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCategoryBlog()
    {
        return $this->hasOne(CategoryBlog::className(), ['id' => 'id_category_blog']);
    }

    /**
     * @param bool $insert
     * @param array $changedAttributes
     */
    public function afterSave($insert, $changedAttributes){
        $this->reCountEnumeratorBlog();
        parent::afterSave($insert, $changedAttributes);
    }

    public static function reCountEnumeratorBlog(){
        //todo можно оптимезировать(много запросов к бд)
        $enumeratorBlogs = EnumeratorBlog::find()->orderBy('id_category_blog')->all();
        $allBlogPages = BlogPages::find()->all();
        foreach ($enumeratorBlogs as $enumeratorBlog){
            $enumeratorBlog->count = 0;
            $enumeratorBlog->save();
        }
        foreach ($allBlogPages as $blogPage){

            if($blogPage->active === 1){
                foreach ($enumeratorBlogs as $enumeratorBlog){
                    if($enumeratorBlog->id_category_blog == $blogPage->id_category_blog) {
                        $enumeratorBlog->count = $enumeratorBlog->count + 1;
                        $enumeratorBlog->save();
                    }
                }
            }

        }
    }
    /**
     * @return array
     */
    public static function getMapCategoryBlog()
    {
        $field = CategoryBlog::find()->all();
        $result = ArrayHelper::map($field,'id','name');
        return $result;
    }

    /* Геттер для названия категории */
    public function getCategoryBlogName() {
        return $this->idCategoryBlog->name;
    }
}
