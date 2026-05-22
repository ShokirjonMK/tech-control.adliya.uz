<?php
namespace backend\controllers;

use common\models\ExamStudent;
use common\models\User;
use common\models\Keys;
use common\models\Password;
use common\models\Student;
use common\models\UserSearch;
use common\rbac\models\Role;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\base\Model;
use yii\web\NotFoundHttpException;
use Yii;
use DateTime;
use DateTimeZone;
use yii\web\UploadedFile;
use Mpdf\Mpdf;

/**
 * UserController implements the CRUD actions for User model.
 */
class StudentController extends BackendController
{

    public function beforeAction($action) {
        $this->enableCsrfValidation = false; return parent::beforeAction($action);
    }
    /**
     * Lists all User models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $user = \common\models\User::find()
            ->where(['=', 'user.id', Yii::$app->user->id])
            ->one();

        if ($user->role_id == "theCreator"){
            $student = \common\models\User::find()
                ->andWhere([ 'role_id'=>'Student', 'status'=>10])
                ->all();
            return $this->render('index', [
                'student' => $student,
            ]);
        }
        elseif ($user->role_id == "Admin"){
            $student = \common\models\User::find()
                ->andWhere([ 'role_id'=>'Student'])
                ->andWhere(['uni_id'=>$user->uni_id])
                ->andWhere(['status'=>10])
                ->all();
            return $this->render('index', [
                'student' => $student,
            ]);

        }elseif ($user->role_id == "Student"){
            $student = \common\models\User::find()
                ->andWhere(['uni_id'=>$user->uni_id, 'role_id'=>'Student'])
                ->andWhere(['status'=>10])
                ->all();
            return $this->render('index', [
                'student' => $student,
            ]);
        }
        else{
            return $this->render('../site/error');
        }

    }

    /**
     * Displays a single User model.
     *
     * @param  integer $id The user id.
     * @return string
     *
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        $group = Stdgroup::find()
        ->joinWith('user', 'stdgroup.student_id = user.id')
        ->joinWith('group', 'group.id = stdgroup.group_id')
        ->where(['stdgroup.student_id'=>$id])->all();
       
        return $this->render('view', [
            'model' => $this->findModel($id),
            'group' =>$group,
            'student_id' =>$id,
        ]);
    }

    /**
     * Creates a new User model.
    */
    public function actionCreate()
    {
        $user = new User(['scenario' => 'create']);
        $role = new Role();

        $user_sayt = \common\models\User::find()
        ->where(['=', 'user.id', Yii::$app->user->id])
        ->one();
        $uni_id = $user_sayt->uni_id;
        if ($user->load(Yii::$app->request->post()) && 
            $role->load(Yii::$app->request->post()) &&
            Model::validateMultiple([$user, $role]))
        {
            $as = Yii::$app->request->post();
            $user->gender = $as['User']['gender'];
            $user->setPassword($user->password);
            $user->generateAuthKey();
            $user->status = 10;
            $user->uni_id = (int) $uni_id;
            $user->role_id= "Student";
            $datetime = new DateTime();
            $timezone = new DateTimeZone('Asia/Tashkent');
            $datetime->setTimezone($timezone);
            $user->rasm = UploadedFile::getInstance($user, 'rasm');
            if ($user->rasm){
                $filename = floor(microtime(true) * 1000) . "." . $user->rasm->extension;
                $user->image = $filename;
                $user->rasm->saveAs("../uploads/user_images/".$filename);
            }
            $user->rasm = null;
            if ($user->save()) 
            {
                $student = new Student();
                $as = Yii::$app->request->post();
                $student->group_id = $as['User']['group_id'];
                $student->finance_type = $as['User']['finance_type'];
                $student->status = $as['User']['status'];
                $student->user_id = $user->getId();
                $student->save();
                $role->user_id = $user->getId();
                $role->save();
                $now_date = ($datetime->format('Y-m-d'));
                $password = ($_POST['User']["password"]);
                $id = Yii::$app->request->get('id');
                $key_id = $this->keyselecter(); // keyselecter method selects randomly and written bottom
                $key = Keys::findOne($key_id);
                $key = $key->key;
                $key = md5('defender' . $key);
                $encrption = new Password();
    	        $encrption->password = rtrim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $password, MCRYPT_MODE_ECB)));
                $encrption->user_id = $user->getId();
                $encrption->key_id = $key_id;
                $encrption->save();

