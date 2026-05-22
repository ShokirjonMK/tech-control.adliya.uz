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
                        <div class="row">
                            <h1><a href="<?=\yii\helpers\Url::to(['../group/create'])?>"><button class="btn btn-success" > Guruh yaratish</button></a></h1>

                            <? $user = \common\models\User::find()
            ->where(['=', 'user.id', Yii::$app->user->id])
            ->one();
            if ($user->uni_id == 4) { ?>
               
               
                            <h1 style="margin-left: 680px"><a href="<?=\yii\helpers\Url::to(['../group/group?faculty_id=9'])?>"><button class="btn btn-warning"> Guruhlarni yangilash</button></a></h1>

                             <? } else {?>

                              <h1 style="margin-left: 680px"><a href="<?=\yii\helpers\Url::to(['../group/group?faculty_id=9'])?>"><button class="btn btn-warning"> Guruhlarni yangilash</button></a></h1>
                          <? }?>
                        </div>
                        <table id="example" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Guruh</th>

         <? $user = \common\models\User::find()
            ->where(['=', 'user.id', Yii::$app->user->id])
            ->one();
            if (!$user->uni_id == 4) { ?>
                                <th>Fakultet</th>
                                <? }?>
                                <th>Mutaxasislik</th>
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
                                    <td><?=$gruxs->name?></td>
                                    <? $user = \common\models\User::find()
            ->where(['=', 'user.id', Yii::$app->user->id])
            ->one();
            if (!$user->uni_id == 4) { ?>
                                    <td><?=$faculty->name;?></td>
                        <? }?>
                                    <td><?=$direction->name;?></td>
                                    <td><?=$gruxs->course_number;?></td>
                                    <td><?=$gruxs->smester;?></td>
                                    <td>
                                        <?php if($gruxs->status == 1){
                                            echo "Aktiv";
                                        }else{
                                            echo "Passiv";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="<?=\yii\helpers\Url::to(['../group/update?id='.$gruxs->id])?>"><span class="glyphicon glyphicon-pencil"></span></a>
                                        <a href="<?=\yii\helpers\Url::to(['../group/student?id='.$gruxs->id])?>"><span class="glyphicon glyphicon-eye-open"></span></a>
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


