<?php

namespace backend\controllers;

use Yii;
use common\models\Para;
use common\models\ParaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class   ParaController extends BackendController
{
//    public function behaviors()
//    {
//        return [
//            'verbs' => [
//                'class' => VerbFilter::class,
//                'actions' => [
//                    'delete' => ['GET'],
//                ],
//            ],
//        ];
//    }

    public function actionIndex()
    {
        $user = \common\models\User::findOne(['id'=> Yii::$app->user->id]);

        if ($user->role_id == "theCreator"){
            $para = \common\models\Para::find()
                ->orderBy(['name' => SORT_ASC])
                ->all();
            return $this->render('index', [
                'para' => $para,
            ]);
        }elseif ( $user->role_id == "Admin"){
            $para = \common\models\Para::find()
                ->where(['uni_id'=>$user->uni_id])
                ->orderBy(['name' => SORT_ASC])
                ->all();
            return $this->render('index', [
                'para' => $para,
            ]);
        }
        else{
            return $this->render('../site/error');
        }
    }
    /**
     * Displays a single Para model.
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
     * Creates a new Para model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Para();

        $user=\common\models\User::find()
            ->where(['=', 'user.id', Yii::$app->user->id])
            ->one();
        if ($model->load(Yii::$app->request->post()) ) {
            $model->uni_id = $user->uni_id;
            $model->save();
            return $this->redirect('index');      
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Para model.
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
     * Deletes an existing Para model.
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
     * Finds the Para model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Para the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Para::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
