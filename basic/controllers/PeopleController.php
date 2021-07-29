<?php

namespace app\controllers;

use Yii;
use app\models\People;
use app\models\PeopleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use app\models\Roles;
/**
 * PeopleController implements the CRUD actions for People model.
 */
class PeopleController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
             'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                     [
                        'allow' => true,
                        'actions' => ['create', 'index', 'update'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create'],
                        'roles' => ['?'],
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all People models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PeopleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $user = People::find()->where(['id' => Yii::$app->user->getId()])->one();
        if($user->role==1){
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        }else{
            throw new \yii\web\HttpException(405, 'Доступ запрещен');
        }
    }

    /**
     * Creates a new People model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new People();

        if ($model->load(Yii::$app->request->post())) {
            $password = $model->password;
            $model->password = Yii::$app->security->generatePasswordHash($password);
            $model->role = 2;
            $model->save();
            return $this->redirect(['site/index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing People model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $all_roles = ArrayHelper::map(Roles::find()->all(), 'id', 'value');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
        $user = People::find()->where(['id' => Yii::$app->user->getId()])->one();
        if($user->role==1){
            return $this->render('update', [
                'model' => $model,
                'all_roles' => $all_roles,
            ]);
        }else{
            throw new \yii\web\HttpException(405, 'Доступ запрещен');
        }
    }

    /**
     * Deletes an existing People model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the People model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return People the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = People::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
