<?php

use yii\helpers\Html;
use yii\grid\GridView;

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
                                <h2 style="text-align:center"> 
                                <?php $group = \common\models\Group::find()->where(['id' => $group_id])->one(); ?>
                                <?= $group->name?> guruh talabalari
                            </h2>
                            </h3>
                        </div>
                        <br>
                        <h1><a href="<?= \yii\helpers\Url::to(['../student/create?id=' . $group_id]) ?>"><button class="btn btn-success" style="width: 20%;float: right"> Student yaratish</button></a></h1>
                        <table id="example" class="table table-striped table-bordered">
                            <thead>
                                <tr>

                                    <th>#</th>
                                    <th>Talabalar</th>
                                    <td><?=$i++?></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($student as $students) : ?>
                                    <?php $users = \common\models\Student::find()->where(['user_id' => $students->id, 'group_id'=>$group_id])->one(); ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $students->full_name; ?></td>
                                        <td style="text-align:center;">
                                            <a href="<?= \yii\helpers\Url::to(['../studentprofile/index?id='.$students->id]) ?>"><span class="mr-2 glyphicon glyphicon-eye-open"></span>
                                            </a>

                                            <a href="<?= \yii\helpers\Url::to(['../student/update?id1='.$users->id.'&id=' . $students->id . '&group=' . $group_id]) ?>"><span class="glyphicon glyphicon-pencil"></span>
                                            </a>
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