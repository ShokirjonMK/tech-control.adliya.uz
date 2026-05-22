<?php

use yii\helpers\Html;
?>
<style>
    
</style>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="course-teacher-view">
                    <div class="card card-info" style="padding: 40px; overflow-x: scroll;">
                        <div class="card-header" style="text-align: center;">
                            <h3 class="card-title1 " style="text-align: center;">
                                <h2 style="text-align:center"> Mening Guruhlarim </h2>
                            </h3>
                        </div>
                        <br>

                        <table id="example" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Guruh nomi</th>
                                        <th>Yo`nalishi</th>
                                        <th>Balolash</th>
                                        <th>Yo`qlama</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                        foreach($time_table as $tt) :
                                        $gr = \common\models\Group::findOne(['id'=>$tt->group_id]);
                                        $dir = \common\models\Direction::findOne(['id'=>$gr->direction_id]);
                                            ?>

                                    <tr>
                                        <td><?=$i++;?></td>
                                        <td><?=$gr->name;?></td>
                                        <td><?=$dir->name;?></td>
                                        <td><a style="" class="btn btn-primary btn-sm m-2" href="<?=\yii\helpers\Url::to(['teacherprofile/rating'], true)?>">
                                        Kirish
                                        </a></td>
                                        <td><a style="" class="btn btn-primary btn-sm m-2" href="<?=\yii\helpers\Url::to(['teacherprofile/checking'], true)?>">
                                                Kirish
                                        </a></td>
                                    </tr>
                                    <? endforeach;?>
                                 </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
</section>