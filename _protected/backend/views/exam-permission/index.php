<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Exams';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
    td {
        vertical-align: middle !important
    }
</style>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="course-teacher-view">
                    <div class="card card-info" style="padding: 40px; overflow-x: scroll;">
                        <div class="card-header" style="text-align: center;">
                            <h3 class="card-title1 " style="text-align: center;">
                                <h2 style="text-align:center"> Imtihonlar </h2>
                            </h3>
                        </div>
                        <br>
                   
                            <div >
                                <button style="width: auto;float: right;margin:5px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-xl">
                                    Imtihon yaratish
                                </button>
                               
                            </div>
                        <table id="example" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Imtihon nomi </th>
                                    <th style="text-align: center;">Javoblar</th>
                                    <th>Holati</th>
                                    <th>Ruxsat </th>
                                    <th>Biriktirish</th>
                                    <th style="text-align: center;"><i class="nav-icon fas fa-cog"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($exam_name as $exam_names) : ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $exam_names->title; ?></td>
                                        <td style="text-align: center;">
                                            <a href="<?= \yii\helpers\Url::to(['../exam-permission/javoblar?id=' . $exam_names->id])?>">Ko`rish</a>
                                        </td>
                                        <td><?php
                                            if ($exam_names->status == 1) {
                                                echo "Ochiq";
                                            } else {
                                                echo "Yopiq";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php if ($exam_names->status == 1) { ?>
                                                <a href="<?= \yii\helpers\Url::to(['../exam-permission/ruxsat?id=' . $exam_names->id], true) ?>">
                                                    <button class="btn btn-success">Yopish</button>
                                                </a>
                                            <?php } elseif ($exam_names->status == 0) { ?>
                                                <a href="<?= \yii\helpers\Url::to(['../exam-permission/ruxsat?id=' . $exam_names->id], true) ?>">
                                                    <button class="btn btn-danger">Ochish</button>
                                                </a>
                                            <?php } ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <a href="<?= \yii\helpers\Url::to(['../exam-permission/answer?id=' . $exam_names->id])?>"><i class="fas fa-key" style="color:green"></i></a>
                                        </td>
                                        <td style="text-align: center;">
                                            <a style="margin-right: 15px !important; font-size: 20px;" href="<?= \yii\helpers\Url::to(['../exam-permission/exam-name?id=' . $exam_names->id]) ?>"><span class="glyphicon glyphicon-eye-open"></span></a> 
                                         
                                            <a style="margin-left: 15px !important;"  onclick="return confirm('Imtihon ichidagi barcha ma`lumotlar bilan o`chirilishiga rozimisiz?')"  href="<?= \yii\helpers\Url::to(['../exam-permission/del?id=' . $exam_names->id]) ?>"><span class="glyphicon glyphicon-trash"></span></a>

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
                    <h4 class="modal-title">Imtixon qo`shish</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="/backend/uz/exam-permission/store" method="post">

                    <div class="row">
                        <div class="col-12">
                            <!-- Default box -->
                            <div class="course-view">

                                <div class="card card-info" style="padding: 10px;">
                                    <div class="row">
                                        <div class="col-xs-12 col-md-3">
                                            <div class="form-group">
                                                <label class="control-label" for="group-name">Imtihon nomi</label>
                                                <input type="text" id="coursedirector-full_name" class="form-control" required name="title" maxlength="50" aria-required="true" aria-invalid="true">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-3">
                                            <div class="form-group field-group-smester required has-success">
                                                <label class="control-label" for="group-smester">Oraliqni tanlang</label>
                                                <select required id="group-smester" class="form-control" name="exam_name" aria-required="true" aria-invalid="false">
                                                    <?php foreach ($exam as $ex) : ?>
                                                        <option type="checkbox" value="<?= $ex->id ?>">
                                                            <?= $ex->name ?>
                                                        </option>
                                                    <?php endforeach ?>
                                                </select>
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-3">
                                            <div class="form-group">
                                                <label class="control-label" for="group-name">Boshlanish vaqti</label>
                                                <input type="date" id="coursedirector-start" class="form-control" required name="start_date" maxlength="50" aria-required="true" aria-invalid="true">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-3">
                                            <div class="form-group">
                                                <label class="control-label" for="group-name">Tugash vaqti</label>
                                                <input type="date" id="coursedirector-finish" class="form-control" required name="finish_date" maxlength="50" aria-required="true" aria-invalid="true">
                                            </div>
                                        </div>
                                    <? $nowUser =  \common\models\User::find()->where(['=', 'user.id', Yii::$app->user->id])->one();
                                    if (! ($nowUser->uni_id == 4)) {?>
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
                                        <?}?>
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
                                         <div class="col-xs-12 col-md-4">
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
                                            <div class="card1">
                                                <div class="card-body">
                                                    <h2 style="text-align: center">Fanlar ro`yxati</h2>
                                                    <div id="fanlar">
                                                    </div>
                                                </div>
                                            </div>
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