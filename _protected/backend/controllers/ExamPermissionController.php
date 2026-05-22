<?php

namespace backend\controllers;

use common\models\Direction;
use common\models\ExamCheck;
use common\models\ExamName;
use Yii;
use common\models\ExamPermission;
use common\models\ExamPermissionSearch;
use common\models\ExamQuestion;
use VARIANT;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

new yii\db\Query();

/**
 * ExamPermissionController
 */
class ExamPermissionController extends BackendController
{
    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {


        $user = \common\models\User::find()
            ->where(['=', 'user.id', Yii::$app->user->id])
            ->one();
        if ($user->role_id == "theCreator" || $user->role_id == "Admin"){
            $uni_id = $user->uni_id;
            $exam_name = \common\models\ExamName::find()
                ->where(['uni_id' => $user->uni_id])
                ->andWhere(['!=', 'status', 9])
                ->orderBy(['id' => SORT_DESC])
                ->all();

            $faculty = \common\models\Faculty::find()
                ->where(['=', 'uni_id', $uni_id])
                ->all();

            $direction = \common\models\Direction::find()
                ->where(['=', 'uni_id', $uni_id])
                ->all();

            $course = \common\models\Course::find()
                ->where(['=', 'uni_id', $uni_id])
                ->all();

            $group = \common\models\Group::find()
                ->where(['=', 'uni_id', $uni_id])
                ->all();

            $exam = \common\models\Exam::find()
                ->where(['=', 'uni_id', $uni_id])
                ->all();

            return $this->render(
                'index',
                [
                    'exam_name' => $exam_name,
                    'faculty' => $faculty,
                    'direction' => $direction,
                    'course' => $course,
                    'group' => $group,
                    'exam' => $exam,
                ]
            );
        }
        else{
            return $this->render('../site/error');
        }

    }

