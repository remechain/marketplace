<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "category_scrap".
 *
 * @property integer $id
 * @property string $name
 * @property integer $id_type_scrap_gost
 *
 * @property TypeScrapGost $idTypeScrapGost
 */
class CategoryScrap extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category_scrap';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'id_type_scrap_gost'], 'required'],
            [['id_type_scrap_gost'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['id_type_scrap_gost'], 'exist', 'skipOnError' => true, 'targetClass' => TypeScrapGost::className(), 'targetAttribute' => ['id_type_scrap_gost' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Id категории металлолома',
            'name' => 'Упращенные категории',
            'id_type_scrap_gost' => 'Id Type Scrap Gost',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTypeScrapGost()
    {
        return $this->hasOne(TypeScrapGost::className(), ['id' => 'id_type_scrap_gost']);
    }
    /* Геттер для названия вида металла */
    public function getTypeScrapGostName() {
        return $this->idTypeScrapGost->name;
    }

    /**
     * @inheritdoc
     */
    public function getTypeScrapGost(){
        $field = TypeScrapGost::find()->all();
        $result = ArrayHelper::map($field,'id','name');
        return $result;
    }
}
