<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\MonitoringSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Monitorings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="course-teacher-view">
                <div class="card card-info" style="padding: 40px; overflow-x: scroll;">
                    <div class="card-header" style="text-align: center;">
                        <h3 class="card-title1 " style="text-align: center;">
                        </h3>
                        <h2 style="text-align:center">
                            <?php foreach ($weekdays as $i => $value) : ?>
                                <?php if ($i == $timetable->week_day) : ?>
                                    <?= $value ?>
                                <?php endif ?>
                            <?php endforeach ?>
                            <?php foreach ($para as $p) : ?>
                                <?php if ($p->id == $timetable->para_id) : ?>
                                    <?= $p->name ?> <?= $p->time_start ?>--<?= $p->time_end ?>
                                <?php endif ?>
                            <?php endforeach ?>
                            <?php foreach ($fan as $f) : ?>
                                <?php if ($f->id == $timetable->fan_id) : ?>
                                    <?= $f->name ?>
                                <?php endif ?>
                            <?php endforeach ?>
                        </h2>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                            <form action="/backend/uz/monitoring/check" method="POST">
                                <div class="col-xs-12 col-md-5">
                                    <div class="form-group">
                                        <label>Sanasi:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="far fa-calendar-alt"></i>
                                                </span>
                                            </div>
                                            <input type="date" <?php if ($date) : ?> value="<?php echo $date ?>" <?php endif ?> <?php if (!$date) : ?> value="<?php echo date("Y-m-d"); ?>" <?php endif ?> class="form-control float-right" name="date" id="reservation" onchange="this.form.submit();">
                                            <input type="hidden" value="<?= $timetable->id ?>" class="form-control float-right" name="time_table_id">
                                        </div>
                                    </div>
                                    </br>
                                </div>
                            </form>
                            <br>
                            <form action="/backend/uz/monitoring/checkpost" method="post">
                                <button style="float: right;margin-top: -100px;" type="submit" style="margin-left: 5%;" class="btn btn-primary">Saqlash</button>
                                
                                <input type="hidden" value="<?= $timetable->id ?>" class="form-control float-right" name="time_table_id">
                                <input type="hidden" <?php if ($date) : ?> value="<?php echo $date ?>" <?php endif ?> <?php if (!$date) : ?> value="<?php echo date("Y-m-d"); ?>" <?php endif ?> class="form-control float-right" name="date" id="reservation" onchange="this.form.submit();">
                                <table id="example" class="table table-bordered table-striped">
                                    <thead>
                                        <tr style="width: 8%;">
                                            <th>#</th>
                                            <th style="text-align: center;"><?=$group->name; ?> - guruh talabalari</th>
                                            <th id="tableDefaultCheck122 ">
                                                <input style="top:0;" id="tableDefaultCheck1" type="checkbox" class="option-input radio" />
                                            </th>
                                        </tr>
                                    </thead>
                                    <?php $num = 1; ?>
                                    <tbody>
                                        <?php foreach ($data as $dt) : ?>
                                            <tr role="row" class="odd">
                                                <td class="sorting_1"><?= $num ?></td>
                                                <td>
                                                    <?php
                                                    $user = \common\models\User::find()
                                                        ->where(['=', 'user.id', $dt->user_id])
                                                        ->one();
                                                    ?>
                                                    <?= $user->full_name ?>
                                                </td>
                                                <td class="day7">
                                                    <input type="hidden" value="0" name="student[<?= $dt->id ?>]" />
                                                    <?php $monitor_chek = \common\models\MonitoringCheck::find()

                                                        ->where(['=', 'date', $date])
                                                        ->andWhere(['=', 'time_table_id', $time_table_id])
                                                        ->one();
                                                    $monitor = \common\models\Monitoring::find()
                                                        ->where(['=', 'monitoring.date', $date])
                                                        ->andWhere(['=', 'monitoring.time_table_id', $time_table_id])
                                                        ->andWhere(['=', 'monitoring.student_id',  $dt->id])
                                                        ->one();

                                                    ?>
                                                    <?php if (($monitor_chek) && ($monitor)) : ?>
                                                        <input type="checkbox" class="option-input radio" value="1" name="student[<?= $dt->id ?>]">
                                                    <?php endif ?>
                                                    <?php if (($monitor_chek) && (!($monitor))) : ?>
                                                        <input type="checkbox" checked class="option-input radio" value="1" name="student[<?= $dt->id ?>]">
                                                    <?php endif ?>
                                                    <?php if ((!$monitor_chek) && (!$monitor)) : ?>
                                                        <input type="checkbox" class="option-input radio" value="1" name="student[<?= $dt->id ?>]">
                                                    <?php endif ?>
                                                </td>
                                            </tr>
                                            <?php $num++; ?>
                                        <?php endforeach ?>
                                    </tbody>


                                </table>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

