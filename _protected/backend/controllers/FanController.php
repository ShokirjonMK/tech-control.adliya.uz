<?php

namespace backend\controllers;

use Yii;
use common\models\Fan;
use common\models\FanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class FanController extends BackendController
{
    public function actionIndex()
    {
        $user = \common\models\User::findOne(['id'=> Yii::$app->user->id]);
        if ($user->role_id == "theCreator"){
            $fan = \common\models\Fan::find()->all();
            return $this->render('index', [
                'fan' => $fan,
            ]);
        }elseif ($user->role_id == "Admin"){
            $fan = \common\models\Fan::find()
                ->where(['uni_id'=>$user->uni_id])
                ->all();
            return $this->render('index', [
                'fan' => $fan,
            ]);
        }else{
            return $this->render('../site/error');
        }
    }
    /**
     * Displays a single Fan model.
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
     * Creates a new Fan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Fan();
        $user=\common\models\User::find()
            ->where(['=', 'user.id', Yii::$app->user->id])
            ->one();
        if ($model->load(Yii::$app->request->post()) ) {
            $model->uni_id = $user->uni_id;
            $model->save();
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    /**
     * Updates an existing Fan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
    /**
     * Deletes an existing Fan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $user = \common\models\User::findOne(['id'=>$id]);
        // $user->delete();
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    /**
     * Finds the Fan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Fan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Fan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
