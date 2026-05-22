<?php
namespace backend\controllers;

use common\models\ExamStudent;
use common\models\User;
use common\models\UserSearch;
use common\rbac\models\Role;
use common\models\Keys;
use common\models\Password;
use common\models\Stdgroup;
use yii\web\Controller;
use yii\base\Model;
use yii\web\NotFoundHttpException;
use Yii;
use DateTime;
use DateTimeZone;


/**
 * UserController implements the CRUD actions for User model.
 */
class AdminController extends Controller
{


    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    /**
     * Lists all User models.
     *
     * @return string
     */
    public function actionIndex()
    {
//        $user = $user=\common\models\User::find()
//            ->where(['=', 'user.id', Yii::$app->user->id])
//            ->one();
//        if ($user->role_id == "theCreator"){
//            $users = \common\models\User::find()->andWhere(['=', 'role_id', 'Admin'])->all();
//            return $this->render('index', [
//                'users' => $users,
//
//            ]);
//        }
//        else{
//            return $this->render('../site/error');
            return $this->render('../tex/index');
//        }
    }

    public function actionStat()
    {
        $user=\common\models\User::find()->where(['=', 'user.id', Yii::$app->user->id])->one();
        $teacher=\common\models\User::find()->where(["uni_id"=>$user->uni_id, 'role_id'=>'Teacher', 'status'=>10])->count();
        $student=\common\models\User::find()->where(["uni_id"=>$user->uni_id, 'role_id'=>'Student', 'status'=>10])->count();
        $admin=\common\models\User::find()->where(["uni_id"=>$user->uni_id, 'role_id'=>'Admin', 'status'=>10])->count();
        $group1=\common\models\Group::find()->where(["uni_id"=>$user->uni_id])->count();
        if ($user->role_id == "theCreator" || $user->role_id == "Admin"){
            $statistika = \common\models\TimeTable::find()
                ->leftJoin('group', 'group.id = time_table.group_id')
                ->select(['group_id', 'fan_id'])
                ->where(['group.uni_id'=>$user->uni_id])
                ->groupBy(['group_id'])
                ->all();

//echo "<pre>";
//print_r($statistika);
//exit();


//        return $statistika;
            return $this->render('stat', [
                'statistika' => $statistika,
                'group1' => $group1,
                'teacher' => $teacher,
                'admin' => $admin,
                'student' => $student,

            ]);
        }
        else{
            return $this->render('../site/error');
        }
    }

    public function actionFan($id)
    {
        $user=\common\models\User::find()->where(['=', 'user.id', Yii::$app->user->id])->one();
        if ($user->role_id == "theCreator" || $user->role_id == "Admin"){
            $fan = \common\models\TimeTable::find()->leftJoin('group', 'group.id=time_table.group_id')
            ->where(['group.id'=>$id, 'group.uni_id'=>$user->uni_id])->groupBy('time_table.fan_id')->all();
            return $this->render('fan', [
                'fan' => $fan
            ]);
        }
        else{
            return $this->render('../site/error');
        }
    }


    public function actionMonitoring($id, $smester_id)
    {
        $user = $user=\common\models\User::find()->where(['=', 'user.id', Yii::$app->user->id])->one();
        if ($user->role_id == "theCreator" || $user->role_id == "Admin"){
            $monitoring = \common\models\User::find()->leftJoin('student', 'student.user_id=user.id')
            ->andWhere(['user.uni_id'=>$user->uni_id, 'student.group_id'=>$id])->all();
            return $this->render('monitoring', [
                'monitoring' => $monitoring,
                'id' => $id,
                'smester_id' => $smester_id,
            ]);
        }
        else{
            return $this->render('../site/error');
        }
    }

