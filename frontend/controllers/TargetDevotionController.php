<?php

namespace frontend\controllers;

use frontend\models\Company;
use Yii;
use frontend\models\TargetDevotion;
use frontend\models\TargetDevotionSearch;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * TargetDevotionController implements the CRUD actions for TargetDevotion model.
 */
class TargetDevotionController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Creates a new TargetDevotion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
   /* public function actionCreate()
    {
        $model = new TargetDevotion();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }*/


    public function actionCreate()
    {
        /*if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }*/
        $model = new TargetDevotion();
        $model->id_business_account = Company::getCurrentIdBusinessUserAccount();

        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(Url::toRoute('request-business/index'));
        }

/*
        if ($model->load(Yii::$app->request->post())
            && $model->id_business_account = Company::getCurrentIdBusinessUserAccount()) {

            return $model->id_business_account.'----'.Company::getCurrentIdBusinessUserAccount();
        }*/
    }
    /**
     * Deletes an existing TargetDevotion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TargetDevotion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TargetDevotion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TargetDevotion::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
