<?php
namespace backend\controllers;

use common\models\Office;
use common\models\Operator;
use common\models\PhoneNumber;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\User as Login;
use yii\web\User;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'operators', 'login-operator', 'operator'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $operators = Operator::find()->all();
        $opCounts  = [];
        foreach ($operators as $operator) {
            $opCounts[$operator->ID_OPERATOR]['countOfEmployee']  = Login::getCountOfEmployees($operator->ID_OPERATOR);
            $opCounts[$operator->ID_OPERATOR]['countOfCustomers'] = Login::getCountOfCustomers($operator->ID_OPERATOR);
            $opCounts[$operator->ID_OPERATOR]['countOfOffices']   = Office::getOperatorOfficeCount($operator->ID_OPERATOR);
        }

        return $this->render('index', [
            'operators' => Operator::find()->orderBy(['NAME' => SORT_ASC])->all(),
            'opCounts'  => $opCounts
        ]);
    }

    /**
     * Operators action.
     *
     * @return string
     */
    public function actionOperators()
    {
        return $this->render('operators', [
            'operators' => Operator::find()->all()
        ]);
    }

    public function actionOperator($id_operator)
    {
        $operator = Operator::findIdentity($id_operator);

        $employeeCount = Login::getCountOfEmployees($operator->ID_OPERATOR);
        $customerCount = Login::getCountOfCustomers($operator->ID_OPERATOR);
        $officiesCount = Office::getOperatorOfficeCount($operator->ID_OPERATOR);
        $numberCount   = PhoneNumber::getOperatorNumbersCount($operator->ID_OPERATOR);

        return $this->render('operator',[
            'operator' => $operator,
            'employeeCount' => $employeeCount,
            'customerCount' => $customerCount,
            'officiesCount' => $officiesCount,
            'numberCount'   => $numberCount,
        ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * LoginOperator action
     *
     * @param $operator
     * @return string|\yii\web\Response
     */
    public function actionLoginOperator($operator)
    {
        $model = new LoginForm();
        if (!is_null(Yii::$app->request->post('LoginForm'))) {
            $post = Yii::$app->request->post('LoginForm');
            $user = Login::findIdentity($post['username']);
            if (!is_null($user) && $user->ID_OPERATOR == $operator || $user->ROLE_NAME == 'super-admin') {
                $model->load(Yii::$app->request->post());
                $model->login();
                $this->redirect('../operator/index');
            } else {
                \Yii::$app->getSession()->setFlash('warning', 'Neplatne prihlasenie');
                $this->redirect(['login']);
            }
        } else {
            return $this->renderAjax('loginOperator', [
                'model' => $model,
            ]);
        }
    }
}
