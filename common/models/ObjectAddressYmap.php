<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "object_address_ymap".
 *
 * @property integer $id
 * @property string $country
 * @property string $region
 * @property string $province
 * @property string $area
 * @property string $locality
 * @property string $street
 * @property string $house
 * @property integer $id_object
 */
class ObjectAddressYmap extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'object_address_ymap';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_object'], 'required'],
            [['id_object'], 'integer'],
            [['country'], 'string', 'max' => 6],
            [['region', 'province', 'area', 'locality', 'street', 'house'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'country' => 'Country',
            'region' => 'Region',
            'province' => 'Province',
            'area' => 'Area',
            'locality' => 'Locality',
            'street' => 'Street',
            'house' => 'House',
            'id_object' => 'Id Object',
        ];
    }
}
