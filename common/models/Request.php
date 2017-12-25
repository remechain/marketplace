<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "request".
 *
 * @property integer $id
 * @property integer $id_standard_user_account
 * @property integer $id_type_delivery
 * @property integer $id_city
 * @property string $address
 * @property integer $id_category_scrap
 * @property integer $id_category_scrap_gost
 * @property integer $id_type_scrap_gost
 * @property integer $id_method_payment
 * @property double $desired_price
 * @property integer $dismantling
 * @property double $mass
 * @property integer $category_by_gost
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property StandardUserAccount $idStandardUserAccount
 */
class Request extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'request';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_standard_user_account', 'id_type_delivery', 'id_city', 'address', 'desired_price', 'mass', 'created_at', 'updated_at'], 'required'],
            [['id_standard_user_account', 'id_type_delivery', 'id_city', 'id_category_scrap', 'id_category_scrap_gost', 'id_type_scrap_gost', 'id_method_payment', 'dismantling', 'category_by_gost', 'created_at', 'updated_at'], 'integer'],
            [['desired_price', 'mass'], 'number'],
            [['address'], 'string', 'max' => 255],
            [['id_standard_user_account'], 'exist', 'skipOnError' => true, 'targetClass' => StandardUserAccount::className(), 'targetAttribute' => ['id_standard_user_account' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Id Request',
            'id_standard_user_account' => 'Id Standard User Account',
            'id_type_delivery' => 'Тип доставки',
            'id_city' => 'Город',
            'address' => 'Адрес',
            'create_at' => 'Дата создания',
            'id_category_scrap' => 'Id Category Scrap',
            'id_category_scrap_gost' => 'Category Scrap Gost',
            'id_type_scrap_gost' => 'Id Type Scrap Gost',
            'id_method_payment' => 'Id Method Payment',
            'desired_price' => 'Desired Price',
            'dismantling' => 'Dismantling',
            'mass' => 'Mass',
            'category_by_gost' => 'Category By Gost',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @return array Массив с записями из таблицы TypeDelivery
     */
    public function getTypeDeliveryMap(){
        $list = TypeDelivery::find()->all();
        $result = ArrayHelper::map($list,'id','name');
        return $result;
    }
    /**
     * @return array Массив с записями из таблицы MethodPayment
     */
    public function getMethodPaymentMap(){
        $list = MethodPayment::find()->all();
        $result = ArrayHelper::map($list,'id','name');
        return $result;
    }



    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdMethodPayment()
    {
        return $this->hasOne(MethodPayment::className(), ['id' => 'id_method_payment']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCategoryScrap()
    {
        return $this->hasOne(CategoryScrap::className(), ['id' => 'id_category_scrap']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCategoryScrapGost()
    {
        return $this->hasOne(CategoryScrapGost::className(), ['id' => 'id_category_scrap_gost']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdStandardUserAccount()
    {
        return $this->hasOne(StandardUserAccount::className(), ['id' => 'id_standard_user_account']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTypeDelivery()
    {
        return $this->hasOne(TypeDelivery::className(), ['id' => 'id_type_delivery']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTypeScrapGost()
    {
        return $this->hasOne(TypeScrapGost::className(), ['id' => 'id_type_scrap_gost']);
    }
}
