<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
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
                                <h2 style="text-align:center"> O`qituvchilar ro`yxati </h2>
                            </h3>
                        </div>
                        <br>
                        <table id="example4" class="table table-bordered table-striped">
                            <thead>
                                <tr style="width: 8%;   ">
                                    <th>#</th>
                                    <th style="text-align: center;">O`qituvchilar</th>
                                    <th style="text-align: center;">Dars jadvali</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($teachers as $tea) : ?>
                                    <tr style="background-color:white;width: 8%;text-align:center;">
                                        <td ><?= $i ?></td>
                                        <td ><?= $tea->full_name ?></td>
                                        <td >
                                            <a href="<?= \yii\helpers\Url::to(["/monitoring/timetable?teacher_id=" . $tea->id], true) ?>" class="btn btn-primary btn-sm">
                                                Ko`rish
                                            </a>
                                        </td>
                                    </tr>
                                <?php $i++;
                                endforeach ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>