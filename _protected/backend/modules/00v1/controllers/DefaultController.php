<?php

namespace backend\modules\v1\controllers;

use backend\modules\v1\models\User;
use yii\web\Controller;
use Yii;

/**
 * Default controller for the `v1` module
 */
class DefaultController extends Controller
{
    public $enableCsrfValidation = false;
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return 3;
    }

    public function actionIndex1($id)
    {
        return $id;
    }

    public function actionUpdate($id)
    {
        $user_id = Yii::$app->user->identity->id;
        $model = User::find()->where(["id" => $id])->one();
        if ($user_id != $model->user_id) {
            Yii::$app->response->setStatusCode(401);
            return ['status' => 'error', 'message' => 'You don\'t have permission to change this answer'];
        }
        $model->load(Yii::$app->request->post(), '');
        $model->user_id = $user_id;
        if ($model->save()) {
            return ['status' => 'success', 'message' => 'Question updated successfully'];
        } else {
            Yii::$app->response->setStatusCode(422);
            return $model->getErrors();
        }
    }
}
