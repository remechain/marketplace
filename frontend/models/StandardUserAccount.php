<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "standard_user_account".
 *
 * @property integer $id_standard_user_account
 * @property integer $id_user
 * @property integer $verification_email
 * @property integer $phone
 * @property integer $verification_phone
 * @property integer $id_gender
 * @property integer $notice_system
 * @property integer $notice_general
 * @property string $first_name
 * @property string $last_name
 *
 * @property User $idUser
 */
class StandardUserAccount extends \common\models\StandardUserAccount
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_user', 'first_name', 'last_name'], 'required'],
            [['id_user', 'id_gender', 'notice_system', 'notice_general'], 'integer'],
            [['first_name', 'last_name', 'phone'], 'string', 'max' => 255],
            [['id_user'], 'unique'],
            [['phone'], 'unique','message' => 'Это телефон уже зарегистрирован.'],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'verification_email' => 'Потвержденный email',
            'phone' => 'Мобильный телефон',
            'verification_phone' => 'Подтвержденный телефон',
            'id_gender' => 'Пол',
            'notice_system' => 'Системные уведомления',
            'notice_general' => 'Общеинформационная рассылка',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
        ];
    }
}
