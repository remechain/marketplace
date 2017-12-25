<?php

namespace frontend\models;

use backend\models\EnumeratorBlog;
use Yii;

/**
 * This is the model class for table "category_blog".
 *
 * @property integer $id
 * @property string $name
 * @property integer $active
 *
 * @property BlogPages[] $blogPages
 */
class CategoryBlog extends \yii\db\ActiveRecord
{
    /**`
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category_blog';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['active'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование',
            'active' => 'Показать|скрыть',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogPages()
    {
        return $this->hasMany(BlogPages::className(), ['id_category_blog' => 'id']);
    }

    public function getCount(){
        return EnumeratorBlog::find()->where(['id_category_blog' => $this->id])->one()->count;
    }
}
