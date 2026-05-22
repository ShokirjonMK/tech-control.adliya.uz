<?php

namespace frontend\modules\infi\controllers;

use yii\rest\Controller;
use Yii;
use common\models\Group;
use common\models\Exam;
use common\models\Elon;
use common\models\ExamFan;
use common\models\Fan;
use common\models\Sms;
use common\models\Chat;
use common\models\GroupSearch;
use common\models\Stdgroup;
use DateTime;
use DateTimeZone;
/**
 * Default controller for the `infi` module
 */
class DefaultController extends Controller
{
    public function behaviors()
    {
        return parent::behaviors() + [
            [
                'class' => \yii\filters\ContentNegotiator::className(),
                'formats' => [
                    'application/json' => \yii\web\Response::FORMAT_JSON,
                ],
            ],
            'bearerAuth' => [
                'class' => \yii\filters\auth\HttpBearerAuth::className(),
                'optional' => ['search', 'login','groups', 'fan',
                 'exam','myresult','elon','sms','chats','examall','mypayments','smssend'
                 ]
            ],
        ];
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionLogin()
    {
        // return 1;
        if(Yii::$app->request->isPost){
            $login = Yii::$app->request->post('login');
            
            $parol = Yii::$app->request->post('parol');

            $user = \common\models\User::findOne(['username' => $login]);
            
            $data=[];

        if ($user)
        {
            if ($user->validatePassword($parol)){
             if ($user->role_id=="O`quvchi")
                {
                    $student = \common\models\CourseStudent::findOne(['user_id' => $user->id]);
                    $data['id']=$user->id;
                    $data['login']=$user->username;
                    $data['first_name']=$student->first_name;
                    $data['last_name']=$student->last_name;
                    $data['middle_name']=$student->middle_name;
                    $data['birth_date']=$student->birth_date;
                    $data['number']=$student->number;
                    $data['father_number']=$student->father_number;
                    $data['mother_number']=$student->mother_number;
                    $data['image']=$student->image;
                    
                    return [
                        'data'=> ($data),
                        'status'=> 1,
                        'message' => 'xush kelibsiz'
                     ];
                }
             }
        
            else
            {
                return [
                    'status'=> -1,
                    'message' => 'Login yoki parol xato!!!'
                    ];
            }            
        }
        else
            {
                return [
                    'status'=> 0,
                    'message' => 'Login yoki Parol xato!!!'
                                ];
            }   
            
        }
    }

    
    public function actionGroups()
    {
        // return 1;
        if(Yii::$app->request->isPost){
            $login = Yii::$app->request->post('login');
            
            $user = \common\models\User::findOne(['username' => $login]);
            
            $data=[];

        if ($user)
        {
                $id=$user->id;
                $groups = \common\models\Group::find()
                ->innerJoin('stdgroup', 'stdgroup.group_id = group.id')
                ->where(['stdgroup.student_id'=>$id])->all();

                foreach($groups as $gr){
                    $data=[];
                    $fan = \common\models\Fan::findOne(['fan.id'=>$gr->fan_id]);
                    $teacher = \common\models\CourseTeacher::findOne(['user_id'=>$gr->teacher_id]);
                    $time_tables = \common\models\Timetables::find()->where(['group_id'=>$gr->id])->all();
                    
                
                        $data['id'] = $gr->id;
                        $data['nomi'] =  $gr->nomi;
                        $data['fan_nomi']=$fan->nomi;
                        $data['narx'] =  $gr->price;
                        $data['teacher'] =  $teacher->full_name;
                        $data['vaqt'] = $gr->start_time."--".$gr->finish_time;
                        
                    
                        $data1=[];
                      foreach($time_tables as $es){
                                  if($es->week_day==1) {
                                  $data1["hafta_kuni"]="Dushanba";      
                                  }
                                  if($es->week_day==2) {
                                    $data1["hafta_kuni"]="Seshanba";      
                                    }
                                    if($es->week_day==3) {
                                        $data1["hafta_kuni"]="Chorshanba";      
                                        }
                                        if($es->week_day==4) {
                                            $data1["hafta_kuni"]="Payshanba";      
                                            }
                                            if($es->week_day==5) {
                                                $data1["hafta_kuni"]="Juma";      
                                                }
                                                if($es->week_day==6) {
                                                    $data1["hafta_kuni"]="Shanba";      
                                                    }
                                                    if($es->week_day==7) {
                                                        $data1["hafta_kuni"]="Yakshanba";      
                                                        }

                      
                    $data["kunlar"][]=(object)$data1;                              
                         
                }
                    $dataa[]=$data;
              
                }
                return [
                    'data'=> ($dataa),
                    'status'=> 1,
                    'message' => 'Guruhlar keldi!'
                ];
            }
            else
            {
                return [
                    'status'=> -1,
                    'message' => 'Guruhga qoshilmagan'
                                ];
            }            
        }
        else
            {
                return [
                    'status'=> -1,
                    'message' => 'Post zapros emas'
                                ];
               
            
        }
    }

    public function actionFan()
    {
        // return 1;
        if(Yii::$app->request->isPost){
            $login = Yii::$app->request->post('login');
            
            $fan = \common\models\Fan::find()->all();
                foreach($fan as $gr){

                
                    $data[] = (object) [
                        'id' => $gr->id,
                        'nomi' =>  $gr->nomi,
                      ];
           
                }

                return [
                    'data'=>($data),
                    'status'=> 1,
                    'message' => 'Fanlar keldi!'
                                ];
                 
        }
        else
            {
                return [
                    'status'=> -1,
                    'message' => 'Post zapros emas'
                                ];
               
            
        }
    }

    public function actionExam()
    {
        // return 1;
        if(Yii::$app->request->isPost){
            $login = Yii::$app->request->post('login');
            
            $user = \common\models\User::findOne(['username' => $login]);
            
            $data=[];

        if ($user)
        {
                $id=$user->id;
                $exam = Exam::find()
        ->leftJoin('exam_fan', 'exam.id = exam_fan.exam_id')
        ->leftJoin('exam_student', 'exam_student.exam_fan_id = exam_fan.id')  
         ->where(['exam_student.student_id' => $id])
        ->orderBy([
            'id' => SORT_DESC 
         ])->all();
                foreach($exam as $gr){
                    $data[] = (object) [
                        'id' => $gr->id,
                        'nomi' =>  $gr->name
                      ];
                }
                return [
                    'data'=> ($data),
                    'status'=> 1,
                    'message' => 'Examlar keldi!'
                                ];
      }
            else
            {
                return [
                    'status'=> -1,
                    'message' => 'Examlar yo`q'
                                ];
            }            
        }
        else
            {
                return [
                    'status'=> -1,
                    'message' => 'Post zapros emas'
                                ];
               
            
        }
    }
    
    public function actionMyresult()
    {
        // return 1;
        if(Yii::$app->request->isPost){
            $login = Yii::$app->request->post('login');
            
            $user = \common\models\User::findOne(['username' => $login]);
            
            $data=[];

        if ($user)
        {
            $student_id=$user->id;
            $exam = Exam::find()
            ->leftJoin('exam_fan', 'exam.id = exam_fan.exam_id')
            ->leftJoin('exam_student', 'exam_student.exam_fan_id = exam_fan.id')  
             ->where(['exam_student.student_id' => $student_id])
            ->orderBy([
                'id' => SORT_DESC 
             ])->all();
             foreach ($exam as $e){    $data=[];$sum=0;
                $data['name'] =  $e->name;
                $exam_fan=ExamFan::find()
                ->where(['exam_fan.exam_id'=>$e->id])
                ->all();
                foreach($exam_fan as $ef){
                    $exam_student=\common\models\ExamStudent::find()
            ->leftJoin('exam_fan', 'exam_student.exam_fan_id = exam_fan.id')
            ->leftJoin('exam', 'exam_fan.exam_id = exam.id')  
             ->where(['exam.id' => $e->id])
             ->andWhere(['=', 'exam_student.student_id', $student_id])
             ->andWhere(['=', 'exam_fan.id',$ef->id])
             ->all();
                    $fan=\common\models\Fan::find()
                    ->where(['fan.id' => $ef->fan_id])->one();
                    foreach($exam_student as $es){
                        $sum=$sum+$es->answer;
                       }
                       $data['sum'] =   round($sum, 2); 
                  
                    foreach($exam_student as $es){
                   
                        $data1["answer"]=$es->answer;
                        $data1["ball"]=$ef->mark;
                        $data1["name"]=  $fan->nomi;
                  
                    
                    $data["block"][]=(object)$data1;
                   
                   }  
                }
                $dataa[]=$data;
                    }
                return [
                    'data'=> ($dataa),
                    'status'=> 1,
                    'message' => 'Examlar keldi!'
                                ];
      }
            else
            {
                return [
                    'status'=> -1,
                    'message' => 'Examlar yo`q'
                                ];
            }            
        }
        else
            {
                return [
                    'status'=> -1,
                    'message' => 'Post zapros emas'
                                ];
               
            
        }
    }

    public function actionMypayments()
    {
        // return 1;
        if(Yii::$app->request->isPost){
            $login = Yii::$app->request->post('login');
            $group_id = Yii::$app->request->post('group_id');
            $year = Yii::$app->request->post('year');
            $month = Yii::$app->request->post('month');
            
            $user = \common\models\User::findOne(['username' => $login]);
            
            $data=[];

        if ($user)
        {
            $student_id=$user->id;
            $payment_month = \common\models\PaymentMount::find()
             ->where(['user_id' => $student_id])
             ->andWhere(['group_id' => $group_id])
             ->andWhere(['year' => $year])
             ->andWhere(['month' => $month])
            ->orderBy([
                'id' => SORT_DESC 
             ])->one();
             $payment_list = \common\models\PaymentList::find()
             ->where(['user_id' => $student_id])
             ->andWhere(['group_id' => $group_id])
             ->andWhere(['year' => $year])
             ->andWhere(['month' => $month])
                ->all();
             $data['payment_month'] =  $payment_month->mount_pay;
                    foreach($payment_list as $es){
                        $data1["amount"]=$es->amount;
                        $data1["date"]=$es->date;
                      $data["payments"][]=(object)$data1;  
                }
                $dataa=$data;
                    }
                return [
                    'data'=> ($dataa),
                    'status'=> 1,
                    'message' => 'Tolovlar keldi!'
                                ];
      }
            else
            {
                return [
                    'status'=> -1,
                    'message' => 'Tolovlar yo`q'
                                ];
            }            
        }
    
    
    
    public function actionElon()
    {
        // return 1;
        if(Yii::$app->request->isPost){
            $login = Yii::$app->request->post('login');
              $user = \common\models\User::findOne(['username' => $login]);
              $course_id=$user->course_id;
            $elon = \common\models\Elon::find()->where(['course_id'=> $user->course_id])->all();
                foreach($elon as $gr){
                    $data[] = (object) [
                        'mavzu' => $gr->mavzu,
                        'matn' =>  $gr->title,
                        'date' =>  $gr->date,
                      ];
           
                }

                return [
                    'data'=> ($data),
                    'status'=> 1,
                    'message' => 'Elon keldi!'
                                ];
                 
        }
        else
            {
                return [
                    'status'=> -1,
                    'message' => 'Post zapros emas'
                                ];
               
            
        }
    }

    public function actionSms()
    {
        // return 1;
        if(Yii::$app->request->isPost){
            $login = Yii::$app->request->post('login');
            $group_id = Yii::$app->request->post('group_id');
            $take = (int)Yii::$app->request->post('take');
            $skip =  (int)Yii::$app->request->post('skip');
            
            $user = \common\models\User::findOne(['username' => $login]);
            
            $data=[];

        if ($user)
        {
            $id=$user->id;

            $group = \common\models\Group::findOne(['id' => $group_id]);
            $teacher = \common\models\CourseTeacher::findOne(['user_id' => $group->teacher_id]);
            $student = \common\models\CourseStudent::findOne(['user_id' => $id]);

                $teacher_id=$group->teacher_id;
                $sms = Sms::find()
                ->where(['sms.kimga'=>$id])
                ->andWhere(['sms.kimdan'=>$teacher_id]) 
                ->orderBy([
                    'id' => SORT_DESC //Need this line to be fixed
                 ])
                ->all();
                $chat = Chat::find()
                ->where(['chat.kimga'=>$teacher_id])
                ->andWhere(['chat.kim'=>$id]) 
                ->orderBy([
                    'id' => SORT_DESC //Need this line to be fixed
                 ])
                ->all();

                foreach($sms as $gr){
           
                    $data[] = (object) [
                        'from' => 'Teacher',
                        'title' =>  $gr->title,
                         'date'=>$gr->date,
                      ];
           
                }
            
                foreach($chat as $gr){
           
                    $data[] = (object) [
                        'from' => "Student",
                        'title' =>  $gr->title,
                         'date'=>$gr->date,
                      ];
           
                }
               
       
                return [
                    'data'=> ($data),
                    'status'=> 1,
                    'message' => 'sms keldi!'
                                ];
      }
            else
            {
                return [
                    'status'=> -1,
                    'message' => 'sms qoshilmagan'
                                ];
            }            
        }
        else
            {
                return [
                    'status'=> -1,
                    'message' => 'Post zapros emas'
                                ];
               
            
        }
    }

    public function actionExamall()
    {
 
        if(Yii::$app->request->isPost){
            $exam_id = Yii::$app->request->post('exam_id');
            $data=[];
        if ($exam_id)
        {
                $student=\common\models\ExamStudent::find()
                ->leftJoin('exam_fan', 'exam_student.exam_fan_id = exam_fan.id')
                ->leftJoin('exam', 'exam_fan.exam_id = exam.id')  
                 ->where(['exam.id' => $exam_id])
                 ->groupBy(['exam_student.student_id'])
                 ->all();

                    $exam_fan=ExamFan::find()
                    ->where(['exam_fan.exam_id'=>$exam_id])
                    ->all();
                    $datas=[];
                foreach ($student as $s){
                    $data=[];
                    $user=\common\models\CourseStudent::find()
                    ->where(['=', 'user_id', $s->student_id])
                    ->one();
                    $data['fish'] =  $user->last_name." ". $user->first_name." ". $user->middle_name." ";
                    $sum=0; 
                    $count=0;
                    foreach($exam_fan as $ef){
                        $data1=[];

            $exam_student=\common\models\ExamStudent::find()
                ->leftJoin('exam_fan', 'exam_student.exam_fan_id = exam_fan.id')
                ->leftJoin('exam', 'exam_fan.exam_id = exam.id')  
                 ->where(['exam.id' => $exam_id])
                 ->andWhere(['=', 'exam_student.student_id', $s->student_id])
                 ->andWhere(['=', 'exam_fan.id',$ef->id])
                 ->all();

                 $exam_type = \common\models\Exam::findOne(['id' => $exam_id]);
                 
                 if($exam_type->status==1){
                    foreach($exam_student as $es){
                        $sum=$sum+$es->points;
                       }
                       $data['sum'] =   round($sum, 2); 

                 }
                 if($exam_type->status==2){
                    foreach($exam_student as $es){
                        $sum=$sum+$es->answer;
                        $count=$count+1;
                       }
                       $sumx=$sum/$count;
                       $data['sum'] =   round($sumx, 2); 

                 }

              
    
                 $fan=\common\models\Fan::find()
                 ->where(['fan.id' => $ef->fan_id])->one();
                 foreach($exam_student as $es){
                        $data1["answer"]=$es->answer;
                        $data1["ball"]=$ef->mark;
                        $data1["name"]=  $fan->nomi;
                    $data["block"][]=(object)$data1;
                   }                     
            } 
            $datas[] =(object) $data;
         
            
        }   return [
                'data'=> ($datas),
                'status'=> 1,
                'message' => 'sms keldi!'
                            ];
      }
            else
            {
                return [
                    'status'=> -1,
                    'message' => 'sms qoshilmagan'
                                ];
            }            
        }
        else
            {
                return [
                    'status'=> -1,
                    'message' => 'Post zapros emas'
                                ];
               
            
        }
    }
    public function actionSmssend()
    {
        // return 1;
        if(Yii::$app->request->isPost){
            $login = Yii::$app->request->post('login');
            $group_id = Yii::$app->request->post('group_id');
             $group = \common\models\Group::findOne(['id' => $group_id]);
             $teacher_id=$group->teacher_id;
            $text = Yii::$app->request->post('text');
  				
            
            $user = \common\models\User::findOne(['username' => $login]);
            
            $data=[];
            $student_id=$user->id;
          
        if ($user&&$text)
        {
            
            $datetime = new DateTime();
            $timezone = new DateTimeZone('Asia/Tashkent');
            $datetime->setTimezone($timezone);
            $now_date = strtotime($datetime->format('Y-m-d H:i:s'));
            
        if($text){
               $sms = new Chat();
               $sms->kim=(int)$student_id;
               $sms->kimga=(int)$teacher_id;
               $sms->title=$text;
               $sms->status=(int)0;
                $sms->date=(int)$now_date;
                $sms->save();
                  return [
                
                    'status'=> 1,
                    'message' => 'sms qoshildi!!!'
                                ];
                 }
                   
          
              
      }
            else
            {
                return [
                    'status'=> -1,
                    'message' => 'sms qoshilmadi!!!'
                                ];
            }            
        }
        else
            {
                return [
                    'status'=> -1,
                    'message' => 'Post zapros emas'
                                ];
               
            
        }
    }

        

}