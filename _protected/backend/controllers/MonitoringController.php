<?php

namespace backend\controllers;

use common\models\Group;
use common\models\MonitoringCheck;
use Yii;
use common\models\Monitoring;
use common\models\MonitoringSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class MonitoringController extends BackendController
{
    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }
    public function actionIndex()
    {
        $user = \common\models\User::find()
            ->where(['=', 'user.id', Yii::$app->user->id])
            ->one();
        if ($user->role_id == "theCreator"){
            $uni_id = $user->uni_id;
            $teachers = \common\models\User::find()
                ->all();
            return $this->render('index', [
                'teachers' => $teachers,

            ]);
        }elseif ( $user->role_id == "Admin"){
            $uni_id = $user->uni_id;
            $teachers = \common\models\User::find()
                ->where(['=', 'user.uni_id', $uni_id])
                ->andWhere(['role_id' => 'Teacher'])
                ->all();
            return $this->render('index', [
                'teachers' => $teachers,

            ]);
        }
        else{
            return $this->render('../site/error');
        }

    }


    public function actionTimetable($teacher_id)
    {
        $user=\common\models\User::find()->where(['=', 'user.id', Yii::$app->user->id])->one();
        if($user->role_id == "theCreator"){
            $user = \common\models\User::find()
                ->where(['=', 'user.id', Yii::$app->user->id])
                ->one();
            $uni_id = $user->uni_id;
            $group = \common\models\Group::find()->all();
            $para = \common\models\Para::find()->all();
            $xona = \common\models\Room::find()->all();
            $fan = \common\models\Fan::find()->all();
            $teachers = \common\models\User::find()->all();
            $timetable = \common\models\TimeTable::find()->where(['=', 'time_table.teacher_id', $teacher_id])->all();
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
            return $this->render('timetable', [
                'para' => $para,
                'xona' => $xona,
                'fan' => $fan,
                'group' => $group,
                'teachers' => $teachers,
                'timetable' => $timetable,
                'weekdays' => $weekdays,


            ]);
        }else if($user->role_id == "Admin"){
            $user = \common\models\User::find()
                ->where(['=', 'user.id', Yii::$app->user->id])
                ->one();
            $uni_id = $user->uni_id;

            $group = \common\models\Group::find()
                ->where(['=', 'group.uni_id', $uni_id])
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
                ->where(['=', 'user.uni_id', $uni_id])
                ->andWhere(['role_id' => 'Teacher'])
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
            return $this->render('timetable', [
                'para' => $para,
                'xona' => $xona,
                'fan' => $fan,
                'group' => $group,
                'teachers' => $teachers,
                'timetable' => $timetable,
                'weekdays' => $weekdays,


            ]);
        }else{
            return $this->render('../site/error');
        }
    }

    public function actionCheck($time_table_id = null, $date = null)
    {
//        echo "<pre>";
//        print_r($_GET);
//        exit();
        if (!$time_table_id) {
            $time_table_id = ($_POST["time_table_id"]);
        }
        if ( $date != NULL ) {

            $date = ($_GET["date"]);
        }
        $time_table_id = $time_table_id;

        $timetable = \common\models\TimeTable::find()
            ->where(['=', 'id', $time_table_id])
            ->one();
        $group_id = $timetable->group_id;
        $week_day = $timetable->week_day;
        $para_id = $timetable->para_id;
        $weekdays = [
            1 =>  "Dushanba",
            2 =>  "Seshanba",
            3 =>  "Chorshanba",
            4 =>  "Payshanba",
            5 =>  "Juma",
            6 =>  "Shanba",
        ];
        $fan_id =  $timetable->fan_id;
        $data = \common\models\Student::find()
            ->andWhere(['student.group_id' => $group_id])
            ->all();
        $user = \common\models\User::find()
            ->where(['=', 'user.id', Yii::$app->user->id])
            ->one();
        $uni_id = $user->uni_id;

        $group = \common\models\Group::find()
            ->where(['=', 'group.uni_id', $uni_id])
            ->andWhere(['=', 'group.id', $group_id])
            ->one();

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
            ->where(['=', 'user.uni_id', $uni_id])
            ->andWhere(['role_id' => 'Teacher'])
            ->all();
        return $this->render('check', [
            'data' => $data,
            'timetable' => $timetable,
            'time_table_id' => $time_table_id,
            'weekdays' => $weekdays,
            'para' => $para,
            'xona' => $xona,
            'fan' => $fan,
            'group' => $group,
            'teachers' => $teachers,
            'timetable' => $timetable,
            'weekdays' => $weekdays,
            'group_id' => $group_id,
            'date' => $date,
        ]);
        die;
        Yii::$app->session->setFlash('success', "Ma`lumotlar o`zgartirildi!");
        return $this->redirect(['create', 'id' => $group_id]);
    }
    public function actionCheckpost()
    {
        $student = ($_POST["student"]);
        $time_table_id = ($_POST["time_table_id"]);
        $date = ($_POST["date"]);

        $month = (date("n", strtotime($date)));
        $timetable = \common\models\TimeTable::find()
            ->where(['=', 'time_table.id', $time_table_id])
            ->one();
        $group_id = $timetable->group_id;

        $group = \common\models\Group::find()
            ->where(['=', 'group.id', $group_id])
            ->one();
        $direction_id = $group->direction_id;
        $faculty_id = $group->faculty_id;
        $uni_id = $group->uni_id;
        $monitor_chek = \common\models\MonitoringCheck::find()
            ->where(['=', 'group_id', $group_id])
            ->andWhere(['=', 'date', $date])
            ->andWhere(['=', 'time_table_id', $time_table_id])
            ->one();
        if (!$monitor_chek) {
            $checked_monitoring = new MonitoringCheck();
            $checked_monitoring->group_id = $group_id;
            $checked_monitoring->direction_id = $direction_id;
            $checked_monitoring->faculty_id = $faculty_id;
            $checked_monitoring->time_table_id = $time_table_id;
            $checked_monitoring->status = 1;
            $checked_monitoring->date = $date;
            $checked_monitoring->uni_id = $uni_id;
            $checked_monitoring->save();
        }
        foreach ($student as $student_id => $value) {
            if ($value == 1) {
                $monitor = \common\models\Monitoring::find()
                    ->where(['=', 'monitoring.group_id', $group_id])
                    ->andWhere(['=', 'monitoring.date', $date])
                    ->andWhere(['=', 'monitoring.student_id', $student_id])
                    ->andWhere(['=', 'monitoring.time_table_id', $time_table_id])
                    ->one();

                if ($monitor) {
                    $monitor->delete();
                }
            }
            if ($value == 0) {
                $monitor = \common\models\Monitoring::find()
                    ->where(['=', 'monitoring.group_id', $group_id])
                    ->andWhere(['=', 'monitoring.date', $date])
                    ->andWhere(['=', 'monitoring.student_id', $student_id])
                    ->andWhere(['=', 'monitoring.time_table_id', $time_table_id])
                    ->one();
                if (!$monitor) {
                    $monitoring = new Monitoring();
                    $monitoring->student_id = $student_id;
                    $monitoring->group_id = $group_id;
                    $monitoring->direction_id = $direction_id;
                    $monitoring->faculty_id = $faculty_id;
                    $monitoring->time_table_id = $time_table_id;
                    $monitoring->status = 0;
                    $monitoring->date = $date;
                    $monitoring->uni_id = $uni_id;
                    $monitoring->save();
                }
            }
        }

        Yii::$app->session->setFlash('success', "Ma`lumotlar o`zgartirildi!");
        return $this->redirect([
            'check',
            'time_table_id' => $time_table_id,
            'date' => $date
        ]);
    }
    /**
     * Displays a single Monitoring model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Monitoring model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Monitoring();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Monitoring model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Monitoring model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Monitoring model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Monitoring the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Monitoring::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
