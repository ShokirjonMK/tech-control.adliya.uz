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
                                <h2 style="text-align:center"> O`qituvchining dars jadvali </h2>
                            </h3>
                        </div>
                        <br>
                        <table id="example4" class="table table-bordered table-striped">
                            <thead>
                                <tr style="width: 8%;   ">
                                    <th>#</th>
                                    <th style="text-align: center;">Hafta kuni</th>
                                    <th style="text-align: center;">Dars jadvali</th>

                                </tr>
                            </thead>
                            <tbody>

                            <?php foreach ($weekdays as $i => $value) : ?>
                                    <tr style="background-color:white;width: 8%;text-align:center;">
                                        <td ><?= $i ?></td>
                                        <td  valign="center" style="background-color:white;width: 1%;">
                                            <div style="transform: rotate(-90deg); cursor: default;" class="weekDays-selector">
                                                <input disabled="" value="1" type="checkbox" checked="" id="weekday-mon" class="weekday">
                                                <label style="width: 130px; cursor: default;" for="weekday-mon"><?= $value ?></label>
                                            </div>
                                        </td>
                                        <form action="../time-table/store" method="POST">
                                            <td valign="center">
                                                <?php foreach ($para as $p) : ?>
                                                    <div class="box" style="display: flex;align-items: center;justify-content: start;    margin-bottom: 10px;">
                                                        <button style="width: 25%; padding-top: 10px !important; padding: 0; cursor: default;" type="button" class="btn btn-success">
                                                            <p><?= $p->name ?>) <?= $p->time_start ?>--<?= $p->time_end ?> </p>
                                                        </button>
                                                        <div class="col-xs-12 col-md-6">
                                                            <div class="form-group" >
                                                                <?php foreach ($fan as $f) : ?>
                                                                    <?php foreach ($timetable as $tt) : ?>
                                                                        <?php if (($tt->para_id == $p->id) && ($tt->week_day == $i) && ($tt->fan_id == $f->id)) : ?>
                                                                            <?= $f->name ?>
                                                                            <?php break ?>
                                                                        <?php endif ?>
                                                                    <?php endforeach ?>
                                                                <?php endforeach ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12 col-md-3">
                                                            <div class="form-group">
                                                                <?php foreach ($group as $gr) : ?>
                                                                    <?php foreach ($timetable as $tt) : ?>
                                                                        <?php if (($tt->para_id == $p->id)  && ($tt->week_day == $i) && ($tt->group_id == $gr->id)) : ?>
                                                                            <a style="width: 80%" href="<?= \yii\helpers\Url::to(["/monitoring/check?time_table_id=".$tt->id], true) ?>" class="btn btn-primary btn-sm p-1">
                                                                                <?= $gr->name ?>
                                                                            </a>
                                                                        <?php endif ?>
                                                                    <?php endforeach ?>
                                                                <?php endforeach ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="test[<?= $p->id ?>][para_id]" value="<?= $p->id ?>">
                                                <?php endforeach ?>
                                            </td>

                                        </form>
                                    </tr>
                            <?php endforeach ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
</section>