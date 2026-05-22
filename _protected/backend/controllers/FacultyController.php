<?php

namespace backend\controllers;
use Yii;
use common\models\Faculty;
use common\models\FacultySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FacultyController implements the CRUD actions for Faculty model.
 */
class FacultyController extends BackendController
{
    /**
     * {@inheritdoc}
     */

    public function beforeAction($action) {
        $this->enableCsrfValidation = false; return parent::beforeAction($action); }
	
	   public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ]);
    }

    /**
     * Lists all Faculty models.
     * @return mixed
     */
    public function actionIndex()
    {
        $user=\common\models\User::find()
            ->where(['=', 'user.id', Yii::$app->user->id])
            ->one();
        if ($user->role_id == "theCreator"){
            $facultys = \common\models\Faculty::find()->where(['status'=>1])->all();
            return $this->render('index', [
                "faculty"=>$facultys,
            ]);
        }elseif($user->role_id == "Admin"){
            $facultys = \common\models\Faculty::find()->where(['uni_id'=>$user->uni_id, 'status'=>1])->all();
            return $this->render('index', [
                "faculty"=>$facultys,
            ]);
        }else{
            return $this->render('../site/error');
        }
    }
    public function actionDirection($id)
    {
        $user=\common\models\User::find()->where(['=', 'user.id', Yii::$app->user->id])->one();
        if ($user->role_id == "theCreator"){
            $direction = \common\models\Direction::find()->where(['faculty_id'=>$id, 'status'=>1])->all();
            return $this->render('direction',
                ['direction'=>$direction]
            );
        }elseif($user->role_id == "Admin"){
            $direction = \common\models\Direction::find()->where(['faculty_id'=>$id, 'status'=>1])
                ->andwhere(['uni_id'=>$user->uni_id])
                ->all();
            return $this->render('direction',
                ['direction'=>$direction]
            );
        }else{
            return $this->render('../site/error');
        }

    }
    public function actionGroup($id, $kurs_id)
    {
        $user=\common\models\User::find()->where(['=', 'user.id', Yii::$app->user->id])->one();
        if($user->role_id == "theCreator"){
            $cours = \common\models\Course::find()->where(['status'=>1])->all();
            if ($kurs_id == 0 ){
                $group = \common\models\Group::find()->where(['direction_id'=>$id,  'status'=>1])->all();
            }else{
                $group = \common\models\Group::find()->where(['direction_id'=>$id,  'status'=>1])->andWhere(['course_number'=>$kurs_id])->all();
            }
            return $this->render('group',['group'=>$group, 'cours'=>$cours]);
        }else if($user->role_id == "Admin"){
            $cours = \common\models\Course::find()->where(['uni_id'=>$user->uni_id, 'status'=>1])->all();
            if ($kurs_id == 0 ){
                $group = \common\models\Group::find()->where(['direction_id'=>$id,  'status'=>1])->andwhere(['uni_id'=>$user->uni_id])->all();
            }else{
                $group = \common\models\Group::find()->where(['direction_id'=>$id,  'status'=>1])->andWhere(['course_number'=>$kurs_id])->andwhere(['uni_id'=>$user->uni_id])->all();
            }
            return $this->render('group',['group'=>$group, 'cours'=>$cours]);
        }else{
            return $this->render('../site/error');
        }


    }
    public function actionStudent($group_id)
    {
        $user=\common\models\User::find()->where(['=', 'id', Yii::$app->user->id])->one();
        $student = \common\models\User::find()
        ->leftJoin('student', 'student.user_id = user.id')
        ->where(['student.group_id'=>$group_id,'user.status'=>10, 'uni_id'=>$user->uni_id])->all();

        // var_dump($student);exit();

        



        return $this->render('student',
            [
                'student'=>$student,
                'group_id'=>$group_id
            ]);
    }



    /**
     * Displays a single Faculty model.
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
     * Creates a new Faculty model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Faculty();
        $user=\common\models\User::find()
        ->where(['=', 'user.id', Yii::$app->user->id])->one();
        if ($model->load(Yii::$app->request->post())) {
            $model->uni_id = $user->uni_id;
            $model->save();
            return $this->redirect(['index', 'id' => $model->id]);
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }
    /**
     * Updates an existing Faculty model.
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
     * Deletes an existing Faculty model.
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
     * Finds the Faculty model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Faculty the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Faculty::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
