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
                                <a href="<?= \yii\helpers\Url::to(['/exam-permission/index']) ?>" style="width: auto;float: right; margin:5px;" class="btn btn-danger">
                                    Imtihonlar
                                </a>
                                <button style="width: auto;float: right;margin:5px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-xl">
                                    Savollarni yuklash
                                </button>

                            </div>
                            <br>
                            <div style="overflow-x:1 scroll;">
                                <table id="example" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Imtihon nomi</th>
                                        <? $userrrr = \common\models\User::find()
                                            ->where(['=', 'user.id', Yii::$app->user->id])
                                            ->one(); ?>

                                            <? if (!$userrrr->uni_id == 4){?> 

                                            <th>Fakultet nomi</th>
                                        <? }?>
                                            <th>Mutaxasisilik</th>
                                            <th>Guruh nomi</th>
                                            <th>Fan nomi</th>
                                            <th>Oraliq turi</th>
                                            <th>Boshlanish vaqti</th>
                                            <th>Tugash vaqti</th>
                                            <th>Savol</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($exam_question as $ep) : ?>
                                            <?php
                                            $exam_name = \common\models\ExamName::find()->where(['=', 'id', $ep->exam_name_id])->one();
                                            $faculty_new = \common\models\Faculty::find()->where(['=', 'id', $ep->faculty_id])->one();
                                            $direction_new = \common\models\Direction::find()->where(['=', 'id', $ep->direction_id])->one();
                                            $group_new = \common\models\Group::find()->where(['=', 'id', $ep->group_id])->one();
                                            $fan_new = \common\models\Fan::find()->where(['=', 'id', $ep->fan_id])->one();
                                            $exam_permission = \common\models\ExamPermission::find()->where(['=', 'exam_name_id', $exam_name->id])->one();

                                            $exams_new = \common\models\Exam::find()->where(['=', 'id', $exam_permission->exam_id])->one();
                                            ?>
                                            <tr>
                                                <td><?=$i++?></td>
                                                <td>
                                                    <?= $exam_name->title ?>
                                                </td>
                                                <? if (!$userrrr->uni_id == 4){?> 
                                                <td>
                                                    <?= $faculty_new->name ?>
                                                </td>
                                                 <? }?>
                                                <td>
                                                    <?= $direction_new->name ?>
                                                </td>
                                                <td>
                                                    <?= $group_new->name ?>
                                                </td>
                                                <td>
                                                    <?= $fan_new->name ?>
                                                </td>
                                                <td>
                                                    <?= $exams_new->name ?>
                                                </td>
                                                <td>
                                                    <?= mb_substr($exam_permission->start_date, 0, 10)  ?>
                                                </td>
                                                <td>
                                                    <?= mb_substr($exam_permission->finish_date, 0, 10)  ?>
                                                </td>
                                                <td style="text-align: center;">
                                                <a  href="<?= \yii\helpers\Url::to(['../../uploads/question/' . $ep->file_pdf], true) ?>">
                                                <i style="color: #0056b3;font-size:20px;" class="fa fa-download" aria-hidden="true">
                                                    </i>
                                                </a>
                                                </td>
                                                <td>
                                                <?php $examAnswerCount = \common\models\ExamAnswer::find()
                                                    ->where(['exam_name_id'=> $ep->exam_name_id])
                                                    ->andWhere(['faculty_id'=>$ep->faculty_id])
                                                    ->andWhere(['direction_id'=>$ep->direction_id])
                                                    ->andWhere(['group_id'=>$ep->group_id])
                                                    ->andWhere(['fan_id'=>$ep->fan_id])
                                                    ->count();
                                                if ($examAnswerCount == 0) : ?>
                                                    <a href="<?= \yii\helpers\Url::to(['/exam-permission/questiondelete?id=' . $ep->id], true) ?>"><span class="glyphicon glyphicon-trash"></span></a>
                                                <? endif; ?>
                                                    <a href="<?= \yii\helpers\Url::to(['/exam-permission/questionupdate?id=' . $ep->id]) ?>"><span class="glyphicon glyphicon-pencil"></span></a>
                                                </td>

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


    <div class="modal fade" id="modal-xl" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Savol yuklash</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="/backend/uz/exam-permission/questionstore" method="post" enctype="multipart/form-data">

                    <div class="row">
                        <div class="col-12">
                            <!-- Default box -->
                            <div class="course-view">

                                <div class="card card-info" style="padding: 10px;">
                                    <div class="row">

                                        <div class="col-xs-12 col-md-4">
                                            <div class="form-group field-group-smester required has-success">
                                                <label class="control-label" for="group-smester">Oraliqni tanlang</label>
                                                <select required id="group-smester" class="form-control" name="exam_name_id" aria-required="true" aria-invalid="false">
                                                    <?php foreach ($exam_name_new as $en) : ?>
                                                        <option type="checkbox" value="<?= $en->id ?>">
                                                            <?= $en->title ?>
                                                        </option>
                                                    <?php endforeach ?>
                                                </select>
                                                <div class="help-block"></div>
                                            </div>
                                        </div>


                                            <? $nowUser = \common\models\User::find()->where(['=', 'user.id', Yii::$app->user->id])->one();
                                            if (!($nowUser->uni_id == 4)) {?>
                                        <div class="col-xs-12 col-md-4">
                                            <div class="form-group">
                                                <label class="control-label" for="group-name">Fakultetni tanlang</label>
                                                <select required class="form-control select2" style="width: 100%;" id="faculty">
                                                    <option selected="" value="">-Fakultetni tanlang-</option>
                                                    <?php foreach ($faculty as $f) : ?>
                                                        <option type="checkbox" value="<?= $f->id ?>">
                                                            <?= $f->name ?>
                                                        </option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>
                                        <? } ?>
                                        <div class="col-xs-12 col-md-4">
                                            <div class="form-group">
                                                <label class="control-label" for="group-name">Mutaxasislik tanlang</label>
                                                <select class="form-control select2" style="width: 100%;" id="direction">
                                                    <option selected="" value="0">-Mutaxasislik tanlang-</option>
                                                    <?php foreach ($direction as $d) : ?>
                                                        <option type="checkbox" value="<?= $d->id ?>">
                                                            <?= $d->name ?>
                                                        </option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-3">
                                            <div class="form-group">
                                                <label class="control-label" for="group-name">Kursni tanlang</label>
                                                <select class="form-control select2" style="width: 100%;" id="course">
                                                    <option selected="" value="0">-Kursni tanlang-</option>
                                                    <?php foreach ($course as $c) : ?>
                                                        <option type="checkbox" value="<?= $c->id ?>">
                                                            <?= $c->name ?>-kurs
                                                        </option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-3">
                                            <div class="form-group">
                                                <label class="control-label" for="group-name">Fanni tanlang</label>
                                                <select required class="form-control select2" style="width: 100%;" name="fan" id="fan_change">
                                                    <option selected="" value="0">-Fanni tanlang-</option>
                                                    <?php foreach ($fan as $f) : ?>
                                                        <option type="checkbox" value="<?= $c->id ?>">
                                                            <?= $f->name ?>
                                                        </option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-5">
                                            <div class="form-group">
                                                <label for="exampleInputFile">Savolni pdfda yuklang</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input required name="ExamQuestion[file]" type="file" class="custom-file-input"  accept=".pdf" id="exampleInputFile">
                                                        <label class="custom-file-label" for="exampleInputFile">Faylni tanlang</label>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="card1">
                                                <div class="card-body">
                                                    <h2 style="text-align: center">Guruhlar ro`yxati</h2>
                                                    <div id="groups">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">


                                            <button style="float: right;width:100px;" type="submit" style="margin-left: 5%;" class="btn btn-primary">Saqlash</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

</div>