<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ExamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Exams';
$this->params['breadcrumbs'][] = $this->title;
$id1 = Yii::$app->request->get('id');
$id0 = Yii::$app->request->get('fan_id');
$fan = Yii::$app->request->get('fan');
$fans = Yii::$app->request->get('fans');
$user = \common\models\User::find()->where(['id'=>Yii::$app->user->id])->one();
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
        <?php if (!empty($id0)){?>
            <div id="w0-success-0" class="alert-success alert fade in">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                Malumotlar berildi
            </div>
        <?php }else if ($fan=='0'){?>
            <div id="w0-success-0" class="alert-danger alert fade in">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                Ma`lumotlar qaytarildi
            </div>
        <?php }else if ($fans=='0'){?>
            <div id="w0-success-0" class="alert-info alert fade in">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                Bunday studentlar yo`q
            </div>
        <?php } ?>
        <div class="row">
            <div class="col-12">
                <div class="course-teacher-view">
                    <div class="card card-info" style="padding: 40px; overflow-x: scroll;">
                        <div class="card-header" style="text-align: center;">
                            <h3 class="card-title1 " style="text-align: center;">
                                <h2 style="text-align:center">
                                    <?php foreach ($answer as $answers => $key) {
                                        $exam_name = \common\models\ExamName::findOne($key['exam_name_id']);
                                    }
                                    echo $examName->title;
                                    ?>
                                </h2>
                            </h3>
                        </div>
                        <br>
                        <a href="<?= \yii\helpers\Url::to(['/exam-permission/index']) ?>" style="width: 25%;float: left; margin:5px;" class="btn btn-success">
                                   Orqaga
                                </a>
                                
                        <table id="example" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="text-align:center;">#</th>
                                    <th style="text-align:center;">Fanlar</th>
                                    <?php $lang = \common\models\Lang::find()->all(); ?>
                                    <?php foreach ($lang as $l) : ?>
                                        <th style="text-align:center;">Ishlar soni(<?=$l->name?>)</th>
                                    <?php endforeach ?>
                                    <th tyle="text-align:center;">Ishlarni biriktirish</th>
                                    <th tyle="text-align:center;">Natijalar</th>
                                    <th>E`lon qilish</th>
                        
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($answer as $answers => $key) : ?>
                                    <?php
                                    $fan = \common\models\Fan::findOne($key['fan_id']);
                                    ?>
                                    <tr>
                                        <td style="text-align:center;"><?= $i++ ?></td>
                                        <td style="text-align:center;"><?= $fan->name; ?></td>
                                        <?php foreach ($lang as $l) : ?>
                                            <td style="text-align:center;">
                                                <?php $answer = \common\models\ExamAnswer::find()
                                                    ->leftJoin('group', 'group.id = exam_answer.group_id')
                                                    ->where(['exam_name_id' => $id])
                                                    ->andWhere(['group.lang_id' => $l->id])
                                                    ->andWhere(['exam_answer.fan_id' => $key['fan_id']])
                                                    ->andWhere(['exam_name_id'=>$exam_name->id])
                                                    ->count();
                                                ?>
                                                <?= $answer ?>
                                            </td>
                                        <?php endforeach ?>
                                        <td style="width: 10%; text-align:center;">
                                            <?php $exam_check = \common\models\ExamCheck::find()
                                                ->where(['exam_name_id' => $id])
                                                ->andWhere(['fan_id' => $key['fan_id']])
                                                ->one();
                                            $exPer = \common\models\ExamPermission::find()->where(['exam_name_id'=>$examName->id])->andWhere(['fan_id'=>$fan->id])->one();
                                            $t = (($exPer->status == 0) || ($exPer->finish_date < date('Y-m-d')));
// var_dump($exPer->status); die();
                                                if ( (! $t) && (!$exam_check) ) {  ?>
                                            <button class="btn btn-info" id="check_teachecher_count<?=$exam_check->id;?>" >Biriktirish</button>
                                                <div class="" style="display: none" ;>
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" id="primary" data-target="#modal-primary">
                                                    To'g'ri kiritildi!
                                                    </button>
                                                    <button type="button" class="btn btn-danger" id="danger" data-toggle="modal" data-target="#modal-danger">
                                                    Xatolik!
                                                    </button>
                                                </div>
                                            
                                            <?php  } else if (!$exam_check) { ?>
                                                <a class="btn btn-success" href="<?= \yii\helpers\Url::to(['../exam-permission/teacher?id=' . $key['fan_id'] . '&exam_name_id=' . $id]) ?>">
                                                    Biriktirish
                                                </a>
                                            
                                            <?php } else  ?>
                                            <?php  if ( $exam_check) {  ?>
                                                <a class="btn btn-success">
                                                    <i style="color: white;" class="fa fa-check" aria-hidden="true"></i>
                                                </a>
                                            <?php } ?>
                                        </td>
                                        <td style="width: 10%; text-align:center;">
                                            <a href="<?= \yii\helpers\Url::to(['../exam-permission/result?fan_id=' . $key['fan_id'] . '&exam_name_id=' . $id]) ?>">
                                                Kirish
                                            </a>
                                        </td>
                                        <td style="width: 10%; text-align:center;">
                                            <?php
                                            $student = \common\models\ExamStudent::find()
                                                ->where([
                                                    'uni_id'        =>$user->uni_id,
                                                    'fan_id'        =>$key['fan_id'],
                                                    'exam_name_id'  =>$id,
                                                    
                                                ])->one();

                                            if ((!empty($student) && ($student->status == 0)) ){
                                            ?>
                                             <a  onclick="return confirm('Tasdiqlaysizmi ?')" href="<?= \yii\helpers\Url::to(['../exam-permission/exams?fan_id=' . $key['fan_id'] . '&exam_name_id=' . $id]) ?>">
                                                 <button type="button" class="btn btn-info">Berish</button>
                                             </a>
                                            <?php }else if (($student->status == 1)) {
                                               
                                            ?>
                                                <a  onclick="return confirm('Tasdiqlaysizmi ?')" href="<?= \yii\helpers\Url::to(['../exam-permission/exams?fan_id=' . $key['fan_id'] . '&exam_name_id=' . $id]) ?>">
                                                   <button type="button" class="btn btn-warning">Qaytarish</button>
                                                </a>
                                            <?php }?>

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
<div class="modal fade" id="modal-danger" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content bg-info">
            <div class="modal-header">
                <h4 class="modal-title">Eslatma</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Belgilangan vaqt tugashi kerak yoki oraliq nazoratni yoping!</p>
            </div>
            <div class="modal-footer justify-content-between1">
                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Yopish</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>