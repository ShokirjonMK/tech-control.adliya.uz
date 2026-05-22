<?php
use common\helpers\CssHelper;
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
   
    td {
        vertical-align: middle !important;
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
                                <h2 style="text-align:center">Tinglovchilar</h2>
                            </h3>
                        </div>
                        <br>
                        <div style="padding-bottom: 5px;"> <span><a href="<?=\yii\helpers\Url::to(['../student/create1'])?>"><button  class="btn btn-success" style="width: 20%; float: right;">Tinglovchi qo`shish</button></a></span>

                        <span><a href="<?=\yii\helpers\Url::to(['../student/export'])?>"><button  class="btn btn-primary" style="width: 20%; float: right">Export <span><i class="fa fa-file-pdf" aria-hidden="true"></span></i></button></a></span>
                        </div>
                        <table id="example" class="table table-striped table-bordered" >
                            <thead>
                            <tr>
                                <th>#</th>
                                <th style="text-align: center;">F.I.O.</th>
                                <th style="text-align: center;">Guruhi</th>
                                <th style="text-align: center;">Yo`nalishi</th>
                                <th style="text-align: center;">Foydalanuvchi</th>
                                <th style="text-align: center;">Holati</th>
                                <th style="text-align: center;"><span class="glyphicon glyphicon-cog"></span></th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $i =1;  foreach ($student as $students): ?>
                                <?php  $student1 = \common\models\Student::find()->where(['user_id'=>$students->id])->one();?>
                                <?php  $group = \common\models\Group::find()->where(['id'=>$student1->group_id])->one();
                                $direction = \common\models\Direction::find()->where(['id'=>$group->direction_id])->one();
                                 if ($group) :?>
                                <tr>
                                    <td style="text-align: center;"><?=$i++?></td>
                             
                                    <td><?=$students->full_name;?></td>


                                    <td style="text-align: center;"><?=$group->name;?></td>

                                
                                    <td><?= $direction->name?>
                                    </td>
                                    <td style="text-align: center;"><?=$students->username;?></td>
                                    <td><?php if($student1->status == 1){
                                            echo "Aktiv";
                                        }else{
                                            echo "Passiv";
                                        } ?>
                                    </td>

                                    <td style="text-align: center;">
                                        <a href="<?=\yii\helpers\Url::to(['../studentprofile/index?id='.$students->id])?>"><span class="glyphicon glyphicon-eye-open"></span></a>
                                        <a href="<?=\yii\helpers\Url::to(['../student/update1?id='.$students->id.'&id1='.$student1->id])?>"><span class="glyphicon glyphicon-pencil"></span></a>
                                    </td>
                                </tr>
                                    <?php endif;  endforeach; ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



