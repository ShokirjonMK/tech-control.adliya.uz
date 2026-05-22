<?php

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
                                <h2 style="text-align:center"> <?= $fan->name ?> fanini tekshirish </h2>
                            </h3>
                        </div>
                        <br>
                   <a class="p-3" href="<?=\yii\helpers\Url::to(['../teacherprofile/examname?id='.$examNameId])?>">
                                <button  class="btn btn-success" style="width: 30%; float: left">
                                    Orqaga
                                </button>
                            </a>
                          
                        <table id="example" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">#</th>
                                    <th style="text-align: center;">Yuklangan vaqt</th>
                                    <th style="text-align: center;">Belgilangan vaqt</th>
                                    <th style="text-align: center;">Holati</th>
                                    <th style="text-align: center;">Tekshirish</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($exam_answer as $ea) :
                                    foreach ($exam_check as $ech) :
                                        if(($ea->fan_id == $ech->fan_id) && ($ea->exam_name_id == $ech->exam_name_id) && ($ea->student_id == $ech->student_id)) :
                                    ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $ea->update_at; ?></td>
                                        <?php $user = \common\models\User::find()
                                                    ->where(['=', 'user.id', Yii::$app->user->id])
                                                    ->one();
                                         $examCheck = \common\models\ExamCheck::find()
                                                        ->where(['teacher_id'=>$user->id])
                                                        ->andWhere(['exam_name_id'=>$ea->exam_name_id])
                                                        ->andWhere(['fan_id'=>$ea->fan_id])
                                                        ->andWhere(['student_id'=>$ea->student_id])
                                                        ->one();?>
                                      

                                        <td style="text-align: center;"><?= $examCheck->last_date ?></td>
                                        <td style="text-align: center;">
                                                    
                                                        <?php if ($examCheck->mark == 0) : ?>
                                                        <i style="font-size: 35px;color: red;" class="fas fa-times-circle"></i>
                                                    <?php endif ?>
                                                    <?php if ($examCheck->mark > 0) : ?>
                                                        <i style="font-size: 35px;color: green;" class="fas fa-check-circle"></i>
                                                    <?php endif ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <?php if ($examCheck->last_date >= date('Y-m-d')) { ?>
                                            <a href="<?= \yii\helpers\Url::to(['../teacherprofile/checkpdf?id='.$ea->id])?>">
                                                <i style="color: #0056b3;font-size:20px;" class="fa fa-eye" aria-hidden="true"></i>
                                            </a>

                                            <a class="pl-3" href="<?= \yii\helpers\Url::to(['../teacherprofile/pdf?id='.$ea->id])?>">
                                                Chizib tekshirish
                                            </a>

                                     <?php } else if (($examCheck->mark == 0) && ( date('Y-m-d') > $examCheck->last_date )) { ?>
                                            <button disabled type="button" class="btn btn-danger">Vaqt tugagan</button> 
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php endif;  endforeach; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
