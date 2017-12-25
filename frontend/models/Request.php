<?php

namespace frontend\models;

use common\models\MethodPayment;
use common\models\TypeDelivery;
use DateTime;
use Yii;

/**
 * This is the model class for table "request".
 *
 * @property integer $id_request
 * @property integer $id_standard_user_account
 * @property integer $id_type_delivery
 * @property integer $id_city
 * @property string $address
 *
 * @property StandardUserAccount $idStandardUserAccount
 */
class Request extends \common\models\Request
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
            [['id_standard_user_account', 'id_type_delivery', 'id_city', 'address', 'desired_price', 'mass'], 'required'],
            [['id_type_delivery', 'id_city', 'address', 'desired_price', 'mass'], 'required'],
            [['id', 'id_standard_user_account', 'id_type_delivery', 'id_city', 'id_category_scrap', 'id_category_scrap_gost', 'id_type_scrap_gost', 'id_method_payment', 'dismantling', 'category_by_gost', 'created_at', 'updated_at'], 'integer'],
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
            'id' => 'ID',
            'id_type_delivery' => 'Тип доставки',
            'id_city' => 'Город',
            'address' => 'Адрес',
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
     * @return \yii\db\ActiveQuery
     */
    public function getIdStandardUserAccount()
    {
        return $this->hasOne(StandardUserAccount::className(), ['id_standard_user_account' => 'id_standard_user_account']);
    }

    public static function getIdCurentStandardUserAccount(){
        $result = StandardUserAccount::find()->where(['id_user' => Yii::$app->user->id ])->one();
        return  $result->id;
    }

    public function getShopper(){
        return Company::find()->where(['id' => $this->id_shopper])->one();
    }

    public function getMethodPaymentById($id){
        return MethodPayment::find()->where(['id' => $id])->one();
    }

    public function getTypeDeliveryById($id){
        return TypeDelivery::find()->where(['id' => $id])->one();
    }

    public function getDateCreateByFormat($format){
        $date = new DateTime("@$this->created_at");
        return $date->format($format);
    }

    public function getDateFormat($date,$format){
        $date = new DateTime("@$date");
        return $date->format($format);
    }
}
