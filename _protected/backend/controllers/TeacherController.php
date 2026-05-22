<?php

namespace backend\controllers;

use common\models\ExamStudent;
use common\models\Teacher;
use common\models\User;
use common\models\UserSearch;
use common\rbac\models\Role;
use common\models\Keys;
use common\models\Password;
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
class TeacherController extends BackendController
{
    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;return parent::beforeAction($action);
    }

    /**
     * Lists all User models.
     *
     * @return string
     */
    public function actionIndex()
    {

        $user = $user=\common\models\User::find()
            ->where(['=', 'user.id', Yii::$app->user->id])
            ->one();
        if ($user->role_id == "theCreator"){
            $user = \common\models\User::find()
                ->where(['status'=>10])
                ->andWhere(['role_id'=>'Teacher'])
                ->all();
            return $this->render('index', [
                'user' => $user,
            ]);
        }elseif ($user->role_id == "Admin"){
            $user = \common\models\User::find()
                ->where(['uni_id'=>$user->uni_id, 'status'=>10])
                ->andWhere(['role_id'=>'Teacher'])
                ->all();
            return $this->render('index', [
                'user' => $user,
            ]);
        }

        else{
            return $this->render('../site/error');
        }
    }


    public function actionStatus($id)
    {
        $user = \common\models\User::find()->where(['id'=>$id])->one();
        echo "<pre>";
        print_r($user->status);exit();

        $user->save();

        return $this->redirect('index');
    }

    public function actionView($id)
    {
        $model = User::findOne($id);
        return $this->render('view', [
            'teacher_id' => $id,
            'model' => $model
        ]);
    }
    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $user = new User(['scenario' => 'create']);
        $role = new Role();
        $user_sayt = \common\models\User::find()->where(['=', 'user.id', Yii::$app->user->id])->one();
        $uni_id = $user_sayt->uni_id;
        $lang = \common\models\Lang::find()->all();
        $fan = \common\models\Fan::find()->where(['=', 'fan.uni_id', $uni_id])->all();
        if ($user->load(Yii::$app->request->post())) {
            $password = ($_POST['User']["password"]);
            $kafedra = $_POST['User']["kafedra_id"];
            $status = $_POST['User']["status"];
            $degree_id = $_POST['User']["degree_id"];
            $user->setPassword($user->password);
            $user->generateAuthKey();
            $user->status = $status;
            $user->uni_id = (int) $uni_id;
            $user->role_id = 'Teacher';
            $datetime = new DateTime();
            $timezone = new DateTimeZone('Asia/Tashkent');
            $datetime->setTimezone($timezone);
            $now_date = ($datetime->format('Y-m-d'));
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
            if ($user->save()) {

                $role->item_name = 'Teacher';
                $role->user_id = $user->getId();
                $role->save();
                foreach ($_POST as $key=>$index) {
                    $result = (explode("fan",$key));
                    $fan_id=($result[0]);
                    $lang_id=($result[1]);
                    $teacher = new Teacher();
                    $teacher->user_id = $user->getId();
                    $teacher->kafedra_id = $kafedra;
                    $teacher->fan_id = $fan_id;
                    $teacher->lang_id = $lang_id;
                    $teacher->status = $status;
                    $teacher->degree_id = $degree_id;
                    $teacher->save();
                }

                $key_id = $this->keyselecter(); // keyselecter method selects randomly and written bottom
                $key = Keys::findOne($key_id);
                $key = $key->key;
                $key = md5('defender' . $key);
                $encrption = new Password();
//                $encrption->password = md5($password);
                $encrption->password = rtrim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $password, MCRYPT_MODE_ECB)));
                $encrption->user_id = $user->getId();
                $encrption->key_id = $key_id;
                $encrption->save();
                return $this->redirect('index');
            }

        } else {

            return $this->render('create', [
                'user' => $user,
                'role' => $role,
                'lang' => $lang,
                'fan' => $fan,
            ]);

        }


    }
