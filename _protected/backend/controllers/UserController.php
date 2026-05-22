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
class UserController extends BackendController
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
        $user = $user=\common\models\User::find()
            ->where(['=', 'user.id', Yii::$app->user->id])
            ->one();


        if ($user->role_id == "Admin"){

            $users = \common\models\User::find()

                ->andWhere(['!=', 'role_id', 'theCreator'])
                ->all();
            return $this->render('index', [
                'users' => $users,

            ]);
        }
        if ($user->role_id == "theCreator"){
            $users = \common\models\User::find()
                ->andWhere(['!=', 'role_id', 'theCreator'])
                ->andWhere(['!=', 'role_id', 'Student'])
                ->all();
            return $this->render('index', [
                'users' => $users,

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
        $user_sayt = \common\models\User::find()
            ->where(['=', 'user.id', Yii::$app->user->id])
            ->one();

        if (
            $user->load(Yii::$app->request->post()) &&
            $role->load(Yii::$app->request->post()) &&
            Model::validateMultiple([$user, $role])
        ) {
            $user->setPassword($user->password);
            $user->generateAuthKey();
            $user->status = 10;
            $user->gender = ($_POST['User']["gender"]);

            $user->role_id = ($_POST['Role']['item_name']);
            $datetime = new DateTime();
            $timezone = new DateTimeZone('Asia/Tashkent');
            $datetime->setTimezone($timezone);
            $now_date = ($datetime->format('Y-m-d'));
            $password = ($_POST['User']["password"]);
            if ($user->save()) {
                $role->user_id = $user->getId();
                $role->save();

                $encrption = new Password();
               $encrption->password = $password;
//               $encrption->password = rtrim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $password, MCRYPT_MODE_ECB)));
               //  $encrption->password = md5($password);
                $encrption->user_id = $user->getId();

                $encrption->save();
                return $this->redirect('index');
            }
        } else {
            return $this->render('create', [
                'user' => $user,
                'role' => $role,
            ]);
        }
    }

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
                // echo "<pre>";
                // print_r($user);
                // echo "</pre>";
                // exit;
        if (
            $user->load(Yii::$app->request->post()) &&
            $role->load(Yii::$app->request->post()) && Model::validateMultiple([$user, $role])
        ) {

            $user->setPassword($user->password);
            $user->generateAuthKey();
            $user->status = 10;
            $user->role_id = ($_POST['Role']['item_name']);
            $datetime = new DateTime();
            $timezone = new DateTimeZone('Asia/Tashkent');
            $datetime->setTimezone($timezone);
            $now_date = ($datetime->format('Y-m-d'));
            $password = ($_POST['User']["password"]);


//            var_dump($password);
//            exit();
            $encrption = Password::findOne(['user_id' => $id]);
            if ($user->save()) {
                $role->user_id = $user->getId();
                $role->save();

                $encrption = new Password();
               $encrption->password = $password;
//               $encrption->password = rtrim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $password, MCRYPT_MODE_ECB)));
               //  $encrption->password = md5($password);
                $encrption->user_id = $user->getId();

                $encrption->save();
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