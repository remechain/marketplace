<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "enumerator_blog".
 *
 * @property integer $id_category_blog
 * @property integer $count
 */
class EnumeratorBlog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'enumerator_blog';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['count'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_category_blog' => 'Id Category Blog',
            'count' => 'Count',
        ];
    }
}
