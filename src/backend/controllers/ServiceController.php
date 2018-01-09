<?php

namespace backend\controllers;

use common\models\search\ServiceSearch;
use common\models\Service;
use Yii;
use yii\db\Query;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ServiceController extends Controller
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
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ServiceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,'customer', 1);
        $model = Service::find()->all();

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
            'model'        => $model,
            'idOperator'   => Yii::$app->params['operator']
        ]);
    }

    /**
     * @param $id
     * @return string
     */
    public function actionView($id)
    {
    }

    /**
     *
     */
    public function actionPair()
    {
        return $this->render('pair', []);
    }

    /**
     *
     */
    public function actionMinute()
    {
        return $this->render('minute', []);
    }

    /**
     *
     */
    public function actionSms()
    {
        return $this->render('sms', []);
    }

    /**
     *
     */
    public function actionPackage()
    {
        return $this->render('package', []);
    }

    /**
     *
     */
    public function actionNet()
    {
        return $this->render('net', []);
    }

    /**
     *
     */
    public function actionTariff()
    {
        return $this->render('tariff', []);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionUpdate($id)
    {
    }

    /**
     * @param $id
     * @return \yii\web\Response
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * @param $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = Invoice::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}