<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "object_transport".
 *
 * @property integer $id_object
 * @property integer $id_transport
 *
 * @property Object $idObject
 * @property Transport $idTransport
 */
class ObjectTransport extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'object_transport';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_object', 'id_transport'], 'required'],
            [['id_object', 'id_transport'], 'integer'],
            [['id_object'], 'exist', 'skipOnError' => true, 'targetClass' => Object::className(), 'targetAttribute' => ['id_object' => 'id']],
            [['id_transport'], 'exist', 'skipOnError' => true, 'targetClass' => Transport::className(), 'targetAttribute' => ['id_transport' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_object' => 'Id Object',
            'id_transport' => 'Id Transport',
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
    public function getIdTransport()
    {
        return $this->hasOne(Transport::className(), ['id' => 'id_transport']);
    }

    static function setObjectTransports($transports, $id_object)
    {
        ObjectTransport::deleteAll(['id_object' => $id_object]);

        if ($transports != '') {
            foreach ($transports as $id_transport) {
                $objectTransport = new ObjectTransport();
                $objectTransport->id_object = $id_object;
                $objectTransport->id_transport = $id_transport;
                if (!$objectTransport->save()) {
                    return false;
                }
            }
        }
        return true;
    }

    static function getAllObjectTransport($id_object){
        $objectTransports = ObjectTransport::find()->select('id_transport')->where(['id_object' => $id_object])->asArray()->all();
        $result = [];
        foreach ($objectTransports as $objectTransport){
            $result[] = $objectTransport['id_transport'];
        }
        return $result;
    }
}
