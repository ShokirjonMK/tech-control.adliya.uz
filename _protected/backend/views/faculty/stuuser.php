<?php
use yii\helpers\Html;
use yii\grid\GridView;
$group = Yii::$app->request->get('group_id');
?>
<!--<h1><a href="--><?//=\yii\helpers\Url::to(['../student/create?id='.$group])?><!--"><button class="btn btn-success" style="width: 20%"> Student qo`shish</button></a></h1>-->




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
                                <h2 style="text-align:center"> Mutaxasislik qushish </h2>
                            </h3>
                        </div>
                        <br>
                        <table id="example" class="table table-striped table-bordered" >
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Rasmi </th>
                                <th>Fuul_name </th>
                                <th>Group</th>
                                <th>Katalog</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $i =1;  foreach ($stuuser as $students): ?>
                                <?php $users = \common\models\User::find()->Where(['id'=>$students->user_id])->one(); ?>
                                <?php $group = \common\models\Group::find()->Where(['id'=>$students->group_id])->one(); ?>
                                <tr>
                                    <td><?=$i++?></td>
                                    <td><?=$users->image;?></td>
                                    <td><?=$users->full_name;?></td>
                                    <td><?=$group->name;?></td>
                                    <td><?php
                                        if($students->finance_type ==1){
                                            echo "Grant";
                                        }else{
                                            echo "Kantrak";
                                        }
                                        ?>
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
