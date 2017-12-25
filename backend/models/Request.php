<?php

namespace backend\models;

use common\models\CategoryScrap;
use common\models\CategoryScrapGost;
use common\models\MethodPayment;
use common\models\StandardUserAccount;
use common\models\TypeDelivery;
use common\models\TypeScrapGost;
use Yii;
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
            'id' => 'ID',
            'id_standard_user_account' => 'Ломоздатчик',
            'id_type_delivery' => 'Тип доставки',
            'id_city' => 'Город',
            'address' => 'Адрес',
            'id_category_scrap' => 'Упращенная категория мет-ма',
            'id_category_scrap_gost' => 'Категория мет-ма по ГОСТ',
            'id_type_scrap_gost' => 'Вид мет-ма по ГОСТ',
            'id_method_payment' => 'Метод оплаты',
            'desired_price' => 'Желаемая цена',
            'dismantling' => 'Требуется демонтж',
            'mass' => 'Масса',
            'category_by_gost' => 'Выбрана категория по ГОСТ',
            'created_at' => 'Создано',
            'updated_at' => 'Обносленно',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdStandardUserAccount()
    {
        return $this->hasOne(StandardUserAccount::className(), ['id' => 'id_standard_user_account']);
    }


    //Вывод названий полей связанных таблиц
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTypeScrapGost()
    {
        return $this->hasOne(TypeScrapGost::className(), ['id' => 'id_type_scrap_gost']);
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
    public function getIdCategoryScrap()
    {
        return $this->hasOne(CategoryScrap::className(), ['id' => 'id_category_scrap']);
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
    public function getIdTypeDelivery()
    {
        return $this->hasOne(TypeDelivery::className(), ['id' => 'id_type_delivery']);
    }

    /* Геттер для названия вида металла по гост */
    public function getTypeScrapGostName() {
        return $this->idTypeScrapGost->name;
    }

    /* Геттер для названия категории металла по гост */
    public function getCategoryScrapGostName() {
        return $this->idCategoryScrapGost->name;
    }

    /* Геттер для названия категории металла  */
    public function getCategoryScrapName() {
        return $this->idCategoryScrap->name;
    }

    /* Геттер для названия метода оплаты  */
    public function getMethodPaymentName() {
        return $this->idMethodPayment->name;
    }
    /* Геттер для названия способа оплаты  */
    public function getTypeDeliveryName() {
        return $this->idTypeDelivery->name;
    }


    /**
     * @return array
     */
    public function getMapTypeScrapGost()
    {
        $field = TypeScrapGost::find()->all();
        $result = ArrayHelper::map($field,'id','name');
        return $result;
    }
    /**
     * @return array
     */
    public function getMapCategoryScrapGost()
    {
        $field = CategoryScrapGost::find()->all();
        $result = ArrayHelper::map($field,'id','name');
        return $result;
    }
    /**
     * @return array
     */
    public function getMapCategoryScrap()
    {
        $field = CategoryScrap::find()->all();
        $result = ArrayHelper::map($field,'id','name');
        return $result;
    }
    /**
     * @return array
    */
    public function getMapMethodPayment()
    {
        $field = MethodPayment::find()->all();
        $result = ArrayHelper::map($field,'id','name');
        return $result;
    }
    /**
     * @return array
     */
    public function getMapTypeDelivery()
    {
        $field = TypeDelivery::find()->all();
        $result = ArrayHelper::map($field,'id','name');
        return $result;
    }

}
