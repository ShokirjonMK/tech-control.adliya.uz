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
                                <h2 style="text-align:center"> Kafedra </h2>
                            </h3>
                        </div>
                        <br>
                        <h1><a href="<?=\yii\helpers\Url::to(['../kafedra/create'])?>"><button class="btn btn-primary" style="width: 16.6%;float: right"> Kafedra  yaratish</button></a></h1>
                        <table id="example" class="table table-striped table-bordered" >
                            <thead>
                            <tr>
                                <th style="text-align:center;">#</th>
                                <th  style="text-align:center;">Kafedra Nomi </th>
                                <th style="text-align:center;">Holati</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i =1;  foreach ($kafedra as $kafedras):
                                // $mudir = \common\models\User::find()->where(['id'=>$kafedras->mudir_id])->one();
                                ?>
                                <tr>
                                    <td style="text-align:center;"><?=$i++?></td>
                                    <td><?=$kafedras->name;?></td>
                                    <td style="text-align:center;"><?php
                                        if($kafedras->status ==1){
                                            echo "Aktiv";
                                        }else{
                                            echo "Passiv";
                                        }
                                        ?>
                                    </td>
                                    <td style="width: 10%; text-align:center;">
                                        <a href="<?=\yii\helpers\Url::to(['../kafedra/update?id='.$kafedras->id])?>"><span class="glyphicon glyphicon-pencil"></span></a>
                                        <a href="<?=\yii\helpers\Url::to(['../kafedra/status?id='.$kafedras->id])?>"><span class="glyphicon glyphicon-trash"></span></a>
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
