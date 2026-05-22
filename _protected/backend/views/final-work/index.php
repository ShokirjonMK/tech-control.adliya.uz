<?php
use yii\helpers\Html;
use yii\grid\GridView;
$this->title = 'Exam Students';
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
                                <h2 style="text-align:center"> Yakuniy nazorat </h2>
                            </h3>
                        </div>
                        <br>
                        <h1><a href="<?=\yii\helpers\Url::to(['../final-work/create'])?>">
                        <button class="btn btn-success" style="width: 16.6%;float: right"> Yakuniy  yaratish</button>
                            </a></h1>

                        <table id="example" class="table table-striped table-bordered" >
                            <thead>
                            <tr>
                                <th style="text-align: center;">#</th>
                                <th style="text-align: center;">Guruh </th>
                                <th style="text-align: center;">Fan </th>
                                <th style="text-align: center;">Semester</th>
                                <th style="text-align: center;">Tekshirish vaqti</th>
                                <th style="text-align: center;">Holati</th>
                                <th style="text-align: center;">Yuklash</th>
                                <th style="text-align: center;"><i class="nav-icon fas fa-cog"></i></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i =1;  foreach ($final_work as $f_w): ?>
                                <?php
                                $user=\common\models\User::find()->where(['=', 'user.id', Yii::$app->user->id])->one();
                                $group = \common\models\Group::find()->where(['uni_id'=>$user->uni_id])->andWhere(['id'=>$f_w->group_id])->one();
                                $fan = \common\models\Fan::find()->where(['uni_id'=>$user->uni_id])->andWhere(['id'=>$f_w->fan_id])->one();
                                ?>
                                <tr>
                                    <td style="text-align: center;"><?=$i++?></td>
                                    <td style="text-align: center;"><?=$group->name;?></td>
                                    <td><?=$fan->name;?></td>
                                    <td><?=$group->smester.' - semester';?></td>
                                    <td><?=$f_w->started_date;?> dan 
                                    <?=$f_w->finished_date;?> gacha</td>
                                    <td style="text-align: center;"><?php
                                        if($f_w->status ==1){
                                            echo "Ochiq";
                                        }else{
                                            echo "Yopiq";
                                        }
                                        ?>
                                    </td>
                                    <td style="width:20px; text-align: center;">
                                        <a href="<?=\yii\helpers\Url::to(['../final-work/finalpdf?id='.$f_w->id])?>">
                                            <i style="color: #0056b3;font-size:35px;" class="fa fa-download ml-2 mr-2" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                    <td style="text-align: center;">
                                    	<a style="margin-left: 15px !important;"  onclick="return confirm('Yakuniyni o`chirasizmi?')"  href="<?= \yii\helpers\Url::to(['../final-work/del?id=' . $f_w->id]) ?>"><span class="glyphicon glyphicon-trash"></span></a>
                                    </td>

                                </tr>
                            <?php  endforeach; ?>
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>
</section>
