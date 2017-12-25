<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "subscription_system".
 *
 * @property integer $id
 * @property integer $id_user
 * @property integer $id_subscription
 *
 * @property User $idUser
 * @property Subscription $idSubscription
 */
class SubscriptionSystem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subscription_system';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_user', 'id_subscription'], 'required'],
            [['id_user', 'id_subscription'], 'integer'],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
            [['id_subscription'], 'exist', 'skipOnError' => true, 'targetClass' => Subscription::className(), 'targetAttribute' => ['id_subscription' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'id_subscription' => 'Id Subscription',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }

    /**
     * @return array массив моделей с уведамлениями на которые подписан пользователь
     */
    public static function getAllUsersSubscription()
    {
        $result = SubscriptionSystem::find()->where(['id_user' => Yii::$app->user->id])->all();
        return $result;
    }

    /**
     * @return array массив с уведамлениями на которые подписан пользователь
     */
    public static function getMapAllUsersSubscription()
    {
        $list = SubscriptionSystem::find()->where(['id_user' => Yii::$app->user->id])->all();
        $result = ArrayHelper::map($list,'id','id_subscription');
        return $result;
    }

    /**
     * @return array массив со уведамлениями в системе
     */
    public static function getMapAllSubscription()
    {
        $list = Subscription::find()->all();
        $result = ArrayHelper::map($list,'id','name');
        return $result;
    }

    /**
     * @return array возвращает массив всех уведамлений: [id подписки,название,состояние(bool)]
     */
    public static function getListUserSubscription()
    {
        $allSubscription = SubscriptionSystem::getMapAllSubscription();
        $allUsersSubscription = SubscriptionSystem::getMapAllUsersSubscription();
        $result = [];
        foreach ($allSubscription as $keySubscription => $subscription){
            if($allUsersSubscription[0] == null){
                $flag = false;
            }else{
                $flag = true;
            }

            foreach ($allUsersSubscription as $keyUsersSubscription => $UsersSubscription){
                if($keySubscription == $UsersSubscription){
                    $result [] = [$keySubscription,$subscription,true];
                    continue 2;
                }else{
                    $flag = false;
                }
            }
            if($flag === false){
                $result [] = [$keySubscription,$subscription,false];
            }
        }
        return $result;
    }
}
