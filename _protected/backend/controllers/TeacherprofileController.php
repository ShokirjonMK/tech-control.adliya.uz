<?php
namespace backend\controllers;

use common\models\ExamAnswer;
use common\models\User;
use common\models\ExamQuestion;
use common\models\ExamCheck;
use common\models\ExamStudent;
use common\models\Keys;
use common\models\Password;
use yii\web\NotFoundHttpException;
use Yii;
use yii\web\UploadedFile;
use DateTime;
use DateTimeZone;


class TeacherprofileController extends BackendController
{
    public function behaviors()
{
    return [
        'corsFilter' => [
            'class' => \yii\filters\Cors::className(),
        ],
    ];
}
    public function beforeAction($action) {
        $this->enableCsrfValidation = false; return parent::beforeAction($action);
    }

    public function actionIndex()
    {
//        var_dump(Yii::$app->request->post()); die();

        $user = \common\models\User::find()
            ->where(['=', 'user.id', Yii::$app->user->id])
            ->one();

        if ($user->role_id == "Teacher") {

        $teacher = \common\models\Teacher::find()
            ->where(['=', 'user_id', $user->id])
            ->groupBy('kafedra_id')
            ->one();

        $kafedra = \common\models\Kafedra::find()
            ->where(['id'=>$teacher->kafedra_id])
            ->one();
            if ($user->load(Yii::$app->request->post()) ){
                if ($user->password)
                {
                    $user->setPassword($user->password);
                }
                $as = Yii::$app->request->post('User');
                $password = ($_POST['User']["password"]);
                $encrption = Password::findOne(['user_id' => Yii::$app->user->id]);

                if ($password) {
                    $key_id = $this->keyselecter();
                    $key = Keys::findOne($key_id);
                    $key = $key->key;
                    $key = md5('defender' . $key);
                    $encrption->password = rtrim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $password, MCRYPT_MODE_ECB)));
                    $encrption->key_id = $key_id;
                    $encrption->save();
                }
                if ($user->status == User::STATUS_ACTIVE && $user->account_activation_token != null)
                {
                    $user->removeAccountActivationToken();
                }
                $user->save(false);
                Yii::$app->session->setFlash('success', "Parol o`zgartirildi!");
                return $this->redirect(['teacherprofile/index']);
            }else {
            return $this->render('index', [
                'teacher' => $teacher,
                'kafedra' => $kafedra,
                'user' => $user,
            ]);
            }
        }
        else {
            return $this->goHome();
        }
    }

    public function actionMydoc(){
        $mydoc = \common\models\Document::find()->all();
        return $this->render('mydoc', ['mydoc'=>$mydoc]);
    }

   

    /**
 * Dars Jadval
 */
    public function actionDarsjadval()
    {
        $user = \common\models\User::find()
            ->where(['=', 'user.id', Yii::$app->user->id])
            ->one();

        $teacher_id = $user->id;

        $uni_id = $user->uni_id;

        $group = \common\models\Group::find()
            ->where(['=', 'group.uni_id', $uni_id])
            ->all();

        $para = \common\models\Para::find()
            ->where(['=', 'para.uni_id', $uni_id])
            ->all();
        $fan = \common\models\Fan::find()
            ->where(['=', 'fan.uni_id', $uni_id])
            ->all();
        $timetable = \common\models\TimeTable::find()
            ->where(['=', 'time_table.teacher_id', $teacher_id])
            ->all();
        if (!($group)) {
            return $this->render('../site/error');
        }
        if (!(($user->role_id == "theCreator") || ($group))) {
            return $this->render('../site/error');
        }
        $weekdays = [
            1 =>  "Dushanba",
            2 =>  "Seshanba",
            3 =>  "Chorshanba",
            4 =>  "Payshanba",
            5 =>  "Juma",
            6 =>  "Shanba",
        ];
        return $this->render('darsjadval', [
            'para' => $para,
            'fan' => $fan,
            'group' => $group,
            'timetable' => $timetable,
            'weekdays' => $weekdays,
        ]);
    }
    /**
 * Dars Jadval end
 */
    /**
  * Checking begin
  */
    public function actionChecking()
    {
        $user = \common\models\User::find()
            ->where(['=', 'user.id', Yii::$app->user->id])
            ->one();

        $uni_id = $user->uni_id;

        $groups = \common\models\Group::find()
            ->andWhere(['=', 'group.uni_id', $uni_id])
            ->all();

        $timetable = \common\models\TimeTable::find()
            ->where(['teacher_id' => $user->id])
            ->groupBy(['fan_id'])
            ->all();

        $fanlar = \common\models\Fan::find()
            ->where(['=', 'uni_id', $uni_id])
            ->all();

      return $this->render('checking', [
            'fanlar' => $fanlar,
            'groups' => $groups,
            'timetable' => $timetable,
      ]);
  }
    public function actionImg(){
//        var_dump(Yii::$app->request->post('User'));
//        var_dump(Yii::$app->request->post()); die();
        $img  =  \common\models\User::find()->where(['id'=>$id])->one();
        $img->rasm = UploadedFile::getInstance($img, 'rasm');
        if ($img->rasm){
            $filename = floor(microtime(true) * 1000) . "." . $img->rasm->extension;
            $img->image = $filename;
            $img->rasm->saveAs("../uploads/".$filename);
        }
        $img->rasm = null;
        $img->save();
        return $this->redirect('../teacherprofile/index');
    }
    /**
 * Checking End
 */
    /**
  * Rating begin
  */
    public function actionRating()
    {
        $user=\common\models\User::find()->where(['=', 'user.id', Yii::$app->user->id])->one();
        if ($user->role_id = 'Teacher'){
            $exam_student = \common\models\TimeTable::find()
                ->select(['group_id', 'fan_id', 'smester'])
                ->andWhere(['teacher_id'=>$user->id])
                ->groupBy(['group_id', 'fan_id', 'smester'])
                ->all();
        }
        return $this->render('rating', [
            'groups' => $exam_student,
        ]);
    }
    /**
 * Rating End
 */
    /**
  * My Groups begin
  */
    public function actionMygroups()
    {
        $user=\common\models\User::find()->where(['=', 'user.id', Yii::$app->user->id])->one();

//               $grtt = \common\models\TimeTable::find()
//                 ->leftJoin('group', 'group.id = time_table.group_id')
//                 ->select(['group.name', 'group.direction_id'])
//                 ->where(['group.uni_id'=>$user->uni_id])
//                 ->andWhere(['group.smester'=>'time_table.smester'])
//                 ->andWhere(['time_table.teacher_id'=>$user->id])
//                 ->groupBy(['time_table.group_id'])
//                 ->all();
// echo '<pre>'.print_r($grtt).'</pre>'; exit;
            $gr = \common\models\TimeTable::find()
                ->select(['group_id', 'fan_id', 'smester'])
                ->andWhere(['teacher_id'=>$user->id])
                ->groupBy(['group_id', 'fan_id', 'smester'])
                ->all();

        return $this->render('mygroups', [
            'time_table' => $gr,
        ]);
    }
    /**
 * My Groups End
 */
    /**
  * Exam Begin
  */
    public function actionExam()
    {
        $user = \common\models\User::find()
            ->where(['=', 'user.id', Yii::$app->user->id])
            ->one();

        $uni_id = $user->uni_id;

        $exam_check = \common\models\ExamCheck::find()
            ->where(['teacher_id'=>$user->id])
            ->andWhere(['status'=>1])
            ->groupBy('exam_name_id')
            ->all();

        $exam_name = \common\models\ExamName::find()
            ->where(['uni_id'=>$uni_id])
            ->andWhere(['status'=>0])
            ->all();


        return $this->render('exam', [
            'exam_check' => $exam_check,
            'exam_name' => $exam_name,
            ]);
    }
    /**
 * Exam End
 */
    /**
 * Exam Name Begin
 */
    public function actionExamname($id)
    {
        $examNameId = $id;

        $user = \common\models\User::find()
            ->where(['=', 'user.id', Yii::$app->user->id])
            ->one();

        $uni_id = $user->uni_id;

        $exam_name = \common\models\ExamName::find()
            ->where(['uni_id' => $uni_id])
            ->andWhere(['=', 'id', $examNameId])
            ->one();

        $exam_check = \common\models\ExamCheck::find()
            ->where(['teacher_id'=>$user->id])
            ->andWhere(['status'=>1])
            ->andWhere(['exam_name_id' => $examNameId])
            ->groupBy(['fan_id'])
            ->all();

        $fanlar = \common\models\Fan::find()
            ->where(['uni_id' => $user->uni_id])
            ->all();


        return $this->render('examname', [
            'fanlar' => $fanlar,
            'exam_name' => $exam_name,
            'exam_check' => $exam_check,

        ]);
    }
    /**
  * Exam Name End;
  */
    /**
 * Exam Sub Begin
 */
    public function actionExamsub($id, $id1)
    {
        $fanId = $id;
        $examNameId = $id1;
        $user = \common\models\User::find()
            ->where(['=', 'user.id', Yii::$app->user->id])
            ->one();

        $uni_id = $user->uni_id;

        $exam_answer = \common\models\ExamAnswer::find()
            // ->innerJoin('exam_check', 'exam_check.exam_name_id=exam_answer.exam_name_id')
            ->where(['exam_name_id' => $examNameId])
            ->andWhere(['fan_id' => $fanId])
            // ->andWhere(['exam_check.teacher_id'=>$user_id])
            ->all();

        $exam_check = \common\models\ExamCheck::find()
            ->where(['exam_name_id' => $examNameId])
            ->andWhere(['fan_id' => $fanId])
            ->andWhere(['teacher_id'=>$user->id])
            ->all();


        $fan = \common\models\Fan::find()
            ->where(['uni_id' => $user->uni_id])
            ->andWhere(['id' => $fanId])
            ->one();

// echo "<pre>";
// print_r($exam_check);
// echo "</pre>";
// exit;

        return $this->render('examsub', [
            'fan' => $fan,
            'exam_check' => $exam_check,
            'exam_answer' => $exam_answer,
            'examNameId' => $examNameId,
            ]);
    }
    /**
* Exam Sub End;
*/
    /**
    Checking PDF begin checkpdf.php
*/
    public function actionCheckingpdf(){
        $id = 8;
          $exam_answer = \common\models\ExamAnswer::find()->where(['id'=>$id])->one();
        // $mydoc = \common\models\Document::find()->all();
        // return $this->render('checkingpdf');
          // $model = $this->findModel1($examCheck->id);
        return $this->render('checkingpdf',[
            'exam_answer' => $exam_answer,
            // 'model' => $model,
            // 'maxball' => $maxball,
        ]);
    }


    public function actionPdf($id){
       
            $user = \common\models\User::find()->where(['=', 'user.id', Yii::$app->user->id])->one();

            $exam_answer = \common\models\ExamAnswer::find()->where(['id'=>$id])->one();

            $examCheck = \common\models\ExamCheck::find()
                ->where(['teacher_id'=>$user->id])
                ->andWhere(['exam_name_id'=>$exam_answer->exam_name_id])
                ->andWhere(['fan_id'=>$exam_answer->fan_id])
                ->andWhere(['student_id'=>$exam_answer->student_id])
                ->one();

            $exam_per = \common\models\ExamPermission::find()
                ->where(['exam_name_id' => $examCheck->exam_name_id])
                ->one();

            $exam = \common\models\Exam::find()
                ->where(['id'=>$exam_per->exam_id])
                ->one();

            $maxball = $exam->mark;

            $group = \common\models\Group::find()
                ->where(['id' => $exam_answer->group_id])
                ->one();

            $model = $this->findModel1($examCheck->id);

// echo '<pre>';
// print_r($model);
// echo '</pre>';
// exit;

        if ($model->load(Yii::$app->request->post())) {
            $model->save();
            $examStudent = ExamStudent::find()
                    ->where(['exam_id'=>$exam->id])
                    ->andWhere(['student_id'=>$model->student_id])
                    ->andWhere(['exam_id'=>$exam->id])
                    ->andWhere(['group_id'=>$exam_answer->group_id])
                    ->andWhere(['fan_id'=>$exam_answer->fan_id])
                    ->andWhere(['smester'=>$group->smester])
                    ->andWhere(['uni_id'=>$user->uni_id])
                    ->one();
            if(empty($examStudent)){
                $examStudent = new ExamStudent();
                $examStudent->student_id = $model->student_id;
                $examStudent->exam_id = $exam->id;
                $examStudent->mark = $model->mark;
                $examStudent->group_id = $exam_answer->group_id;
                $examStudent->fan_id = $exam_answer->fan_id;
                $examStudent->smester = $group->smester;
                $examStudent->uni_id = $user->uni_id;
                $examStudent->user_create = $user->id;
                $examStudent->create_date = date('Y-m-d');
                $examStudent->exam_name_id = $examCheck->exam_name_id;
                $examStudent->status = 0;
                $examStudent->save();

            }
                if($examStudent){
                    $examStudent->mark = $model->mark;
                    $examStudent->user_update = $user->id;
                    $examStudent->status = 0;
                    $examStudent->update_date = date('Y-m-d');
                    $examStudent->save();
            }
            return $this->redirect('examsub?id='.$exam_answer->fan_id.'&id1='.$examCheck->exam_name_id);

        }
        return $this->render('pdf',[
            'exam_answer' => $exam_answer,
            'model' => $model,
            'maxball' => $maxball,
        ]);
    }


    public function actionCheckpdf($id)
    {

            $user = \common\models\User::find()->where(['=', 'user.id', Yii::$app->user->id])->one();

            $exam_answer = \common\models\ExamAnswer::find()->where(['id'=>$id])->one();

            $examCheck = \common\models\ExamCheck::find()
                ->where(['teacher_id'=>$user->id])
                ->andWhere(['exam_name_id'=>$exam_answer->exam_name_id])
                ->andWhere(['fan_id'=>$exam_answer->fan_id])
                ->andWhere(['student_id'=>$exam_answer->student_id])
                ->one();

            $exam_per = \common\models\ExamPermission::find()
                ->where(['exam_name_id' => $examCheck->exam_name_id])
                ->one();

            $exam = \common\models\Exam::find()
                ->where(['id'=>$exam_per->exam_id])
                ->one();

            $maxball = $exam->mark;

            $group = \common\models\Group::find()
                ->where(['id' => $exam_answer->group_id])
                ->one();

            // $examStudent = \common\models\ExamStudent::find()
            //     ->where([])


            $model = $this->findModel1($examCheck->id);

// echo '<pre>';
// print_r($model);
// echo '</pre>';
// exit;

        if ($model->load(Yii::$app->request->post())) {
            $model->save();
            $examStudent = ExamStudent::find()
                    ->where(['exam_id'=>$exam->id])
                    ->andWhere(['student_id'=>$model->student_id])
                    ->andWhere(['exam_id'=>$exam->id])
                    ->andWhere(['group_id'=>$exam_answer->group_id])
                    ->andWhere(['fan_id'=>$exam_answer->fan_id])
                    ->andWhere(['smester'=>$group->smester])
                    ->andWhere(['uni_id'=>$user->uni_id])
                    ->one();
            if(empty($examStudent)){
                $examStudent = new ExamStudent();
                $examStudent->student_id = $model->student_id;
                $examStudent->exam_id = $exam->id;
                $examStudent->mark = $model->mark;
                $examStudent->group_id = $exam_answer->group_id;
                $examStudent->fan_id = $exam_answer->fan_id;
                $examStudent->smester = $group->smester;
                $examStudent->uni_id = $user->uni_id;
                $examStudent->user_create = $user->id;
                $examStudent->create_date = date('Y-m-d');
                $examStudent->exam_name_id = $examCheck->exam_name_id;
                $examStudent->status = 0;
                $examStudent->save();

            }
                if($examStudent){
                    $examStudent->mark = $model->mark;
                    $examStudent->user_update = $user->id;
                    $examStudent->status = 0;
                    $examStudent->update_date = date('Y-m-d');
                    $examStudent->save();
            }
            return $this->redirect('examsub?id='.$exam_answer->fan_id.'&id1='.$examCheck->exam_name_id);

        }
        return $this->render('checkpdf',[
            'exam_answer' => $exam_answer,
            'model' => $model,
            'maxball' => $maxball,
        ]);
        }
    /*
    Checking PDF end;
*/
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null)
        {
            return $model;
        }
        else
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    protected function findModel1($id)
    {
        if (($model = ExamCheck::findOne($id)) !== null)
        {
            return $model;
        }
        else
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function keyselecter()
    {
        $keys = Keys::find()->all();
        $array = array();
        foreach ($keys as $key) {
            $array[] = $key->id;
        }

        return array_rand($array, 1);
    }




}