                return $this->redirect(['faculty/student','group_id' => $id]);

            }
        } 
        else 
        {
            return $this->render('create', [
                'user' => $user,
                'role' => $role,
            ]);
        }
    }



    public function actionCreate1()
    {
        $user = new User(['scenario' => 'create']);
        $role = new Role();

        $user_sayt = \common\models\User::find()
            ->where(['=', 'user.id', Yii::$app->user->id])
            ->one();
        $uni_id = $user_sayt->uni_id;
        if ($user->load(Yii::$app->request->post()) &&
            $role->load(Yii::$app->request->post()) &&
            Model::validateMultiple([$user, $role]))
        {
            $as = Yii::$app->request->post();
            $user->gender = $as['User']['gender'];
            $user->setPassword($user->password);
            $user->generateAuthKey();
            $user->status = 10;
            $user->uni_id = (int) $uni_id;
            $user->role_id= "Student";
            $datetime = new DateTime();
            $timezone = new DateTimeZone('Asia/Tashkent');
            $datetime->setTimezone($timezone);
            $user->rasm = UploadedFile::getInstance($user, 'rasm');
            if ($user->rasm){
                $filename = floor(microtime(true) * 1000) . "." . $user->rasm->extension;
                $user->image = $filename;
                $user->rasm->saveAs("../uploads/user_images/".$filename);
            }
            $user->rasm = null;
            if ($user->save())
            {
                $student = new Student();
                $as = Yii::$app->request->post();
                $student->group_id = $as['User']['group_id'];
                $student->finance_type = $as['User']['finance_type'];
                $student->status = $as['User']['status'];
                $student->user_id = $user->getId();
                $student->save();
                $role->user_id = $user->getId();
                $role->save();
                $now_date = ($datetime->format('Y-m-d'));
                $password = ($_POST['User']["password"]);
                $id = Yii::$app->request->get('id');
                $key_id = $this->keyselecter(); // keyselecter method selects randomly and written bottom
                $key = Keys::findOne($key_id);
                $key = $key->key;
                $key = md5('defender' . $key);
                $encrption = new Password();
                $encrption->password = rtrim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $password, MCRYPT_MODE_ECB)));
//                $encrption->password = md5($password);
                $encrption->user_id = $user->getId();
                $encrption->key_id = $key_id;
                $encrption->save();

                return $this->redirect(['student/index']);

            }
        }
        else
        {
            return $this->render('create1', [
                'user' => $user,
                'role' => $role,
            ]);
        }
    }
    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param  integer $id The user id.
     * @return string|\yii\web\Response
     *
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id, $id1)
    {
        // get role
        $role = Role::findOne(['user_id' => $id]);

        // get user details
        $user = $this->findModel($id);

        // only The Creator can update everyone`s roles
        // admin will not be able to update role of theCreator
        if (!Yii::$app->user->can('theCreator')) 
        {
            if ($role->item_name === 'theCreator') 
            {
                return $this->goHome();
            }
        }

        // load user data with role and validate them
        if ($user->load(Yii::$app->request->post()) && 
            $role->load(Yii::$app->request->post()) && Model::validateMultiple([$user, $role])) 
        {
            // only if user entered new password we want to hash and save it
            if ($user->password) 
            {
                $user->setPassword($user->password);
            }
            $as = Yii::$app->request->post('User');
            $student = Student::findOne($id1);
            $student->group_id = $as['group_id'];
            $student->finance_type = $as['finance_type'];
            $student->status = $as['status'];
            $password = ($_POST['User']["password"]);
            $encrption = Password::findOne(['user_id' => $id]);
                if ($password) {
                    $key_id = $this->keyselecter(); // keyselecter method selects randomly and written bottom
                    $key = Keys::findOne($key_id);
                    $key = $key->key;
                    $key = md5('defender' . $key);
                    $encrption->password = rtrim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $password, MCRYPT_MODE_ECB)));
