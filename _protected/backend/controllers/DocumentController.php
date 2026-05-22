<?php

namespace backend\controllers;

use Yii;
use common\models\Document;
use common\models\DocumentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * DocumentController implements the CRUD actions for Document model.
 */
class DocumentController extends Controller
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
     * Lists all Document models.
     * @return mixed
     */
    public function actionIndex()
    {
        $mydoc = \common\models\Document::find()->all();
        return $this->render('index');
    }



    public function actionMydoc1(){
        $user = \common\models\Document::find()->where(['user_id'=>Yii::$app->user->id])->one();
        if (!empty($user)) {
            $model = \common\models\Document::find()->where(['user_id'=>Yii::$app->user->id])->one();
            $model->file = UploadedFile::getInstance($model, 'file');
            $model->user_id = Yii::$app->user->id;
            $filename = ((int) (microtime(true) * (1000))) . '.' . $model->file->extension;
            $model->file->saveAs("../uploads/document/shartnoma/" . $filename);
            $model->shartnoma = $filename;
            $model->file = null;
            $model->save();
            return $this->redirect('../document/index');
        }else{
            $model = new Document();
            $model->file = UploadedFile::getInstance($model, 'file');
            $model->user_id = Yii::$app->user->id;
            $filename = ((int) (microtime(true) * (1000))) . '.' . $model->file->extension;
            $model->file->saveAs("../uploads/document/shartnoma/" . $filename);
            $model->shartnoma = $filename;
            $model->file = null;
            $model->save();
            return $this->redirect('../document/index');
        }
    }
    public function actionMydoc2(){
        $user = \common\models\Document::find()->where(['user_id'=>Yii::$app->user->id])->one();
        if (!empty($user)) {
            $model = \common\models\Document::find()->where(['user_id'=>Yii::$app->user->id])->one();
            $model->file = UploadedFile::getInstance($model, 'file');
            $model->user_id = Yii::$app->user->id;
            $filename = ((int) (microtime(true) * (1000))) . '.' . $model->file->extension;
            $model->file->saveAs("../uploads/document/ob/" . $filename);
            $model->ob = $filename;
            $model->file = null;
            $model->save();
            return $this->redirect('../document/index');
        }else{
            $model = new Document();
            $model->file = UploadedFile::getInstance($model, 'file');
            $model->user_id = Yii::$app->user->id;
            $filename = ((int) (microtime(true) * (1000))) . '.' . $model->file->extension;
            $model->file->saveAs("../uploads/document/ob/" . $filename);
            $model->ob = $filename;
            $model->file = null;
            $model->save();
            return $this->redirect('../document/index');
        }
    }
    public function actionMydoc3(){
        $user = \common\models\Document::find()->where(['user_id'=>Yii::$app->user->id])->one();
        if (!empty($user)) {
            $model = \common\models\Document::find()->where(['user_id'=>Yii::$app->user->id])->one();
            $model->file = UploadedFile::getInstance($model, 'file');
            $model->user_id = Yii::$app->user->id;
            $filename = ((int) (microtime(true) * (1000))) . '.' . $model->file->extension;
            $model->file->saveAs("../uploads/document/pos/" . $filename);
            $model->pos = $filename;
            $model->file = null;
            $model->save();
            return $this->redirect('../document/index');
        }else{
            $model = new Document();
            $model->file = UploadedFile::getInstance($model, 'file');
            $model->user_id = Yii::$app->user->id;
            $filename = ((int) (microtime(true) * (1000))) . '.' . $model->file->extension;
            $model->file->saveAs("../uploads/document/pos/" . $filename);
            $model->pos = $filename;
            $model->file = null;
            $model->save();
            return $this->redirect('../document/index');
        }
    }
    public function actionMydoc4(){
        $user = \common\models\Document::find()->where(['user_id'=>Yii::$app->user->id])->one();
        if (!empty($user)) {
            $model = \common\models\Document::find()->where(['user_id'=>Yii::$app->user->id])->one();
            $model->file = UploadedFile::getInstance($model, 'file');
            $model->user_id = Yii::$app->user->id;
            $filename = ((int) (microtime(true) * (1000))) . '.' . $model->file->extension;
            $model->file->saveAs("../uploads/document/inn/" . $filename);
            $model->inn = $filename;
            $model->file = null;
            $model->save();
            return $this->redirect('../document/index');
        }else{
            $model = new Document();
            $model->file = UploadedFile::getInstance($model, 'file');
            $model->user_id = Yii::$app->user->id;
            $filename = ((int) (microtime(true) * (1000))) . '.' . $model->file->extension;
            $model->file->saveAs("../uploads/document/inn/" . $filename);
            $model->inn = $filename;
            $model->file = null;
            $model->save();
            return $this->redirect('../document/index');
        }
    }


    public function actionMydoc5(){
        $user = \common\models\Document::find()->where(['user_id'=>Yii::$app->user->id])->one();
        if (!empty($user)) {
            $model = \common\models\Document::find()->where(['user_id'=>Yii::$app->user->id])->one();
            $model->file = UploadedFile::getInstance($model, 'file');
            $model->user_id = Yii::$app->user->id;
            $filename = ((int) (microtime(true) * (1000))) . '.' . $model->file->extension;
            $model->file->saveAs("../uploads/document/inps/" . $filename);
            $model->inps = $filename;
            $model->file = null;
            $model->save();
            return $this->redirect('../document/index');
        }else{
            $model = new Document();
            $model->file = UploadedFile::getInstance($model, 'file');
            $model->user_id = Yii::$app->user->id;
            $filename = ((int) (microtime(true) * (1000))) . '.' . $model->file->extension;
            $model->file->saveAs("../uploads/document/inps/" . $filename);
            $model->inps = $filename;
            $model->file = null;
            $model->save();
            return $this->redirect('../document/index');
        }
    }

    public function actionMydoc6(){
        $user = \common\models\Document::find()->where(['user_id'=>Yii::$app->user->id])->one();
        if (!empty($user)) {
            $model = \common\models\Document::find()->where(['user_id'=>Yii::$app->user->id])->one();
            $model->file = UploadedFile::getInstance($model, 'file');
            $model->user_id = Yii::$app->user->id;
            $filename = ((int) (microtime(true) * (1000))) . '.' . $model->file->extension;
            $model->file->saveAs("../uploads/document/diplom/" . $filename);
            $model->diplom = $filename;
            $model->file = null;
            $model->save();
            return $this->redirect('../document/index');
        }else{
            $model = new Document();
            $model->file = UploadedFile::getInstance($model, 'file');
            $model->user_id = Yii::$app->user->id;
            $filename = ((int) (microtime(true) * (1000))) . '.' . $model->file->extension;
            $model->file->saveAs("../uploads/document/diplom/" . $filename);
            $model->diplom = $filename;
            $model->file = null;
            $model->save();
            return $this->redirect('../document/index');
        }
    }

    /**
     * Displays a single Document model.
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
     * Creates a new Document model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Document();

        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = Yii::$app->user->id;
            $model->save();
            return $this->redirect(['index', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Document model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = Yii::$app->user->id;
            $model->save();
            return $this->redirect(['index', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Document model.
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
     * Finds the Document model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Document the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Document::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }



    public function actionTeacher(){
        $user = \common\models\User::find()->where(['id'=>Yii::$app->user->id])->one();

        $teachers = \common\models\User::find()->where(['role_id'=>'Teacher', 'uni_id'=>$user->uni_id])->all();
//echo "<pre>";
////    print_r($teachers[0]->id);
//echo "as";
//$doc = \common\models\Document::findOne(['user_id'=>$teachers[1]->id]);
//print_r($doc);
//echo "<pre>";
//exit();
        return $this->render('teacher', ['teachers'=>$teachers]);
    }

    public function actionStudent(){
        $user = \common\models\User::find()->where(['id'=>Yii::$app->user->id])->one();
        $students = \common\models\User::find()->where(['role_id'=>'Student', 'uni_id'=>$user->uni_id])->all();
        return $this->render('student', ['students'=>$students]);
    }
}
