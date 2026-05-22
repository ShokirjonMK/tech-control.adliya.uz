<?php

namespace backend\controllers;

use Yii;
use common\models\TarkibiyBolinma;
use common\models\TarkibiyBolinmaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use common\models\TexMainBase;

use Mpdf\Mpdf;

/**
 * TarkibiyBolinmaController implements the CRUD actions for TarkibiyBolinma model.
 */
class TarkibiyBolinmaController extends Controller
{
    /**
     * {@inheritdoc}
     */
//    public function behaviors()
//    {
//        return [
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'delete' => ['POST'],
//                ],
//            ],
//        ];
//    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'update', 'view', 'create', 'depdf', 'see'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'update', 'view', 'create', 'depdf', 'see'],
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


    /**
     * Lists all TarkibiyBolinma models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TarkibiyBolinmaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $t_b = \common\models\TarkibiyBolinma::find()->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            't_b' => $t_b,
        ]);
    }

    /**
     * Displays a single TarkibiyBolinma model.
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
     * Creates a new TarkibiyBolinma model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TarkibiyBolinma();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TarkibiyBolinma model.
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
     * Deletes an existing TarkibiyBolinma model.
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

    public function actionDepdf($id = NULL)
    {
        if ($id == NULL) {
            $id = $_GET["id"];
        }

        $model = $this->findModel($id);
        $tex = TexMainBase::find()
            ->where(['status' => 1])
            ->andWhere(['tarkibiy_bolinma_id' => $id])
            ->all();

        $ped_pdf = new mPDF();

        ob_start();
        echo '<style>
            table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
              }
            </style>';
        echo '<h5 style="text-align: center;">' . $model->name . '</h5>';
        echo '<table style="width: 100%; ">';
        echo '<tr>';
        echo '<th style="width:5%; text-align: center;">#</th>';
        echo '<th style="width:20%">Nomi</th>';
        echo '<th style="width:20%">Inventer</th>';
        echo '<th style="width:60%">Parametri</th>';


        echo '</tr>';
        $i = 0;
        foreach ($tex as $texOne) {
            echo '<tr> <td style="text-align: center;">' . ++$i . '</td>';
            echo '<td>' . $texOne->tipi->name . '</td>';
            echo '<td style="text-align: center">' . $texOne->inventar_ichki . '</td>';
            echo '<td>' . $texOne->parametr . '</td>
                </tr>';


        }
        echo '</table>';

        echo '<p></p> <p style="text-align: right; margin-right: 50px;"> Mas\'ul:  ' . $model->rahbar . ' &nbsp;&nbsp; _________ <br> ( imzo )</p> ';
        $c = base64_encode(")(&+=-wertse45!@12!1212@!12!(*$^^% " . '#' . 'TSUL EUM' . '#'  . 'http://tech.tsul.uz/backend/tarkibiy-bolinma/see?id=' . $id . "%$^^awefvwertfwb gw4g354236");


        echo '<div style="position: absolute; bottom: 30px; right: 30px;">';
        echo '<barcode code="' . $c . '" size="1.2" type="QR" error="M" class="barcode" />';
        echo '</div>';
        $htmlQR = ob_get_contents();
        ob_end_clean();
        $ped_pdf->WriteHTML($htmlQR);
        $ped_pdf->Output();

        exit;
    }

    protected function findModel($id)
    {
        if (($model = TarkibiyBolinma::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionSee($id)
    {
        $this->layout = 'see';

        $tex = TexMainBase::find()
            ->where(['status' => 1])
            ->andWhere(['tarkibiy_bolinma_id' => $id])
            ->all();
        $One = TexMainBase::find()
            ->where(['status' => 1])
            ->andWhere(['tarkibiy_bolinma_id' => $id])
            ->one();

        $model = $this->findModel($id);


//    print_r($One->biriktirilgan);
//    exit();
        return $this->render('see', [
            'tex' => $tex,
            'One' => $One,
            'model' => $model,
        ]);

    }
}
