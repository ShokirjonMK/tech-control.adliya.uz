<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ExamStudentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Exam Students';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><a href="<?=\yii\helpers\Url::to(['../exam-student/create'])?>"><button class="btn btn-success" style="width: 20%"> Exam Student yaratish</button></a></h1>

<table id="example" class="table table-striped table-bordered" >
    <thead>
    <tr>
        <th>#</th>
        <th>student_id </th>
        <th>exam_id </th>
        <th>mark</th>
        <th>group_id</th>
        <th>fan_id</th>
        <th>smester</th>
        <th></th>
    </tr>
    </thead>
    <?php $i = 1;  foreach ($exam_student as $exam_students): ?>
        <tbody>
        <tr>
            <td><?=$i++?></td>
            <td><?=$exam_students->student_id;?></td>
            <td><?=$exam_students->exam_id;?></td>
            <td><?=$exam_students->mark;?></td>
            <td><?=$exam_students->group_id;?></td>
            <td><?=$exam_students->fan_id;?></td>
            <td><?=$exam_students->smester;?></td>
            <td>
                <a href="<?=\yii\helpers\Url::to(['../exam-student/delete?id='.$exam_students->id], true)?>"><span class="glyphicon glyphicon-trash"></span></a>
                <a href="<?=\yii\helpers\Url::to(['../exam-student/update?id='.$exam_students->id])?>"><span class="glyphicon glyphicon-pencil"></span></a>
            </td>
        </tr>

        </tbody>
    <?php  endforeach; ?>
</table>