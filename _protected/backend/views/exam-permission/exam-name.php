<?php

use yii\helpers\Html;
use yii\grid\GridView;

$id1 = Yii::$app->request->get('id');
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
                                    <h2 style="text-align:center"> <?=$examt->title?> </h2>
                                </h3>
                            </div>
                            <br>
                            <div>
                                <a href="<?= \yii\helpers\Url::to(['/exam-permission/index']) ?>" style="width: 25%;float: left; margin:5px;" class="btn btn-success">
                                   Orqaga
                                </a>
                                <button style="width: 25%;float: right;margin:5px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-xl">
                                    Savollarni yuklash
                                </button>
                            </div>
                            <br>
                            <table id="example" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Mutahasislik nomi</th>
                                        <th>Guruh nomi</th>
                                        <th>Fan nomi</th>
                                        <th>Oraliq turi</th>
                                        <th>Boshlanish vaqti</th>
                                        <th>Tugash vaqti</th>
                                        <th>Ruxsat</th>
                                        <th>Savol</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($exam_permission as $ep) : ?>
                                        <?php
                                        $faculty_new = \common\models\Faculty::find()->where(['=', 'id', $ep->faculty_id])->one();
                                        $direction_new = \common\models\Direction::find()->where(['=', 'id', $ep->direction_id])->one();
                                        $group_new = \common\models\Group::find()->where(['=', 'id', $ep->group_id])->one();
                                        $fan_new = \common\models\Fan::find()->where(['=', 'id', $ep->fan_id])->one();
                                        $exams_new = \common\models\Exam::find()->where(['=', 'id', $ep->exam_id])->one();
                                        ?>
                                        <tr>
                                            <td><?=$i++?></td>
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
                                                <?= mb_substr($ep->start_date, 0, 10)  ?>
                                            </td>
                                            <td>
                                                <?= mb_substr($ep->finish_date, 0, 10)  ?>
                                            </td>
                                            <td>
                                                <?php if ($ep->status == 1) { ?>
                                                    <a href="<?= \yii\helpers\Url::to(['../exam-permission/ruxsat1?id=' . $ep->id . '&id1=' . $id1], true) ?>">
                                                        <button class="btn btn-success">Yopish</button>
                                                    </a>
                                                <?php } elseif ($ep->status == 0) { ?>
                                                    <a href="<?= \yii\helpers\Url::to(['../exam-permission/ruxsat1?id=' . $ep->id . '&id1=' . $id1], true) ?>">
                                                        <button class="btn btn-danger">Ochish</button>
                                                    </a>
                                                <?php } ?>
                                            </td>
                                            </td>
                                            <? $filePdf = \common\models\ExamQuestion::find()
                                                ->where(['faculty_id'=>$ep->faculty_id])
                                                ->andWhere(['direction_id'=>$ep->direction_id])
                                                ->andWhere(['group_id'=>$ep->group_id])
                                                ->andWhere(['fan_id'=>$ep->fan_id])
                                                ->andWhere(['exam_name_id'=>$ep->exam_name_id])
                                                ->one();?>
                                            <td style="text-align: center;">
                                            <? if($filePdf) :?>
                                            <a  href="<?= \yii\helpers\Url::to(['../../uploads/question/' . $filePdf->file_pdf], true) ?>">
                                            <i style="color: #0056b3;font-size:20px;" class="fa fa-download" aria-hidden="true">
                                                </i>
                                            </a>
                                            <?endif;?>
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
                                                    <a href="<?= \yii\helpers\Url::to(['/exam-permission/delete?id=' . $ep->id], true) ?>"><span class="glyphicon glyphicon-trash"></span></a>
                                                <? endif; ?>
                                                <a href="<?= \yii\helpers\Url::to(['/exam-permission/update?id=' . $ep->id]) ?>"><span class="glyphicon glyphicon-pencil"></span></a>
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
    </section>


    <div class="modal fade" id="modal-xl" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?=$examt->title?>dan savol yuklash</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="/backend/uz/exam-permission/questionstore" method="post" enctype="multipart/form-data" class="upload-form">

                    <div class="row">
                        <div class="col-12">
                            <!-- Default box -->
                            <div class="course-view">

                                <div class="card card-info" style="padding: 10px;">
                                    <div class="row">
                                        <input type='hidden' value='<?=$examt->id?>' name='exam_name_id'>
                                        <div class="col-xs-12 col-md-3">
                                            <div class="form-group">
                                                <label class="control-label" for="group-name">Fanni tanlang</label>
                                                <select required class="form-control" style="width: 100%;" name="fan" id="fan_change">
                                                    <?php foreach ($fanlar as $f) : ?>
                                                        <option type="checkbox"  value="<?= $f->id ?>">
                                                            <?= $f->name ?>
                                                        </option>
                                                    <?php  endforeach ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-5">
                                            <div class="form-group">
                                                <label for="exampleInputFile">Savolni pdfda yuklang </label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input required name="ExamQuestion[file]" class="custom-file-input"  type="file" accept=".pdf" id="exampleInputFile">
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
                                                    <?php foreach ($group as $grr):?>


                                                    <label style="padding: 0 10px 0 0;">
                                                    <input checked type="checkbox" class="option-input radio change_groups"
                                                     value="<?=$grr->id?>" name="group[<?=$grr->id?>]"><?= $grr->name?></label>
                                                   <?php endforeach; ?>
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


<?php
$this->registerJs(
    "$('#fan_change').select2().addAttr('required')"

);
?>