//                    $encrption->password = md5($password);
                    $encrption->key_id = $key_id;
                    $encrption->save();
                }
            $user->rasm = UploadedFile::getInstance($user, 'rasm');
            if ($user->rasm){
                if (file_exists("../uploads/direktorlar/".$user->image)){
                    unlink("../uploads/direktorlar/".$user->image);
                }
                $filename = floor(microtime(true) * 1000) . "." . $user->rasm->extension;
                $user->image = $filename;
                $user->rasm->saveAs("../uploads/".$filename);
            }
            $student->save();
            // if admin is activating user manually we want to remove account activation token
            if ($user->status == User::STATUS_ACTIVE && $user->account_activation_token != null) 
            {
                $user->removeAccountActivationToken();
            }
            $user->save(false);
            $role->save(false);
            $id2 =  $student->group_id;
//            var_dump($id2);exit;
            return $this->redirect('../faculty/student?group_id='.$id2);
//            , ['group_id'=>$id2]
        }
        else 
        {
            return $this->render('update', [
                'user' => $user,
                'role' => $role,
            ]);
        }
    }

    public function actionUpdate1($id, $id1)
    {
        // get role
        $role = Role::findOne(['user_id' => $id]);

        // get user details
        $user = $this->findModel($id);

        // only The Creator can update everyone`s roles
        // admin will not be able to update role of theCreator
        if (!Yii::$app->user->can('theCreator'))
        {
            if ($role->item_name === 'theCreator')
            {
                return $this->goHome();
            }
        }

        // load user data with role and validate them
        if ($user->load(Yii::$app->request->post()) &&
            $role->load(Yii::$app->request->post()) && Model::validateMultiple([$user, $role]))
        {
            // only if user entered new password we want to hash and save it
            if ($user->password)
            {
                $user->setPassword($user->password);
            }
            $as = Yii::$app->request->post('User');
            $student = Student::findOne($id1);
            $student->group_id = $as['group_id'];
            $student->finance_type = $as['finance_type'];
            $student->status = $as['status'];
            $password = ($_POST['User']["password"]);
            $encrption = Password::findOne(['user_id' => $id]);
            if ($password) {
                $key_id = $this->keyselecter(); // keyselecter method selects randomly and written bottom
                $key = Keys::findOne($key_id);
                $key = $key->key;
                $key = md5('defender' . $key);
                $encrption->password = rtrim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $password, MCRYPT_MODE_ECB)));
//                $encrption->password = md5($password);
                $encrption->key_id = $key_id;
                $encrption->save();
            }
            $user->rasm = UploadedFile::getInstance($user, 'rasm');
            if ($user->rasm){
                if (file_exists("../uploads/direktorlar/".$user->image)){
                    unlink("../uploads/direktorlar/".$user->image);
                }
                $filename = floor(microtime(true) * 1000) . "." . $user->rasm->extension;
                $user->image = $filename;
                $user->rasm->saveAs("../uploads/".$filename);
            }
            $student->save();
            // if admin is activating user manually we want to remove account activation token
            if ($user->status == User::STATUS_ACTIVE && $user->account_activation_token != null)
            {
                $user->removeAccountActivationToken();
            }
            $user->save(false);
            $role->save(false);
            $id2 = Yii::$app->request->get('group');
//            var_dump($id2);exit;
            return $this->redirect('../student/');
