<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "object_accept_scrap".
 *
 * @property integer $id_object
 * @property integer $id_accept_scrap
 *
 * @property AcceptScrap $idAcceptScrap
 * @property Object $idObject
 */
class ObjectAcceptScrap extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'object_accept_scrap';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_object', 'id_accept_scrap'], 'required'],
            [['id_object', 'id_accept_scrap'], 'integer'],
            [['id_accept_scrap'], 'exist', 'skipOnError' => true, 'targetClass' => AcceptScrap::className(), 'targetAttribute' => ['id_accept_scrap' => 'id']],
            [['id_object'], 'exist', 'skipOnError' => true, 'targetClass' => Object::className(), 'targetAttribute' => ['id_object' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_object' => 'Id Object',
            'id_accept_scrap' => 'Id Accept Scrap',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAcceptScrap()
    {
        return $this->hasOne(AcceptScrap::className(), ['id' => 'id_accept_scrap']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdObject()
    {
        return $this->hasOne(Object::className(), ['id' => 'id_object']);
    }
}
