<?php
namespace backend\controllers;

use common\models\Address;
use common\models\PersonSearch;
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
class CustomerController extends Controller
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
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,'customer', 1);

        $model = Person::find()->all();
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel'  => $searchModel,
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
        $person = Person::findIdentity($id);
        if (!is_null($person)) {
            $user = User::findIdentity($person->ID_USER);
        } else {
            \Yii::$app->getSession()->setFlash('warning', 'Nenasiel som hladanu osobu');
            return $this->redirect(['index']);
        }
        return $this->render('view', [
            'person' => $person,
            'user'   => $user
        ]);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        if (!is_null(Yii::$app->request->post('SignupForm'))) {
            $signup = Yii::$app->request->post('SignupForm');
            $check_user = User::findByUsername($signup['username']);
            if (is_null($check_user)) {
                $user = new SignupForm();
                $user->
                $user = $user->signup();
                $user->load(Yii::$app->request->post());
            } else {
                $user = $check_user;
            }
            if (isset($user->ID_USER)) {
                $data_person = Yii::$app->request->post('Person');
                if (is_null(Person::findIdentity($data_person['IDENTIFICATION_NUMBER']))) {
                    $person             = new Person();
                    $person->ID_USER    = $user->ID_USER;
                    $person->LAST_NAME  = $data_person['LAST_NAME'];
                    $person->CITY       = $data_person['POST_CODE'];
                    $person->STREET     = $data_person['STREET'];
                    $person->FIRST_NAME = $data_person['FIRST_NAME'];
                    $person->POST_CODE  = $data_person['POST_CODE'];
                    $person->IDENTIFICATION_NUMBER = $data_person['IDENTIFICATION_NUMBER'];
                    if ($person->save()) {
                        \Yii::$app->getSession()->setFlash('success', 'Úspešne uložený používateľ');
                    } else {
                        \Yii::$app->getSession()->setFlash('warning', 'Nepodarilo sa uložiť nového používateľa');
                    }
                    return $this->redirect(['index']);
                }
            }
            \Yii::$app->getSession()->setFlash('warning', 'Osobu s týmto rodným číslom už v databáze máme');
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'person'     => new Person(),
                'user'       => new SignupForm(),
                'address'    => new Address(),
                'idOperator'   => Yii::$app->params['operator']
            ]);
        }

    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionUpdate($id)
    {
        $person = Person::findIdentity($id);
        if (!is_null($person)) {
            $user = User::findIdentity($person->ID_USER);
            if (!is_null($user)) {
                if (!is_null(Yii::$app->request->post('User'))) {
                    $user->load(Yii::$app->request->post());
                    $user->update();
                    $data_person = Yii::$app->request->post('Person');
                    $person->IDENTIFICATION_NUMBER = $data_person['IDENTIFICATION_NUMBER'];
                    $person->LAST_NAME  = $data_person['LAST_NAME'];
                    $person->CITY       = $data_person['CITY'];
                    $person->STREET     = $data_person['STREET'];
                    $person->FIRST_NAME = $data_person['FIRST_NAME'];
                    $person->POST_CODE  = $data_person['POST_CODE'];
                    $person->update();
                    \Yii::$app->getSession()->setFlash('success', 'Používateľ uspesne upraveny');

                    return $this->redirect(['index']);
                }
            } else {
                \Yii::$app->getSession()->setFlash('warning', 'Nenasiel som hladanu osobu');
                return $this->redirect(['index']);
            }
        } else {
            \Yii::$app->getSession()->setFlash('warning', 'Nenasiel som hladanu osobu');
            return $this->redirect(['index']);
        }

        return $this->renderAjax('update', [
            'person' => $person,
            'user'   => $user
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