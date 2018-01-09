<?php
namespace backend\controllers;

use common\models\Address;
use common\models\City;
use common\models\Employee;
use common\models\Office;
use common\models\PersonSearch;
use common\models\PhoneNumber;
use common\models\Role;
use common\models\search\PhoneNumberSearch;
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
class EmployeeController extends Controller
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
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, 'employee', 1);
        $dataProvider->pagination = ['pageSize' => 5];

        $model = Person::findOperatorEmployies(1);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel'  => $searchModel,
            'model'        => $model,
            'idOperator'   => 1
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
        return $this->renderAjax('view', [
            'person' => $person,
            'user'   => $user
        ]);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        if (!is_null(Yii::$app->request->post('id_operator'))) {
            $idOperator = Yii::$app->request->post('id_operator');
        } else {
            $this->redirect(['site/index']);
        }
        if (!is_null(Yii::$app->request->post('SignupForm'))) {
            $signup = Yii::$app->request->post('SignupForm');
            $user = User::findByUsername($signup['username']);
            if (is_null($user)) {
                $user = new User();
//                $user->load(Yii::$app->request->post());
                $user->USERNAME    = $signup['username'];
                $user->EMAIL       = $signup['email'];
                $user->ROLE_NAME   = 'employee';//$signup['role_name'];
                $user->ID_OPERATOR = $signup['ID_OPERATOR'];
                $user->setPassword($signup['password']);
                $user->generateAuthKey();
                $user->save();
                $user = User::findByUsername($signup['username']);
            }

            if (isset($user->USERNAME)) {
                $data_person = Yii::$app->request->post('Person');
                if (is_null(Person::findIdentity($data_person['IDENTIFICATION_NUMBER']))) {
                    $person             = new Person();
                    $person->USERNAME   = $user->USERNAME;
                    $person->ID_ADDRESS = 1;
                    $person->LAST_NAME  = $data_person['LAST_NAME'];
                    $person->FIRST_NAME = $data_person['FIRST_NAME'];
                    $person->IDENTIFICATION_NUMBER = $data_person['IDENTIFICATION_NUMBER'];
                    $person_save = $person->save();
                    $employee    = new Employee();
                    $employee->ID_OFFICE             = 1;
                    $employee->IDENTIFICATION_NUMBER = $person->IDENTIFICATION_NUMBER;
                    $employee->VALID_FROM            = 1;
                    $employee->save();
                    $phone_number = new PhoneNumber();
                    $phone_number->IDENTIFICATION_NUMBER = $person->IDENTIFICATION_NUMBER;
                    $phone_number->PHONE_NUMBER = Yii::$app->request->post('PhoneNumber')['PHONE_NUMBER'];
                    $phone_number->save();

                    if ($person_save) {
                        \Yii::$app->getSession()->setFlash('success', 'Úspešne uložený zamestnanec');
                    } else {
                        \Yii::$app->getSession()->setFlash('warning', 'Nepodarilo sa uložiť nového zamestnanca');
                    }

                    return $this->redirect(['index']);
                }
            }
            \Yii::$app->getSession()->setFlash('warning', 'Zamestnanca s týmto rodným číslom už v databáze máme');

            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'person'     => new Person(),
                'user'       => new SignupForm(),
                'address'    => new Address(),
                'office'     => new Office(),
                'phone'      => new PhoneNumber(),
                'idOperator' => 1,
                'roles'      => Role::find()->all(),
                'phoneNumbers' => PhoneNumber::getOperatorNumbers(1),
            ]);
        }

    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionUpdate($id)
    {
        $person  = Person::findIdentity($id);
        if (!is_null($person)) {
            $address = Address::findIdentity($person->ID_ADDRESS);
            $phone   = PhoneNumber::findAll(['IDENTIFICATION_NUMBER' => $person->IDENTIFICATION_NUMBER]);
            $user = User::findIdentity($person->USERNAME);
        } else {
            \Yii::$app->getSession()->setFlash('warning', 'Nenasiel som hladanu osobu');
            return $this->redirect(['index']);
        }

        if (!is_null(Yii::$app->request->post('User'))) {
            if (!is_null($person)) {

                $user = User::findIdentity($person->USERNAME);
                if (!is_null($user)) {
                    if (!is_null(Yii::$app->request->post('User'))) {
                        $user->USERNAME = Yii::$app->request->post('User')['USERNAME'];
                        $user->EMAIL    = Yii::$app->request->post('User')['EMAIL'];
                        $user->update();

                        $data_person = Yii::$app->request->post('Person');
                        $person->USERNAME   = Yii::$app->request->post('User')['USERNAME'];
                        $person->ID_ADDRESS = 1;
                        $person->LAST_NAME  = $data_person['LAST_NAME'];
                        $person->FIRST_NAME = $data_person['FIRST_NAME'];
                        $person->IDENTIFICATION_NUMBER   = $data_person['IDENTIFICATION_NUMBER'];
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

            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'person'  => $person,
            'user'    => $user,
            'address' => $address,
            'phone'   => isset($phone[0]) ? $phone[0] : new PhoneNumber(),
            'office'  => new Office(),
            'roles'   => Role::find()->all(),
            'idOperator'   => 1,
            'phoneNumbers' => PhoneNumber::getOperatorNumbers(1)
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