<?php

namespace backend\controllers;

use Yii;
use common\models\FinalWork;
use common\models\FinalWorkSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Mpdf\Mpdf;

use Mpdf\QrCode\QrCode;
use Mpdf\QrCode\Output;

class FinalWorkController extends BackendController
{
    public function actionIndex()
    {
        $user=\common\models\User::find()->where(['=', 'user.id', Yii::$app->user->id])->one();
        if($user->role_id == "theCreator"){
            $uni_id = $user->uni_id;
            $final_work = \common\models\FinalWork::find()
                ->andWhere(['status'=>1])
                ->groupBy(['name'])
                ->all();

            return $this->render('index', [
                'final_work' => $final_work,
            ]);
        }else if($user->role_id == "Admin"){
            $uni_id = $user->uni_id;
            $final_work = \common\models\FinalWork::find()
                ->where(['uni_id'=>$uni_id])
                ->andWhere(['status'=>1])
                ->groupBy(['name'])
                ->all();
            return $this->render('index', [
                'final_work' => $final_work,
            ]);
        }else{
            return $this->render('../site/error');
        }
    }
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    public function actionCreate()
    {

         $started_date = ($_POST["started_date"]);
         $finished_date = ($_POST["finished_date"]);


// echo "<pre>";
// print_r($started_date);
// print_r($finished_date);
// echo "</pre>";
// exit;

        $user=\common\models\User::find()
            ->where(['=', 'user.id', Yii::$app->user->id])
            ->one();
        $uni_id = $user->uni_id;

        $e = Yii::$app->request->post('FinalWork');

        $student = \common\models\Student::find()
                ->where(['group_id'=>$e['group_id']])
                ->all();
        $grId = $e['group_id'];
        $group = \common\models\Group::find()
            ->where(['id'=>$e['group_id']])
            ->one();
        $smester = $group->smester;
        $fan = \common\models\Fan::find()
            ->where(['id'=>$e['fan_id']])
            ->one();
        // $teacher = \common\models\User::find()
        //     ->where(['id'=>$e['teacher_id']])
        //     ->one();    
        $status = $e['status'];

    $name = $group->id ."_".$smester ."_".$fan->id."_".((int) (microtime(true) * (1000)));
    $model = new FinalWork();

    if ($model->load(Yii::$app->request->post())) {
        foreach ($student as $std) {
            $model = new FinalWork();
    $userstd = \common\models\User::find()
        ->where(['id'=>$std->user_id])
        ->one();
        $model->uni_id = $uni_id;
        $model->group_id = $grId;
        $model->student_id = $userstd->id;
        $model->fan_id = $fan->id;
        $model->status = $status;
        // $model->teacher_id = $teacher->id;
        $model->name = $name;
        $model->smester = $smester;
        $model->started_date = $started_date;
        $model->finished_date = $finished_date;
        $model->created_by = $user->id;
        $model->uni_id = $user->uni_id;

// qr_code = gr / smester / fan / (teacher) / student;
        $model->qr_code = $group->id ."_".$smester ."_".$fan->id."_".$userstd->id;
        $model->isNewRecord = true;

        $model->save();  

    }  
    return $this->redirect(['index']);
} else {

        return $this->render('create', [
            'model' => $model,
        ]);
       }
    }
    public function actionFinalpdf($id){
        $finalWork = \common\models\FinalWork::findOne(['id'=>$id]);
        $finalWorks = \common\models\FinalWork::find()
            ->where(['name'=>$finalWork->name])
            ->andWhere(['uni_id'=>$finalWork->uni_id])
            ->andWhere(['group_id'=>$finalWork->group_id])
            ->andWhere(['smester'=>$finalWork->smester])
            ->andWhere(['fan_id'=>$finalWork->fan_id])
            ->andWhere(['teacher_id'=>$finalWork->teacher_id])
            ->all();
        $fan_fan = \common\models\Fan::findOne(['id'=>$finalWork->fan_id]);

    $yakuniy=new mPDF();
    ob_start();
    echo '<p style="text-align: center;">ТОШКЕНТ ДАВЛАТ ЮРИДИК УНИВЕРСИТЕТИ ҲУЗУРИДАГИ ЮРИДИК КАДРЛАРНИ<br>
	ХАЛҚАРО СТАНДАРТЛАР БЎЙИЧА ПРОФЕССИОНАЛ ЎҚИТИШ МАРКАЗИ
    <br/>
    ОЛИЙ МАЪЛУМОТГА ЭГА БЎЛГАН ШАХСЛАРНИ ЮРИДИК МУТАХАССИСЛИККА<br>
    ҚАЙТА ТАЙЁРЛАШ КУРСЛАРИ ЯКУНИЙ НАЗОРАТ УЧУН ТИТУЛ ВАРАҒИ
    </p>
    <p style="text-align: start; margin-left: 40px;">
    Модуль номи: '.$fan_fan->name.'<br><br/ >
    Иш тури: Якуний назорат <br/>
    Ўтказилган сана:________________</p>
    <span>А бўлимдан 2 та мантиқий саволга жавоб ёзилиши шарт.</span>
    <table border="1" style="text-align: center; border-collapse: collapse;">
        <tr><th rowspan="2" style="width: 40px">Т/р</th>
            <th rowspan="2" style="width: 400px">Баҳолаш мезонлари</th>
            <th style="width: 120px">12.5 баллгача</th>
            <th style="width: 120px">12.5 баллгача</th>
        </tr>
        <tr><td>1-мантиқий савол</td><td>2-мантиқий савол</td></tr>
        <tr><td>1.</td><td></td><td></td><td></td></tr>
        <tr><td>2.</td>	<td></td><td></td><td></td></tr>
        <tr><td>3.</td><td></td><td></td><td></td></tr>
        <tr><td>4.</td><td></td><td></td><td></td></tr>
        <tr><td colspan="2">Умумий балл</td><td colspan="2"></td></tr>
    </table><br/>
    <span>Б бўлимдан 1 та казусга жавоб ёзилиши шарт. </span>
    <table border="1" style="text-align: center; border-collapse: collapse;">
        <tr><th style="width: 40px">Т/р</th>
            <th style="width: 400px">Баҳолаш мезонлари</th>
            <th style="width: 244px">25 баллгача</th>
        </tr>
        <tr><td>1.</td><td></td><td></td></tr>
        <tr><td>2.</td><td></td><td></td></tr>
        <tr><td>3.</td><td></td><td></td></tr>
        <tr><td>4.</td><td></td><td></td></tr>
        <tr><td colspan="2">Умумий балл:</td><td></td>
        </tr></table><br />
    <span>Иш бўйича қўшимча тақриз:</span><br><br>
    <div style=" display:flex; flex-wrap: no-wrap;">
    <div style=" width: 100%; height: 200px; border: 1px solid;"></div>
    </div><br>
    <div style="margin-bottom: 20px;"><b>Умумий балл: </b><b>___________</b></div>
    <span>Текширувчи имзоси: _________________</span>';     
   
    $html = ob_get_contents();
    ob_end_clean();

    foreach ($finalWorks as $fws) {
        if ($fws->qr_code) {
            $c = base64_encode(")(&+=-wertse45!@##!#@!#!(*$^^%".$fws->qr_code."%$^^awefvwertfwb gw4g354236");

            $yakuniy->AddPage();
            ob_start();
            echo '<div style="position: absolute; bottom: 30px; right: 30px;">';
            echo '<barcode code="'.$c.'" size="1.2" type="QR" error="M" class="barcode" />';
            echo '</div>';
            $htmlQR = ob_get_contents();
            ob_end_clean();

            $yakuniy->WriteHTML($html);
            $yakuniy->WriteHTML($htmlQR);
            $yakuniy->AddPage();
            $yakuniy->WriteHTML($htmlQR);
            $yakuniy->AddPage();
            $yakuniy->WriteHTML($htmlQR);
            $yakuniy->AddPage();
            $yakuniy->WriteHTML($htmlQR);
        }
    }
        $yakuniy->Output();
        exit;
    }
    public function actionUpdate($id)
    {
        $user=\common\models\User::find()->where(['=', 'user.id', Yii::$app->user->id])->one();

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDel($id)
    {
        $finalWork = \common\models\FinalWork::findOne($id);
        $finalWorks = \common\models\FinalWork::find()
        	->where(['name'=>$finalWork->name])
        	->all();

        foreach ($finalWorks as $fW) {
                $fW->status = 9;
            	$fW->save();
        }

        return $this->redirect('index');
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    protected function findModel($id)
    {
        if (($model = FinalWork::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
