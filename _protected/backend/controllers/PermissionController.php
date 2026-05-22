<?php

namespace backend\controllers;

use common\models\Exam;
use common\models\ExamStudent;
use Yii;
use common\models\Permission;
use common\models\PermissionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PermissionController implements the CRUD actions for Permission model.
 */
class PermissionController extends BackendController
{
    /**
     * {@inheritdoc}
     */

    /**
     * Lists all Permission models.
     * @return mixed
     */
    public function actionIndex()
    {
        $user=\common\models\User::find()
            ->where(['=', 'user.id', Yii::$app->user->id])
            ->one();

        if ($user->role_id == "theCreator"){
            $guruh = \common\models\Permission::find()->all();
            return $this->render('index', [
                'permission' => $guruh,
            ]);
        }elseif ($user->role_id == "Admin"){
            $guruh = \common\models\Permission::find()->where(['uni_id'=>$user->uni_id])->all();
            return $this->render('index', [
                'permission' => $guruh,
            ]);
        }
        else{
            return $this->render('../site/error');
        }
    }

    public function actionFaculty()
    {
        $user=\common\models\User::find()
            ->where(['=', 'user.id', Yii::$app->user->id])
            ->one();

        if($user->role_id == "theCreator"){
            $facultys = \common\models\Faculty::find()->all();
            return $this->render('faculty', [
                "faculty"=>$facultys,
            ]);
        }else if($user->role_id == "Admin"){
            $facultys = \common\models\Faculty::find()->where(['uni_id'=>$user->uni_id])->all();
            return $this->render('faculty', [
                "faculty"=>$facultys,
            ]);
        }else{
            return $this->render('../site/error');
        }
    }




    public function actionPermission(){
        $user = \common\models\User::find()->where(['id'=>Yii::$app->user->id])->one();
        $permission = Yii::$app->request->post('Permission');
        $group_id = $permission['group_id'];
        $fan_id = $permission['fan_id'];
        $exam_id = $permission['exam_id'];
        $a = Permission::find()->where(['group_id'=>$group_id, 'fan_id'=>$fan_id, 'exam_id'=>$exam_id])->one();
        if (!empty($a)){
           $b =  Permission::findOne(['id'=>$a->id]);
           $b->delete();
        }
        $permission_new = new Permission();
        $permission_new->group_id = $group_id;
        $permission_new->exam_id = $exam_id;
        $permission_new->fan_id = $fan_id;
        $permission_new->uni_id = $user->uni_id;
        $permission_new->status = 1;
        $permission_new->save();
        return $this->redirect('index');
    }
    public function actionPermissionup($g, $f, $e){
        $updat = Permission::findOne(['group_id'=>$g, 'fan_id'=>$f, 'exam_id'=>$e]);
        $updat->status = 0;
        $updat->save();
        return $this->redirect('index');
    }

    public function actionGroup($group_id)
    {

    }

    /**
     * Displays a single Permission model.
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
     * Creates a new Permission model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Permission();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Permission model.
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
     * Deletes an existing Permission model.
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
     * Finds the Permission model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Permission the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Permission::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionList($id) {
        echo "<option> -Guruh tanlang-</option>";
        $client = \common\models\Group::find()->where(['faculty_id'=>$id])->all();
        foreach($client as $c){
                echo "<option value='".$c->id."'> $c->name </option>";
        }
    }
    public function actionLists($id) {
        $group = \common\models\Group::find()
            ->where(['id'=>$id])
            ->one();
        $dars_j = \common\models\TimeTable::find()
            ->where(['group_id'=>$group->id])
            ->andWhere(['smester'=>$group->smester])
            ->groupBy('fan_id')
            ->all();
        echo "<option>-Fan Tanlang-</option>";
        foreach($dars_j as $c):
            $fan = \common\models\Fan::find()
                ->select(['name', 'id'])
                ->where(['id'=>$c->fan_id, 'uni_id'=>$group->uni_id])
                ->all();
            foreach ($fan as $a):
                echo "<option value='".$a->id."'> $a->name </option>";
            endforeach;
        endforeach;

    }
}
