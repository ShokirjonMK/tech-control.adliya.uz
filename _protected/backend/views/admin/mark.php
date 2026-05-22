<?php
use common\helpers\CssHelper;
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = Yii::t('app', 'Users');
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
                                <h2 style="text-align:center">Tinglovchilar Ballari</h2>
                            </h3>
                        </div>
                        <br/>
                        <table id="example" class="table table-striped table-bordered" >
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>F.I.O</th>
                                <th>Ballar</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $i =1;  foreach ($statistika as $monitorings): ?>
                                <?php  $monitoring = \common\models\ExamStudent::find()->andWhere(['fan_id'=>$fan_id,'smester'=>$exam_id, 'student_id'=>$monitorings->id,'group_id'=>$id, 'uni_id'=>$monitorings->uni_id])->orderBy('mark')->sum('mark');?>
                                <tr>
                                    <td><?=$i++?></td>
                                    <td><?=$monitorings->full_name;?></td>
                                    <td><?php if($monitoring != null){echo $monitoring.' Ball';}else{echo 0;}?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
