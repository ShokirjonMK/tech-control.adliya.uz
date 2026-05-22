<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
?>
<style>
    input[type=checkbox] {
        box-sizing: border-box;
        padding: 0;
        width: 50px;
        height: 38px;
    }

    .field-user-first {
        margin-top: 25px;
    }

    .weekDays-selector input {
        display: none !important;
    }

    .weekDays-selector input[type=checkbox]+label {
        display: inline-block;
        border-radius: 6px;
        background: #dddddd;
        height: 40px;
        width: 30px;
        margin-right: 3px;
        line-height: 40px;
        text-align: center;
        cursor: pointer;
    }

    .weekDays-selector input[type=checkbox]:checked+label {
        background: #2AD705;
        color: #ffffff;
    }

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
                                <h2 style="text-align:center"><?=$group->name?> dars jadvali </h2>
                            </h3>
                        </div>
                        <br>
                        <table id="example4" class="table table-bordered table-striped">
                            <thead>
                                <tr style="width: 100%;">
                                    <th>#</th>
                                    <th style="text-align: center;">Hafta kuni</th>
                                    <th style="text-align: center;">Dars jadvali</th>
                                    <th style="text-align: center;"></th>
                                </tr>
                            </thead>
                            <?php foreach ($weekdays as $i => $value) : ?>
                                <tbody>
                                    <tr style="background-color:white;width: 8%;text-align:center;">
                                        <td rowspan="6"><?= $i ?></td>
                                        <td rowspan="6" valign="center" style="background-color:white;width: 1%;">
                                            <div style="transform: rotate(-90deg);" class="weekDays-selector">
                                                <input disabled="" value="1" type="checkbox" checked="" id="weekday-mon" class="weekday">
                                                <label style="width: 110px; cursor: default;" for="weekday-mon"><?= $value ?></label>
                                            </div>
                                        </td>
                                        <form action="../time-table/store" method="POST">
                                            <td valign="center">
                                                <?php foreach ($para as $p) : ?>
                                                    <div class="row box" style="display: flex; padding:0px; margin: 0px; align-items: center;justify-content: center;">
                                                        <p style="background-color: rgba(57, 115, 234, 0.6); padding: 4px 6px; border-radius: 4px; cursor: default;"><?= $p->name ?>) <?= $p->time_start ?>--<?= $p->time_end ?> </p>
                                                        <div class="col-xs-12 col-md-3">
                                                            <div class="form-group">
                                                                <select class="form-control select2" style="width: 100%;" name="test[<?= $p->id ?>][fan]">
                                                                    <option selected="" value="0">-</option>
                                                                    <?php foreach ($fan as $f) : ?>
                                                                        <option <?php foreach ($timetable as $tt) : ?><?php if (($tt->para_id == $p->id) && ($tt->group_id == $group_id)&& ($tt->week_day == $i) && ($tt->fan_id == $f->id)) : ?>selected="" <?php endif ?><?php endforeach ?> value="<?= $f->id ?>"><?= $f->name ?></option>
                                                                    <?php endforeach ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12 col-md-3">
                                                            <div class="form-group">
                                                                <select class="form-control select2" style="width: 100%;" name="test[<?= $p->id ?>][teacher]">
                                                                    <option selected="" value="0">-</option>
                                                                    <?php foreach ($teachers as $t) : ?>
                                                                        <option <?php foreach ($timetable as $tt) : ?><?php if (($tt->para_id == $p->id) && ($tt->group_id == $group_id)  && ($tt->week_day == $i) && ($tt->teacher_id == $t->id)) : ?>selected="" <?php endif ?><?php endforeach ?> value="<?= $t->id ?>"><?= $t->full_name ?></option>
                                                                    <?php endforeach ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12 col-md-3">
                                                            <div class="form-group">
                                                                <select class="form-control select2" style="width: 100%;" name="test[<?= $p->id ?>][xona]">
                                                                    <option selected="" value="0">-</option>
                                                                    <?php foreach ($xona as $x) : ?>
                                                                        <option <?php foreach ($timetable as $tt) : ?><?php if (($tt->para_id == $p->id) && ($tt->group_id == $group_id) && ($tt->week_day == $i) && ($tt->xona_id == $x->id)) : ?>selected="" <?php endif ?><?php endforeach ?> value="<?= $x->id ?>"><?= $x->name ?></option>
                                                                    <?php endforeach ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="test[<?= $p->id ?>][para_id]" value="<?= $p->id ?>">
                                                <?php endforeach ?>
                                            </td>
                                            <td>
                                                <input type="hidden" name="week_day" value="<?= $i ?>">
                                                <input type="hidden" name="group_id" value="<?= $group_id ?>">
                                                <button style=" width: 100%;" type="submit" class="btn btn-primary">Saqlash</button>
                                            </td>
                                        </form>
                                    </tr>
                                </tbody>
                            <?php endforeach ?>
                        </table>
                    </div>
                </div>
            </div>
    </div>
 </section|>