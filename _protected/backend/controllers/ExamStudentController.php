<?php

namespace backend\controllers;

use common\models\Exam;
use Yii;
use common\models\ExamStudent;
use common\models\ExamStudentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ExamStudentController implements the CRUD actions for ExamStudent model.
 */
class ExamStudentController extends BackendController
{
    /**
     * {@inheritdoc}
     */



    public function actionIndex($group_id)
    {
        $user = \common\models\User::find()->where(['id'=>Yii::$app->user->id])->one();
        $teacher = \common\models\TimeTable::find()
            ->where(['teacher_id'=>$user->id])
            ->andWhere(['group_id'=>$group_id])->one();

        if ($user->role_id == "theCreator" ||$user->role_id == "Admin" || ($user->role_id == "Teacher" && $teacher)){

            $student = \common\models\Student::find()->where(['group_id'=>$group_id])->all();

            // echo "<pre>";
            //     print_r($student);
            //     echo "</pre>";
            //     exit;
            return $this->render('index', [
                'student' => $student,
            ]);
        }
        else{
            return $this->render('../site/error');
        }
    }
    public function actionGroups()
    {
        $user=\common\models\User::find()->where(['=', 'user.id', Yii::$app->user->id])->one();
        if ($user->role_id == 'theCreator') {
            $exam_student = \common\models\TimeTable::find()
                ->leftJoin('group', 'group.id = time_table.group_id')
                ->select(['group_id', 'fan_id', 'group.smester'])
                //->where(['group.uni_id'=>$user->uni_id])
                // ->andWhere(['group.smester'=>'time_table.smester'])
                ->groupBy(['group_id', 'fan_id', 'group.smester'])
                ->all();
        }elseif ($user->role_id == 'Admin'){
            $exam_student = \common\models\TimeTable::find()
                ->leftJoin('group', 'group.id = time_table.group_id')
                ->select(['group_id', 'fan_id', 'group.smester','time_table.smester'])
                ->where(['group.uni_id'=>$user->uni_id])
                // ->andWhere(['group.smester'=>'time_table.smester'])
                ->groupBy(['group_id', 'fan_id', 'group.smester'])
                ->all();
        }elseif ($user->role_id == 'Teacher'){
            $exam_student = \common\models\TimeTable::find()
                ->leftJoin('exam_name', 'exam_name.id = exam_permission.exam_name_id')
                ->select(['group_id', 'fan_id', 'group.smester'])
                ->andWhere(['teacher_id'=>'group.smester'])
                // ->andWhere(['group.smester'=>'time_table.smester'])
                ->groupBy(['group_id', 'fan_id', 'group.smester'])
                ->all();
        }
        return $this->render('groups', [
            'groups' => $exam_student,
        ]);
    }
    public function actionReting($group_id)
    {
        $fan_id = Yii::$app->request->get('fan_id');
        $group=\common\models\Group::find()->where(['id'=>$group_id])->one();
        $user=\common\models\User::find()->where(['id'=>Yii::$app->user->id])->one();
        foreach ($_POST as $key=>$index) {
            $result = (explode("mark",$key));
            $student_id=($result[0]);
            $exam_id=($result[1]);
            $answer=(int)$index;
            $examfan=Exam::find()
                ->where(['id'=>$exam_id])->all();
            foreach ($examfan as $k) {
                $mark=(float)($k->mark);
            }
            $exam_student= ExamStudent::find()
                ->where(['exam_id'=>$exam_id, 'smester'=>$group->smester])
                ->andWhere(['=', 'student_id', $student_id])
                ->andWhere(['fan_id'=>$fan_id])
                ->all();
            if(empty($exam_student)){
                if ($answer != null) {
                    $model=new ExamStudent();
                    $model->student_id = $student_id;
                    $model->exam_id = $exam_id;
                    $model->mark = $answer;
                    $model->group_id = $group->id;
                    $model->uni_id = $user->uni_id;
                    $model->fan_id = $fan_id;
                    $model->smester = $group->smester;
                    $model->status = 1;
                    $model->user_create = $user->id;
                    $model->create_date = date('Y-m-d H:i');
                    $model->save();
                }
            }else{
                foreach($exam_student as $es){
                    $exam_student_id=$es->id;

                    if ($es->mark != $answer){
                        $exam_student=\common\models\ExamStudent::findOne($exam_student_id);
                        $exam_student->user_update = $user->id;
                        $exam_student->update_date = date('Y-m-d H:i');
                        $model->status = 1;
                        $exam_student->save();
                    }
                }
                $exam_student=\common\models\ExamStudent::findOne($exam_student_id);
                $exam_student->student_id = $student_id;
                $exam_student->exam_id = $exam_id;
                $exam_student->mark = $answer;
                $exam_student->group_id = $group->id;
                $exam_student->uni_id = $user->uni_id;
                $exam_student->fan_id = $fan_id;
                $model->status = 1;
                $exam_student->smester = $group->smester;
                $exam_student->save();
            }
        }
        return $this->redirect('index?group_id='.$group_id.'&fan_id='.$fan_id);

    }
    public function actionExams()
    {
        $user=\common\models\User::find()
            ->where(['=', 'user.id', Yii::$app->user->id])
            ->one();
        $exam_student = \common\models\ExamStudent::find()->where(['uni_id'=>$user->uni_id])->all();
        return $this->render('exams', [
            'exam_student' => $exam_student,
        ]);
    }
    /**
     * Displays a single ExamStudent model.
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
     * Creates a new ExamStudent model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ExamStudent();

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
    /**
     * Updates an existing ExamStudent model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
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
    /**
     * Deletes an existing ExamStudent model.
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
     * Finds the ExamStudent model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ExamStudent the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ExamStudent::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionIndexa($group_id, $fan_id){
        return $this->render('mark');
    }
    public function actionMark($group_id, $fan_id){
        return $this->render('mark');
    }
}
