<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ExamPermission */

$this->title = 'Update Exam Permission: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Exam Permissions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<form action="/backend/uz/exam-permission/edit" method="post">

    <div class="row">
        <div class="col-12">
            <!-- Default box -->
            <div class="course-view">

                <div class="card card-info" style="padding: 10px;">

                    <div class="card-header" style="text-align: center;">
                        <h3 class="card-title1 " style="text-align: center;">
                        </h3>
                        <h2 style="text-align:center"> Imtixonlar </h2>

                    </div>
                    <br>
                    <div class="row">
                        <div class="col-xs-12 col-md-3">
                            <div class="form-group">
                                <label class="control-label" for="group-name">Imtihon nomi</label>
                                <input type="text" id="coursedirector-full_name" class="form-control"  readonly value="<?= $exam_name->title ?>" maxlength="50" aria-required="true" aria-invalid="true">
                                <input type="hidden" id="coursedirector-full_name" class="form-control"  name="id" value="<?= $exam_permission->id ?>" maxlength="50" aria-required="true" aria-invalid="true">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <div class="form-group field-group-smester required has-success">
                                <label class="control-label" for="group-smester">Oraliqni nomi</label>
                                <input type="text" id="coursedirector-full_name" class="form-control"  readonly value="<?= $exam->name ?>" maxlength="50" aria-required="true" aria-invalid="true">
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <div class="form-group">
                                <label class="control-label" for="group-name">Boshlanish vaqti</label>
                                <input type="date" id="coursedirector-full_name" class="form-control"   name="start_date" value="<?=mb_substr($exam_permission->start_date, 0, 10) ?>" maxlength="50" aria-required="true" aria-invalid="true">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <div class="form-group">
                                <label class="control-label" for="group-name">Tugash vaqti</label>
                                <input type="date" id="coursedirector-full_name" class="form-control" value="<?=mb_substr($exam_permission->finish_date, 0, 10) ?>" name="finish_date" maxlength="50" aria-required="true" aria-invalid="true">
                            </div>
                        </div>
                        <? $nowUser =  \common\models\User::find()->where(['=', 'user.id', Yii::$app->user->id])->one();
                                    if (! ($nowUser->uni_id == 4)) {?>
                        <div class="col-xs-12 col-md-3">
                            <div class="form-group">
                                <label class="control-label" for="group-name">Fakultetni nomi</label>
                                <input type="text" id="coursedirector-full_name" class="form-control"  readonly value="<?= $faculty->name ?>" maxlength="50" aria-required="true" aria-invalid="true">
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <?}?>
                        
                        <div class="col-xs-12 col-md-<? $nowUser =  \common\models\User::find()->where(['=', 'user.id', Yii::$app->user->id])->one();
                                    if ( ($nowUser->uni_id == 4)) { echo "6";} else {echo "3";}?>">
                            <div class="form-group">
                                <label class="control-label" for="group-name">Yo`nalishni nomi</label>
                                <input type="text" id="coursedirector-full_name" class="form-control"  readonly value="<?= $direction->name ?>" maxlength="50" aria-required="true" aria-invalid="true">
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-1">
                            <div class="form-group">
                                <label class="control-label" for="group-name">Kursi</label>
                                <input type="text" id="coursedirector-full_name" class="form-control"  readonly value="<?= $course->name ?>-kurs" maxlength="50" aria-required="true" aria-invalid="true">
                                <div class="help-block"></div>
                            </div>
                        
                        </div>
                        <div class="col-xs-12 col-md-2">
                            <div class="form-group">
                                <label class="control-label" for="group-name">Guruh</label>
                                <input type="text" id="coursedirector-full_name" class="form-control"  readonly value="<?= $group->name ?>" maxlength="50" aria-required="true" aria-invalid="true">
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <div class="form-group">
                                <label class="control-label" for="group-name">Fan nomi</label>
                                <input type="text" id="coursedirector-full_name" class="form-control"  readonly value="<?= $fan->name ?>" maxlength="50" aria-required="true" aria-invalid="true">
                                <div class="help-block"></div>
                            </div>
                            <button style="float: right;width:100px;" type="submit" style="margin-left: 5%;" class="btn btn-primary">Saqlash</button>

                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>
</form>