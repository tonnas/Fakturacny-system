<?php

namespace backend\controllers;

use common\models\PermissionSearch;
use common\models\Role;
use common\models\RolesSearch;
use common\models\Permission;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class RoleController extends Controller
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
        $searchModel = new RolesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $model = Role::find()->all();
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
        $searchModel = new PermissionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $model = Permission::find()->all();

        return $this->render('view', [
            'dataProvider' => $dataProvider,
            'searchModel'  => $searchModel,
            'model'        => $model,
            'role'         => Role::findIdentity($id),
            'idOperator'   => Yii::$app->params['operator']
        ]);
    }

    /**
     *
     */
    public function actionViewRoles()
    {
        $searchModel = new RolesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $model = Role::find()->all();
        return $this->render('viewRoles', [
            'dataProvider' => $dataProvider,
            'searchModel'  => $searchModel,
            'model'        => $model,
        ]);
    }

    /**
     *
     */
    public function actionViewPermissions()
    {
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionCreateRole()
    {
        if (isset(Yii::$app->request->post('Role')['NAME'])) {
            $role = Role::findIdentity(Yii::$app->request->post('Role')['NAME']);
            if (is_null($role)) {
                $role = new Role();
                $role->NAME = Yii::$app->request->post('Role')['NAME'];
                $role->save();
            } else {
                \Yii::$app->getSession()->setFlash('warning', 'Rola s týmto menom už existuje.');
            }

            return $this->redirect(['index']);
        }

        return $this->renderAjax('createRole', [
            'role' => new Role()
        ]);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionCreatePermission()
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
//        if (($model = Invoice::findOne($id)) !== null) {
//            return $model;
//        } else {
//            throw new NotFoundHttpException('The requested page does not exist.');
//        }
    }
}