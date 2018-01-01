<?php

namespace backend\controllers;

use common\models\PermissionSearch;
use common\models\Role;
use common\models\RolesSearch;
use common\models\Permission;
use Yii;
use yii\data\ActiveDataProvider;
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
        $dataPermissions = new ActiveDataProvider([
            'query' => Permission::find()->where(['ROLE_NAME' => 'All']),
        ]);
        $model = Role::find()->all();

        return $this->render('index', [
            'dataProvider'    => $dataProvider,
            'dataPermissions' => $dataPermissions,
            'searchModel'  => $searchModel,
            'model'        => $model,
            'idOperator'   => Yii::$app->params['operator']
        ]);
    }

    /**
     * @param $id
     * @return string
     */
    public function actionUpdate($id)
    {
        if (!empty(Yii::$app->request->post('permissions'))) {
            if ($id != 'All') {
                Permission::deleteAll(['ROLE_NAME' => $id]);
                $permissions = Yii::$app->request->post('permissions');
                foreach ($permissions as $permission) {
                    $new_permission = new Permission();
                    $new_permission->ROLE_NAME = $id;
                    $new_permission->NAME      = $permission;
                    $new_permission->save();
                }
                \Yii::$app->getSession()->setFlash('success', 'Opravnenie upravene.');
            }

            return $this->redirect(['index']);
        }

        $searchModel = new PermissionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('update', [
            'dataProvider' => $dataProvider,
            'searchModel'  => $searchModel,
            'model'        => Permission::find()->all(),
            'role'         => Role::findIdentity($id),
            'idOperator'   => Yii::$app->params['operator'],
            'permissions'  => Permission::find(),
            'role_permissions' => Role::getPermissions($id)
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
        if (isset(Yii::$app->request->post('Permission')['NAME'])) {
            $permission = Permission::findOne(['NAME' => Yii::$app->request->post('Permission')['NAME']]);
            if (is_null($permission)) {
                $permission            = new Permission();
                $permission->ROLE_NAME = 'All';
                $permission->NAME      = Yii::$app->request->post('Permission')['NAME'];
                $permission->save();
            } else {
                \Yii::$app->getSession()->setFlash('warning', 'Opravnenie s týmto menom už existuje.');
            }
            \Yii::$app->getSession()->setFlash('success', 'Opravnenie vytvorene.');

            return $this->redirect(['index']);
        }

        return $this->renderAjax('createPermission', [
            'permission' => new Permission()
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
//        if (($model = Invoice::findOne($id)) !== null) {
//            return $model;
//        } else {
//            throw new NotFoundHttpException('The requested page does not exist.');
//        }
    }
}