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
                                    $fan1 = \common\models\Fan::findOne($fan_id);
                                    echo $fan1->name . " fani"
                                     ?>
                                </h2>
                            </h3>
                        </div>
                        <br>
                        <h1>
                            <a href="<?= \yii\helpers\Url::to(['../exam-permission/answer?id=' . $exam_name_id])  ?>"><button class="btn btn-primary" style="width: 120px;">
                                Ortga
                            </button></a>
                        </h1>
                        
                            <table id="example" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th style="text-align:center;">#</th>
                                        <th style="text-align:center;">O'qituvchilar</th>
                                        <th style="text-align:center;">O'quvchilar</th>
                                        <th style="text-align:center;">Belgilangan vaqt</th>
                                        <th style="text-align:center;">Tekshirilgan nazorat</th>
                                        <th style="text-align:center;">Ball</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php $i = 1;
                                    foreach ($exam_check as $ec) :  ?>
                                        <?php
                                        $user = \common\models\User::findOne($ec->teacher_id);
                                        $user2 = \common\models\User::findOne($ec->student_id);
                                         ?>
                                        <tr>


                                            <td style="text-align:center;"><?= $i++  ?></td>
                                            <td style="text-align:center;"><?= $user->full_name  ?></td>
                                            <td style="text-align:center;"><?= $user2->full_name  ?></td>
                                            <?php if (($ec->mark == 0) && ( date('Y-m-d') <= $ec->last_date )) { ?>

                                            <td style="text-align: center;"><?= $ec->last_date  ?></td>
                                            <?php } else if ($ec->mark > 0) { ?>
                                                <td style="text-align:center;"><button disabled type="button" class="btn btn-primary">Tekshirilgan</button></td>
                                           <?php } else { ?>
                                            <td style="text-align:center;"><button disabled type="button" class="btn btn-danger">Vaqt tugagan</button>
                                            
                                            
                                            </td>
                                            <?php }  ?>
                                            <td style="text-align:center;">
                                                <?php if(($ec->mark == 0) && ( date('Y-m-d') > $ec->last_date )){ ?>
                                            <button style="margin-top: 0px; margin-left: 0px;" type="button" class="btn btn-primary changedatebtn zafarbut" data-toggle="modal" id="primary" data-target="#modal-primary" style="width: 120px;float: right">
                                                Vaqtni cho`zish
                                            </button>
                                            <input type="hidden" class="changedategetinput zafarin1" value="<?=$ec->id ?>">
                                                <?php }  else { echo $ec->description; } ?>
                                            </td>
                                            <td style="text-align:center;"><?=$ec->mark  ?></td>
                
                                        </tr>
                                    <?php endforeach;  ?>
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<form action="../exam-permission/changedate" method="POST">
<div class="modal fade" id="modal-primary" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content bg-primary">
            <div class="modal-header">
                <h4 class="modal-title">Vaqtni o'zgartirish</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <p>Ushbu o`qituvchi ishlarni tekshirishi uchun vaqtni qayta belgilash.</p>
            
                <div style=" margin-right: 25%;" class="col-xs-12 col-md-8">
                    <div class="form-group">
                        <label>Vaqtni belgilang: </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="far fa-calendar-alt"></i>
                                </span>
                            </div>
                        <input required="" type="date" value="<?php echo date("Y-m-d");  ?>" class="form-control float-right" name="date">

                        <input type="hidden" value="" class="zafarin2" name="exam_check_id">
                        </div>
                    </div>
                    <br>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                
                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Chiqish</button>
                <button type="submit" class="btn btn-outline-light">Saqlash</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
</form>