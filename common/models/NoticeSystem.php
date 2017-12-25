<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "notice_system".
 *
 * @property integer $id
 * @property integer $id_user
 * @property integer $id_notice
 *
 * @property User $idUser
 * @property Notice $idNotice
 */
class NoticeSystem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notice_system';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_user', 'id_notice'], 'required'],
            [['id_user', 'id_notice'], 'integer'],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
            [['id_notice'], 'exist', 'skipOnError' => true, 'targetClass' => Notice::className(), 'targetAttribute' => ['id_notice' => 'id']],
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
            'id_notice' => 'Id Notice',
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
     * @return \yii\db\ActiveQuery
     */
    public function getIdNotice()
    {
        return $this->hasOne(Notice::className(), ['id' => 'id_notice']);
    }

    /**
     * @return array массив моделей с уведамлениями на которые подписан пользователь
     */
    public static function getAllUsersNotice()
    {
        $result = NoticeSystem::find()->where(['id_user' => Yii::$app->user->id])->all();
        return $result;
    }

    /**
     * @return array массив с уведамлениями на которые подписан пользователь
     */
    public static function getMapAllUsersNotice()
    {
        $list = NoticeSystem::find()->where(['id_user' => Yii::$app->user->id])->all();
        $result = ArrayHelper::map($list,'id','id_notice');
        return $result;
    }

    /**
     * @return array массив со уведамлениями в системе
     */
    public static function getMapAllNotice()
    {
        $list = Notice::find()->all();
        $result = ArrayHelper::map($list,'id','name');
        return $result;
    }

    /**
     * @return array возвращает массив всех уведамлений: [id подписки,название,состояние(bool)]
     */
    public static function getListUserNotice()
    {
        $allNotice = NoticeSystem::getMapAllNotice();
        $allUsersNotice = NoticeSystem::getMapAllUsersNotice();
        $result = [];
        foreach ($allNotice as $keyNotice => $notice){
            if($allUsersNotice[0] == null){
                $flag = false;
            }else{
                $flag = true;
            }

            foreach ($allUsersNotice as $keyUsersNotice => $UsersNotice){
                if($keyNotice == $UsersNotice){
                    $result [] = [$keyNotice,$notice,true];
                    continue 2;
                }else{
                    $flag = false;
                }
            }
            if($flag === false){
                $result [] = [$keyNotice,$notice,false];
            }
        }
        return $result;
    }
}
