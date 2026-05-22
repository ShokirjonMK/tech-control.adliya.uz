<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ExamPermissionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Exam Permissions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exam-permission-index">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="course-teacher-view">
                        <div class="card card-info" style="padding: 40px; overflow-x: scroll;">
                            <div class="card-header" style="text-align: center;">
                                <h3 class="card-title1 " style="text-align: center;">
                                    <h2 style="text-align:center">Savollar </h2>
                                </h3>
                            </div>
                            <br>
                            <div>

                            </div>
                            <br> 
                            <div style="overflow-x:1 scroll;">
                                <br/>
                                <table id="example" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>

                                            <th>Imtihon nomi</th>
                                            <th>Fan nomi</th>
                                            <th>Oraliq turi</th>
                                            <th>Boshlanish vaqti</th>
                                            <th>Tugash vaqti</th>
                                            <th>Savol</th>
                                            <th>Holati</th>
                                            <th>Yuklangan fayl</th>
                                            <th>Javob/Taqriz</th>
                                            <th style="width: 20px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($exam_question as $ep) : ?>
                                            <?php
                                            $usernow = \common\models\User::find()
                                                ->where(['=', 'user.id', Yii::$app->user->id])
                                                ->one();

                                            $exam_name = \common\models\ExamName::find()->where(['=', 'id', $ep->exam_name_id])->one();
                                            $faculty_new = \common\models\Faculty::find()->where(['=', 'id', $ep->faculty_id])->one();
                                            $direction_new = \common\models\Direction::find()->where(['=', 'id', $ep->direction_id])->one();
                                            $group_new = \common\models\Group::find()->where(['=', 'id', $ep->group_id])->one();
                                            $fan_new = \common\models\Fan::find()->where(['=', 'id', $ep->fan_id])->one();
                                            $exam_permission = \common\models\ExamPermission::find()
                                            ->where(['=', 'exam_name_id', $exam_name->id])
                                            ->andWhere(['=', 'group_id', $ep->group_id])
                                            ->andWhere(['=', 'fan_id', $ep->fan_id])
                                            ->one();
                                            $exam_answer = \common\models\ExamAnswer::find()
                                                ->where(['=', 'exam_name_id', $ep->exam_name_id])
                                                ->andWhere(['=', 'fan_id', $ep->fan_id])
                                                ->andWhere(['=', 'student_id', $usernow->id])
                                                ->one();
                                            $exams_new = \common\models\Exam::find()->where(['=', 'id', $exam_permission->exam_id])->one();
                                            
                                            ?>
                                            <tr>
                                                <td>
                                                    <?= $exam_name->title ?>
                                                </td>
                                                <td>
                                                    <?= $fan_new->name ?>
                                                </td>
                                                <td>
                                                    <?= $exams_new->name ?>
                                                </td>
                                                <td>
                                                    <?= $exam_permission->start_date; ?>
                                                </td>
                                                <td>
                                                    <?= $exam_permission->finish_date; ?>
                                                </td>
                                                <td style="text-align: center;">
                                                    <a href="<?= \yii\helpers\Url::to(['../../uploads/question/' . $ep->file_pdf], true) ?>">
                                                        <i style="color: #0056b3;font-size:25px;" class="fa fa-download" aria-hidden="true">
                                                        </i>
                                                    </a>
                                                </td>
                                                <td style="text-align: center;">
                                                    <?php if (!$exam_answer) : ?>
                                                        <i style="font-size: 25px; color: red;" class="fas fa-times-circle"></i>
                                                    <?php endif ?>
                                                    <?php if ($exam_answer) : ?>
                                                        <i style="font-size: 25px; color: green;" class="fas fa-check-circle"></i>
                                                    <?php endif ?>
                                                </td>
                                                <td>
                                                    <a href="<?= \yii\helpers\Url::to(['../../uploads/answer/' . $exam_answer->answer_pdf], true) ?>">
                                                    <?php 
                                                        echo $exam_answer->original_name; ?>
                                                    </a>
                                                </td>
                                                <td>
                                                    <form action="/backend/studentprofile/answerstore" method="post" enctype="multipart/form-data">

                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <?php if($exam_permission->status==1):?>
                                                                <?php if ($exam_permission->start_date <= date('Y-m-d') && $exam_permission->finish_date >= date('Y-m-d')) { ?>
                                                                    <input required="" name="ExamAnswer[file]" type="file" class="custom-file-input" accept=".pdf" id="exampleInputFile">
                                                                    <label class="custom-file-label" for="exampleInputFile">Faylni tanlang</label>
                                                                <?php }   ?>
                                                                <?php endif?>
                                                </div>

                                                                 <?php if (!($exam_permission->start_date <= date('Y-m-d') && $exam_permission->finish_date >= date('Y-m-d'))) { 

                                                                            $std = \common\models\Student::find()
                                                                                ->where(['=',  'user_id', $usernow->id])
                                                                                ->one();

                                                                            $gr = \common\models\Group::find()
                                                                                ->where(['=', 'id', $std->group_id])
                                                                                ->one();

                                                                            $exam_check = \common\models\ExamCheck::find()
                                                                                ->where(['=', 'exam_name_id', $ep->exam_name_id])
                                                                                ->andWhere(['=', 'fan_id', $ep->fan_id])
                                                                                ->andWhere(['=', 'student_id', $usernow->id])
                                                                                ->andWhere(['=', 'course_id', $gr->course_number])
                                                                                ->one();

                                                                   echo $exam_check->description;  } ?>

                                                                
                                                          

                                                        </div>
                                                </td>
                                                <input type="hidden" name="group_id" value="<?= $ep->group_id ?>">
                                                <input type="hidden" name="fan_id" value="<?= $ep->fan_id ?>">
                                                <input type="hidden" name="exam_name_id" value="<?= $ep->exam_name_id ?>">
                                                <td style="">
                                                    <button style="" type="submit" class="btn">
                                                        <i style="color: #0056b3; font-size:25px;" class="fa fa-upload" aria-hidden="true">
                                                        </i>
                                                    </button>
                                                </td>
                                                </form>

                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>

                                </table>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>