<?php

namespace backend\controllers;

use Symfony\Component\VarDumper\Cloner\Data;
use Yii;
use common\models\EduType;
use common\models\EduTypeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EduTypeController implements the CRUD actions for EduType model.
 */
class EduTypeController extends Controller
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
     * Lists all EduType models.
     * @return mixed
     */
    public function actionIndex()
    {
        $user=\common\models\User::find()->where(['=', 'user.id', Yii::$app->user->id])->one();
        if($user->role_id == "theCreator"){
            $courses = \common\models\EduType::find()->all();
            return $this->render('index', [
                'courses' => $courses,
            ]);
        }else if($user->role_id == "Admin"){
            $courses = \common\models\EduType::find()->where(['uni_id'=>$user->uni_id])->all();
            return $this->render('index', [
                'courses' => $courses,
            ]);
        }else{
            return $this->render('../site/error');
        }

    }

    /**
     * Displays a single EduType model.
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
     * Creates a new EduType model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new EduType();

        if ($model->load(Yii::$app->request->post())) {
            $user = \common\models\User::find()->where(['id'=>Yii::$app->user->id])->one();
            $model->uni_id = $user->uni_id;
            $model->created_at = date('Y-m-d H:i');
            $model->save();
            return $this->redirect(['index', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing EduType model.
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
     * Deletes an existing EduType model.
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
     * Finds the EduType model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EduType the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EduType::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
