<?php

use yii\helpers\Html;
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
                                <h2 style="text-align:center"> Yo`qlama </h2>
                            </h3>
                        </div>
                        <br>

                        <table id="example" class="table table-striped table-bordered" >
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Guruh nomi</th>
                                <th>Fan</th>
                                <th>Semester</th>
                                <th><span class="glyphicon glyphicon-cog"></span></th>
                            </tr>
                            </thead>
                            <tbody>

                                <?php $i =1;  foreach ($timetable as $tt):?>
                                <?php foreach ($groups as $gr):?>
                                <?php foreach ($fanlar as $fan):?>
                                    <? if(($tt->fan_id == $fan->id) && ($tt->group_id == $gr->id)):?>
                                <tr>
                                    <td><?=$i++?></td>
                                    <td><?= $gr->name?></td>
                                    <td><?=$fan->name?></td>
                                    <td><?=$gr->smester?></td>
                                    
                                    <td>
                                        <a href="<?= \yii\helpers\Url::to(["/monitoring/check?time_table_id=".$tt->id], true) ?>"><span class="glyphicon glyphicon-eye-open"></span>
                                    </td>
                                </tr>

                                <? endif;?>
                                <?endforeach; ?>
                                <?endforeach; ?>
                                <?endforeach; ?>


                        
                    </div>
                </div>
            </div>
        </div>
</section>