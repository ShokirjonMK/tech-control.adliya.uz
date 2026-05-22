<?php

namespace backend\controllers;

use Yii;
use common\models\Library;
use common\models\CategoryLib;
use common\models\LibrarySearch;
use common\models\CategoryLibSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;


class LibraryController extends BackendController
{

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }


    public function actionIndex()
    {
        $user=\common\models\User::find()->where(['=', 'user.id', Yii::$app->user->id])->one();

        if($user->role_id == "theCreator"){
            $fan = \common\models\Fan::find()->all();
            
            return $this->render('index', [
                'fan' => $fan,
                
            ]);

        }else if($user->role_id == "Admin"){

            $fan = \common\models\Fan::find()
                ->where(['uni_id'=>$user->uni_id])
                ->all();
            $course = \common\models\Course::find()
                ->where(['uni_id'=>$user->uni_id])
                ->all();

            return $this->render('index', [
                'fan' => $fan,
                'course' => $course,
            ]);

        }else if($user->role_id == "Teacher"){
            $time_table = \common\models\TimeTable::find()
                ->leftJoin('fan', 'fan.id = time_table.fan_id')
                ->where(['teacher_id'=>$user->id])
                ->groupBy(['fan_id'])
                ->select(['fan.id'])
                ->all();

            
            return $this->render('index', [
                'fan' => $time_table,
            ]);

        }else if($user->role_id == "Student"){

            $std = \common\models\Student::findOne(['user_id'=>$user->id]);

            $time_table = \common\models\TimeTable::find()
                ->leftJoin('fan', 'fan.id = time_table.fan_id')
                ->where(['group_id'=>$std->group_id])
                ->groupBy(['fan_id'])
                ->select(['fan.id', 'fan.name',])
                ->all();

            return $this->render('index', [
                'fan' => $time_table,
            ]);
        }else{
            return $this->render('../site/error');
        }

    }

    public function actionFan($id)
    {
        $user=\common\models\User::find()
            ->where(['=', 'user.id', Yii::$app->user->id])
            ->one();

        $fan = \common\models\Fan::findOne(['id'=>$id]);

        $course = \common\models\Course::find()
                ->where(['uni_id'=>$user->uni_id])
                ->all();

        $lib = \common\models\Library::find()
                ->where(['uni_id'=>$user->uni_id])
                ->andWhere(['fan_id'=>$fan->id])
                ->all();

        $categoryLib = \common\models\CategoryLib::find()
            ->where(['uni_id'=>$user->uni_id])
            ->andWhere(['fan_id'=>$fan->id])
            ->andWhere(['status'=>1])
            ->all();

        return $this->render('fan', [
            'fan' => $fan,
            'category' => $categoryLib,
            'lib' => $lib,
            'course' => $course,

        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    public function actionUploadfayl()
    {

$post = Yii::$app->request->post();

        $user = \common\models\User::find()
            ->where(['=', 'user.id', Yii::$app->user->id])
            ->one();

        $uni_id = $user->uni_id;

        $name = ($_POST["name"]);
        $category = ($_POST["category"]);
        $course_id = ($_POST["course"]);
        $fan_id = ($_POST["fan"]);
        // $file = ($_POST["Library[file]"]);

        $model = new Library();

        $model->file = UploadedFile::getInstance($model, 'file');

      
        if ($model->file != NUll) {
            $fayl = ((int) (microtime(true) * (1000))) . '.' . $model->file->extension;
            $model->file->saveAs("../uploads/library/" . $fayl);
        }

        $model->file = null;

        $model->status = 1;
        $model->uni_id = $user->uni_id;
        $model->category = $category;
        $model->user_id = $user->id;
        $model->course_id = $course_id;
        $model->fan_id = $fan_id;
        $model->name = $name;
        $model->fayl = $fayl;
        


        $model->save(false);
        
        return $this->redirect(['fan?id='.$fan_id]);
    }


    public function actionCreate($id)
    {
        $user = \common\models\User::find()
            ->where(['=', 'user.id', Yii::$app->user->id])
            ->one();

        $model = new CategoryLib();

        if ($model->load(Yii::$app->request->post())) {
            $model->fan_id = $id;
            $model->user_id = $user->id;
            $model->uni_id = $user->uni_id;
            $model->save();
            return $this->redirect(['fan', 'id' => $id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Library::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    public function actionList($id) {
        echo "<option> -Guruh tanlang-</option>";
        $client = \common\models\Group::find()->where(['course_number'=>$id])->all();
        foreach($client as $c){
            echo "<option value='".$c->id."'> $c->name </option>";
        }
    }
}