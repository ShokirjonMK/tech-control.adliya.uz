<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\MonitoringCheckSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Monitoring Checks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="monitoring-check-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Monitoring Check', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'group_id',
            'faculty_id',
            'direction_id',
            'status',
            //'time_table_id:datetime',
            //'date',
            //'uni_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
