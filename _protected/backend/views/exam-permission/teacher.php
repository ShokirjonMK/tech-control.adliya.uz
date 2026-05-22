<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ExamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Exams';
$this->params['breadcrumbs'][] = $this->title;
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
                                    <?php
                                    $fan = Yii::$app->request->get('id');
                                    $fan1 = \common\models\Fan::findOne($fan);
                                    echo $fan1->name . " fani o'qituvchilari"
                                    ?>
                                </h2>
                            </h3>
                        </div>
                        <br>
                        <h1>
                            <button style="float: right;margin-top: 0px; margin-left: 5%;" class="btn btn-primary" id="check_teachecher_count" style="width: 120px;float: right">
                                Tasdiqlash
                            </button>
                            <div class="" style="display: none" ;>
                                <button type="button" class="btn btn-primary" data-toggle="modal" id="primary" data-target="#modal-primary">
                                    To'g'ri kiritildi!
                                </button>
                                <button type="button" class="btn btn-danger" id="danger" data-toggle="modal" data-target="#modal-danger">
                                    Xatolik!
                                </button>
                            </div>
                        </h1>
                        <form action="../exam-permission/spread" method="POST">
                            <table id="example" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th style="text-align:center;">#</th>
                                        <th style="text-align:center;">O'qituvchilar</th>
                                        <?php $lang = \common\models\Lang::find()->all(); ?>
                                        <?php foreach ($lang as $l) : ?>
                                            <?php $answer = \common\models\ExamAnswer::find()
                                                ->leftJoin('group', 'group.id = exam_answer.group_id')
                                                ->where(['exam_name_id' => $exam_name_id])
                                                ->andWhere(['group.lang_id' => $l->id])
                                                ->andWhere(['exam_answer.fan_id' => $fan_id])
                                                ->count();
                                            ?>
                                            <th style="text-align:center;">
                                                Tekshiriladigan oraliqlar soni:<?= $answer ?> ta (<?= $l->name ?>)
                                                <input type="hidden" value="<?= $answer ?>" id="<?= $l->url ?>_count">
                                            </th>
                                        <?php endforeach ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($teacher as $teachers) : ?>
                                        <?php
                                        $user = \common\models\User::findOne($teachers);
                                        ?>
                                        <tr>
                                            <td style="text-align:center;"><?= $i++ ?></td>
                                            <td style="text-align:center;"><?= $user->full_name ?></td>
                                            <?php $lang = \common\models\Lang::find()->all(); ?>
                                            <?php foreach ($lang as $l) : ?>
                                                <?php $teacher = \common\models\Teacher::find()
                                                    ->where(['=', 'user_id', $user->id])
                                                    ->andWhere(['=', 'lang_id', $l->id])
                                                    ->andWhere(['=', 'fan_id', $fan_id])
                                                    ->one(); ?>
                                                <td style="text-align:center;">
                                                    <?php if ($teacher->lang_id == $l->id) : ?>
                                                        <input type="number" class="form-control <?= $l->url ?>_teacher" name="teacher[<?= $user->id ?>][<?= $l->url ?>]" value="0">
                                                    <?php endif ?>
                                                </td>
                                            <?php endforeach ?>
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
<div class="modal fade" id="modal-primary" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content bg-primary">
            <div class="modal-header">
                <h4 class="modal-title">To'g'ri kiritildi!</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <p>Hamma malumotlar to`g`ri kiritildi tasdiqlash uchun saqlash tugmasini bosing.</p>
           
            	<div style=" margin-right: 25%;" class="col-xs-12 col-md-8">
                    <div class="form-group">
                        <label>Tekshirish uchun oxirgi kunni belgilang: </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="far fa-calendar-alt"></i>
                                </span>
                            </div>
                        <input type="date" required="" value="<?php echo date("Y-m-d"); ?>" class="form-control float-right" name="date_m" id="reservation">
		                </div>
                    </div>
                    <br>
                     </div>
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" value="<?= $fan_id ?>" name="fan_id">
                				
                <input type="hidden" value="<?= $exam_name_id ?>" name="exam_name_id">
                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Chiqish</button>
                <button type="submit" class="btn btn-outline-light">Saqlash</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
</form>
<div class="modal fade" id="modal-danger" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content bg-danger">
            <div class="modal-header">
                <h4 class="modal-title">Xato kiritildi!</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Sonlar xato kiritildi iltimos qaytib urinib ko`ring!!!</p>
            </div>
            <div class="modal-footer justify-content-between1">
                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Chiqish</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>