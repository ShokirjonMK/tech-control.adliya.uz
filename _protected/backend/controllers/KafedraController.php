<?php

namespace backend\controllers;

use Yii;
use common\models\Kafedra;
use common\models\KafedraSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * KafedraController implements the CRUD actions for Kafedra model.
 */
class KafedraController extends BackendController
{
    /**
     * {@inheritdoc}
     */
//    public function behaviors()
//    {
//        return [
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'delete' => ['POST'],
//                ],
//            ],
//        ];
//    }

    /**
     * Lists all Kafedra models.
     * @return mixed
     */
    public function actionIndex()
    {
        $user = \common\models\User::find()->where(['id'=>Yii::$app->user->id])->one();
        if ($user->role_id == "theCreator"){
            $kafedra = \common\models\Kafedra::find()->all();
            return $this->render('index', [
                'kafedra' => $kafedra,
            ]);
        }elseif ($user->role_id == "Admin"){
            $kafedra = \common\models\Kafedra::find()->where(['uni_id'=>$user->uni_id, 'status'=>1])->all();
            return $this->render('index', [
                'kafedra' => $kafedra,
            ]);
        }
        else{
            return $this->render('../site/error');
        }
    }

    /**
     * Displays a single Kafedra model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    public function actionStatus($id)
    {
//        exit();
        $kafedra = \common\models\Kafedra::find()->where(['id'=>$id])->one();
        $kafedra->status = 9;
        $kafedra->save();
        return $this->redirect('index');
    }

    /**
     * Creates a new Kafedra model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Kafedra();
        $user = \common\models\User::find()->where(['id'=>Yii::$app->user->id])->one();
        if ($model->load(Yii::$app->request->post())) {
            $model->uni_id = $user->uni_id;
            $model->save();
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Kafedra model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Kafedra model.
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
     * Finds the Kafedra model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Kafedra the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Kafedra::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
