<?php

namespace backend\controllers;

use common\models\TarkibiyBolinma;
use Yii;
use common\models\TexMainBase;
use common\models\TexSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

use yii\helpers\Url;

use Mpdf\Mpdf;


/**
 * TexController implements the CRUD actions for TexMainBase model.
 */
class TexController extends Controller
{

     public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','test','chop','update','see', 'view', 'create', 'qrpdf', 'finalpdf', 'qrpdftr', 'oxirii'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index','test','chop','update', 'view', 'create','qrpdf', 'finalpdf', 'qrpdftr', 'see', 'oxirii'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['see'],
                        'roles' => ['?'],
                    ],
                ],
            ],
        ];
    }

    public function actionSee($id)
    {
        $this->layout='see';
        $tex = TexMainBase::findOne($id);

        return $this->render('see', [
            'model' => $tex,
        ]);

    }

    public function actionIndex()
    {
        $searchModel = new TexSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

         $t_b=\common\models\TarkibiyBolinma::find()->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
           't_b'=>$t_b,
        ]);
    }







    public function actionChop()
    {
//        $searchModel = new TexSearch();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $t_b=\common\models\TarkibiyBolinma::find()->all();

        return $this->render('chop', [
//            'searchModel' => $searchModel,
//            'dataProvider' => $dataProvider,
            't_b'=>$t_b,
        ]);
    }

    public function actionTest()
    {

        $group_id = $_POST["test"];


        return $group_id;
    }


    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new TexMainBase();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

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

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionLists($id)
    {
        $Rooms = \common\models\Room::find()
            ->where(['building_id' => $id])
            ->orderBy('id')
            ->all();

        if (!empty($Rooms)) {
            foreach($Rooms as $post) {
                echo "<option value='".$post->id."'>".$post->name."</option>";
            }
        } else {
            echo "<option> - </option>";
        }

    }

    protected function findModel($id)
    {
        if (($model = TexMainBase::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

     public function actionQrpdf(){

        $tex = TexMainBase::find()
            ->where(['status'=>1])
            ->all();
//        echo '<pre>   ';
//        foreach ($tex as $eeeee){
//
//        print_r($eeeee->tipi);
//        }
//        exit();


    $yakuniy=new mPDF();
    ob_start();
    echo '';

    $html = ob_get_contents();
    ob_end_clean();
         ob_start();

    foreach ($tex as $texOne) {

            $c = base64_encode(")(&+=-wertse45!@12!1212@!12!(*$^^% TSUL EUM ".$texOne->whoRecive->name. 'http://tech.tsul.uz/backend/tex/see?id='.$texOne->id."%$^^awefvwertfwb gw4g354236");
//          $yakuniy->AddPage();

//          echo '<div style="position: absolute; bottom: 30px; right: 30px;">';
//          echo '<barcode code="'.$c.'" size="1.2" type="QR" error="M" class="barcode" />';
            echo '<barcode code="'.$texOne->inventar_ichki.'\n'.$texOne->parametr.'\n'.$texOne->inventar_b.'\n \n'. 'http://tech.tsul.uz/backend/tex/see?id='.$texOne->id.'" size="1.2" type="QR" error="M" class="barcode" />';
            echo '<barcode code="'.$c.'" size="1.2" type="QR" error="M" class="barcode" />';
    }
         $htmlQR = ob_get_contents();
         ob_end_clean();
         $yakuniy->WriteHTML($htmlQR);

        $yakuniy->Output();
        exit;
    }

    public function actionQrpdftr(){

        $tex = TexMainBase::find()
            ->where(['status'=>1])


            ->andWhere(['tarkibiy_bolinma_id'=> [1,2,3,4,5,6,7,8,9,10,11,12,13,14]])
//            ->andWhere(['tarkibiy_bolinma_id'=> [15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55]])
//            ->andWhere(['tarkibiy_bolinma_id'=> [56,57,58,59,60,61,62,63,64,65,66,67,68,69,70]])
            ->orderBy('tarkibiy_bolinma_id')
            ->orderBy('inventar_ichki')
            ->all();

        $yakuniy=new mPDF();
        ob_start();
        echo '';

    $html = ob_get_contents();
    ob_end_clean();
         ob_start();
    echo '<table style="margin-left: -20px; margin-right: -25px; width: 100%">';

    $k=0;
    foreach ($tex as $key => $texOne) {
        $k++;

        if($k%3==1){
            echo '<tr style="width: 30%">';
        }

        if($k%3==1 || $k%3==2 || $k%3==0){
            echo '<td style="height: 140px;">';
        }
             $c = base64_encode(")(&+=-wertse45!@12!1212@!12!(*$^^%TSUL EUM ".'#'.$texOne->who_recive()->name.'#'.$texOne->inventar_ichki. 'http://tech.tsul.uz/backend/tex/see?id='.$texOne->id."%$^^awefvwertfwb gw4g354236");
//          $yakuniy->AddPage();
            echo '<barcode code="'.'ttt'.$texOne->inventar_ichki.'\n'.$texOne->parametr.'\n'.$texOne->inventar_b.'\n \n'. 'http://tech.tsul.uz/backend/tex/see?id='.$texOne->id.'" size="1.2" type="QR" error="M" class="barcode" />';
            echo '<barcode code="'.$c.'" size="1.2" type="QR" error="M" class="barcode" />';
            echo '<br /><span style="display: block; width: 100%; " >  &nbsp; '.$texOne->inventar_ichki.'		&nbsp;	&nbsp; '.' #TSUL_EUM</span>';

        if($k%3==1 || $k%3==2 || $k%3==0){
            echo '</td>';
        }

            if($k%3==1){
            echo '</tr>';
        }

    }
        echo '</table>';
         $htmlQR = ob_get_contents();
         ob_end_clean();
         $yakuniy->WriteHTML($htmlQR);


//         return $yakuniy;
        $yakuniy->Output();

        
        exit;
    }
    
      public function actionAssa($tarkibiy_bolinma_id){
             $tex = TexMainBase::find()
//            ->where(['status'=>1])
            ->where(['tarkibiy_bolinma_id'=>$tarkibiy_bolinma_id])
//          return $tex->inventar_ichki;
//            ->andWhere(['tarkibiy_bolinma_id'=>$tarkibiy_bolinma_id])
            ->orderBy('id')
            ->all();

        $yakuniy=new mPDF();
        ob_start();
        echo '';

    $html = ob_get_contents();
    ob_end_clean();
         ob_start();
    echo '<table style="margin-left: -20px; margin-right: -25px; width: 100%">';

    $k=0;
    foreach ($tex as $key => $texOne) {
        $k++;

        if($k%3==1){
            echo '<tr style="width: 30%">';
        }

        if($k%3==1 || $k%3==2 || $k%3==0){
            echo '<td style="height: 140px;">';
        }
             $c = base64_encode(")(&+=-wertse45!@12!1212@!12!(*$^^%TSUL EUM ".'#'.$texOne->inventar_ichki. 'http://tech.tsul.uz/backend/tex/see?id='.$texOne->id."%$^^awefvwertfwb gw4g354236");
//          $yakuniy->AddPage();
            echo '<barcode code="'.$texOne->inventar_ichki.'\n'/* $texOne->parametr */.'\n'.$texOne->inventar_b.'\n \n'. 'http://tech.tsul.uz/backend/tex/see?id='.$texOne->id.'" size="1.2" type="QR" error="M" class="barcode" />';
            echo '<barcode code="'.$c.'" size="1.2" type="QR" error="M" class="barcode" />';
            echo '<br /><span style="display: block; width: 100%; " >  &nbsp; '.$texOne->inventar_ichki.'		&nbsp;	&nbsp; '.' #TSUL_EUM</span>';

        if($k%3==1 || $k%3==2 || $k%3==0){
            echo '</td>';
        }
            if($k%3==1){
            echo '</tr>';
        }

    }
        echo '</table>';
         $htmlQR = ob_get_contents();
         ob_end_clean();
         $yakuniy->WriteHTML($htmlQR);


//         return $yakuniy;
        $yakuniy->Output();


        exit;
    }
    public function actionOxirii($tipi=NULL, $yil=NULL, $tarkibiy_bolinma=NULL){



        // $tarkibiy_bolinma_id = $_GET["tarkibiy_bolinma_id"];
//        $tarkibiy_bolinma_id = 1;

       if ($yil && $tipi && (!$tarkibiy_bolinma)){
            $tex = TexMainBase::find()
//            ->where(['status'=>1])

                ->andWhere(['yili'=>$yil])
                ->andWhere(['tipi_id'=>$tipi])
                ->orderBy('id')
                ->all();
        }
        elseif($yil && $tipi && $tarkibiy_bolinma){
            $tex = TexMainBase::find()
//            ->where(['status'=>1])

//                ->andWhere(['yili'=>$yil])
                ->andWhere(['tipi_id'=>$tipi])
                 ->andWhere(['tarkibiy_bolinma_id'=>$tarkibiy_bolinma])
                ->orderBy('id')
                ->all();
        }
        elseif((!$yil) && $tipi && (! $tarkibiy_bolinma)){
            $tex = TexMainBase::find()
//            ->where(['status'=>1])

//                ->andWhere(['yili'=>$yil])
                ->andWhere(['tipi_id'=>$tipi])
                // ->andWhere(['tarkibiy_bolinma_id'=>$tarkibiy_bolinma_id])
                ->orderBy('id')
                ->all();
        }

        elseif($yil && (!$tipi) && (! $tarkibiy_bolinma)){
            $tex = TexMainBase::find()
//            ->where(['status'=>1])

                ->andWhere(['yili'=>$yil])
//                ->andWhere(['yili'=>$tipi])
                // ->andWhere(['tarkibiy_bolinma_id'=>$tarkibiy_bolinma_id])
                ->orderBy('id')
                ->all();
        }
        else{
            $tex = TexMainBase::find()
//            ->where(['status'=>1])

//                ->andWhere(['yili'=>$yil])
//                ->andWhere(['yili'=>$tipi])
                // ->andWhere(['tarkibiy_bolinma_id'=>$tarkibiy_bolinma_id])
                ->orderBy('id')
                ->all();
        }

//
// echo "<pre>";
// print_r($query);
// exit();

        $yakuniy=new mPDF();
        ob_start();
        echo '';

    $html = ob_get_contents();
    ob_end_clean();
         ob_start();

    echo '<table style="margin-left: -20px; margin-right: -25px; width: 100%">';

    $k=0;
    foreach ($tex as $key => $texOne) {
        $k++;

        if($k%3==1){
            echo '<tr style="width: 30%">';
        }

        if($k%3==1 || $k%3==2 || $k%3==0){
            echo '<td style="height: 140px;">';
        }
        $c = base64_encode(")(&+=-wertse45!@12!1212@!12!(*$^^%TSUL EUM ".'#'.$texOne->inventar_ichki. 'http://tech.tsul.uz/backend/tex/see?id='.$texOne->id."%$^^awefvwertfwb gw4g354236");
//          $yakuniy->AddPage();
        echo '<barcode code="'.$texOne->inventar_ichki.'\n'.$texOne->parametr.'\n'.$texOne->inventar_b.'\n \n'. 'http://tech.tsul.uz/backend/tex/see?id='.$texOne->id.'" size="1.2" type="QR" error="M" class="barcode" />';
        echo '<barcode code="'.$c.'" size="1.2" type="QR" error="M" class="barcode" />';
        echo '<br /><span style="display: block; width: 100%; " >  &nbsp; '.$texOne->inventar_ichki.'       &nbsp;  &nbsp; '.' #TSUL_EUM</span>';

        if($k%3==1 || $k%3==2 || $k%3==0){
            echo '</td>';
        }
        if($k%3==1){
            echo '</tr>';
        }
    }
        echo '</table>';
         $htmlQR = ob_get_contents();
         ob_end_clean();
         $yakuniy->WriteHTML($htmlQR);
//         return $yakuniy;
        $yakuniy->Output();
        exit;
    }

}
