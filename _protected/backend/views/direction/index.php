<?php

use yii\helpers\Html;
use yii\grid\GridView;
$this->title = 'Directions';
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
                                <h2 style="text-align:center"> Mutaxasisliklar</h2>
                            </h3>
                        </div>
                        <br>
                        <h1><a href="<?=\yii\helpers\Url::to(['../direction/create1'])?>"><button style="float: right" class="btn btn-success"> Mutaxasislik yaratish</button></a></h1>
                        <table id="example" class="table table-striped table-bordered" >
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nomi</th>
                                <th>Ta`lim turi</th>
                                <? if ( !$uni_id == 4) :?>
                                    <th>Fakultet</th>
                                <? endif; ?>
                                <th>Holati</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php $i =1;  foreach ($direction as $directions): ?>
                                    <?php  $unversitet = \common\models\University::find()->where(['id'=>$directions->uni_id])->one();?>
                                    <?php  $faculty = \common\models\Faculty::find()->where(['id'=>$directions->faculty_id])->one();?>
                                    <tr>
                                        <td><?=$i++;?></td>
                                        <td> <a href="<?=\yii\helpers\Url::to(['../direction/group?id='.$directions->id])?>"><?=$directions->name;?></a></td>
                                        <td>
                                            <?php 
                                            $user = \common\models\User::find()->where(['id'=>Yii::$app->user->id])->one();
                                            $eduType = \common\models\EduType::find()->where(['uni_id'=>$user->uni_id])->all();
                                            foreach ($eduType as $et) {
                                             if($directions->edu_type == $et->id){
                                                echo $et->name;
                                             }
                                            }
                                            ?>
                                        </td>
                                <? if ( !$uni_id == 4) :?>

                                        <td><?=$faculty->name;?></td>
                                    <? endif; ?>
                                        <td>
                                            <?php
                                            if($directions->status == 1){
                                                echo "Aktiv";
                                            }else{
                                                echo "Passiv";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <a href="<?=\yii\helpers\Url::to(['../direction/update1?id='.$directions->id])?>"><span class="glyphicon glyphicon-pencil"></span></a>
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


