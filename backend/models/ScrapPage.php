<?php

namespace backend\models;

use common\models\CategoryScrapGost;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "scrap_page".
 *
 * @property integer $id
 * @property string $preview_img
 * @property string $title
 * @property string $content
 * @property integer $id_category_scrap_gost
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property CategoryScrapGost $idCategoryScrapGost
 */
class ScrapPage extends \yii\db\ActiveRecord
{
    const SCENARIO_UPDATE = 'update';
    const SCENARIO_CREATE = 'create';

    public $file;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scrap_page';
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
            [['title', 'content', 'id_category_scrap_gost'], 'required'],
            [['content'], 'string'],
            [['id_category_scrap_gost', 'created_at', 'updated_at'], 'integer'],
            [['preview_img', 'title'], 'string', 'max' => 255],
            [['id_category_scrap_gost'], 'exist', 'skipOnError' => true, 'targetClass' => CategoryScrapGost::className(), 'targetAttribute' => ['id_category_scrap_gost' => 'id']],

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
            'preview_img' => 'Превью',
            'file' => 'Изображение на превью',
            'title' => 'Заголовок',
            'content' => 'Контент',
            'id_category_scrap_gost' => 'Категория металлолома по гост',
            'created_at' => 'Созданно',
            'updated_at' => 'Измененно',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCategoryScrapGost()
    {
        return $this->hasOne(CategoryScrapGost::className(), ['id' => 'id_category_scrap_gost']);
    }


    /**
     * @inheritdoc
     */
    public static function getMapCategoryScrapGost(){
        $field = CategoryScrapGost::find()->all();
        $result = ArrayHelper::map($field,'id','name');
        return $result;
    }
   /* public static function getStaticCategoryScrapGostName($id){
        $list = ScrapPage::getMapCategoryScrapGost();

        foreach ($list as $key => $name){
            if($key === $id){
                return $name;
            }
        }

    }*/

    /* Геттер для названия категории */
    public function getCategoryScrapGostName() {
        return $this->idCategoryScrapGost->name;
    }
}
