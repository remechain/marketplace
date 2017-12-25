<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "object".
 *
 * @property integer $id
 * @property integer $id_company
 * @property string $name
 * @property string $email
 * @property integer $phone
 * @property integer $id_city
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $id_status
 * @property integer $id_type_object
 *
 * @property Company $idCompany
 */
class Object extends \yii\db\ActiveRecord
{

    public $equipments = [];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'object';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_company', 'name', 'created_at', 'updated_at', 'id_type_object'], 'required'],
            [['id_company', 'phone', 'id_city', 'created_at', 'updated_at', 'id_status', 'id_type_object'], 'integer'],
            [['name', 'email'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['id_company'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['id_company' => 'id']],

            [['equipments'],'each','rule' => ['string']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_company' => 'Id Company',
            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'id_city' => 'Id City',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'id_status' => 'Id Status',
            'id_type_object' => 'Id Type Object',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'id_company']);
    }
}