    public function actionExamName($id)
    {
        $user = \common\models\User::find()->where(['id'=>Yii::$app->user->id])->one();
        if ($user->role_id == "theCreator" || $user->role_id == "Admin"){

            $user = \common\models\User::find()
                ->where(['=', 'user.id', Yii::$app->user->id])
                ->one();

            $uni_id = $user->uni_id;

            $faculty = \common\models\Faculty::find()
                ->where(['=', 'uni_id', $uni_id])
                ->all();

            $exam_name_new = \common\models\ExamName::find()
                ->where(['=', 'uni_id', $uni_id])
                ->andWhere(['!=', 'status', 9])
                ->all();
            $direction = \common\models\Direction::find()
                ->where(['=', 'uni_id', $uni_id])
                ->all();
            $course = \common\models\Course::find()
                ->where(['=', 'uni_id', $uni_id])
                ->all();
            $group = \common\models\Group::find()
                ->where(['=', 'uni_id', $uni_id])
                ->all();
            $exam = \common\models\Exam::find()
                ->where(['=', 'uni_id', $uni_id])
                ->all();

            $examt = \common\models\ExamName::find()
                ->where(['=', 'uni_id', $uni_id])
                ->andWhere(['=', 'id', $id])
                ->one();

            $exam_permission = \common\models\ExamPermission::find()
                ->leftJoin('exam_name', 'exam_name.id = exam_permission.exam_name_id')
                ->where(['=', 'exam_name.uni_id', $uni_id])
                ->andWhere(['exam_name_id' => $id])
                ->orderBy(['id' => SORT_ASC])
                ->all();

            $fanlar = \common\models\Fan::find()
                ->leftJoin('exam_permission', 'fan.id = exam_permission.fan_id')
                ->where(['=', 'fan.uni_id', $uni_id])
                ->andWhere(['exam_permission.exam_name_id' => $id])
                ->orderBy(['exam_permission.fan_id' => SORT_ASC])
                ->all();

            $groups = \common\models\Group::find()
                ->leftJoin('exam_permission', 'group.id = exam_permission.group_id')
                ->where(['=', 'group.uni_id', $uni_id])
                ->andWhere(['exam_permission.exam_name_id' => $id])
                ->orderBy(['exam_permission.group_id' => SORT_ASC])
                ->all();

                // echo "<pre>";
                // print_r($groups);
                // echo "</pre>";
                // exit;
            $fan = \common\models\Fan::find()
                ->where(['=', 'uni_id', $uni_id])
                ->all();

            return $this->render('exam-name', [
                'faculty' => $faculty,
                'direction' => $direction,
                'course' => $course,
                'fan' => $fan,
                'fanlar' => $fanlar,
                'group' => $groups,
                // 'groups' => $groups,
                'exam' => $exam,
                'examt' => $examt,
                'exam_name_new' => $exam_name_new,
                'exam_permission' => $exam_permission,
            ]);
        }
        else{
            return $this->render('../site/error');
        }



    }
    public function actionQuestion()
    {
        $user = \common\models\User::find()
            ->where(['=', 'user.id', Yii::$app->user->id])
            ->one();
        $uni_id = $user->uni_id;
        $faculty = \common\models\Faculty::find()
            ->where(['=', 'uni_id', $uni_id])
            ->all();
        $exam_name_new = \common\models\ExamName::find()
            ->where(['uni_id'=>$uni_id,])
            ->andWhere(['!=', 'status', 9])
            ->all();
        $direction = \common\models\Direction::find()
            ->where(['=', 'uni_id', $uni_id])
            ->all();
        $course = \common\models\Course::find()
            ->where(['=', 'uni_id', $uni_id])
            ->all();
        $group = \common\models\Group::find()
            ->where(['=', 'uni_id', $uni_id])
            ->all();
        $exam = \common\models\Exam::find()
            ->where(['=', 'uni_id', $uni_id])
            ->all();
        $exam_question = \common\models\ExamQuestion::find()
            ->leftJoin('exam_name', 'exam_name.id = exam_question.exam_name_id')
            ->where(['=', 'exam_name.uni_id', $uni_id])
            ->orderBy(['id' => SORT_DESC])
            ->all();
        $fan = \common\models\Fan::find()
            ->where(['=', 'uni_id', $uni_id])
            ->all();
        $model = new ExamQuestion();
        return $this->render('question', [
            'faculty' => $faculty,
            'direction' => $direction,
            'course' => $course,
            'group' => $group,
            'exam' => $exam,
            'fan' => $fan,
            'model' => $model,
            'exam_name_new' => $exam_name_new,
            'exam_question' => $exam_question,
        ]);
    }
    public function actionStore()
    {
        $user = \common\models\User::find()
            ->where(['=', 'user.id', Yii::$app->user->id])
            ->one();
        $uni_id = $user->uni_id;
        $title = ($_POST["title"]);
        $exam_id = ($_POST["exam_name"]);
        $start_date = ($_POST["start_date"]);
        $finish_date = ($_POST["finish_date"]);
        $group = ($_POST["group"]);
        $fanlar = ($_POST["fanlar"]);
        $exam_permission = new ExamPermission();
        $exam_name = new ExamName();
        $exam_name->title = $title;
        $exam_name->uni_id = $uni_id;
        $exam_name->status = 1;
        $exam_name->save();
        $exam_name_id = ($exam_name->id);
        foreach ($group as $gr) {
            $group_new = \common\models\Group::find()
                ->where(['=', 'id', $gr])
                ->one();
            $faculty_id = $group_new->faculty_id;
            $direction_id = $group_new->direction_id;
            $course_number = $group_new->course_number;
            $group_id = $group_new->id;
            foreach ($fanlar as $fan_id) {
                $exam_permission = new ExamPermission();
                $exam_permission->faculty_id = $faculty_id;
                $exam_permission->direction_id = $direction_id;
                $exam_permission->group_id = $group_id;
                $exam_permission->fan_id = $fan_id;
                $exam_permission->exam_id = $exam_id;
                $exam_permission->start_date = $start_date;
                $exam_permission->finish_date = $finish_date;
                $exam_permission->exam_name_id = $exam_name_id;
                $exam_permission->course_number_id = $course_number;
                $exam_permission->status = 1;
                $exam_permission->save();
            }
        }
        return $this->redirect(['index']);
    }
    public function actionQuestionstore()
    {

        $user = \common\models\User::find()
            ->where(['=', 'user.id', Yii::$app->user->id])
            ->one();
        $uni_id = $user->uni_id;
        $exam_name_id = ($_POST["exam_name_id"]);
        $group = ($_POST["group"]);
        $fan_id = ($_POST["fan"]);


        $model = new ExamQuestion();
        $model->file = UploadedFile::getInstance($model, 'file');
        if ($model->file != NUll) {
            $filename = ((int) (microtime(true) * (1000))) . '.' . $model->file->extension;
            $model->file->saveAs("../uploads/question/" . $filename);
        }


        $model->file = null;
        foreach ($group as $gr) {
            $group_new = \common\models\Group::find()
                ->where(['=', 'id', $gr])
                ->one();

            $exam_question_group = \common\models\ExamQuestion::find()
                ->where(['=', 'group_id', $gr])
                ->andWhere(['=', 'fan_id', $fan_id])
                ->andWhere(['=', 'exam_name_id', $exam_name_id])
                ->one();


// echo "<pre>";
// print_r($exam_question_group);
// echo "</pre>";
// exit;

            if (!$exam_question_group) {
                $exam_question = new ExamQuestion();
                $exam_question->faculty_id =  $group_new->faculty_id;
                $exam_question->direction_id = $group_new->direction_id;
                $exam_question->group_id = $gr;
                $exam_question->fan_id = $fan_id;
                $exam_question->exam_name_id = $exam_name_id;
                $exam_question->title = $exam_name_id;
                $exam_question->file_pdf = $filename;
                $exam_question->status = 1;
                $exam_question->errors;
                $exam_question->save();

// echo "<pre>".print_r($exam_question->errors, true); die;

            } else {
                $exam_question_group->file_pdf = $filename;
                $exam_question_group->save();
            }
        }
        return $this->redirect(['exam-name?id='.$exam_name_id]);
    }
    public function actionDel($id)
    {
        $exam_name = \common\models\ExamName::findOne($id);
        $exam_permission = \common\models\ExamPermission::findAll(['exam_name_id' => $id]);
            $exam_name->status = 9;
        $exam_question = \common\models\ExamQuestion::find()
            ->where(['exam_name_id'=>$exam_name->id])
            ->all();

        $exam_name->save();

        foreach ($exam_permission as $permissions) {
                $permissions->status = 9;
            $permissions->save();
        }
        foreach ($exam_question as $e_q) {

            $e_q->delete();
        }
        return $this->redirect('index');
    }

