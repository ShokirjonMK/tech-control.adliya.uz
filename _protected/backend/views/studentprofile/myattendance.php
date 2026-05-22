<?php

use yii\helpers\Html;
// use yii\widgets\ActiveForm;
// use wbraganca\dynamicform\DynamicFormWidget;
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
                                <h2 style="text-align:center"> Qoldirgan darslarim </h2>
                            </h3>
                        </div>
                        <br>
                        <table id="example4" class="table table-bordered table-striped" style="text-align:center;">
                            <thead>
                                <tr style="width: 8%;   ">
                                    <th>#</th>
                                    <th style="text-align: center;">Fanlar</th>
                                    <th style="text-align: center;">Qoldirilgan dars</th>
                                    <th style="text-align: center;">Ko'rish</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php $i=0; foreach ($fanlar as $fan) : ?>
                                    <?php   foreach ($timetable as $t) :?>
                                        <?php if($fan->id == $t->fan_id): ?>
                                            <tr>
                                                <td>
                                                    <?php echo ++$i; ?>
                                                </td>
                                                <td>
                                                    <?php echo $fan->name; ?>
                                                </td>
                                                <td>
                                                    <?php $a=0;
                                                    foreach ($timetable as $tt) :
                                                        if($tt->fan_id == $fan->id): 
                                                        $a += \common\models\Monitoring::find()
                                                        ->where(['student_id'=>$student->id])
                                                        ->andWhere(['time_table_id'=>$tt->id])
                                                        ->count();
                                                        endif;
                                                    endforeach;
                                                        echo $a;
                                                        
                                                    ?>

                                                </td>
                                                <td><?php if ($a>0) :?>
                                                    <a href="<?= \yii\helpers\Url::to(["/studentprofile/onesubject?fan_id=" . $fan->id], true) ?>" class="btn btn-primary btn-sm">
                                                        Ko`rish
                                                    </a>
                                                <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php break; ?>
                                    <?php endif; ?>

                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</section>