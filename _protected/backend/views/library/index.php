<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

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
                                <h2 style="text-align:center">Kutubxona</h2>
                            </h3>
                        </div>
                        <br>
                      
                        <table id="example" class="table table-striped table-bordered" >
                            <thead>
                            <tr>
                                <th style="text-align: center;">#</th>
                                <th style="text-align: center;">Fan nomi</th>
                                <th style="text-align: center;">Kirish</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $i =0;  foreach ($fan as $f): ?>
                            <?php $f = \common\models\Fan::findOne(['id'=>$f->id]); ?>
                                <tr>
                                    <td  style="text-align: center;"><?= ++$i?></td>
                                    <td><?= $f->name ?></td>
                                    <td style="text-align: center;">
                                        <a href="<?=\yii\helpers\Url::to(['../library/fan?id='.$f->id])?>"><span class="glyphicon glyphicon-eye-open"></span></a>
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