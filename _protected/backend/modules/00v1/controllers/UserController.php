<?php

namespace backend\modules\v1\controllers;

use backend\modules\v1\models\User;
use Yii;

class UserController extends \yii\web\Controller
{
    public $enableCsrfValidation = false;

    public function behaviors()
    {
        return parent::behaviors() + [
                [
                    'class' => \yii\filters\ContentNegotiator::className(),
                    'formats' => [
                        'application/json' => \yii\web\Response::FORMAT_JSON,
                    ],
                ],
            ];
    }


    public function actionIndex($login, $parol, $device_id)
    {
        if (\Yii::$app->request->isGet){

            // $user_data = \Yii::$app->request->getRawBody();
            // $user_data = json_decode($user_data);
            $username = $login;
            $password = $parol;

        $data = [];

                 
            $user = \common\models\User::find()
                ->where(['username'=>$username])
                ->one();
                
            if ($user->role_id == 'theCreator') {
                $role = 0;
            }
            if ($user->role_id == 'Admin') {
                $role = 1;
            }
            if ($user->role_id == 'Teacher') {
                $role = 2;
            }
            if ($user->role_id == 'Student') {
                $role = 3;
            }
            if ($user) {  
                if ($user->validatePassword($password)) {
                    
					if($user->device_id == NULL || $user->device_id == $device_id){

			        $str_result = $user->password_hash; 
                    $length_of_string = ((int) (microtime(true) * (1000)));

                    $token = substr(str_shuffle($str_result), 0, $length_of_string);
                    $user->password_reset_token = $token;
					$user->device_id = $device_id;
                    $user->save(false);

                    $data['id'] = $user->id;
                    $data['role'] = $role;
                    $data['full_name'] = $user->full_name;
                    $data['image'] = $user->image;
                    $data['token'] = $user->password_reset_token;



                    return [
                        'status' => 1,
                        'data' => $data
                        ];
					} else {
						return [
                        'status' => 0,
                        'message' => 'Bu boshqa qurilma!'
                        ];
					}
                   
                    }  else {
                      return [
                        'status' => 0,
                        'message' => 'Login yoki parol xato!'
                        ];
                    }
                } else {
                      return [
                        'status' => 0,
                        'message' => 'Login yoki parol xato!'
                        ];
                    }

            } else {
                      return [
                        'status' => 0,
                        'message' => 'So`rov xato jo`natildi!'
                        ];
                    }
        
    }

    public function actionIndex1($t)
    {
        if (\Yii::$app->request->isGet){

           $user = \common\models\User::findOne(['password_reset_token'=>$t]);

           if (empty($user)) {
                return [
                        'status' => -1,
                        'message' => 'Xavfsizlik tekshiruvidan o`ta olmadingiz!!!'
                ];
           }

           if ($user->role_id == 'Admin' || $user->role_id == 'theCreator') {
               

            $std = \common\models\User::find()
               ->where(['uni_id'=>$user->uni_id])
            	->andWhere(['role_id'=>'Student'])
                ->select(['id', 'full_name', 'image' ])
                ->all();

            $data = [];
            $ddd = [];
            foreach ($std as $stdOne) {
                $student = \common\models\Student::findOne(['user_id'=>$stdOne->id]);

                $ddd['id'] = $stdOne->id;
                $ddd['full_name'] = $stdOne->full_name;
                $ddd['image'] = $stdOne->image;
                $ddd['group'] = $student->group_id;

                $data[] = $ddd;
            }

            return $data;
        } 
            else {

               return [
                        'status' => -1,
                        'message' => 'Faqat admin bunday huquqga ega!!!'
                        ];
            }
        }
    }

}