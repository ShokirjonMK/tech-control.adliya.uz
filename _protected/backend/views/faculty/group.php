<?php

use yii\helpers\Html;
use yii\grid\GridView;

$mut = Yii::$app->request->get('id');

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
                                <h2 style="text-align:center"> Guruhlar </h2>
                            </h3>
                        </div>
                        <br>
                        <div class="row">
                            <div style="float:left;" class="btn-group">
                                <div style="float:left;" class="btn-group">
                                    <?php foreach ($cours as $course):?>
                                    <a href="<?= \yii\helpers\Url::to(['../faculty/group?id=' . $mut . '&kurs_id='.$course->name]) ?>" style="color: #fff;margin: 5px;"><button type="button" class="btn btn-primary"><?=$course->name;?>-kurs</button></a>
                                    <?php endforeach;?>
                                </div>
                            </div>

                        </div>
                        <div style="margin-top: -40px;">
                            <a style="float:right;margin:5px;" href="<?= \yii\helpers\Url::to(['../group/create?id=' . $mut]) ?>">
                                <button class="btn btn-success pull-right"> Guruh yaratish</button></a>
                        </div>
                        <table id="example" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Guruhlar</th>
                                    <th>Ta'lim tili</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php $i = 1;
                                foreach ($group as $groups) : ?>
                                <?php $lang = \common\models\Lang::find()->where(['id'=>$groups->lang_id])->one();?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $groups->name.'-guruh'; ?></td>
                                        <td><?= $lang->name; ?></td>
                                        <td><a href="<?= \yii\helpers\Url::to(['../faculty/student?group_id=' . $groups->id]) ?>">Kirish <span class="glyphicon glyphicon-arrow-right"></span></a></td>
                                        <td>
                                            <a href="<?= \yii\helpers\Url::to(['../group/update?id=' . $groups->id]) ?>"><span class="glyphicon glyphicon-pencil"></span></a>
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