<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ExamAnswerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Exam Answers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exam-answer-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Exam Answer', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'exam_name_id',
            'faculty_id',
            'direction_id',
            'group_id',
            //'fan_id',
            //'answer_pdf',
            //'student_id',
            //'created_at',
            //'update_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
