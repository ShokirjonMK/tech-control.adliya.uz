<?php

namespace backend\modules\v1\controllers;

use common\models\IsThere;
use Yii;

class MainController extends \yii\web\Controller
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

    public function actionIndex($qr, $t)
    {
        if (\Yii::$app->request->isGet){
            
        $user = \common\models\User::findOne(['password_reset_token' => $t]);


        $finalWork = \common\models\FinalWork::find()
            ->where(['qr_code' => $qr])
            ->andWhere(['status' => 1])
            ->andWhere(['uni_id' => $user->uni_id])
            ->one();

       $fan = \common\models\Fan::find()
            ->where(['id'=>$finalWork->fan_id])
            ->andWhere(['uni_id' => $user->uni_id])
            ->one();
            
//  echo "<pre>";
// print_r(date('Y-m-d'));
// echo "<br>";
// print_r($finalWork->started_date);
// echo "<br>";
// print_r($finalWork->started_date  > date('Y-m-d'));

// echo "<br>";
// print_r($finalWork->finished_date  > date('Y-m-d'));
// echo "</pre>";
// exit;           

        if( ($finalWork->started_date  <= date('Y-m-d')) && ($finalWork->finished_date  >= date('Y-m-d')) )
        {

            return [
                        'status' => 1,
                        'fan' => $fan->name
                        ];
        }
            else {  
                return [
                            'status' => 0,
                            'message' => 'Afsuski ruxsat yo`q!'
                ];
            }
        
        }
    }

    public function actionGrade($qr, $ball, $des, $t)
    {
        if (\Yii::$app->request->isPost){

            $user = \common\models\User::findOne(['password_reset_token' => $t]);

            $finalWork = \common\models\FinalWork::find()
                ->where(['qr_code'=>$qr])
                // ->andWhere(['uni_id'=>$user->uni_id])
                ->one();

        if( ($finalWork->started_date  <= date('Y-m-d')) && ($finalWork->finished_date  >= date('Y-m-d')) )
        {
            $finalWork->ball = $ball;
            $finalWork->description = $des;
            $finalWork->updated_at = date('Y-m-d H:i:s');
            $finalWork->updated_by = $user->id;

            if($finalWork->save()){


            return [
                'message' => 'Success',
            ];
            }
        }

            else {
            return [
                'message' => 'Failed',
            ];
            }
        }
    }

    /**/


    public function actionTime()
    {
        if (\Yii::$app->request->isPost) {
            $userdata = \Yii::$app->request->getRawBody();
            $userdata = json_decode($userdata);
        if(empty($userdata)){
            return "Ma`lumotlar kelmadi!!!";
        }
            $id = $userdata->id;
            $time = $userdata->date;
            function get_day($day)
            {
                return date("Y-m-d", strtotime($day));
            }

            // $userT = \common\models\User::findOne(['password_reset_token' => $t]);
            $user = \common\models\User::findOne(['id' => $id]);
            $uni_id = $user->uni_id;

            if ($user->id == $id) {

                $here = \common\models\IsThere::find()
                    ->where(['user_id' => $id])
                    ->orderBy(['id' => SORT_DESC])
                    ->one();

                if ($here->status == 1) {

                    if(date("Y-m-d", strtotime($time)) != date("Y-m-d", strtotime($here->start_at))) {
                        $here->delete();
                        $here_New = new IsThere();
                        $here_New->user_id = $id;
                        $here_New->date = get_day($time);
                        $here_New->start_at = $time;
                        $here_New->uni_id = $uni_id;
                        $here_New->status = 1;
                        $here_New->save();
                        return [
                            'status' => 1,
                            'message' => 'Hush kelibsiz! Kecha chiqishda nazoratdan o`tmaganingiz uchun kechagi vaqt o`chirildi!'
                        ];
                    }
                    else {

                        $here->finish_at = $time;
                        $here->status = 0;
                        $here->different = strtotime($here->finish_at) - strtotime($here->start_at);
                        $here->save();

                        return [
                            'status' => 0,
                            'message' => 'Xayr!'
                        ];
                    }
                }
                if (($here->status == 0) or  empty($here)) {
                    $hereNew = new IsThere();
                    $hereNew->user_id = $id;
                    $hereNew->date = get_day($time);
                    $hereNew->start_at = $time;
                    $hereNew->uni_id = $uni_id;
                    $hereNew->status = 1;
                    $hereNew->save();

                    return [
                        'status' => 1,
                        'message' => 'Hush kelibsiz!'
                    ];
                }
            }

            else {
                return [
                    'status' => -1,
                    'message' => 'Foydalanuvchi topilmadi!!!'
                ];
            }
        } else {
            return "Xatolik! POST so`rov emas!!!";
        }

    }

    public function actionFtime($t, $id, $date)
    {
        if (\Yii::$app->request->isGet) {
        //     $userdata = \Yii::$app->request->getRawBody();
        //     $userdata = json_decode($userdata);
        // if(empty($userdata)){
        //     return "Ma`lumotlar kelmadi!!!";
        // }
            // $id = $userdata->id;
            // $date = $userdata->date;

            function get_day($day)
            {
                return date("Y-m-d", strtotime($day));
            }

            $user_t = \common\models\User::findOne(['password_reset_token' => $t]);

            if (empty($user_t)) {
                return [
                        'status' => -1,
                        'message' => 'Xavfsizlik tekshiruvidan o`ta olmadingiz!!!'
                ];
            }

            // if ( $user_t->role_id == 'Student') {
            //     return [
            //             'status' => -1,
            //             'message' => 'Siz uchun ma`lumotlarni olishga ruxsat yo`q!!!'
            //     ];
            // }

            $uni_id = $user_t->uni_id;
            $user = \common\models\User::findOne(['id' => $id]);
            $student = \common\models\Student::findOne(['user_id'=>$user->id]);
            $gr = \common\models\Group::findOne(['id'=>$student->group_id]);

            if ($user->id == $id) {
                $data = [];
                $is_here = \common\models\IsThere::find()
                    ->where(['user_id'=>$id])
                    ->andWhere(['>=', 'date', get_day($date)])
                    ->andWhere(['uni_id'=> $uni_id ])
                    ->andWhere(['status'=> 0 ])
                    ->select(['date', 'start_at', 'finish_at', 'different'])
                    ->all();

              return $is_here;
            }
            else {
                return [
                    'status' => -1,
                    'message' => 'Foydalanuvchi topilmadi!!!'
                ];
            }
        } else {
            return "Xatolik! GET so`rov emas!!!";
        }

    }

    public function actionGroup($t)
    {
        if (\Yii::$app->request->isGet){

           $user = \common\models\User::findOne(['password_reset_token'=>$t]);

           if (empty($user)) {
                return [
                        'status' => -1,
                        'message' => 'Xavfsizlik tekshiruvidan o`ta olmadingiz!!!'
                ];
           }

           $uni_id = $user->uni_id;

           if ($user->role_id == 'Admin' || $user->role_id == 'theCreator' || $user->role_id == 'Teacher') {
               
            $gr = \common\models\Group::find()
                ->where(['uni_id'=>$user->uni_id])
                ->select(['id', 'name', 'course_number' ])
                ->all();
             
            return $gr;
        } 
            else {

               return [
                        'status' => -1,
                        'message' => 'Sizga bunday huquq belgilanmagan!!!'
                        ];
            }
        }
    }

     public function actionVersion($t)
    {
        if (\Yii::$app->request->isGet){

           $user = \common\models\User::findOne(['password_reset_token'=>$t]);

           if (empty($user)) {
                return [
                        'status' => -1,
                        'message' => 'Xavfsizlik tekshiruvidan o`ta olmadingiz!!!'
                ];
           }

           $version = \common\models\AppVersion::find()->orderBy(['id' => SORT_DESC])->one();

                // $data = [];

                // $data['version_code'] = $version->code;
                // $data['version_name'] = $version->version;


               return [
                        'status' => $version->status,
                        'version_code' => $version->code,
                        'version_name' => $version->version,
                        ];
            }
       
    }
  
}