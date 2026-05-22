<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\db\Expression;

$this->title = 'Exam Students';
$this->params['breadcrumbs'][] = $this->title;

 $a = Yii::$app->request->get('group_id');
 $b = Yii::$app->request->get('fan_id');
 $fan = \common\models\Fan::find()->where(['id'=>$b])->one();
 $group3 = \common\models\Group::find()->where(['id'=>$a])->one();

 $user = \common\models\User::find()->where(['id'=>Yii::$app->user->id])->one();
 $permission2 = \common\models\Permission::find()->where([ 'group_id'=>$a, 'fan_id'=>$b])->one();
  $exam2 = \common\models\Exam::find()->where(['id'=>$permission2->exam_id, 'uni_id'=>$user->uni_id])->orderBy(['sort'=>SORT_ASC])->all();
 $exam1 = \common\models\Exam::find()->where(['uni_id'=>$user->uni_id])->orderBy(['sort'=>SORT_ASC])->all();
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
    #example_wrapper{
        margin-top: 55px;


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
                                <h2 style="text-align:center"><?php  echo $group3->name.' '; echo  $fan->name;?> </h2>
                            </h3>
                        </div>
                        <br>
                        <?php $form = ActiveForm::begin(['action' =>'reting?group_id='.$a.'&fan_id='.$b]); ?>
                        <button class="btn btn-success" style="float: right;margin-bottom: 40px;">Saqlash</button>
                        <table style="margin-top: 55px;" id="example" class="table table-striped table-bordered" >
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>F.I.O</th>

                                <?php  foreach ($exam1 as $exams): ?>
                                    <th><?=$exams->name;?></th>
                                <?php  endforeach; ?>
                                <th>Jami</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php  $i =1; foreach ($student as $students): ?>
                                <?php $users = \common\models\User::find()->where(['id'=>$students->user_id])->one();?>
                                <?php $group = \common\models\Group::find()->where(['id'=>$students->group_id])->one();?>

                                <tr>
                                    <td><?=$i++?></td>
                                    <td><?=$users->full_name;?></td>

                                    <?php  foreach ($exam1 as $exams): ?>
                                        <?php $exam_student = \common\models\ExamStudent::find()->where(['fan_id'=>$b,'student_id'=>$students->user_id, 'smester'=>$group->smester, 'exam_id'=>$exams->id])->one();?>
                                        <td>
                                            <?php if ($exams->status == 1){ ?>
                                                <?php if (!$exam_student->mark){ ?>
                                                    <input type="number" style="text-align: center" min="0" max=<?=$exams->mark;?> name="<?=$students->user_id?>mark<?=$exams->id?>" value="">
                                                <?php } else{ ?>
                                                    <input type="number"  style="text-align: center" min="0" max=<?=$exams->mark;?> required  name="<?=$students->user_id?>mark<?=$exams->id?>" value=<?=$exam_student->mark?>>
                                                <?php }?>
                                            <?php }  else  if ($exams->status == 0){ ?>

                                                <?php if ($permission2->status == 1 && $permission2->exam_id == $exams->id){ ?>
                                                    <?php  foreach ($exam2 as $examse): ?>
                                                        <?php $exam_student = \common\models\ExamStudent::find()->where(['student_id'=>$students->user_id, 'smester'=>$group->smester, 'exam_id'=>$examse->id])->one();?>
                                                        <?php if (!$exam_student->mark){ ?>
                                                            <input type="number" min="0" style="text-align: center" max=<?=$examse->mark;?> name="<?=$students->user_id?>mark<?=$examse->id?>" value="">
                                                        <?php } else{ ?>
                                                            <input type="number" min="0" style="text-align: center" max=<?=$examse->mark;?> required  name="<?=$students->user_id?>mark<?=$examse->id?>" value=<?=$exam_student->mark?>>
                                                        <?php }?>
                                                    <?php  endforeach; ?>
                                                <?php } else { ?>
                                                    <?php if (!$exam_student->mark){ ?>
                                                        <input type="number" style="text-align: center" disabled="disabled" min="0" max='0' value="">
                                                    <?php } else { ?>
                                                        <input type="number" style="text-align: center" disabled="disabled" min="0" max='0' value=<?=$exam_student->mark?>>
                                                    <?php }?>
                                                <?php }?>

                                            <?php }?>

                                        </td>
                                    <?php  endforeach; ?>


                                    <td style="text-align: center;">
                                        <?php
                                            $exam_s = \common\models\Group::find()->where(['id'=>$students->group_id])->one();
                                            $query = (new \yii\db\Query())->from('exam_student')->where(['student_id'=>$students->user_id, 'fan_id'=>$b, 'smester'=>$exam_s->smester]);
                                            $sum = $query->sum('mark');
                                            echo $sum;
                                        ?>
                                    </td>

                                </tr>
                            <?php  endforeach; ?>
                                </tbody>

                        </table>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
</section|>

