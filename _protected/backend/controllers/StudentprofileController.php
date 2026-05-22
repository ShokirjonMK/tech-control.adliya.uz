<?php
namespace backend\controllers;

use common\models\ExamStudent;
use common\models\User;
use common\models\Keys;
use common\models\Password;
use common\models\ExamQuestion;
use common\models\ExamAnswer;
use common\models\StdNote;
use common\models\UserSearch;
use common\rbac\models\Role;
use yii\web\Controller;
use yii\base\Model;
use yii\web\NotFoundHttpException;
use Yii;
use yii\web\UploadedFile;
use Mpdf\Mpdf;
use DateTime;
use DateTimeZone;

class StudentprofileController extends BackendController
{

    public function beforeAction($action) {
        $this->enableCsrfValidation = false; return parent::beforeAction($action);
    }

    public function actionIndex($id = NULL)
    {
        $user = \common\models\User::find()
            ->where(['=', 'user.id', Yii::$app->user->id])
            ->one();

        if ($user->role_id == "theCreator") {
            if($id){
                $user = \common\models\User::find()
                	->where(['id'=>$id])
                	->one();
                $std_note = \common\models\StdNote::find()
                	->where(['student_id'=>$user->id])
                	->all();
            } else  { return $this->render('../site/error'); }
        }elseif ($user->role_id == "Admin"){
            if($id){
                $user = \common\models\User::find()
                	->where(['uni_id'=>$user->uni_id, 'id'=>$id])
                	->one();
                $std_note = \common\models\StdNote::find()
                	->where(['student_id'=>$user->id])
                	->all();

            } else  { return $this->render('../site/error'); }
        }

        if ($user->role_id == "Student") {
            $student = \common\models\Student::find()
                ->where(['=', 'user_id', $user->id])->one();

            if ($user->load(Yii::$app->request->post()) ){
                if ($user->password)
                {
                    $user->setPassword($user->password);
                }
                $as = Yii::$app->request->post('User');
                $password = ($_POST['User']["password"]);
                $encrption = Password::findOne(['user_id' =>$user->id]);

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
                return $this->render('index', [
                    'student' => $student,
                    'user' => $user,
                ]);
            }
            else
            {
                return $this->render('index', [
                    'student' => $student,
                    'user' => $user,
                    'std_note' => $std_note,
                ]);
            }
        }
        else {
            return $this->goHome();
        }
    }

    public function actionStdnote()
    {
        $user = \common\models\User::find()
            ->where(['=', 'user.id', Yii::$app->user->id])
            ->one();

        $uni_id = $user->uni_id;

        $note = ($_POST["description"]);
        $student_id = ($_POST["student_id"]);
		$date = date('Y-m-d');



        $model = new StdNote();
        $model->student_id = $student_id;
        $model->note = $note;
        $model->date = $date;
        $model->user_id = $user->id;
        $model->uni_id = $uni_id;


        $model->save(false);

        return $this->redirect(['index?id='.$student_id]);
    }

