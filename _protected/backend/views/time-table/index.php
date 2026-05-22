<?php

use yii\helpers\Html;
use yii\grid\GridView;

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
                                <h2 style="text-align:center"> Guruhlar</h2>
                            </h3>
                        </div>
                        <br>
                        <table id="example" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Guruh</th>
                                <? $user = \common\models\User::find()
                                        ->where(['=', 'user.id', Yii::$app->user->id])
                                        ->one();

                                if ( $user->uni_id == 4 ) { } else {?>
                                <th>Fakultet</th>
                                    <?}?>
                                
                                <th style="text-align:center">Mutaxasislik</th>
                                <th>Kurs</th>
                                <th>Semester</th>
                                <th>Holati</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $i =1;  foreach ($guruh as $gruxs): ?>
                                 <?php  $faculty = \common\models\Faculty::find()->where(['id'=>$gruxs->faculty_id])->one();?>
                                <?php  $direction = \common\models\Direction::find()->where(['id'=>$gruxs->direction_id])->one();?>
                                <tr>
                                    <td><?=$i++?></td>
                                    <td><?=$gruxs->name;?></td>
                                    <? if ( $user->uni_id == 4 ) { } else {?>
                                    <td><?=$faculty->name;?></td>
                                     <?}?>
                                    <td><?=$direction->name;?></td>
                                    <td style="text-align:center"><?=$gruxs->course_number;?></td>
                                    <td style="text-align:center"><?=$gruxs->smester;?></td>
                                    <td style="text-align:center">
                                        <?php if($gruxs->status == 1){
                                            echo "Aktiv";
                                        }else{
                                            echo "Passiv";
                                        }
                                        ?>
                                    <td>
                                        <a href="<?=\yii\helpers\Url::to(['../time-table/create?id='.$gruxs->id])?>"><span class="glyphicon glyphicon-eye-open"></span></a>
                                    </td>
                                </tr>
                            <?php  endforeach; ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


