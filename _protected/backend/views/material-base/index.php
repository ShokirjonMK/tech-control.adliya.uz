<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = 'Tarkibiy Bolinmas';
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
<div class="tarkibiy-bolinma-index">

    <div class="row">
        <div class="col-md-3">
            <div class="row">

                <p>
                    <?= Html::a('Qo\'shish', ['create'], ['class' => 'btn btn-success']) ?>
                </p>

            </div>
        </div>


        <div class="col-md-9">
            <form action="<?= \yii\helpers\Url::to(["/material-base/depdf"], true) ?>" method="GET" id="tttt">
                <div class="row">
                    <div class="select col-md-8">
                        <select  onchange="getId(this)" id="roomId">
                            <option> Bino tanlang</option>
                            <?php foreach ($t_b as $t_b_one) { ?>
                                <option value="<?= $t_b_one->id ?>"><?= $t_b_one->name ?></option>
                            <?php } ?>
                        </select>
                        <select id="room_id" name="id">
                            <option> Xonani tanlang</option>
                        </select>
                    </div>

                    <button style="width: 100%;" class="primary col-md-4">Xonadagi texnika</button>

                </div>
            </form>

        </div>
    </div>


    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            [
                'attribute' => 'building_id',
                'value' => function ($model) {
                    return $model->building->name;
                },
            ],
            [
                'attribute' => 'room_id',
                'value' => function ($model) {
                    return $model->room->name;
                },
            ],
            'inventar',
            'count',


            [
                'attribute' => 'status',
                'value' => function (\common\models\MaterialBase $model) {
                    return \common\helpers\MaterialBaseHelper::getStatusLabel($model->status);
                },
                'filter' => \common\helpers\MaterialBaseHelper::getStatusList(),
                'format' => 'raw',

            ],

            [

                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['style' => 'width: 5%', 'class' => 'text-center'],
                

            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
<script>
    function getId(e){
        let id = e.value;
        get_regions(id);
    }
    function get_regions(id) {
        if (id != "") {
            var url = '/backend/uz/material-base/lists?id=' + id;
            $.ajax({
                url: url,
                method: 'GET',
                success: function (result) {
                    console.log(result);
                    $('select[name="id"]').html(result);
                }
            })
        }
    }
</script>

