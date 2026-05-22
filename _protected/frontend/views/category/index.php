<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CourseStudentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Course Students';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-student-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Course Student', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'first_name',
            'middle_name',
            'last_name',
            'gender',
            //'number',
            //'father_number',
            //'mother_number',
            //'birth_date',
            //'level',
            //'image',
            //'user_id',
            //'course_id',
            //'status',
            //'passport_image',
            //'description:ntext',
            //'come_date',
            //'fan_id',
            //'come_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
