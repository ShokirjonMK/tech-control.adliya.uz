<?php

use yii\helpers\Html;
// use yii\widgets\ActiveForm;
// use wbraganca\dynamicform\DynamicFormWidget;
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
                                <h2 style="text-align:center"> O'zlashtirish </h2>
                            </h3>
                        </div>
                        
                        <br>
   <div class="row">
   <a href="" class="btn btn-primary m-3" style="height:38px"> Smester : </a>
    <ul>
    <? for($k=1; $k<=$smester; $k++) {?>
		<li style="display:inline"><a style="height:38px" class="btn btn-primary mt-3 <? if($k == $sm) echo 'active'?>" href="<?=\yii\helpers\Url::to(['../studentprofile/rating?sm='.$k])?>"><?=$k?></a></li>
    <? }?>
	</ul>
    </div>
                        <table id="example4" class="table table-bordered table-striped" style="text-align:center;">
                            <thead>
                                <tr style="width: 8%;   ">
                                    <th>#</th>
                                    <th style="text-align: center;">Fanlar</th>
                                    <?php
                                        foreach ($exams as $exam) : ?>
                                    <th style="text-align: center;"> <?=$exam->name ?> </th>       
                                        <?php endforeach; ?>
                                    <th style="text-align: center;">Umumiy</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=0; foreach($timetable as $tt) : ?>
                                <tr>
                                   
                                        <?php  foreach ($fanlar as $fan) :
                                            if($tt->fan_id == $fan->id) :?>
                                    <td><?php echo ++$i; ?> </td>
                                    <td><?php echo $fan->name; ?></td>
                                        <?php $a=0; $t=0; foreach($exams as $exam) : ?>
                                            <?php foreach($examstd as $estd):
                                              if(($estd->fan_id == $fan->id)) :
                                              if ($exam->id == $estd->exam_id) {
                                               ++$t; $a+=$estd->mark; ?>
                                    <td><?php echo $estd->mark; ?></td>
                                              <?php } else ?>
                                           
                                            <? endif; 
                                            endforeach; endforeach; ?>
                                            <?php for($t; $t<$ecount; $t++) { ?>
                                            <td></td>
                                            <?php } ?>
                                            <td> <?php if($a>0) {echo $a;} ?></td>
                                        <?php endif; endforeach; ?>
                                </tr>
                                        <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</section>