<?php

namespace backend\controllers;

use common\models\ExamAnswerSearch;
use Yii;
use common\models\Exam;
use common\models\ExamSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ExamController implements the CRUD actions for Exam model.
 */
class ExamController extends BackendController
{
    /**
     * {@inheritdoc}
     */


    /**
     * Lists all Exam models.
     * @return mixed
     */
    public function actionIndex()
    {
        $user = \common\models\User::find()->where(['id'=>Yii::$app->user->id])->one();
        if($user->role_id == "theCreator"){
            $exam = \common\models\Exam::find()->where(['!=', 'status', 9])->orderBy(['sort'=>SORT_ASC])->all();
            return $this->render('index', [
                'exam' => $exam,
            ]);
        }else if($user->role_id == "Admin"){
            $exam = \common\models\Exam::find()->where(['!=', 'status', 9])->andWhere(['uni_id'=>$user->uni_id])->orderBy(['sort'=>SORT_ASC])->all();
            return $this->render('index', [
                'exam' => $exam,
            ]);
        }else{
            return $this->render('../site/error');
        }

    }

    public function actionYopish($id){
        $user = \common\models\User::find()->where(['id'=>Yii::$app->user->id])->one();
        if ($user->role_id == "theCreator" || $user->role_id == "Admin"){
            $exam = Exam::findOne($id)->status;
            if ($exam == 1){
                $a = 0;
            }elseif ($exam == 0){
                $a = 1;
            }
            $exam1 = Exam::findOne($id);
            $exam1->status = $a;
            $exam1->save();
            return $this->redirect('index');
        }
        else{
            return $this->render('../site/error');
        }
    }

    public function actionDel($id){
        $user = \common\models\User::find()->where(['id'=>Yii::$app->user->id])->one();
        if ($user->role_id == "theCreator" || $user->role_id == "Admin"){
            $exam = Exam::findOne($id)->status;
            $a=9;
            $exam1 = Exam::findOne($id);
            $exam1->status = $a;
            $exam1->save();
            return $this->redirect('index');
        }
        else{
            return $this->render('../site/error');
        }
    }

    public function actionView($id)
    {

        $user = \common\models\User::find()->where(['id'=>Yii::$app->user->id])->one();
        if ($user->role_id == "theCreator" || $user->role_id == "Admin"){

            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
        else{
            return $this->render('../site/error');
        }

    }

    /**
     * Creates a new Exam model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $user = \common\models\User::find()->where(['id'=>Yii::$app->user->id])->one();
        if ($user->role_id == "theCreator" || $user->role_id == "Admin"){

            $model = new Exam();
            if ($model->load(Yii::$app->request->post())) {
                $user=\common\models\User::find()->where(['=', 'user.id', Yii::$app->user->id])->one();
                $model->uni_id = $user->uni_id;
                $model->save();
                return $this->redirect(['index', 'id' => $model->id]);
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
     * Updates an existing Exam model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $user = \common\models\User::find()->where(['id'=>Yii::$app->user->id])->one();
        if ($user->role_id == "theCreator" || $user->role_id == "Admin"){
            $model = $this->findModel($id);
            if ($model->load(Yii::$app->request->post())) {
                $model->save();
                return $this->redirect(['index', 'id' => $model->id]);
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
     * Deletes an existing Exam model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        
            $model = $this->findModel($id);
            if ($model->load(Yii::$app->request->post())) {
                $model->status = 9;
                $model->save();
                return $this->redirect(['index', 'id' => $model->id]);
            }
                   
        return $this->redirect(['index']);
    }

    /**
     * Finds the Exam model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Exam the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Exam::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