/**
* EXPORT
*/
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
        $userTeacher = \common\models\User::find()
            ->where(['uni_id'=>$user->uni_id])
            ->andWhere(['role_id'=>'Teacher'])
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
    <br/>ЎҚИТУВЧИЛАРИНИНГ ЛОГИН ВА ПАРОЛЛАРИ
    </p>
    <table border="1" style="border-collapse: collapse;">
        <tr>
            <th style="width: 40px; text-align:center">Т/р</th>
            <th style="width: 320px; text-align:center">Ф.И.О.</th>
            <th style="width: 150px; text-align:center">Логин</th>
            <th style="width: 150px; text-align:center">Парол</th>
        </tr>
        '; $i=0;
        foreach ($userTeacher as $ut) :

             $pass = $this->fetch($ut->id);
             $pass = mb_convert_encoding($pass, 'UTF-8', 'UTF-8');
        echo '<tr>
            <td style="text-align: center;">'.++$i.'</td>
            <td>'.$ut->full_name.'</td>
            <td style="text-align: center;">'.$ut->username.'</td>
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

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param  integer $id The user id.
     * @return string|\yii\web\Response
     *
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $deletes = Teacher::find()->where(['user_id'=>$id])->all();
//        echo "<pre>";
//        print_r($_POST);
//        exit();
        if (Yii::$app->request->post()) {

//var_dump(Yii::$app->request->post());

            $status = ($_POST['User']["status"]);
            $degree_id = ($_POST['User']["degree_id"]);
            $kafedra_id = ($_POST['User']["kafedra_id"]);
            foreach ($_POST as $key => $index) {
                $result = (explode("fan", $key));
                $fan_id=0;
                if((int)$result[0] >0 ){
//                    echo "NOL=".$result[0] ;
//                    echo "<br>BIR=".$result[1] ;
                    $fan_id = ($result[0]);
                    $lang_id = ($result[1]);
                }

                foreach ($deletes as $delete) {
                    if ($deletes) {
                        $delete->delete();
                    }
                }
                if($fan_id>0) {
                    $teacher = new Teacher();
                    $teacher->user_id = $id;
                    $teacher->kafedra_id = $kafedra_id;
                    $teacher->fan_id = $fan_id;
                    $teacher->lang_id = $lang_id;
                    $teacher->status = $status;
                    $teacher->degree_id = $degree_id;
                    $teacher->save();
                }
            }
        }
        // get role
        $role = Role::findOne(['user_id' => $id]);

        // get user details
        $user = $this->findModel($id);

        // only The Creator can update everyone`s roles
        // admin will not be able to update role of theCreator
        if (!Yii::$app->user->can('theCreator')) {
            if ($role->item_name === 'theCreator') {
                return $this->goHome();
            }
        }

        // load user data with role and validate them
        if (
        $user->load(Yii::$app->request->post())
        ) {
            $role = Role::findOne(['user_id' => $id]);
            $user->setPassword($user->password);
            $user->generateAuthKey();
            $user->status = $status;
            $datetime = new DateTime();
            $timezone = new DateTimeZone('Asia/Tashkent');
            $datetime->setTimezone($timezone);
            $user->rasm = UploadedFile::getInstance($user, 'rasm');
            if ($user->rasm){
                $filename = floor(microtime(true) * 1000) . "." . $user->rasm->extension;
                $user->image = $filename;
                $user->rasm->saveAs("../uploads/".$filename);
            }
            $user->rasm = null;
            $user->save();
            $role->user_id = $user->getId();
            $role->save(false);
            $now_date = ($datetime->format('Y-m-d'));
            $password = ($_POST['User']["password"]);
            $encrption = Password::findOne(['user_id' => $id]);
            if ($user->save()) {
                    $key_id = $this->keyselecter(); // keyselecter method selects randomly and written bottom
                    $key = Keys::findOne($key_id);
                    $key = $key->key;
                    $key = md5('defender' . $key);
                    $encrption->password = rtrim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $password, MCRYPT_MODE_ECB)));
                    $encrption->user_id = $user->getId();
                    $encrption->key_id = $key_id;
                    $encrption->save();
                return $this->redirect('index?id='.$id);
            }
        } else {
            return $this->render('update', [
                'user' => $user,
                'role' => $role,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param  integer $id The user id.
     * @return \yii\web\Response
     *
     * @throws NotFoundHttpException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        // delete this user's role from auth_assignment table
        if ($role = Role::find()->where(['user_id' => $id])->one()) {

            $role->delete();
        }

        return $this->redirect('student');
    }
    public function actionDeletes($id, $student_id)
    {

        $model = Stdgroup::findOne($id)->delete();

        return $this->redirect(['view', 'id' => $student_id]);
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
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
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
    public function actionFetch($id)
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
}
