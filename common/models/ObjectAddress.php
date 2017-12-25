<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "object_address".
 *
 * @property integer $id_object
 * @property string $country
 * @property string $region
 * @property string $province
 * @property string $area
 * @property string $locality
 * @property string $street
 * @property string $house
 *
 * @property Object $idObject
 */
class ObjectAddress extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'object_address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['country', 'region', 'province', 'area', 'locality', 'street', 'house'], 'string', 'max' => 255],
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
            'country' => 'Country',
            'region' => 'Region',
            'province' => 'Province',
            'area' => 'Area',
            'locality' => 'Locality',
            'street' => 'Street',
            'house' => 'House',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdObject()
    {
        return $this->hasOne(Object::className(), ['id' => 'id_object']);
    }
}
