<?php

use yii\helpers\Html;
use yii\grid\GridView;

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
                                <h2 style="text-align:center"> Tekshirish </h2>
                            </h3>
                        </div>
                        <br>
                   
                          
                        <table id="example" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Imtxon nomi </th>
                                    <th>Holati</th>
                                    <th>Soni</th>
                                    <th>Kirish</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; 
                                foreach ($exam_name as $en) : 
                                foreach ($exam_check as $ech) :
                                if ($ech->exam_name_id == $en->id) : ?>
                                    <tr class="collapsed" 
                                    data-toggle="collapse"
                                    data-target=".collapse<?=$i?>"
                                    aria-expanded="true"
                                    aria-controls="collapse<?=$i?>"
                                    style="cursor: pointer;">
                                        <td><?= $i++ ?></td>
                                        <td><?= $en->title; ?></td>
                                        <td><?php
                                            if ($en->status == 1) {
                                                echo "Ochiq";
                                            } else {
                                                echo "Yopiq";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php $u =  \common\models\User::findOne(['=', 'user.id', Yii::$app->user->id]);
                                             $count = \common\models\ExamCheck::find()
                                                ->where(['teacher_id'=>$u->id])
                                                ->andWhere(['status'=>1])
                                                ->andWhere(['exam_name_id'=>$en->id])
                                                ->count();
                                            echo $count;?>
                                        </td>
                                        <td >
                                            <a href="<?= \yii\helpers\Url::to(['../teacherprofile/examname?id='. $en->id])?>">Kirish</a>
                                        </td>
                                    </tr>
                                <?php endif; endforeach; endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
