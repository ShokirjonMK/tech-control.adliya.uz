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
                                <h2 style="text-align:center">Barcha Imtihonlar</h2>
                            </h3>
                        </div>
                        <br>
                        <table id="example" class="table table-striped table-bordered" >
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nomi</th>
                                <th style="text-align: center;">Javoblar</th>
                                <th>Topshirivchilar soni</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i =1;  foreach ($exams as $exam):
                                $count = \common\models\ExamCheck::find()->where(['exam_name_id'=>$exam->id])->count();
                                ?>
                                <tr>
                                    <td><?=$i++?></td>
                                    <td><?=$exam->title;?></td>
                                    <td style="text-align: center;">
                                            <a href="<?= \yii\helpers\Url::to(['../exam-permission/javoblar?id=' . $exam->id])?>">Ko`rish</a>
                                    </td>
                                    <td class="text-center">
                                            <?php if($count != 0){ echo $count; } ?>
                                    </td>
                                    <td><a href="<?=\yii\helpers\Url::to(['../exam-permission/results?id='.$exam->id])?>"><span class="glyphicon glyphicon-eye-open"></span></a></td>
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
