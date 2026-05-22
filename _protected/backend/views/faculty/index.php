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
                                <h2 style="text-align:center">Fakultetlar</h2>
                            </h3>
                        </div>
                        <br>
                        <h1><a href="<?=\yii\helpers\Url::to(['../faculty/create'])?>"><button style="float: right;" class="btn btn-success mt-3"> Fakultet yaratish</button></a></h1>
                        <table id="example" class="table table-striped table-bordered" >
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Fakultetlar</th>
                                <th>Holati</th>
                                <th>Kirish</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $i =1;  foreach ($faculty as $facultys): ?>
                                <?php  $unversitet = \common\models\University::find()->where(['id'=>$facultys->uni_id])->one();?>

                                <tr>
                                    <td><?=$i++?></td>
                                    <td><?=$facultys->name;?></td>

                                    <td>
                                        <?php if($facultys->status == 1){
                                            echo "Aktiv";
                                        }else{
                                            echo "Passiv";
                                        }
                                        ?>
                                    </td>
                                    <td><a href="<?=\yii\helpers\Url::to(['../faculty/direction?id='.$facultys->id])?>">Kirish <span class="glyphicon glyphicon-arrow-right"></span></a></td>
                                    <td>
                                        <a href="<?=\yii\helpers\Url::to(['../faculty/update?id='.$facultys->id])?>"><span class="glyphicon glyphicon-pencil"></span></a>
<!--                                        <a href="--><?//=\yii\helpers\Url::to(['../faculty/view?id='.$facultys->id])?><!--"><span class="glyphicon glyphicon-eye-open"></span></a>-->
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
