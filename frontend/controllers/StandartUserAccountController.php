<?php

namespace frontend\controllers;

use common\models\NoticeSystem;
use common\models\SubscriptionSystem;
use frontend\models\StandardUserAccount;
use frontend\models\User;
use Yii;

class StandartUserAccountController extends \yii\web\Controller
{
    public function actionIndex()
    {
        if (Yii::$app->request->post()) {
            $noticesDelete = NoticeSystem::getAllUsersNotice();
            $subscriptionsDelete = SubscriptionSystem::getAllUsersSubscription();

            /** @var NoticeSystem $noticeDelete */
            foreach ($noticesDelete as $noticeDelete){
                $noticeDelete->delete();
            }
            /** @var SubscriptionSystem $subscriptionDelete */
            foreach ($subscriptionsDelete as $subscriptionDelete){
                $subscriptionDelete->delete();
            }

            foreach ($_POST as $keyPost => $post) {
                $result = preg_match('{notice-[0-9]+}',$keyPost);
                if($result == 1){
                    $match = [];
                    preg_match('{[0-9]+}',$keyPost,$match);
                    $modelNotice = new NoticeSystem();
                    $modelNotice->id_user = Yii::$app->user->id;
                    $modelNotice->id_notice = $match[0];
                    $modelNotice->save();
                }
            }

            foreach ($_POST as $keyPost => $post) {
                $result = preg_match('{subscription-[0-9]+}',$keyPost);
                if($result == 1){
                    $match = [];
                    preg_match('{[0-9]+}',$keyPost,$match);
                    $modelSubscription = new SubscriptionSystem();
                    $modelSubscription->id_user = Yii::$app->user->id;
                    $modelSubscription->id_subscription = $match[0];
                    $modelSubscription->save();
                }
            }

        }
        return $this->actionStandartUserAccountSetting();
    }


    public function actionStandartUserAccountSetting()
    {
        //todo на рефакторинг это безобразие

        $user = User::findOne(Yii::$app->user->id);
        $model = StandardUserAccount::find()->where(['id_user' => Yii::$app->user->id])->one();

        $subscription = SubscriptionSystem::getListUserSubscription();
        $notice = NoticeSystem::getListUserNotice();

        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            if ($model->save()) {
                if ($user->load(Yii::$app->request->post())) {
                    $user->username = $user->email;
                    if ($user->save()) {
                        $transaction->commit();
                    } else {
                        $transaction->rollBack();
                    }
                } else {
                    $transaction->rollBack();
                }
            } else {
                $transaction->rollBack();
            }
            // form inputs are valid, do something here

        }
        return $this->render('standart-user-account-setting', [
            'user' => $user,
            'model' => $model,
            'subscription' => $subscription,
            'notice' => $notice,
        ]);
    }
}
