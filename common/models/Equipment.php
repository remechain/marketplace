<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "equipment".
 *
 * @property integer $id
 * @property string $name
 *
 * @property ObjectEquipment[] $objectEquipments
 */
class Equipment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'equipment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
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
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectEquipments()
    {
        return $this->hasMany(ObjectEquipment::className(), ['id_equipment' => 'id']);
    }

    static function getAllEquipments(){
        return Equipment::find()->all();
    }
}