    public function actionMark($id, $exam_id, $fan_id)
    {
        $user=\common\models\User::find()->where(['=', 'user.id', Yii::$app->user->id])->one();
        if ($user->role_id == "theCreator" || $user->role_id == "Admin"){

            $statistika = \common\models\User::find()->leftJoin('student', 'student.user_id=user.id')
            ->andWhere(['user.uni_id'=>$user->uni_id, 'student.group_id'=>$id])->all();

            return $this->render('mark', [
                'statistika' => $statistika,
                'id' => $id,
                'exam_id' => $exam_id,
                'fan_id' => $fan_id,
            ]);
        }
        else{
            return $this->render('../site/error');
        }
    }

    public function actionDocument(){
        $user = \common\models\User::find()->where(['id'=>Yii::$app->user->id])->one();
        $document = \common\models\Document::find()
            ->leftJoin('user', 'user.id=document.user_id')
            ->where(['user.role_id'=>'Teacher'])
            ->andWhere(['user.uni_id'=>$user->uni_id])->all();

        return $this->render('../admin/document');
    }



    /**
     * Displays a single User model.
     *
     * @param  integer $id The user id.
     * @return string
     *
     * @throws NotFoundHttpException
     */

    public function actionViewuser($id)
    {
        $userone = \common\models\User::findOne(['id'=>$id]);

        return $this->render('viewuser', [
            'user' => $userone,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
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
        $uni_id = ($_POST['User']['university']);

        if (
            $user->load(Yii::$app->request->post()) &&
            $role->load(Yii::$app->request->post()) &&
            Model::validateMultiple([$user, $role])
        ) {
            $user->setPassword($user->password);
            $user->generateAuthKey();
            $user->status = 10;
            $user->gender = ($_POST['User']["gender"]);
            $user->uni_id = (int) $uni_id;
            $user->role_id = "Admin";
            $datetime = new DateTime();
            $timezone = new DateTimeZone('Asia/Tashkent');
            $datetime->setTimezone($timezone);
            $now_date = ($datetime->format('Y-m-d'));
            $password = ($_POST['User']["password"]);
            if ($user->save()) {
                $role->user_id = $user->getId();
                $role->save();
                $key_id = $this->keyselecter(); // keyselecter method selects randomly and written bottom
                $key = Keys::findOne($key_id);
                $key = $key->key;
                $key = md5('defender' . $key);
                $encrption = new Password();
               $encrption->password = rtrim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $password, MCRYPT_MODE_ECB)));
                $encrption->user_id = $user->getId();
                $encrption->key_id = $key_id;
                $encrption->save();
                return $this->redirect('../admin/index');
            }
        } else {
            return $this->render('create', [
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
    public function actionUpdate($id)
    {
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
            $user->load(Yii::$app->request->post()) &&
            $role->load(Yii::$app->request->post()) && Model::validateMultiple([$user, $role])
        ) {
            $user->setPassword($user->password);
            $user->generateAuthKey();
            $user->status = 10;
            $user->role_id = "Admin";
            $datetime = new DateTime();
            $timezone = new DateTimeZone('Asia/Tashkent');
            $datetime->setTimezone($timezone);
            $now_date = ($datetime->format('Y-m-d'));
            $password = ($_POST['User']["password"]);
            $encrption = Password::findOne(['user_id' => $id]);
            if ($user->save()) {
                $role->user_id = $user->getId();
                $role->save();
                if ($password) {
                    $key_id = $this->keyselecter(); // keyselecter method selects randomly and written bottom
                    $key = Keys::findOne($key_id);
                    $key = $key->key;
                    $key = md5('defender' . $key);
                    $encrption->password = rtrim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $password, MCRYPT_MODE_ECB)));
                    $encrption->key_id = $key_id;
                    $encrption->save();
                }
                return $this->redirect('index');
            }
        } else {
            return $this->render('update', [
                'user' => $user,
                'role' => $role,
            ]);
        }
    }

    public function actionDel($id){
        // $user = User::find()->select(['user.id', 'user.status'])->where(['id'=>$id])->one();
        $user = $this->findModel($id);
        $user->status = 1;
        $user->save();
        // echo "<pre>".print_r($user->errors, true); die;
// var_dump($user->status); die;
        return $this->redirect('index');
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

        return $this->redirect('index');
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
