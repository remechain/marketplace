<?php

namespace backend\models;

use common\models\Gender;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "business_user_account".
 *
 * @property integer $id
 * @property integer $id_gender
 * @property string $first_name
 * @property string $last_name
 * @property string $landline_phone
 * @property string $email
 * @property string $password
 * @property string $phone
 */
class BusinessUserAccount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'business_user_account';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_gender'], 'integer'],
            [['first_name', 'last_name', 'email','phone','landline_phone','id_gender'], 'required'],
            [['first_name', 'last_name', 'email', 'password'], 'string', 'max' => 255],
            [['landline_phone'], 'string', 'max' => 50],
            [['email'], 'unique'],
            [['landline_phone'], 'unique'],
            [['phone'], 'unique'],
            [['phone'],'string'],
            [['password'],'string','min' => 6],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_gender' => 'Пол',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'landline_phone' => 'Стационарный телефон',
            'email' => 'Email',
            'password' => 'Пароль',
            'phone' => 'Мобильный телефон',
        ];
    }

    /**
     * @return array Массив с записями из таблицы Gender
     */
    public static function getGenderMap(){
        $list = Gender::find()->all();
        $result = ArrayHelper::map($list,'id','name');
        return $result;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdGender()
    {
        return $this->hasOne(Gender::className(), ['id' => 'id_gender']);
    }
    public function getGenderName()
    {
        return $this->idGender->name;
    }

}
