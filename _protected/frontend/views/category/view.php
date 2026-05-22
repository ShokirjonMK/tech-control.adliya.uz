<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CourseStudent */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Course Students', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-student-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'first_name',
            'middle_name',
            'last_name',
            'gender',
            'number',
            'father_number',
            'mother_number',
            'birth_date',
            'level',
            'image',
            'user_id',
            'course_id',
            'status',
            'passport_image',
            'description:ntext',
            'come_date',
            'fan_id',
            'come_time',
        ],
    ]) ?>

</div>
