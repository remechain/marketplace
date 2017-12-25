<?php

namespace frontend\models;

use common\models\TypeObject;
use Yii;
use yii\helpers\ArrayHelper;

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
class Object extends \common\models\Object
{
    public $equipments = [];
    public $transports = [];
    public $scraps = [];
    public $weekend = [];
    public $weekday = [];
    public $city;
    public $address;

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
            [['name', 'id_type_object'], 'required'],
            [['id_company', 'id_city', 'created_at', 'updated_at', 'id_status', 'id_type_object'], 'integer'],
            [['name', 'email','phone','site'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['id_company'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['id_company' => 'id']],

            [['equipments'],'each','rule' => ['string']],
            [['transports'],'each','rule' => ['string']],
            [['scraps'],'each','rule' => ['string']],
            [['weekend'],'each','rule' => ['string']],
            [['weekday'],'each','rule' => ['string']],

            [['city'],'string', 'max' => 50],
            [['address'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Название обьекта',
            'site' => 'Сайт',
            'email' => 'Email',
            'phone' => 'Телефон',
            'id_city' => 'Город',
            'id_type_object' => 'Тип обьекта',
            'city' => 'Город',
            'address' => 'Адрес',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'id_company']);
    }


    /**
 * @inheritdoc
 */
    public function getMapTypeObject(){
        $field =TypeObject::find()->all();
        $result = ArrayHelper::map($field,'id','name');
        return $result;
    }

    //не понятно где используется используется
    /*public function getCheckBoxListTypeObject(){
        $content = [];
        $field = TypeObject::find()->all();
        foreach ($field as $model){
            array_push ( $content  , [ $model->id , $model->name , false] ) ;
        }

        return $content;
    }*/

}
