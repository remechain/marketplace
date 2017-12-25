<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "transport".
 *
 * @property integer $id
 * @property string $name
 *
 * @property ObjectTransport[] $objectTransports
 */
class Transport extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transport';
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
    public function getObjectTransports()
    {
        return $this->hasMany(ObjectTransport::className(), ['id_transport' => 'id']);
    }

    static function getAllTransports(){
        return Transport::find()->all();
    }
}