	public function actionExport($id)
    {
        $user=\common\models\User::find()
            ->where(['=', 'user.id', Yii::$app->user->id])
            ->one();

        $userStd = \common\models\User::find()
            ->where(['id'=>$id])
            ->one();

        $university = \common\models\University::findOne(['id'=>$user->uni_id]);

        $stdNote = \common\models\StdNote::find()
        		->where(['student_id'=>$userStd->id])
        		->all();

        $studentt = \common\models\Student::findOne(['user_id'=>$userStd->id]);
        $gr = \common\models\Group::findOne(['id'=>$studentt->group_id]);
        $dir = \common\models\Direction::findOne(['id'=>$gr->direction_id]);
        $export = new mPDF();
        $export->SetHeader($university->name);
        ob_start();
        echo '<p style="text-align: center;">
        '.$userStd->full_name.'
    </p>
    <p style="text-align: start; margin-left: 8%;">
    Guruh: '.$gr->name.'<br><br/ >
    Mutaxasislik: '.$dir->name.' <br/>
    Sana: '.date("Y-m-d").'</p>
    <table border="1" style="border-collapse: collapse; margin-left: 5%;">
        <tr>
            <th style="width: 10%; text-align:center">T/R</th>
            <th style="width: 15%; text-align:center">Sana</th>
            <th style="width: 65%; text-align:center">Eslatma</th>
        </tr>
        '; $i=0;
        foreach ($stdNote as $std) :
            
        echo '<tr>
            <td style="text-align: center;">'.++$i.'</td>
            <td style="text-align: center;">'.$std->date.'</td>
            <td style="text-align: center;">'.$std->note.'</td>
            </tr>';
        endforeach;
        echo '</table>';
        $t = ob_get_contents();
        ob_end_clean();

        $export->WriteHTML($t);

        $export->Output();
        exit;

    }
    /**
 * Dars Jadval  
 */
    public function actionDarsjadval()
    {
        $user = \common\models\User::find()
            ->where(['=', 'user.id', Yii::$app->user->id])
            ->one();

        $student = \common\models\Student::find()->where(['user_id'=>$user->id])->one();

        $uni_id = $user->uni_id;

        $group = \common\models\Group::find()
            ->andWhere(['=', 'group.uni_id', $uni_id])
            ->andWhere(['id'=>$student->group_id])
            ->one();

        $timetable = \common\models\TimeTable::find()
            ->where(['group_id'=>$group->id])
            ->orderBy(['week_day' => SORT_ASC])
            ->all();

        $para = \common\models\Para::find()
            ->where(['=', 'para.uni_id', $uni_id])
            ->all();

        $xona = \common\models\Room::find()
            ->where(['=', 'room.uni_id', $uni_id])
            ->all();

        $fan = \common\models\Fan::find()
            ->where(['=', 'fan.uni_id', $uni_id])
            ->all();

        $teachers = \common\models\User::find()
            ->andWhere(['uni_id' => $uni_id])
            ->andWhere(['role_id' => 'Teacher'])
            ->all();

        // if (!(($user->role_id == "theCreator") || ($group))) {
        //     return $this->render('../site/error');
        // }

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
            'xona' => $xona,
            'fan' => $fan,
            'group' => $group,
            'teachers' => $teachers,
            'timetable' => $timetable,
            'weekdays' => $weekdays,
        ]);
    }
    /**
 * Lesson Schedule end
 */
    /**
  * Myattandence begin
  */
    public function actionMyattendance()
    {
        $user = \common\models\User::find()
            ->where(['=', 'user.id', Yii::$app->user->id])
            ->one();

        $student = \common\models\Student::find()->where(['user_id'=>$user->id])->one();

        $uni_id = $user->uni_id;

        $group = \common\models\Group::find()
            ->andWhere(['=', 'group.uni_id', $uni_id])
            ->andWhere(['id'=>$student->group_id])
            ->one();


        $timetable = \common\models\TimeTable::find()
            ->andWhere(['group_id'=>$group->id])
            ->andWhere(['smester'=>$group->smester])
            ->all();

        $fanlar = \common\models\Fan::find()
            ->where(['=', 'uni_id', $uni_id])
            ->all();

      return $this->render('myattendance', [

          'fanlar' => $fanlar,
          'student' => $student,
          'timetable' => $timetable,
      ]);
  }
    /**
 * My Attandence end
 */
    /**
  * Onesubject Fan Id Begin
  */
    public function actionOnesubject($fan_id = NULL)
    {

$user = \common\models\User::find()
            ->where(['=', 'user.id', Yii::$app->user->id])
            ->one();

        $student = \common\models\Student::find()->where(['user_id'=>$user->id])->one();

        $uni_id = $user->uni_id;

        $group = \common\models\Group::find()
            ->andWhere(['=', 'group.uni_id', $uni_id])
            ->andWhere(['id'=>$student->group_id])
            ->one();

    if($fan_id){
        $fan = \common\models\Fan::find()
            ->where(['uni_id'=>$uni_id])
            ->andWhere(['id'=>$fan_id])
            ->one();

$timetable = \common\models\TimeTable::find()
            ->andWhere(['smester'=>$group->smester])
            ->andWhere(['fan_id'=>$fan_id])
            ->andWhere(['group_id'=>$group->id])
            ->all();

 $monitoring = \common\models\Monitoring::find()
            ->where(['uni_id'=>$uni_id])
            ->andWhere(['student_id'=>$student->id])
            ->andWhere(['group_id'=>$group->id])
            ->orderBy(['date' => SORT_ASC])
            ->all();

        $teachers = \common\models\User::find()
            ->andWhere(['uni_id' => $uni_id])
            ->andWhere(['role_id' => 'Teacher'])
            ->all();
    }

     return $this->render('onesubject', [

          'fan' => $fan,
          'teachers' => $teachers,
          'monitoring' => $monitoring,
          'timetable' => $timetable,
      ]);

    }
   /**
 * Onesubject Fan Id End
 */
    /**
  * Exam Begin
  */
    public function actionExam()
    {
        $user = \common\models\User::find()
            ->where(['=', 'user.id', Yii::$app->user->id])
            ->one();
        $studet_group = \common\models\Student::find()
            ->where(['=', 'user_id', Yii::$app->user->id])
            ->andWhere(['!=', 'status', 9])
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

        $exam_question = \common\models\ExamQuestion::find()
            ->leftJoin('exam_name', 'exam_name.id = exam_question.exam_name_id')
            ->where(['=', 'exam_name.uni_id', $uni_id])
            // ->andWhere(['status'=>1])
            ->andWhere(['=', 'exam_question.group_id', $studet_group->group_id])
            ->orderBy(['id' => SORT_DESC])
            ->all();

        $fan = \common\models\Fan::find()
            ->where(['=', 'uni_id', $uni_id])
            ->all();

// echo '<pre>';
// print_r($exam_question);
// echo '</pre>'; die();

        $model = new ExamQuestion();
        return $this->render('exam', [
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
    public function actionAnswerstore()
    {

        $user = \common\models\User::find()
            ->where(['=', 'user.id', Yii::$app->user->id])
            ->one();
        $uni_id = $user->uni_id;
        $exam_name_id = ($_POST["exam_name_id"]);
        $group_id = ($_POST["group_id"]);
        $fan_id = ($_POST["fan_id"]);

        $model = \common\models\ExamAnswer::find()
            ->where(['student_id'=>$user->id])
            ->andWhere(['fan_id'=>$fan_id])
            ->andWhere(['exam_name_id'=>$exam_name_id])
            ->andWhere(['group_id'=>$group_id])
            ->one();
// echo '<pre>'.print_r($examAnswer).'</pre>'; die();
            if (!$model) {
            $model = new ExamAnswer();
            }
        $model->file = UploadedFile::getInstance($model, 'file');
        if ($model->file != NUll) {
            $filename = ((int) (microtime(true) * (1000))) . '.' . $model->file->extension;
            $model->file->saveAs("../uploads/answer/" . $filename);
            $model->original_name = $model->file->name;
        }
        $model->file = null;
        $group_new = \common\models\Group::find()
            ->where(['=', 'id', $group_id])
            ->one();

        $datetime = new DateTime();
        $timezone = new DateTimeZone('Asia/Tashkent');
        $datetime->setTimezone($timezone);
        $now_date = ($datetime->format('Y-m-d H:i:s'));

        $model->exam_name_id = $exam_name_id;
        $model->faculty_id = $group_new->faculty_id;
        $model->direction_id = $group_new->direction_id;
        $model->group_id = $group_new->id;
        $model->fan_id = $fan_id;
        $model->answer_pdf = $filename;
        $model->student_id = $user->id;
        $model->created_at = $now_date;
        $model->update_at = $now_date;
        $model->save();
        return $this->redirect(['exam']);
    }
    /**
   * Exam End
   */
    /**
 * Rating Student Begin
 */
    public function actionRating($sm = NULL)
    {
        $user = \common\models\User::find()
            ->where(['=', 'user.id', Yii::$app->user->id])
            ->one();
            if ($user->role_id == "Student") {

        $student = \common\models\Student::find()->where(['user_id'=>$user->id])->one();

        $uni_id = $user->uni_id;

        $group = \common\models\Group::find()
            ->andWhere(['=', 'group.uni_id', $uni_id])
            ->andWhere(['id'=>$student->group_id])
            ->one();

        $smester = $group->smester;

        if($sm){
            $smester = $sm;
        } else {
        $sm = $smester;
        }

        $exams = \common\models\Exam::find()
            ->where(['uni_id'=>$uni_id])
            ->orderBy(['sort' => SORT_ASC])
            ->all();

        $timetable = \common\models\TimeTable::find()
            ->andWhere(['group_id'=>$group->id])
            ->andWhere(['smester'=>$smester])
            ->groupBy(['fan_id'])
            ->all();

        $fanlar = \common\models\Fan::find()
            ->where(['=', 'uni_id', $uni_id])
            ->all();

        $examstd = \common\models\ExamStudent::find()
            ->where(['uni_id'=>$uni_id])
            ->andWhere(['group_id'=>$group->id])
            ->andWhere(['student_id'=>$user->id])
            ->andWhere(['smester'=>$smester])
            ->andWhere(['status'=>1])
            ->all();
/*echo "<pre>";
print_r($examstd);
echo "</pre>";
exit;*/
        $ecount = \common\models\Exam::find()
            ->where(['uni_id'=>$uni_id])
            ->count();

        $mainsmester = $group->smester;

// echo "<pre>";
// print_r($ecount);
// echo "</pre>";
// exit;

      return $this->render('rating', [
        'sm' => $sm,
        'exams' => $exams,
        'ecount' => $ecount,
        'fanlar' => $fanlar,
        'smester' => $mainsmester,
        'examstd' => $examstd,
        'timetable' => $timetable,
      ]);
            }
            else {
                return $this->render('../site/error');
            }
    }
    /**
 * Raing Student End
 */
    public function actionView($id)
    {

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param  integer $id The user id.
     * @return User The loaded model.
     *
     * @throws NotFoundHttpException
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