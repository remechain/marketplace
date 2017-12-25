<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "type_scrap_gost".
 *
 * @property integer $id
 * @property string $name
 */
class TypeScrapGost extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'type_scrap_gost';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Id тип металлолома по ГОСТ',
            'name' => 'Название',
        ];
    }

    static function  getAllTypeScrapGost(){
        return TypeScrapGost::find()->all();
    }
}
