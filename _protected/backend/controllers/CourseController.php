<?php

namespace backend\controllers;

use Yii;
use common\models\Course;
use common\models\CourseSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CourseController implements the CRUD actions for Course model.
 */
class CourseController extends BackendController
{
    /**
     * {@inheritdoc}
     */


    /**
     * Lists all Course models.
     * @return mixed
     */
    public function actionIndex()
    {
        $user=\common\models\User::find()->where(['=', 'user.id', Yii::$app->user->id])->one();
        if($user->role_id == "theCreator"){
            $courses = \common\models\Course::find()->all();
            return $this->render('index', [
                'courses' => $courses,
            ]);
        }else if($user->role_id == "Admin"){
            $courses = \common\models\Course::find()->where(['uni_id'=>$user->uni_id])->all();
            return $this->render('index', [
                'courses' => $courses,
            ]);
        }else{
            return $this->render('../site/error');
        }

    }

    /**
     * Displays a single Course model.
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
     * Creates a new Course model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $user=\common\models\User::find()->where(['=', 'user.id', Yii::$app->user->id])->one();
        if ($user->role_id == "theCreator" ||$user->role_id == "Admin"){
            $model = new Course();
            if ($model->load(Yii::$app->request->post())){
                $model->uni_id = $user->uni_id;
                $model->save();
                return $this->redirect(['index']);
            }
            return $this->render('create', [
                'model' => $model,
            ]);
        }
        else{
            return $this->render('../site/error');
        }


    }

    /**
     * Updates an existing Course model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $user=\common\models\User::find()->where(['=', 'user.id', Yii::$app->user->id])->one();
        if ($user->role_id == "theCreator" ||$user->role_id == "Admin"){
            $model = $this->findModel($id);
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['index']);
            }
            return $this->render('update', [
                'model' => $model,
            ]);
        }
        else{
            return $this->render('../site/error');
        }


    }

    /**
     * Deletes an existing Course model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {

        $user=\common\models\User::find()->where(['=', 'user.id', Yii::$app->user->id])->one();
        if ($user->role_id == "theCreator" ||$user->role_id == "Admin"){
            $this->findModel($id)->delete();
            return $this->redirect(['index']);
        }
        else{
            return $this->render('../site/error');
        }

    }

    /**
     * Finds the Course model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Course the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Course::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}