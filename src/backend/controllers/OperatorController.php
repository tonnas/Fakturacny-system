<?php
namespace backend\controllers;

use common\models\Address;
use common\models\City;
use common\models\Employee;
use common\models\Office;
use common\models\PersonSearch;
use common\models\search\OfficeSearch;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Person;
use common\models\User;
use backend\models\SignupForm;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class OperatorController extends Controller
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
        $searchModel = new PersonSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $model = Person::find()->all();
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel'  => $searchModel,
            'model'        => $model,
        ]);
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

    public function actionOffice()
    {
        $searchModel = new OfficeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $model = Person::find()->all();
        return $this->render('office', [
            'dataProvider' => $dataProvider,
            'searchModel'  => $searchModel,
            'model'        => $model,
        ]);
    }

    public function actionCreateOffice()
    {
        if (!is_null(Yii::$app->request->post('Address'))) {
            $post = Yii::$app->request->post('Address');
            $address = Address::find()
                ->where(['STREET' => $post['STREET']])
                ->andWhere(['STREET_NUMBER' => $post['STREET_NUMBER']])
                ->one();

            if (is_null($address)) {
                $address = new Address();
                $address->STREET  = $post['STREET'];
                $address->ID_CITY = $post['ID_CITY'];
                $address->STREET_NUMBER = $post['STREET_NUMBER'];
                $address->save();
            }

            $office = Office::find()
                ->where(['ID_ADDRESS' => $address->ID_ADDRESS])->one();

            if (is_null($office)) {
                $office = new Office();
                $office->ID_ADDRESS = $address->ID_ADDRESS;
                $office->save();
            }

            \Yii::$app->getSession()->setFlash('success', 'Úspešne uložena pobocka');

            return $this->redirect(['office']);
        }

        return $this->render('createOffice',[
            'office'  => new Office(),
            'address' => new Address(),
        ]);
    }

    /**
     * @param $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = Person::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}