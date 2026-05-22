<?php

namespace backend\controllers;

use Yii;
use common\models\Degree;
use common\models\DegreeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DegreeController implements the CRUD actions for Degree model.
 */
class DegreeController extends Controller
{
    /**
     * {@inheritdoc}
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
     * Lists all Degree models.
     * @return mixed
     */
    public function actionIndex()
    {
        $user=\common\models\User::find()->where(['=', 'user.id', Yii::$app->user->id])->one();
        if($user->role_id == "theCreator"){
            $degree = \common\models\Degree::find()->where(['status'=>1])->all();
            return $this->render('index', [
                'degree' => $degree,
            ]);
        }else if($user->role_id == "Admin"){
            $degree = \common\models\Degree::find()->where(['uni_id'=>$user->uni_id])->all();
            return $this->render('index', [
                'degree' => $degree,
            ]);
        }else{
            return $this->render('../site/error');
        }

    }

    /**
     * Displays a single Degree model.
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

    /**
     * Creates a new Degree model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Degree();
        if ($model->load(Yii::$app->request->post())) {
            $user = \common\models\User::find()->where(['id'=>Yii::$app->user->id])->one();
            $model->uni_id = $user->uni_id;
            $model->created_at = date('Y-m-d');
            $model->save();
            return $this->redirect(['index', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Degree model.
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
     * Deletes an existing Degree model.
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
     * Finds the Degree model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Degree the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Degree::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
