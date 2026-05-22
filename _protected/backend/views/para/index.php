<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ParaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Paras';
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
                                <h2 style="text-align:center"> Juftliklar</h2>
                            </h3>
                        </div>
                        <br>
                        <h1><a href="<?=\yii\helpers\Url::to(['../para/create'])?>"><button class="btn btn-success" style="width: 20%; float: right"> Juftlik yaratish</button></a></h1>
                        <table id="example" class="table table-striped table-bordered" >
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Fan</th>
                                <th>Boshlash vaqti</th>
                                <th>Tugash vaqti</th>
                                <th>Holati</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $i =1;  foreach ($para as $paras): ?>
                                <tr>
                                    <td><?=$i++?></td>
                                    <td><?=$paras->name.'-juftlik';?></td>
                                    <td><?=$paras->time_start;?></td>
                                    <td><?=$paras->time_end;?></td>
                                    <td><?php
                                        if ($paras->sort ==1){
                                            echo "Aktiv";
                                        }else{
                                            echo "Passiv";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="<?=\yii\helpers\Url::to(['../para/update?id='.$paras->id])?>"><span class="glyphicon glyphicon-pencil"></span></a>
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



