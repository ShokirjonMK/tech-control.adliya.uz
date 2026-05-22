<?php

namespace backend\controllers;

use Yii;
use common\models\Direction;
use common\models\Faculty;
use common\models\DirectionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DirectionController implements the CRUD actions for Direction model.
 */
class DirectionController extends BackendController
{
    /**
     * {@inheritdoc}
     */


    /**
     * Lists all Direction models.
     * @return mixed
     */
    public function actionIndex()
    {
        $user = \common\models\User::find()->where(['id'=>Yii::$app->user->id])->one();

        if($user->role_id == "theCreator"){
            $direction = \common\models\Direction::find()->where(['status'=>1])->all();
            return $this->render('index', [
                'direction' => $direction,
            ]);
        }else if($user->role_id == "Admin"){
            $direction = \common\models\Direction::find()->where(['uni_id'=>$user->uni_id, 'status'=>1])->all();
            return $this->render('index', [
                'uni_id' => $user->uni_id,
                'direction' => $direction,
            ]);
        }else{
            return $this->render('../site/error');
        }

    }

    /**
     * Displays a single Direction model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
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
     public function actionGroup($id)
    {
        $user=\common\models\User::find()
            ->where(['=', 'user.id', Yii::$app->user->id])->one();
        if ($user->role_id == "theCreator"){
            $guruh = \common\models\Group::find()
                ->andWhere(['direction_id'=>$id])
                ->all();
            return $this->render('group', [
                'guruh' => $guruh,
            ]);
        }elseif ($user->role_id == "Admin"){
            $guruh = \common\models\Group::find()
                ->where(['uni_id'=>$user->uni_id])
                ->andWhere(['direction_id'=>$id])
                ->all();
            return $this->render('group', [
                'guruh' => $guruh,
            ]);
        }
        else{
            return $this->render('../site/error');
        }
    }

    /**
     * Creates a new Direction model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $user = \common\models\User::find()->where(['id'=>Yii::$app->user->id])->one();
        if ($user->role_id == "theCreator" || $user->role_id == "Admin"){
            $id = Yii::$app->request->get('id');
            $model = new Direction();
            $user=\common\models\User::find()
                ->where(['=', 'user.id', Yii::$app->user->id])->one();
            if ($model->load(Yii::$app->request->post())) {
                if (!$user->uni_id == 4){
                    $model->faculty = 'Markaz';

                $model->uni_id = $user->uni_id;
                $model->save();
                return $this->redirect(['faculty/direction',   'id' => $id]);
            }
            return $this->render('create', [
                'model' => $model,
            ]);
        }
        else{
            return $this->render('../site/error');
        }

}
    }


    public function actionCreate1()
    {
        $user = \common\models\User::find()->where(['id'=>Yii::$app->user->id])->one();
        if ($user->role_id == "theCreator" || $user->role_id == "Admin"){
            $model = new Direction();
            $user=\common\models\User::find()
                ->where(['=', 'user.id', Yii::$app->user->id])->one();
            if ($model->load(Yii::$app->request->post())) {
                $model->uni_id = $user->uni_id;

                if ($user->uni_id == 4) {
                    $model->faculty_id = 9;
                }
                $model->save();
// echo "<pre>".print_r($model->errors, true); die;
                return $this->redirect('index');
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
     * Updates an existing Direction model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {

        $user = \common\models\User::find()->where(['id'=>Yii::$app->user->id])->one();
        if ($user->role_id == "theCreator" || $user->role_id == "Admin"){
            $id1 = Yii::$app->request->get('id1');
            $model = $this->findModel($id);
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['faculty/direction', 'id' => $id1]);
            }
            return $this->render('update', [
                'model' => $model,
            ]);
        }
        else{
            return $this->render('../site/error');
        }


    }
    public function actionUpdate1($id)
    {
        $user = \common\models\User::find()->where(['id'=>Yii::$app->user->id])->one();
        if ($user->role_id == "theCreator" || $user->role_id == "Admin"){
            $model = $this->findModel($id);
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
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
     * Deletes an existing Direction model.
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
     * Finds the Direction model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Direction the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Direction::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
