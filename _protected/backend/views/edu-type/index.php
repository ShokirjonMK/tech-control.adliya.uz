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
                                <h2 style="text-align:center"> Ta'lim turi</h2>
                            </h3>
                        </div>
                        <br>
                        <h1><a href="<?=\yii\helpers\Url::to(['../edu-type/create'])?>"><button style="float: right;" class="btn btn-success"> Ta'lim turi qo`shish</button></a></h1>
                        <table id="example" class="table table-striped table-bordered" >
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nomi</th>
                                <th>Holati</th>
                                <th><span class="glyphicon glyphicon-cog"></span></th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $i =0;  foreach ($courses as $course): ?>
                                <tr>
                                    <td><?= ++$i?></td>
                                    <td><?= $course->name;?></td>
                                    <td>
                                        <?php if($course->status == 1){
                                            echo "Aktiv";
                                        }else{
                                            echo "Passiv";
                                        }
                                        ?>
                                    </td>

                                    <td>
                                        <a href="<?=\yii\helpers\Url::to(['../edu-type/update?id='.$course->id])?>"><span class="glyphicon glyphicon-edit"></span></a>
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
