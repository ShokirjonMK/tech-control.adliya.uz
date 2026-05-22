<?php

namespace backend\controllers;

use Yii;
use common\models\Group;
use common\models\GroupSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;



/**
 * GroupController implements the CRUD actions for Group model.
 */
class GroupController extends BackendController
{
    /**
     * {@inheritdoc}
     */
    /**
     * Lists all Group models.
     * @return mixed
     */
    public function actionIndex($id)
    {
        $user=\common\models\User::find()->where(['=', 'user.id', Yii::$app->user->id])->one();
        if ($user->role_id == "theCreator"){
            $guruh = \common\models\Group::find()->all();
            return $this->render('index', [
                'guruh' => $guruh,
            ]);
        }elseif ($user->role_id == "Admin"){
            $guruh = \common\models\Group::find()
                ->where(['status'=>1, 'direction_id'=>$id])
                ->andWhere(['uni_id'=>$user->uni_id])->all();
            return $this->render('index', [
                'guruh' => $guruh,
            ]);
        }
        else{
            return $this->render('../site/error');
        }
    }


    public function actionStatus($id1)
    {
        $kafedra = \common\models\Group::find()->where(['id'=>$id1])->one();
        $kafedra->status = 9;
        $kafedra->save();
        $id = Yii::$app->request->get('id');
        return $this->redirect('index?id='.$id);
    }

    public function actionEduType()
    {
        $user=\common\models\User::find()->where(['=', 'user.id', Yii::$app->user->id])->one();
        if($user->role_id == "theCreator" || $user->role_id == "Admin"){
            $user = \common\models\User::find()->where(['id'=>Yii::$app->user->id])->one();
            $courses = \common\models\EduType::find()->where(['status'=>1, 'uni_id'=>$user->uni_id])->all();
            return $this->render('edu-type', [
                'courses' => $courses,
            ]);
        }else if($user->role_id == "Admin"){
            $courses = \common\models\EduType::find()->where(['uni_id'=>$user->uni_id])->all();
            return $this->render('edu-type', [
                'courses' => $courses,
            ]);
        }else{
            return $this->render('../site/error');
        }

    }


//    public function actionEdutype()
//    {
//        $user=\common\models\User::find()
//            ->where(['=', 'user.id', Yii::$app->user->id])
//            ->one();
//
//        $eduType = \common\models\EduType::find()
//            ->where(['uni_id' => $user->uni_id])
//            ->all();
//
//        return $this->render('edutype',[
//            'eduType' => $eduType,
//        ]);
//    }
    public function actionFaculty()
    {
        $user=\common\models\User::find()
            ->where(['=', 'user.id', Yii::$app->user->id])
            ->one();
        if($user->role_id == "theCreator"){
            $faculties = \common\models\Faculty::find()
                ->where(['status'=>1])->all();

            return $this->render('faculty', [
                'faculties' => $faculties,
            ]);
        }else if($user->role_id == "Admin"){
            $faculties = \common\models\Faculty::find()
                ->andWhere(['uni_id'=>$user->uni_id])
                ->andWhere(['status'=>1])->all();
            return $this->render('faculty', [
                'faculties' => $faculties,
            ]);
        }else{
            return $this->render('../site/error');
        }
    }
    public function actionGroup()
    {
        $user=\common\models\User::find()->where(['=', 'user.id', Yii::$app->user->id])->one();
        if($user->role_id == "theCreator"){
            if (Yii::$app->request->post()){
                $user=\common\models\User::find()
                    ->where(['=', 'user.id', Yii::$app->user->id])
                    ->one();

                $faculty_id=($_POST["faculty_id"]);
                $groups = \common\models\Group::find()
                    ->andWhere(['faculty_id'=>$faculty_id])
                    ->andWhere(['status'=>1])
                    ->all();
                $courses = \common\models\Course::find()->all();
                $course = [];
                $data = [];
                foreach ($courses as $cone) {
                    $course['name'] = $cone->name.' - kurs';
                    $course['value'] = $cone->name;
                    $data[] = $course;
                }

                $kurs=($_POST["kurs"]);
                error_log(print_r($kurs, true));


                $semest=($_POST["semest"]);
                $check=($_POST["check"]);
                if(!$check){
                    return $this->redirect(['group', 'faculty_id'=> $faculty_id]);
                }
                foreach($check as $group_id => $check_value){
                    $group_one = \common\models\Group::find()
                        ->andWhere(['id'=>$group_id])
                        ->andWhere(['status'=>1])
                        ->one();
                    if($check_value == "1"){
                        $group_one->course_number = $kurs;

                        $group_one->smester = $semest;

                        $group_one->save();

                    }
                    else{
                    }
                }
                return $this->redirect(['group','faculty_id' => $faculty_id]);
            }
            else{
                $user=\common\models\User::find()
                    ->where(['=', 'user.id', Yii::$app->user->id])
                    ->one();
                $faculty_id=($_GET["faculty_id"]);
                $groups = \common\models\Group::find()
                    ->andWhere(['faculty_id'=>$faculty_id])
                    ->andWhere(['status'=>1])->all();
                $courses = \common\models\Course::find()->all();
                $course = [];
                $data = [];
                foreach ($courses as $cone) {
                    $course['name'] = $cone->name.' - kurs';
                    $course['value'] = $cone->name;
                    $data[] = $course;
                }

                return $this->render('group', [
                    'groups' => $groups,
                    'course' => $data,
                    'faculty_id' => $faculty_id,
                ]);
            }
        }else if($user->role_id == "Admin"){
            if (Yii::$app->request->post()){
                $user=\common\models\User::find()
                    ->where(['=', 'user.id', Yii::$app->user->id])
                    ->one();

                $faculty_id=($_POST["faculty_id"]);
                $groups = \common\models\Group::find()
                    ->andWhere(['uni_id'=>$user->uni_id])
                    ->andWhere(['faculty_id'=>$faculty_id])
                    ->andWhere(['status'=>1])
                    ->all();
                $courses = \common\models\Course::find()->where(['uni_id'=>$user->uni_id])->all();
                $course = [];
                $data = [];
                foreach ($courses as $cone) {
                    $course['name'] = $cone->name.' - kurs';
                    $course['value'] = $cone->name;
                    $data[] = $course;
                }

                $kurs=($_POST["kurs"]);
                error_log(print_r($kurs, true));


                $semest=($_POST["semest"]);
                $check=($_POST["check"]);
                if(!$check){
                    return $this->redirect(['group', 'faculty_id'=> $faculty_id]);
                }
                foreach($check as $group_id => $check_value){
                    $group_one = \common\models\Group::find()
                        ->andWhere(['id'=>$group_id])
                        ->andWhere(['status'=>1])
                        ->one();
                    if($check_value == "1"){
                        $group_one->course_number = $kurs;

                        $group_one->smester = $semest;

                        $group_one->save();

                    }
                    else{
                    }
                }
                return $this->redirect(['group','faculty_id' => $faculty_id]);
            }
            else{
                $user=\common\models\User::find()
                    ->where(['=', 'user.id', Yii::$app->user->id])
                    ->one();
                $faculty_id=($_GET["faculty_id"]);
                $groups = \common\models\Group::find()
                    ->andWhere(['uni_id'=>$user->uni_id])
                    ->andWhere(['faculty_id'=>$faculty_id])
                    ->andWhere(['status'=>1])->all();
                $courses = \common\models\Course::find()->where(['uni_id'=>$user->uni_id])->all();
                $course = [];
                $data = [];
                foreach ($courses as $cone) {
                    $course['name'] = $cone->name.' - kurs';
                    $course['value'] = $cone->name;
                    $data[] = $course;
                }

                return $this->render('group', [
                    'groups' => $groups,
                    'course' => $data,
                    'faculty_id' => $faculty_id,
                ]);
            }
        }else{
            return $this->render('../site/error');
        }

    }
    public function actionStudent($id)
    {
        $student = \common\models\Student::find()->where([ 'status'=>1, 'group_id'=>$id])->all();
        $group = \common\models\Group::find()
            ->where(['id'=>$id])
            ->one();
        return $this->render('student', ['student'=>$student, 'group'=>$group]);
    }



