<?php

namespace frontend\controllers;

use frontend\models\Company;
use frontend\models\CompanySearch;
use frontend\models\ObjectSearch;
use Yii;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;

class CompanyController extends \yii\web\Controller
{
    public function actionCreate()
    {
        $model = new Company();


        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $model->id_business_user_account = $model->getCurrentIdBusinessUserAccount();
                $model->save();

                return $this->redirect(Url::toRoute('company/index'));
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);

    }

    public function actionCreateFirst()
    {
        $companyId = null;
        $model = new Company();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $model->id_business_user_account = $model->getCurrentIdBusinessUserAccount();
                $model->save();
                $companyId = $model->id;
                $this->redirect(Url::toRoute(['object/create-first','companyId' => $companyId])   );
            }
        }
        return $this->render('create-first', [
            'model' => $model,
        ]);

    }

    public function actionIndex($count = 2)
    {
        $searchModel = new CompanySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize=$count;
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUpdate()
    {
        return $this->render('update');
    }

    public function actionView($id,$count = 1)
    {
        $searchModel = new ObjectSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize=$count;

        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }


    /**
     * Finds the ScrapPage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Company the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Company::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
