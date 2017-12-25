<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "object_scrap".
 *
 * @property integer $id_object
 * @property integer $id_type_scrap_gost
 *
 * @property Object $idObject
 * @property TypeScrapGost $idTypeScrapGost
 */
class ObjectScrap extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'object_scrap';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_object', 'id_type_scrap_gost'], 'required'],
            [['id_object', 'id_type_scrap_gost'], 'integer'],
            [['id_object'], 'exist', 'skipOnError' => true, 'targetClass' => Object::className(), 'targetAttribute' => ['id_object' => 'id']],
            [['id_type_scrap_gost'], 'exist', 'skipOnError' => true, 'targetClass' => TypeScrapGost::className(), 'targetAttribute' => ['id_type_scrap_gost' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_object' => 'Id Object',
            'id_type_scrap_gost' => 'Id Type Scrap Gost',
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
    public function getIdTypeScrapGost()
    {
        return $this->hasOne(TypeScrapGost::className(), ['id' => 'id_type_scrap_gost']);
    }


    static function setObjectScraps($scraps, $id_object)
    {
        ObjectScrap::deleteAll(['id_object' => $id_object]);

        if ($scraps != '') {
            foreach ($scraps as $id_scrap) {
                $objectScrap = new ObjectScrap();
                $objectScrap->id_object = $id_object;
                $objectScrap->id_type_scrap_gost = $id_scrap;
                if (!$objectScrap->save()) {
                    return false;
                }
            }
        }
        return true;
    }

    static function getAllObjectScrap($id_object){
        $objectScraps = ObjectScrap::find()->select('id_type_scrap_gost')->where(['id_object' => $id_object])->asArray()->all();
        $result = [];
        foreach ($objectScraps as $objectScrap){
            $result[] = $objectScrap['id_type_scrap_gost'];
        }
        return $result;
    }
}
