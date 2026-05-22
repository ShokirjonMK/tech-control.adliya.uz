<?php

namespace backend\controllers;

use Yii;
use common\models\TimeTable;
use common\models\TimeTableSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Model;
use common\models\Group;
use yii\web\Response;
use yii\helpers\ArrayHelper;

/**
 * TimeTableController implements the CRUD actions for TimeTable model.
 */
class TimeTableController extends BackendController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    /**
     * Lists all TimeTable models.
     * @return mixed
     */
    public function actionIndex()
    {
        $user = $user=\common\models\User::find()
            ->where(['=', 'user.id', Yii::$app->user->id])
            ->one();


        if ($user->role_id == "theCreator"){
            $guruh = \common\models\Group::find()->all();
            return $this->render('index', [
                'guruh' => $guruh,
            ]);
        }elseif ($user->role_id == "Admin"){
            $guruh = \common\models\Group::find()->where(['uni_id'=>$user->uni_id])->all();
            return $this->render('index', [
                'guruh' => $guruh,
            ]);
        }
        else{
            return $this->render('../site/error');
        }
    }

    /**
     * Displays a single TimeTable model.
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
     * Creates a new Customer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $user = \common\models\User::find()
            ->where(['=', 'user.id', Yii::$app->user->id])
            ->one();
        $uni_id = $user->uni_id;
        $group_id = $id;
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
        $timetable = \common\models\TimeTable::find()
            ->where(['=', 'time_table.group_id', $group_id])
            ->where(['=', 'time_table.smester', $group->smester])
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

        return $this->render('create', [

            'para' => $para,
            'xona' => $xona,
            'fan' => $fan,
            'teachers' => $teachers,
            'timetable' => $timetable,
            'weekdays' => $weekdays,
            'group_id' => $group_id,
            'group' => $group,

        ]);
    }

    public function actionStore()
    {
        $group_id = $_POST['group_id'];
        $group_new = Group::find()
            ->where(['id' => $group_id])
            ->one();
        $smester = $group_new->smester;
        foreach ($_POST['test'] as $key) {
            $fan = $key['fan'];
            $teacher = $key['teacher'];
            $xona = $key['xona'];
            $week_day = $_POST['week_day'];

            $group_id = $_POST['group_id'];
            $para_id = $key['para_id'];
            $timetable = TimeTable::find()
                ->where(['group_id' => $group_id])
                ->andWhere(['para_id' => $para_id])
                ->andWhere(['week_day' => $week_day])
                ->one();
            if (!$timetable&&$fan!=0&&$xona!=0&&$teacher!=0) {
                $model = new TimeTable();
                $model->group_id = $group_id;
                $model->week_day = $week_day;
                $model->para_id = $para_id;
                $model->xona_id = $xona;
                $model->smester = $smester;
                $model->fan_id = $fan;
                $model->teacher_id = $teacher;
                $model->save();
            }
            if ($timetable) {
                $timetable->xona_id = $xona;
                $timetable->fan_id = $fan;
                $timetable->teacher_id = $teacher;
                $timetable->save();
            }
        }
        $user = \common\models\User::find()
            ->where(['=', 'user.id', Yii::$app->user->id])
            ->one();
        $uni_id = $user->uni_id;
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
            ->where(['=', 'time_table.group_id', $group_id])
            ->all();
        $weekdays = [
            1 =>  "Dushanba",
            2 =>  "Seshanba",
            3 =>  "Chorshanba",
            4 =>  "Payshanba",
            5 =>  "Juma",
            6 =>  "Shanba",
        ];
        Yii::$app->session->setFlash('success', "Ma`lumotlar o`zgartirildi!");
        return $this->redirect(['create', 'id' => $group_id]);
    }

    /**
     * Updates an existing Customer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */

    /**
     * Deletes an existing TimeTable model.
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
     * Finds the TimeTable model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TimeTable the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TimeTable::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
