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
                                <h2 style="text-align:center"> O`qituvchilar hujjatlari </h2>
                            </h3>
                        </div>
                        <br>
                        <table id="example" class="table table-striped table-bordered" >
                            <thead>
                            <tr>
                                <th style="text-align:center;">#</th>
                                <th style="text-align:center;">F.I.O.</th>
                                <th>Shartnoma</th>
                                <th>Obyektivka</th>
                                <th>Passport</th>
                                <th>INN</th>
                                <th>INPS</th>
                                <th>Doplom</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php $i =1;  foreach ($students as $teacher): ?>
                                <? $doc = \common\models\Document::findOne(['user_id'=>$teacher->id]);?>
                            <?php if($doc): ?>

                            <tr>
                                    <td style="text-align:center;"><?=$i++?></td>
                                    <td><?=$teacher->full_name;?></td>
                                    <td style="text-align:center;">
                                        <? if ($doc->shartnoma) {?>
                                         <a href="<?= \yii\helpers\Url::to(['../../uploads/document/shartnoma/' . $doc->shartnoma], true) ?>">
                                            <i style="color: #0056b3;font-size:25px;" class="fa fa-download" aria-hidden="true">
                                            </i>
                                        </a>
                                        <?}?>
                                    </td>
                                    <td style="text-align:center;">
                                        <? if ($doc->ob) {?>

                                        <a href="<?= \yii\helpers\Url::to(['../../uploads/document/ob/' . $doc->ob], true) ?>">
                                            <i style="color: #0056b3;font-size:25px;" class="fa fa-download" aria-hidden="true">
                                            </i>
                                        </a>
                                        <?}?>
                                    </td>
                                    <td style="text-align:center;">
                                        <? if ($doc->pos) {?>

                                        <a href="<?= \yii\helpers\Url::to(['../../uploads/document/pos/' . $doc->pos], true) ?>">
                                            <i style="color: #0056b3;font-size:25px;" class="fa fa-download" aria-hidden="true">
                                            </i>
                                        </a>
                                        <?}?>
                                    </td>
                                    <td style="text-align:center;">
                                        <? if ($doc->inn) {?>

                                        <a href="<?= \yii\helpers\Url::to(['../../uploads/document/inn' . $doc->inn], true) ?>">
                                            <i style="color: #0056b3;font-size:25px;" class="fa fa-download" aria-hidden="true">
                                            </i>
                                        </a>
                                        <?}?>
                                    </td>
                                    <td style="text-align:center;">
                                        <? if ($doc->inps) {?>

                                        <a href="<?= \yii\helpers\Url::to(['../../uploads/document/inps/' . $doc->inps], true) ?>">
                                            <i style="color: #0056b3;font-size:25px;" class="fa fa-download" aria-hidden="true">
                                            </i>
                                        </a>
                                        <?}?>
                                    </td>
                                    <td style="text-align:center;"> 
                                        <? if ($doc->diplom) {?>

                                        <a href="<?= \yii\helpers\Url::to(['../../uploads/document/diplom/' . $doc->diplom], true) ?>">
                                            <i style="color: #0056b3;font-size:25px;" class="fa fa-download" aria-hidden="true">
                                            </i>
                                        </a>
                                        <?}?>
                                    </td>
                                    
                                </tr>
                            <?php  endif; ?>
                            <?php  endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>