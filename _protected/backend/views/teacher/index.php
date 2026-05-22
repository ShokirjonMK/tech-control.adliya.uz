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
                                <h2 style="text-align:center"> O`qituvchilar</h2>
                            </h3>
                        </div>
                        <br>
                        <div style="padding-bottom: 5px;"> <span><a href="<?=\yii\helpers\Url::to(['../teacher/create'])?>"><button style="float: right; margin-left: 5px" class="btn btn-success">O`qituvchi qo`shish</button></a></span>
                         <span><a href="<?=\yii\helpers\Url::to(['../teacher/export'])?>"><button style="float: right; " class="btn btn-primary">Export qilish</button></a></span>
                        </div>
                        <table id="example" class="table table-striped table-bordered" >
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Ismi familiyasi</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $i =1;  foreach ($user as $users): ?>
                                <?php  $uqitivchi = \common\models\Teacher::find()->where(['user_id'=>$users->id])->one();?>
                                <tr>
                                    <td><?=$i++?></td>
                                    <td><?= $users->full_name;?></td>
                                    <td>
                                        <a href="<?=\yii\helpers\Url::to(['../teacher/view?id='.$users->id])?>"><span class="glyphicon glyphicon-eye-open"></span></a>
                                        <a href="<?=\yii\helpers\Url::to(['../teacher/update?id='.$users->id])?>"><span class="glyphicon glyphicon-pencil"></span></a>
<!--                                        <a href="--><?//=\yii\helpers\Url::to(['../teacher/status?id='.$users->id])?><!--"><span class="glyphicon glyphicon-trash"></span></a>-->
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



