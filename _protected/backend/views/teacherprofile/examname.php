<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Exams';
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
                                <h2 style="text-align:center"> <?= $exam_name->title ?> </h2>
                            </h3>
                        </div>
                        <br>
                   <a class="p-3" href="<?=\yii\helpers\Url::to(['../teacherprofile/exam'])?>">
                                <button  class="btn btn-success" style="width: 30%; float: left">
                                    Orqaga
                                </button>
                            </a>
                          
                        <table id="example" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fan</th>
                                    <th>Soni</th>
                                    <th>Tekshirish</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($exam_check as $ech) :
                                    foreach ($fanlar as $fan) :
                                if ($ech->fan_id == $fan->id) :?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $fan->name; ?></td>
                                        <td>
                                            <?php $u =  \common\models\User::findOne(['=', 'user.id', Yii::$app->user->id]);
                                             $count = \common\models\ExamCheck::find()
                                             ->where(['teacher_id'=>$u->id])
                                             ->andWhere(['status'=>1])
                                             ->andWhere(['exam_name_id'=>$exam_name])
                                             ->andWhere(['fan_id'=>$fan->id])
                                             ->count();
                                            echo $count;?>
                                        </td>
                                        <td >
                                            <a href="<?= \yii\helpers\Url::to(['../teacherprofile/examsub?id='.$fan->id.'&id1='.$ech->exam_name_id])?>">Kirish</a>
                                        </td>
                                    </tr>
                                <?php endif; endforeach; endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
