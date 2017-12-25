<?php

namespace frontend\controllers;

use frontend\models\BusinessUserAccount;
use frontend\models\User;
use Yii;

class BusinessUserAccountController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }


    public function actionBusinessUserAccountSetting()
    {
        //todo на рефакторинг это безобразие

        $user = User::findOne(Yii::$app->user->id);
        $model = BusinessUserAccount::find()->where(['id_user' => Yii::$app->user->id])->one();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $transaction = Yii::$app->db->beginTransaction();
                if($model->save()) {

                        if ($user->validate()) {
                            $user->username = $user->email;
                            if($user->save()){
                                $transaction->commit();
                            }else{
                                $transaction->rollBack();
                            }
                        }else{
                            $transaction->rollBack();
                        }
                }else{
                    $transaction->rollBack();
                }
                // form inputs are valid, do something here
            }

        }
        return $this->render('business-user-account-setting', [
            'user' => $user,
            'model' => $model,
        ]);
    }
}
