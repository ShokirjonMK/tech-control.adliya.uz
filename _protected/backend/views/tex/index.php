<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $searchModel common\models\TexSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tex Main Bases';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
    select {
        -webkit-appearance: none;
        -moz-appearance: none;
        -ms-appearance: none;
        appearance: none;
        outline: 0;
        box-shadow: none;
        border: 0 !important;
        background: #2c3e50;
        background-image: none;
    }

    /* Remove IE arrow */
    select::-ms-expand {
        display: none;
    }

    /* Custom Select */
    .select {
        position: relative;
        display: flex;


        line-height: 3;
        background: #2c3e50;
        overflow: hidden;
        border-radius: .25em;
    }

    select {
        flex: 1;
        padding: 0 .5em;
        color: #fff;
        cursor: pointer;
    }

    /* Arrow */
    .select::after {
        content: '\25BC';
        position: absolute;
        top: 0;
        right: 0;
        padding: 0 1em;
        background: #34495e;
        cursor: pointer;
        pointer-events: none;
        -webkit-transition: .25s all ease;
        -o-transition: .25s all ease;
        transition: .25s all ease;
    }

    /* Transition */
    .select:hover::after {
        color: #f39c12;
    }
</style>
<div class="tex-main-base-index">

    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6">
                    <p>
                        <?= Html::a('Create Tex Main Base', ['create'], ['class' => 'btn btn-success']) ?>
                    </p>
                </div>
                <div class="col-md-6">
                    <a href="<?= \yii\helpers\Url::to(['../tex/qrpdftr']) ?>">
                        <i style="color: #0056b3;font-size:35px;" class="fa fa-download ml-2 mr-2" aria-hidden="true">Barchasi</i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <form action="<?= \yii\helpers\Url::to(["/tex/assa"], true) ?>" method="GET" id="tttt">

                <div class="row">
                    <div class="select col-md-8">
                        <select style="width: 100%" name="tarkibiy_bolinma_id" id="slct">
                            <option> Bo'limni tanlang</option>
                            <?php foreach ($t_b as $t_b_one) { ?>
                                <option value="<?= $t_b_one->id ?>"><?= $t_b_one->name ?></option>
                            <?php }

                            ?>
                        </select>
                    </div>

                    <button style="width: 100%;" class="primary col-md-4">Bo'lim bo'yicha qr</button>

                </div>
            </form>
        </div>
    </div>


    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'tartib_raqami',
//            'uzasbo_nomi',
            'tipi_id',
            'parametr:ntext',
            [
                'attribute' => 'bino',

            ],

            [
                'attribute' => 'room_id',
                'value' => function ($model) {
                    if ($model->room && $model->room->name !== null) {
                        return $model->room->name;
                    } else {
                        return '';
                    }
                },
            ],
            'tarkibiy_bolinma_id',
            [
                'attribute' => 'rahbar',
                'value' => function ($model) {
                    return  $model->tarkibiyBolinma->rahbar;
                },
            ],
            [
                'attribute' => 'holati',
                'value' => function ($model) {
                    return $model->holati->name;
                },
            ],
            'inventar_ichki',
//            'yili',
            'holati_id',
            'yaroqliligi_id',
//            'inventar_b',
//            'partiya',
            'dona_narx',
            'partiya_narx',
//            'bino_qushimcha',
            'how_come_id',
//            'status',
//            'created_at',
//            'updated_at',
//            'created_by',
//            'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
