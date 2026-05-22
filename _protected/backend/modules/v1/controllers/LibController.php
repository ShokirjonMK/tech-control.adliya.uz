<?php

namespace backend\modules\v1\controllers;

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

    public function actionLibfan($t){

        if (\Yii::$app->request->isGet){

           $user = \common\models\User::findOne(['password_reset_token'=>$t]);

            if (empty($user)) {
                return [
                        'status' => -1,
                        'message' => 'Xavfsizlik tekshiruvidan o`ta olmadingiz!!!'
                ];
            }

        //student
            if ($user->role_id == "Student") {
                $uni_id = $user->uni_id;
                $student = \common\models\Student::findOne(['user_id'=>$user->id]);

                $gr = \common\models\Group::findOne(['id'=>$student->group_id]);

                $time_table = \common\models\TimeTable::find()
                    ->where(['group_id'=>$gr->id])
                    ->andWhere(['uni_id'=>$uni_id])
                    ->andWhere(['smester'=>$gr->smester])
                    ->all();

                $data = [];
                $dd = [];
                foreach ($time_table as $tt) {
                    
                    $fan = \common\models\Fan::findOne(['id'=>$tt->fan_id]);

                    $data['id'] = $fan->id;
                    $data['name'] = $fan->name;
                    $dd[] = $data;
                }

                return [
                        'status' => 1,
                        'data' => $dd,
                        ];

            }
        //teacher
            if ($user->role_id == "Teacher") {
                $uni_id = $user->uni_id;
                $teacher = \common\models\Teacher::find()
                    ->where(['user_id'=>$user->id])
                    ->groupBy(['fan_id'])
                    ->all();

                $data = [];
                $dd = [];
                foreach ($teacher as $tt) {
                    
                    $fan = \common\models\Fan::findOne(['id'=>$tt->fan_id]);

                    $data['id'] = $fan->id;
                    $data['name'] = $fan->name;
                    $dd[] = $data;
                }

                return [
                        'status' => 1,
                        'data' => $dd,
                        ];

            }

        // Admin theCreator
            if ($user->role_id == "Admin" || $user->role_id == "theCreator") {
                
                $data = [];
                $dd = [];

                if ($user->role_id == "theCreator") {
                    $fan = \common\models\Fan::find()
                        ->all();
                }

                if ($user->role_id == "Admin") {
                    $uni_id = $user->uni_id;
                    $fan = \common\models\Fan::find()
                        ->where(['uni_id'=>$uni_id])
                        ->all();
                }

                foreach ($fan as $f) {

                    $data['id'] = $f->id;
                    $data['name'] = $f->name;
                    $dd[] = $data;
                }

                return [
                        'status' => 1,
                        'data' => $dd,
                        ];

            }
               else {
                    return [
                        'status' => -1,
                        'message' => 'Tizimda bunday rol belgilanmagan!',
                        ];
               }
            }
            else {
            return "Xatolik! GET so`rov emas!!!";
        }

    }

    public function actionLibcat($t, $fan_id){
        if (\Yii::$app->request->isGet){

           $user = \common\models\User::findOne(['password_reset_token'=>$t]);

            if (empty($user)) {
                return [
                        'status' => -1,
                        'message' => 'Xavfsizlik tekshiruvidan o`ta olmadingiz!!!'
                ];
            }

            $uni_id = $user->uni_id;
        //student
            if ($user->role_id == "Student") {
                $uni_id = $user->uni_id;
                $library  = \common\models\Library::find()
                    ->where(['fan_id'=>$fan_id])
                    ->andWhere(['uni_id'=>$uni_id])
                    ->andWhere(['status'=>1])
                    ->groupBy(['category'])
                    ->all();
                
                $fan = \common\models\Fan::findOne(['id'=>$fan_id]);

                $data = [];
                $dd = [];

                foreach ($library as $lib) {
                    
                    $cat = \common\models\CategoryLib::findOne(['id'=>$lib->category]);

                    $data['id'] = $cat->id;
                    $data['name'] = $cat->name;

                    $dd[] = $data;
                }

                return [
                        'status' => 1,
                        'fan' = $fan,
                        'data' => $dd,
                        ];
            }

        //teacher
           if ($user->role_id == "Teacher") {
                $uni_id = $user->uni_id;
                $library  = \common\models\Library::find()
                    ->where(['fan_id'=>$fan_id])
                    ->andWhere(['uni_id'=>$uni_id])
                    ->andWhere(['status'=>1])
                    ->groupBy(['category'])
                    ->all();
                
                $fan = \common\models\Fan::findOne(['id'=>$fan_id]);

                $teacher = \common\models\Teacher::find()
                    ->where(['user_id'=>$user->id])
                    ->andWhere(['fan_id'=>$fan_id])
                    ->one();

                if (empty($teacher)) {
                    return 'Siz bu fandan dars bermaysiz!';
                }

                $data = [];
                $dd = [];

                foreach ($library as $lib) {
                    
                    $cat = \common\models\CategoryLib::findOne(['id'=>$lib->category]);

                    $data['id'] = $cat->id;
                    $data['name'] = $cat->name;

                    $dd[] = $data;
                }

                return [
                        'status' => 1,
                        'fan' = $fan,
                        'data' => $dd,
                        ];
            }

        // Admin theCreator
           if ($user->role_id == "Admin" || $user->role_id == "theCreator") {

                if ($user->role_id == "Admin") {
                $uni_id = $user->uni_id;
                $library  = \common\models\Library::find()
                    ->where(['fan_id'=>$fan_id])
                    ->andWhere(['uni_id'=>$uni_id])
                    ->andWhere(['status'=>1])
                    ->andWhere(['uni_id'=>$uni_id])
                    ->groupBy(['category'])
                    ->all();
                }
                
                if ($user->role_id == "theCreator") {

                $library  = \common\models\Library::find()
                    ->where(['fan_id'=>$fan_id])
                    ->andWhere(['uni_id'=>$uni_id])
                    ->andWhere(['status'=>1])
                    ->groupBy(['category'])
                    ->all();   
                }

                $fan = \common\models\Fan::findOne(['id'=>$fan_id]);

                $data = [];
                $dd = [];

                foreach ($library as $lib) {
                    
                    $cat = \common\models\CategoryLib::findOne(['id'=>$lib->category]);

                    $data['id'] = $cat->id;
                    $data['name'] = $cat->name;

                    $dd[] = $data;
                }

                return [
                    'status' => 1,
                    'fan' = $fan->name,
                    'data' => $dd,
                        ];
            }
               else {
                    return [
                        'status' => -1,
                        'message' => 'Tizimda bunday rol belgilanmagan!',
                        ];
               }

            }
            else{
                return "Xatolik! GET so`rov emas!!!";
            }
    }

    public function actionLibrary($t, $fan_id, $cat){
        if (\Yii::$app->request->isGet){

           $user = \common\models\User::findOne(['password_reset_token'=>$t]);

            if (empty($user)) {
                return [
                        'status' => -1,
                        'message' => 'Xavfsizlik tekshiruvidan o`ta olmadingiz!!!'
                ];
            }

        //Student
            if ($user->role_id == "Student") {
                $uni_id = $user->uni_id;
                $library  = \common\models\Library::find()
                    ->where(['fan_id'=>$fan_id])
                    ->andWhere(['category'=>$cat])
                    ->andWhere(['status'=>1])
                    ->andWhere(['uni_id'=>$uni_id])
                    ->all();

                $fan = \common\models\Fan::findOne(['id'=>$fan_id]);
                $category = \common\models\CategoryLib::findOne(['id'=>$cat]);

                $data = [];
                $dd = [];

                foreach ($library as $lib) {

                    $data['id'] = $lib->id;
                    $data['name'] = $lib->name;
                    $data['fayl'] = $lib->fayl;


                    $dd[] = $data;
                }
                return [
                    'status' => 1,
                    'cat' => $category,
                    'fan' => $fan,
                    'data' => $dd,
                    ];
            }
        //Teacher
            if ($user->role_id == "Teacher") {
                $uni_id = $user->uni_id;
                $library  = \common\models\Library::find()
                    ->where(['fan_id'=>$fan_id])
                    ->andWhere(['category'=>$cat])
                    ->andWhere(['status'=>1])
                    ->andWhere(['uni_id'=>$uni_id])
                    ->all();

                $fan = \common\models\Fan::findOne(['id'=>$fan_id]);
                $category = \common\models\CategoryLib::findOne(['id'=>$cat]);

                $data = [];
                $dd = [];

                foreach ($library as $lib) {

                    $data['id'] = $lib->id;
                    $data['name'] = $lib->name;
                    $data['fayl'] = $lib->fayl;


                    $dd[] = $data;
                }
                return [
                    'status' => 1,
                    'cat' => $category,
                    'fan' => $fan,
                    'data' => $dd,
                    ];
            }

        // Admin theCreator 
            if ($user->role_id == "Admin" || $user->role_id == "theCreator") {
                if ($user->role_id == "Admin") {
                    $uni_id = $user->uni_id;
                    $library  = \common\models\Library::find()
                        ->where(['fan_id'=>$fan_id])
                        ->andWhere(['category'=>$cat])
                        ->andWhere(['status'=>1])
                        ->andWhere(['uni_id'=>$uni_id])
                        ->all();
                }
                if ($user->role_id == "theCreator") {
                    $library  = \common\models\Library::find()
                        ->where(['fan_id'=>$fan_id])
                        ->andWhere(['category'=>$cat])
                        ->andWhere(['status'=>1])
                        ->all();
                }

                $fan = \common\models\Fan::findOne(['id'=>$fan_id]);
                $category = \common\models\CategoryLib::findOne(['id'=>$cat]);

                $data = [];
                $dd = [];

                foreach ($library as $lib) {

                    $data['id'] = $lib->id;
                    $data['name'] = $lib->name;
                    $data['fayl'] = $lib->fayl;


                    $dd[] = $data;
                }
                return [
                    'status' => 1,
                    'cat' => $category,
                    'fan' => $fan,
                    'data' => $dd,
                    ];
            }

            // else {
            //     return [
            //         'status' => -1,
            //         'message' => 'Tizimda bunday rol belgilanmagan!',
            //     ]
            // }
            }
            else {
                return "Xatolik! GET so`rov emas!!!";
            }
    }
}