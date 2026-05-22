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
                                <h2 style="text-align:center"> Nazoratlar </h2>
                            </h3>
                        </div>
                        <br>
                        <h1><a href="<?=\yii\helpers\Url::to(['../exam/create'])?>"><button class="btn btn-primary" style="width: 16.6%;float: right"> Nazoratlar  yaratish</button></a></h1>
                        <table id="example" class="table table-striped table-bordered" >
                            <thead>
                            <tr>
                                <th style="text-align:center;">#</th>
                                <th>Nomi </th>
                                <th style="text-align:center;">Baho</th>
                                <th style="text-align:center;">Holati</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i =1;  foreach ($exam as $exams): ?>
                                <tr>
                                    <td style="text-align:center;"><?=$i++?></td>
                                    <td><?=$exams->name;?></td>
                                    <td style="text-align:center;"><?=$exams->mark;?></td>
                                    
                                    <td style="text-align:center;"><?php
                                        if($exams->status ==1){
                                            echo "Ochiq";
                                        }if ($exams->status == 0) {
                                            # code...
                                            echo "Yopiq";
                                        }
                                        ?>
                                    </td>
                                    <td style="width: 15%; text-align:center;">
                                        <?php if ($exams->status ==1){ ?>
                                            <a href="<?=\yii\helpers\Url::to(['../exam/yopish?id='.$exams->id], true)?>">
                                                <button class="btn btn-success">Yopish</button>
                                            </a>
                                        <?php } elseif ($exams->status == 0){ ?>
                                            <a href="<?=\yii\helpers\Url::to(['../exam/yopish?id='.$exams->id], true)?>">
                                                <button class="btn btn-danger">Ochish</button>
                                            </a>
                                        <?php }?>
                                    </td>
                                    <td style="width: 10%; text-align:center;">
                                        <a href="<?=\yii\helpers\Url::to(['../exam/update?id='.$exams->id])?>"><span class="glyphicon glyphicon-pencil"></span></a>
                                        <a href="<?=\yii\helpers\Url::to(['../exam/del?id='.$exams->id])?>"><span class="glyphicon glyphicon-trash"></span></a>
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