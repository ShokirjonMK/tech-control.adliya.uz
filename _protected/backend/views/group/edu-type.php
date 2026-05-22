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
                        <table id="example" class="table table-striped table-bordered" >
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Nomi</th>
                                <th class="text-center">Holati</th>
                                <th class="text-center"><span class="glyphicon glyphicon-cog"></span></th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $i =0;  foreach ($courses as $course): ?>
                            <?php $direction =\common\models\Direction::find()->where(['edu_type'=>$course->id])->one();?>
                                <tr>
                                    <td class="text-center"><?= ++$i?></td>
                                    <td><?= $course->name;?></td>
                                    <td class="text-center">
                                        <?php if($course->status == 1){
                                            echo "Aktiv";
                                        }else{
                                            echo "Passiv";
                                        }
                                        ?>
                                    </td>

                                    <td class="text-center">
                                        <?php if(!empty($direction->edu_type)){ ?>
                                        <a style="font-size: 35px;color: blue;" href="<?=\yii\helpers\Url::to(['../group/index?id='.$direction->id])?>"><span class="glyphicon glyphicon-eye-open"></span></a>
                                        <?php } else {echo '<i style="font-size: 35px;color: red;" class="fas fa-times-circle"></i>';} ?>
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
