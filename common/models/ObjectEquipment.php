<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "object_equipment".
 *
 * @property integer $id_object
 * @property integer $id_equipment
 *
 * @property Object $idObject
 * @property Equipment $idEquipment
 */
class ObjectEquipment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'object_equipment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_object', 'id_equipment'], 'required'],
            [['id_object', 'id_equipment'], 'integer'],
            [['id_object'], 'exist', 'skipOnError' => true, 'targetClass' => Object::className(), 'targetAttribute' => ['id_object' => 'id']],
            [['id_equipment'], 'exist', 'skipOnError' => true, 'targetClass' => Equipment::className(), 'targetAttribute' => ['id_equipment' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_object' => 'Id Object',
            'id_equipment' => 'Id Equipment',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdObject()
    {
        return $this->hasOne(Object::className(), ['id' => 'id_object']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdEquipment()
    {
        return $this->hasOne(Equipment::className(), ['id' => 'id_equipment']);
    }

    static function setObjectEquipments($equipments, $id_object)
    {
        ObjectEquipment::deleteAll(['id_object' => $id_object]);
        if ($equipments != '') {

            foreach ($equipments as $id_equipment) {
                $objectEquipment = new ObjectEquipment();
                $objectEquipment->id_object = $id_object;
                $objectEquipment->id_equipment = $id_equipment;

                if (!$objectEquipment->save()) {

                    return false;
                }
            }

        }
        return true;
    }

    static function getAllObjectEquipment($id_object){
        $objectEquipments = ObjectEquipment::find()->select('id_equipment')->where(['id_object' => $id_object])->asArray()->all();
        $result = [];
        foreach ($objectEquipments as $objectEquipment){
            $result[] = $objectEquipment['id_equipment'];
        }
        return $result;
    }
}