    public function actionRuxsat($id)
    {
        $exam_name = \common\models\ExamName::findOne($id);
        $exam_permission = \common\models\ExamPermission::findAll(['exam_name_id' => $id]);
        if ($exam_name->status == 1) {
            $exam_name->status = 0;
        } elseif ($exam_name->status == 0) {
            $exam_name->status = 1;
        }
        $exam_name->save();

        foreach ($exam_permission as $permissions) {
            if ($permissions->status == 1) {
                $permissions->status = 0;
            } elseif ($permissions->status == 0) {
                $permissions->status = 1;
            }
            $permissions->save();
        }
        return $this->redirect('index');
    }

    public function actionRuxsat1($id, $id1)
    {
        $exam_permission = \common\models\ExamPermission::findOne($id);
        if ($exam_permission->status == 1) {
            $exam_permission->status = 0;
        } elseif ($exam_permission->status == 0) {
            $exam_permission->status = 1;
        }
        $exam_permission->save();
        return $this->redirect('exam-name?id=' . $id1);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new ExamPermission();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $user = \common\models\User::find()
            ->where(['=', 'user.id', Yii::$app->user->id])
            ->one();
        $uni_id = $user->uni_id;
        $exam_permission = \common\models\ExamPermission::find()
            ->where(['=', 'id', $id])
            ->one();
        $faculty = \common\models\Faculty::find()
            ->where(['=', 'id', $exam_permission->faculty_id])
            ->one();
        $direction = \common\models\Direction::find()
            ->where(['=', 'id', $exam_permission->direction_id])
            ->one();
        $course = \common\models\Course::find()
            ->where(['=', 'id', $exam_permission->course_number_id])
            ->one();
        $group = \common\models\Group::find()
            ->where(['=', 'id', $exam_permission->group_id])
            ->one();
        $exam = \common\models\Exam::find()
            ->where(['=', 'id', $exam_permission->exam_id])
            ->one();
        $exam_name = \common\models\ExamName::find()
            ->where(['=', 'id', $exam_permission->exam_name_id])
            ->one();
        $fan = \common\models\Fan::find()
            ->where(['=', 'id', $exam_permission->fan_id])
            ->one();


        $searchModel = new ExamPermissionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('update', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'faculty' => $faculty,
            'direction' => $direction,
            'course' => $course,
            'group' => $group,
            'exam' => $exam,
            'fan' => $fan,
            'exam_name' => $exam_name,
            'exam_permission' => $exam_permission,
        ]);
    }
    public function actionEdit()
    {
        $user = \common\models\User::find()
            ->where(['=', 'user.id', Yii::$app->user->id])
            ->one();
        $uni_id = $user->uni_id;
        $id = ($_POST["id"]);
        $start_date = ($_POST["start_date"]);
        $finish_date = ($_POST["finish_date"]);

        $exam_permission = \common\models\ExamPermission::find()
            ->where(['=', 'id', $id])
            ->one();

        $examNameId = $exam_permission->exam_name_id;

        $exam_permission->start_date = $start_date;
        $exam_permission->finish_date = $finish_date;
        $exam_permission->save();

        return $this->redirect(['exam-name', 'id' => $examNameId]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', "Ma`lumot o`chirildi!");
        return $this->redirect(['index']);
    }
    public function actionQuestiondelete($id)
    {
        $exam_question_group = \common\models\ExamQuestion::find()
            ->where(['=', 'id', $id])
            ->one();
        $exam_question_group->delete();
        Yii::$app->session->setFlash('success', "Ma`lumot o`chirildi!");
        return $this->redirect(['question']);
    }

    protected function findModel($id)
    {
        if (($model = ExamPermission::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionAjaxdirection()
    {
        $user = \common\models\User::find()
        ->where(['=', 'user.id', Yii::$app->user->id])
        ->one();

        $uni_id = $user->uni_id;

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->request->isGet) {
            $faculty_id = Yii::$app->request->get("faculty_id");
            $direction = \common\models\Direction::find()
                ->where(['=', 'faculty_id', $faculty_id])
                ->andWhere(['uni_id'=>$uni_id])
                ->all();
            $groups = \common\models\Group::find()
                ->where(['=', 'faculty_id', $faculty_id])
                ->andWhere(['uni_id'=>$uni_id])
                ->all();
            $timetable = \common\models\TimeTable::find()
                ->all();
            $data = [];
            foreach ($groups as $gr) {
                foreach ($timetable as $tt) {
                    $data1 = [];
                    if ($tt->group_id == $gr->id) {
                        $data[] = $tt->fan_id;
                    }
                }
            }

            $result = array_keys(array_count_values($data));
            $fanlar = [];
            for ($i = 0; $i < count($result); $i++) {
                $massiv = [];
                $fan = \common\models\Fan::find()
                    ->where(['=', 'id', $result[$i]])
                    ->one();
                $massiv['id'] = $fan->id;
                $massiv['name'] = $fan->name;
                $fanlar[] = $massiv;
            }

            $response = [
                'message' => "message is not sent",
                'direction' => $direction,
                'groups' => $groups,
                'fanlar' => $fanlar,

            ];
            return ($response);
        }
    }
    public function actionAjaxcourse()
    {
        $user = \common\models\User::find()
        ->where(['=', 'user.id', Yii::$app->user->id])
        ->one();

        $uni_id = $user->uni_id;

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->request->isGet) {
            $direction_id = Yii::$app->request->get("direction_id");
            $course = \common\models\Course::find()
                ->andWhere(['uni_id'=>$uni_id])
                ->all();
            $groups = \common\models\Group::find()
                ->where(['=', 'direction_id', $direction_id])
                ->andWhere(['uni_id'=>$uni_id])
                ->all();
            $timetable = \common\models\TimeTable::find()
                ->all();
            $data = [];
            foreach ($groups as $gr) {
                foreach ($timetable as $tt) {
                    $data1 = [];
                    if ($tt->group_id == $gr->id) {
                        $data[] = $tt->fan_id;
                    }
                }
            }

            $result = array_keys(array_count_values($data));
            $fanlar = [];
            for ($i = 0; $i < count($result); $i++) {
                $massiv = [];
                $fan = \common\models\Fan::find()
                    ->where(['=', 'id', $result[$i]])
                    ->one();
                $massiv['id'] = $fan->id;
                $massiv['name'] = $fan->name;
                $fanlar[] = $massiv;
            }

            $response = [
                'message' => "message is not sent",
                'course' => $course,
                'groups' => $groups,
                'fanlar' => $fanlar,

            ];
            return ($response);
        }
    }
    public function actionAjaxgroups()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        if (Yii::$app->request->isPost) {

            $course_id = Yii::$app->request->post("course_id");
            $direction_id = Yii::$app->request->post("direction_id");

            $groups = \common\models\Group::find()
                ->where(['=', 'course_number', $course_id])
                ->andWhere(['=', 'direction_id', $direction_id])
                ->all();
            $timetable = \common\models\TimeTable::find()
                ->all();
            $data = [];
            foreach ($groups as $gr) {
                foreach ($timetable as $tt) {
                    $data1 = [];
                    if ($tt->group_id == $gr->id) {
                        $data[] = $tt->fan_id;
                    }
                }
            }

            $result = array_keys(array_count_values($data));
            $fanlar = [];
            for ($i = 0; $i < count($result); $i++) {
                $massiv = [];
                $fan = \common\models\Fan::find()
                    ->where(['=', 'id', $result[$i]])
                    ->one();
                $massiv['id'] = $fan->id;
                $massiv['name'] = $fan->name;
                $fanlar[] = $massiv;
            }
            $response = [
                'message' => "message is not sent",
                'groups' => $groups,
                'fanlar' => $fanlar,

            ];
            return ($response);
        }
    }
    public function actionAnswer($id)
    {
        $answer = \common\models\ExamAnswer::find()
            ->select(['exam_name_id', 'fan_id', 'COUNT(student_id) AS student'])
            ->where(['exam_name_id' => $id])
            ->groupBy(['fan_id'])
            ->createCommand()->queryAll();
        $examName = \common\models\ExamName::find()
            ->where(['id'=>$id])
            ->one();
        return $this->render(
            'answer',
            [
                'id' => $id,
                'answer' => $answer,
                'examName' => $examName,
            ]
        );
    }
    public function actionTeacher($id, $exam_name_id)
    {
        $fan_id = $id;
          $exam_check = \common\models\ExamCheck::find()
        ->where(['exam_name_id' => $exam_name_id])
        ->andWhere(['fan_id' => $fan_id])
        ->one();

        if($exam_check){
            return $this->redirect(['answer', 'id' => $exam_name_id]);
        }

        $user = \common\models\User::find()->where(['id' => Yii::$app->user->id])->one();

        $teacher = \common\models\Teacher::find()
            ->leftJoin('user', 'user.id = teacher.user_id')
            ->select(['teacher.user_id'])
            ->where(['teacher.fan_id' => $fan_id, 'user.uni_id' => $user->uni_id])
            ->groupBy(['teacher.user_id'])
            ->all();

            // echo '<pre>'. print_r($teacher); die;

        return $this->render(
            'teacher',
            [
                'fan_id' => $fan_id,
                'exam_name_id' => $exam_name_id,
                'teacher' => $teacher,
            ]
        );
    }
    public function actionResult($fan_id, $exam_name_id)
    {
        $fan_id = $fan_id;
            $exam_check = \common\models\ExamCheck::find()
                ->where(['exam_name_id' => $exam_name_id])
                ->andWhere(['fan_id' => $fan_id])
                ->all();

        $user = \common\models\User::find()->where(['id' => Yii::$app->user->id])->one();


        return $this->render(
            'result',
            [
                'fan_id' => $fan_id,
                'exam_check' => $exam_check,
                'exam_name_id' =>$exam_name_id

            ]
        );
    }

    public function actionExam(){
        $user = \common\models\User::findOne(Yii::$app->user->id);
        $exams = \common\models\ExamName::find()->where(['uni_id'=>$user->uni_id])
            ->where(['!=', 'status', 9])
            ->all();
        return $this->render('exam', ['exams'=>$exams]);
    }

    public function actionStudent($id){
        $student = \common\models\ExamCheck::find()
            ->where(['exam_name_id'=>$id])->groupby('student_id')->all();
        return $this->render('student', ['student'=>$student]);
    }

    public function actionResults($id){


        $natija1 = \common\models\ExamCheck::find()
            ->select(['teacher_id', 'fan_id'])->where(['exam_name_id'=>$id])
            ->groupBy('fan_id')->all();

        $natija2 = \common\models\ExamCheck::find()
            ->select(['teacher_id', 'fan_id'])->where(['exam_name_id'=>$id])
            ->groupBy('teacher_id')->all();
//        var_dump($natija);exit();
        return $this->render('results', ['natija1'=>$natija1, 'natija2'=>$natija2]);
    }

    public function actionJavoblar($id)
    {
        $examName = \common\models\ExamName::find()
            ->where(['id'=>$id])
            ->one();

        $examPer = \common\models\ExamPermission::find()
            ->leftJoin('direction', 'exam_permission.direction_id = direction.id')
            ->where(['exam_name_id'=>$id])
            // ->select(['direction.name', 'direction.id'])
            ->groupBy(['direction_id'])
            ->all();

        return $this->render('javoblar', [
                'examName' => $examName,
                'examPer' => $examPer,
            ]);
    }
    public function actionAnsgr($en, $dir)
    {
        $examName = \common\models\ExamName::find()
            ->where(['id'=>$en])
            ->one();

        $direction = \common\models\Direction::findOne(['id'=>$dir]);

        $examPer = \common\models\ExamPermission::find()
            // ->leftJoin('group', 'exam_permission.group_id = group.id')
            ->where(['exam_name_id'=>$en])
            ->andWhere(['direction_id'=>$dir])
            ->groupBy(['group_id'])
            ->all();


            return $this->render('ansgr', [
                'direction' => $direction,
                'examName' => $examName,
                'examPer' => $examPer,
            ]);
    }
    public function actionAnsstd($en, $gr)
    {
        $examName = \common\models\ExamName::find()
            ->where(['id'=>$en])
            ->one();

        $group = \common\models\Group::findOne(['id'=>$gr]);

        $examPer = \common\models\ExamPermission::find()
            // ->leftJoin('group', 'exam_permission.group_id = group.id')
            ->where(['exam_name_id'=>$en])
            ->andWhere(['group_id'=>$gr])
            // ->groupBy([''])
            ->all();

        $std = \common\models\Student::find()
            ->where(['group_id'=>$gr])
            ->all();

            return $this->render('ansstd', [
                'examName' => $examName,
                'examPer' => $examPer,
                'group' => $group,
                'students' => $std
            ]);
    }
    // changedate changedate

    public function actionChangedate(){

        $exam_check_id = $_POST["exam_check_id"];

        $exam_check = \common\models\ExamCheck::findOne(['id'=>$exam_check_id]);

        $exam_name = \common\models\ExamName::findOne(['id'=>$exam_check->exam_name_id]);

        $date = $_POST["date"];

        $exam_check->last_date = $date;
        $exam_check->save();

        return $this->redirect(['result',
            'fan_id' => $exam_check->fan_id,
            'exam_check' => $exam_check,
            'exam_name_id' =>$exam_check->exam_name_id

            ]
        );
    }

    public function actionSpread()
    {
        $fan_id = $_POST["fan_id"];
        $exam_name_id = $_POST["exam_name_id"];
        $teacher = $_POST["teacher"];

        $exam_check = \common\models\ExamCheck::find()
            ->where(['exam_name_id' => $exam_name_id])
            ->andWhere(['fan_id' => $fan_id])
            ->one();
        $last_date = $_POST['date_m'];

        if($exam_check){
            return $this->redirect(['answer', 'id' => $exam_name_id]);
        }

        $data1 = [];
        $students = [];
        $lang = \common\models\Lang::find()->all();

        foreach ($lang as $l) {
            $data2 = [];
            $answer = \common\models\ExamAnswer::find()
                ->leftJoin('group', 'group.id = exam_answer.group_id')
                ->where(['exam_name_id' => $exam_name_id])
                ->andWhere(['group.lang_id' => $l->id])
                ->andWhere(['exam_answer.fan_id' => $fan_id])
                ->all();
            $data = [];
            foreach ($answer as $a) {
                $data[] =  $a->student_id;
                $data2[$l->url] = $data;
                $students[$l->url] = $data;
            }
            foreach ($teacher as $teacher_id => $til_count) {
                $count = $til_count[$l->url];
                for ($i = 0; $i < $count; $i++) {
                    $student_id = $data2[$l->url][0];
                    $group_id = \common\models\Student::find()
                        ->where(['=', 'user_id', $student_id])
                        ->one();
                        $group= \common\models\Group::find()
                        ->where(['=', 'id', $group_id->group_id])
                        ->one();
                    $fan_id = $fan_id;
                    $course_id = $group->course_number;
                    $exam_name_id = $exam_name_id;
                    $teacher_id = $teacher_id;
                    $model = new ExamCheck();
                    $model->teacher_id=$teacher_id;
                    $model->fan_id=$fan_id;
                    $model->course_id=1;
                    $model->exam_name_id=$exam_name_id;
                    $model->student_id=$student_id;
                    $model->status=1;
                    $model->last_date=$last_date;
                    $model->save();
                    unset($data2[$l->url][0]);
                    sort($data2[$l->url]);
                }
            }
        }

        return $this->redirect(['answer', 'id' => $exam_name_id]);

    }
    public function actionExams( $fan_id,  $exam_name_id){
            $user = \common\models\User::findOne(Yii::$app->user->id);
            $student = \common\models\ExamStudent::find()
                ->where([
                    'uni_id'        =>$user->uni_id,
                    'fan_id'        =>$fan_id,
                    'exam_name_id'  =>$exam_name_id,
                    'status'        =>0
                ])->all();

        $student1 = \common\models\ExamStudent::find()
            ->where([
                'uni_id'        =>$user->uni_id,
                'fan_id'        =>$fan_id,
                'exam_name_id'  =>$exam_name_id,
                'status'        =>1
            ])->all();

                if (!empty($student)){
                    foreach ($student as $students){
                        $students->status = 1;
                        $students->save();
                    }
                    return $this->redirect('answer?id='.$exam_name_id.'&fan_id='.$fan_id);
                }else if(!empty($student1)){
                    foreach ($student1 as $students){
                        $students->status = 0;
                        $students->save();
                    }
                    return $this->redirect('answer?id='.$exam_name_id.'&fan=0');
                }else{
                    return $this->redirect('answer?id='.$exam_name_id.'&fans=0');
                }
    }
}