    /**
     * Displays a single Group model.
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
     * Creates a new Group model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $user=\common\models\User::find()
        ->where(['=', 'user.id', Yii::$app->user->id])
        ->one();
        $courses = \common\models\Course::find()->where(['uni_id'=>$user->uni_id])->all();

        $model = new Group();
        if ($model->load(Yii::$app->request->post())) {
            $model->uni_id = $user->uni_id;
            $model->save();
            if ($model->save()){
                return $this->redirect(['faculty/student', 'group_id' => $model->id]);
            }
        }
        return $this->render('create', [
            'model' => $model,
            'courses' =>$courses,
        ]);
    }

    /**
     * Updates an existing Group model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $user=\common\models\User::find()
            ->where(['=', 'user.id', Yii::$app->user->id])
            ->one();
        $courses = \common\models\Course::find()->where(['uni_id'=>$user->uni_id])->all();
        if ($model->load(Yii::$app->request->post())) {
            $model->save();
            if ($model->save()){
                return $this->redirect(['faculty/student', 'group_id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Group model.
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
     * Finds the Group model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Group the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionList($id) {

        $user=\common\models\User::find()
        ->where(['=', 'user.id', Yii::$app->user->id])
        ->one();

        $direction = \common\models\Direction::find()->andWhere(['faculty_id'=>$id])->andWhere(['uni_id'=>$user->uni_id])->all();


        if($direction){


                foreach($direction as $c){
                    echo "<option value='".$c->id."'> ".$c->name." </option>";
                }
        }

        else{
                echo "<option> Mutahasislik yo`q </option>";
        }

    }



    protected function findModel($id)
    {
        if (($model = Group::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
