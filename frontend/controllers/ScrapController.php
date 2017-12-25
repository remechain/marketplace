<?php

namespace frontend\controllers;

use frontend\models\Company;
use frontend\models\ScrapPage;
use Yii;
use yii\web\NotFoundHttpException;

class ScrapController extends \yii\web\Controller
{


    public function actionIndex()
    {
        return $this->render('index');
    }


    /**
     * Displays a single Scrap model.
     * @param integer $id
     * @return mixed
     */
    public function actionPage($id)
    {

        return $this->render('page',[
         'model' => $this->findModel($id),
        ]);
    }


    /**
     * Finds the CategoryScrap model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ScrapPage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ScrapPage::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
