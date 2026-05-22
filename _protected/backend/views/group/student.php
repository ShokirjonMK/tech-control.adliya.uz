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
                                <h2 style="text-align:center"><?=$group->name?> - guruh tinglovchilari </h2>
                            </h3>
                        </div>
                        <br>
                        <table id="example" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>F.I.O</th>
                                <th style="text-align: center;"><span class="glyphicon glyphicon-cog"></span></th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $i =1;  foreach ($student as $students): ?>
                                <?php  $user = \common\models\User::find()->where(['id'=>$students->user_id])->one();?>
                                <tr>
                                    <td><?=$i++?></td>
                                    <td><?=$user->full_name;?></td>

                                    <td style="text-align: center;">
                                        <a href="<?=\yii\helpers\Url::to(['../studentprofile/index?id='.$user->id])?>"><span class="glyphicon glyphicon-eye-open"></span></a>
                                        <a href="<?=\yii\helpers\Url::to(['../student/update1?id='.$user->id.'&id1='.$students->id])?>"><span class="glyphicon glyphicon-pencil"></span></a>
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