//            , ['group_id'=>$id2]
        }
        else
        {
            return $this->render('update1', [
                'user' => $user,
                'role' => $role,
            ]);
        }
    }
    public function fetch($id)
    {
        if (Password::find()->where(['=', 'user_id', $id])->one()) {
            $password = Password::find()->where(['=', 'user_id', $id])->one();
            $key = Keys::find()->where(['=', 'id', $password->key_id])->one();
            $key = md5('defender' . $key->key);
            $encoded = $password->password;
            $decoded = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, base64_decode($encoded), MCRYPT_MODE_ECB));
            return ($decoded);
        } else {
            return '';
        }
    }

    public function actionExport()
    {
        $user=\common\models\User::find()
            ->where(['=', 'user.id', Yii::$app->user->id])
            ->one();
        $userStd = \common\models\User::find()
            ->where(['uni_id'=>$user->uni_id])
            ->andWhere(['role_id'=>'Student'])
            ->select(['id', 'full_name', 'username'])
            ->all();

        $university = \common\models\University::findOne(['id'=>$user->uni_id]);

// var_dump($pass); die();
// echo "<pre>";
// print_r(User::fetch(6));
// echo "</pre>";
// exit;

        $export = new mPDF();
        $export->SetHeader($university->name);
        ob_start();
        echo '<p style="text-align: center;">ТОШКЕНТ ДАВЛАТ ЮРИДИК УНИВЕРСИТЕТИ ҲУЗУРИДАГИ ЮРИДИК КАДРЛАРНИ<br>
    ХАЛҚАРО СТАНДАРТЛАР БЎЙИЧА ПРОФЕССИОНАЛ ЎҚИТИШ МАРКАЗИ
    <br/>ТИНГЛОВЧИЛАРИНИНГ ЛОГИН ВА ПАРОЛЛАРИ
    </p>
    <table border="1" style="border-collapse: collapse;">
        <tr>
            <th style="width: 40px; text-align:center">Т/р</th>
            <th style="width: 320px; text-align:center">Ф.И.О.</th>
            <th style="width: 50px; text-align:center">Гуруҳ</th>
            <th style="width: 120px; text-align:center">Логин</th>
            <th style="width: 120px; text-align:center">Парол</th>
        </tr>
        '; $i=0;
        foreach ($userStd as $std) :
            $student = \common\models\Student::find()
                ->where(['user_id'=>$std->id])
                ->one();
            $gr = \common\models\Group::find()
                ->where(['id'=>$student->group_id])
                ->one();
             $pass = (string)StudentController::fetch($std->id);
             $pass = mb_convert_encoding($pass, 'UTF-8', 'UTF-8');
        echo '<tr>
            <td style="text-align: center;">'.++$i.'</td>
            <td>'.$std->full_name.'</td>
            <td style="text-align: center;">'.$gr->name.'</td>
            <td style="text-align: center;">'.$std->username.'</td>
            <td style="text-align: center;">'.$pass.'</td>
            </tr>';
        endforeach;
        echo '</table>';
        $t = ob_get_contents();
        ob_end_clean();

        $export->WriteHTML($t);

        $export->Output();
        exit;

    }
    public function actionDelete($id, $id1)
    {

        $fanclub = Student::find()->where(['id'=>$id1])->one();
        if($fanclub)
        {
            $fanclub->delete();
        }

        $this->findModel($id)->delete();
        // delete this user's role from auth_assignment table
        if ($role = Role::find()->where(['user_id'=>$id])->one()) 
        {
            $role->delete();
        }
        return $this->redirect('../student');
    }

    public function actionDeletes($id,$student_id)
    {


        $user = $this->findUser($id);


        return $this->redirect(['student', 'id' => $student_id]);
    }

    public function actionList($id) {

        $user=\common\models\User::find()
            ->where(['=', 'user.id', Yii::$app->user->id])
            ->one();

        $direction = \common\models\Direction::find()->andWhere(['faculty_id'=>$id])->andWhere(['uni_id'=>$user->uni_id])->all();
        if($direction){

            echo "<option> -Yunalish tanlang-</option>";
            foreach($direction as $c){
                echo "<option value='".$c->id."'> $c->name </option>";
            }

        }

        else{
            echo "<option> Grux yo`q </option>";
        }

    }
    public function actionLists($id) {

        $user=\common\models\User::find()
            ->where(['=', 'user.id', Yii::$app->user->id])
            ->one();

        $direction = \common\models\Group::find()->andWhere(['direction_id'=>$id])->andWhere(['uni_id'=>$user->uni_id])->all();
        if($direction){
                echo "<option> -Guruh tanlang-</option>>";
            foreach($direction as $c){
                echo "<option value='".$c->id."'>$c->name </option>";
            }
        }
        else{
            echo "<option> Grux yo`q </option>";
        }
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
