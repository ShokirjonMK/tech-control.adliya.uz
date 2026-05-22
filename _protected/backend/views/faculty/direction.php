<?php
use yii\helpers\Html;
use yii\grid\GridView;
$a = Yii::$app->request->get('id');
?>



<style>
    input[type=checkbox] {
        box-sizing: border-box;
        padding: 0;
        width: 50px;
        height: 38px;
    }

    .field-user-first {
        margin-top: 25px;
    }

    .weekDays-selector input {
        display: none !important;
    }

    .weekDays-selector input[type=checkbox]+label {
        display: inline-block;
        border-radius: 6px;
        background: #dddddd;
        height: 40px;
        width: 30px;
        margin-right: 3px;
        line-height: 40px;
        text-align: center;
        cursor: pointer;
    }

    .weekDays-selector input[type=checkbox]:checked+label {
        background: #2AD705;
        color: #ffffff;
    }
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
                                <h2 style="text-align:center"> Mutaxasisliklar </h2>
                            </h3>
                        </div>
                        <br>
                        <h1><a href="<?=\yii\helpers\Url::to(['../direction/create?id='.$a])?>"><button  class="btn btn-success" style="width: 20%; float: right"> Mutaxasislik yaratish</button></a></h1>
                        <table id="example" class="table table-striped table-bordered" >
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Mutaxasislik</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $i =1;  foreach ($direction as $directions): ?>
                                <?php  $unversitet = \common\models\University::find()->where(['id'=>$directions->uni_id])->one();?>
                                <?php  $faculty = \common\models\Faculty::find()->where(['id'=>$directions->faculty_id])->one();?>
                                <tr>
                                    <td><?=$i++?></td>
                                    <td> <?=$directions->name;?></td>
                                    <td><a href="<?=\yii\helpers\Url::to(['../faculty/group?id='.$directions->id.'&kurs_id=0'])?>">Krish <span class="glyphicon glyphicon-arrow-right"></span></a></td>
                                    <td>
                                      
                                        <a href="<?=\yii\helpers\Url::to(['../direction/update?id='.$directions->id.'&id1='.$a ])?>"><span class="glyphicon glyphicon-pencil"></span></a>
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
