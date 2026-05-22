<?php

use yii\helpers\Html;
use yii\grid\GridView;

$id1 = Yii::$app->request->get('id');
$this->title = 'Exam Permissions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exam-permission-index">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="course-teacher-view">
                        <div class="card card-info" style="padding: 40px; overflow-x: scroll;">
                            <div class="card-header" style="text-align: center;">
                                <h3 class="card-title1 " style="text-align: center;">
                                    <h2 style="text-align:center"><?=$group->name?> - guruh</h2>
                                </h3>
                            </div>
                            <br>
                            <div>

                                <a href="<?= \yii\helpers\Url::to(['/exam-permission/ansgr?en='.$examName->id.'&dir='.$group->direction_id]) ?>" style="width: 25%;float: left; margin:5px;" class="btn btn-success">
                                   Orqaga
                                </a>
                                <span style="float: right; margin:5px; cursor: default;" class="btn btn-primary">
                                    Imtihon: <?=$examName->title?>
                                </span>
                            </div>
                            <br>
                            <table id="example" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>F.I.O</th>
                                        <? foreach ($examPer as $ep) :
                                            $fan = \common\models\Fan::findOne(['id'=>$ep->fan_id]);?>
                                            <th><?=$fan->name?></th>
                                        <? endforeach; ?>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($students as $std) : ?>
                                        <?php
                                        $ustd = \common\models\User::findOne(['id'=>$std->user_id]);

                                        ?>
                                        <tr>
                                            <td><?=$i++;?></td>
                                            <td><?=$ustd->full_name?></td>
                                            <? foreach ($examPer as $ep) :
                                            $fan = \common\models\Fan::findOne(['id'=>$ep->fan_id]);
                                                $examAnswer = \common\models\ExamAnswer::find()
                                                    ->where(['exam_name_id'=>$examName->id])
                                                    ->andWhere(['group_id'=>$group->id])
                                                    ->andWhere(['fan_id'=>$ep->fan_id])
                                                    ->andWhere(['student_id'=>$ustd->id])
                                                    ->one();
                                            ?>
                                            <td style="text-align: center;">
                                                <? if($examAnswer) : ?>
                                                <a href="<?= \yii\helpers\Url::to(['../../uploads/answer/' . $examAnswer->answer_pdf], true) ?>">
                                                    <i style="color: #0056b3;font-size:25px;" class="fa fa-download" aria-hidden="true">
                                                    </i>
                                                </a>
                                            <? endif; ?>
                                            </td>
                                        <? endforeach; ?>
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

</div>