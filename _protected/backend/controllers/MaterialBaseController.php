<?php

namespace backend\controllers;


use common\models\MaterialBase;
use common\models\MaterialBaseSearch;
use dmstr\bootstrap\Tabs;
use Yii;
use Mpdf\Mpdf;

use yii\helpers\Url;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;

//use common\models\Room;
//use common\models\RoomSearch;

class MaterialBaseController extends BackendController
{


    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'update', 'see', 'view', 'depdf', 'create'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'update', 'see', 'depdf', 'view', 'create'],
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


    public function actionIndex()
    {
        $model = new MaterialBase;
        $searchModel = new MaterialBaseSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $t_b = \common\models\Building::find()->all();
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'model' => $model,
            't_b' => $t_b,
        ]);
    }


    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    public function actionCreate()
    {
        $model = new MaterialBase;

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
        $Rooms = \common\models\Room::find()
            ->where(['building_id' => $id])
            ->orderBy('id')
            ->one();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'rooms'=>$Rooms

        ]);
    }


    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    protected function findModel($id)
    {
        if (($model = MaterialBase::findOne($id)) !== null) {
            return $model;
        } else {
            throw new HttpException(404, 'The requested page does not exist.');
        }
    }


    public function actionDepdf($id)
    {
//        if ($id == NULL) {
//            $id = $_GET["id"];
//        }

//        return $id;

        $tex2 = \common\models\Room::find()->where(['id' => $id])->one();

        $ttt = \common\models\Building::find()->where(['id' => $tex2->building_id])->one();

//        $model = $this->findModel($id);

        $material = \common\models\MaterialBase::find()
            ->andWhere(['room_id' => $id])
            ->all();

        $texnika = \common\models\TexMainBase::find()
            ->andWhere(['room_id' => $id])
            ->all();

        $ped_pdf = new mPDF();



        ob_start();
        echo '<style>
    
            table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
              }
              
            </style>';
        echo '<h5 style="text-align: right">Tasdiqlayman</h5>';
        echo '<h5 style="text-align: right">Toshkent davlat yuridik <br> universiteti prorektori 
   <br>
   ________________ A.Iminov <br>
    20__ -yil "___"_______________
</h5>';

        echo '<h5 style="text-align: center;">Toshkent davlat yuridik universiteti ' . $ttt->name . 'si  ' . $tex2->name . 'da  mavjud invertarlar</h5>';
        echo '<h3 style="text-align: center;"> ROʻYXATI </h3>';
        echo '<table style="width: 100%; ">';
        echo '<tr>';
        echo '<th style="width:5%; text-align: center;">#</th>';
        echo '<th style="width:20%">Inventar  nomi</th>';
        echo '<th style="width:20%">Inv. raqami</th>';
        echo '<th style="width:20%">Soni </th>';


        echo '</tr>';
        $i = 0;
        foreach ($material as $materialOne) {
            echo '<tr> <td style="text-align: center;">' . ++$i . '</td>';
            echo '<td>' . $materialOne->name . '</td>';
            echo '<td style="text-align: center">' . $materialOne->inventar . '</td>';
            echo '<td style="text-align: center">' . $materialOne->count . '</td>';

            '</tr>';
        }

        foreach ($texnika as $texnikaOne) {
            echo '<tr> <td style="text-align: center;">' . ++$i . '</td>';
            echo '<td>' . $texnikaOne->tipi->name . '</td>';
            echo '<td style="text-align: center">' . $texnikaOne->inventar_b . '</td>';
            echo '<td style="text-align: center"> 1 </td>';

            '</tr>';
        }

        echo '</table>';
        echo '<table style="border: none; width: 100%; margin-top: 2rem;">';
        echo '<tr style="margin-bottom: 2rem;">';
        echo '<th style="width:20%; border:none;">Topshirildi</th>';
        echo '<br>';
        echo '<th style="width:20%; border:none;  ">Maʼsul shaxs </th>';
        echo '<br>';
        echo '</tr>';
        echo '<br>';

        echo '<tr style="border: none; margin-top: 2rem" >';

        echo '<td style="border: none"> ______________' . $ttt->commandant . '</td>';
        
        echo '<td  style="text-align: right;border: none"> ______________ ' . $tex2->responce_persion . '</td>';
        echo '</tr>';
        echo '<br>';

        echo '<tr style="border: none; margin-top: 2rem" >';
        echo '<hr>';
        echo '<td style="border: none"> ______________ A.Karimov</td>';
        echo '<td  style="text-align: right;border: none"></td>';
        echo '</tr>';
        echo '</table>';
        $c = 'TSUL EUM' . '# \n' . 'http://tech.tsul.uz/backend/material-base/see?id=' . $id;

        echo '<div style="position: absolute; bottom: 30px; right: 30px;">';
        echo '<barcode code="' . $c . '" size="1.2" type="QR" error="M" class="barcode" />';
        echo '</div>';
        $htmlQR = ob_get_contents();
        ob_end_clean();
        $ped_pdf->WriteHTML($htmlQR);
        $ped_pdf->Output();

        exit;
    }

    public function actionSee($id)
    {
        $room = \common\models\Room::find()->where(['id' => $id])->one();
        $building = \common\models\Building::find()->where(['id' => $room->building_id])->one();
        $model = $this->findModel($id);
        $material = \common\models\MaterialBase::find()
            ->andWhere(['room_id' => $id])
            ->all();
        $texnika = \common\models\TexMainBase::find()
            ->andWhere(['room_id' => $id])
            ->all();

        return $this->render('see', [
            'room' => $room,
            'building' => $building,
            'material' => $material,
            'texnika' => $texnika,

        ]);

    }


    public function actionLists($id)
    {
        $Rooms = \common\models\Room::find()
            ->where(['building_id' => $id])
            ->orderBy('id')
            ->all();

        if (!empty($Rooms)) {
            foreach ($Rooms as $post) {
               echo "<option value='" . $post->id . "'>" . $post->name . "</option>";
            }
        } else {
            echo "<option> xona yuq </option>";
        }

    }
}
