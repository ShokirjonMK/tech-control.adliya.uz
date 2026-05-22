<?php
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;
use common\models\Permission;
$premm = new Permission();
$user = \common\models\User::find()->where(['id'=>Yii::$app->user->id])->one();
$fackulty = yii\helpers\ArrayHelper::map(\common\models\Faculty::find()->where(['uni_id'=>$user->uni_id])->all(), 'id', 'name');
$exams =\yii\helpers\ArrayHelper::map(common\models\Exam::find()->where(['uni_id'=>$user->uni_id])->all(), 'id', 'name');
?>

<style>
    input[type=checkbox] {
        box-sizing: border-box;
        padding: 0;
        width: 50px;
        height: 38px;
    }

    .field-user-first {
        margin-top: 25px;
    }

    .weekDays-selector input {
        display: none !important;
    }

    .weekDays-selector input[type=checkbox]+label {
        display: inline-block;
        border-radius: 6px;
        background: #dddddd;
        height: 40px;
        width: 30px;
        margin-right: 3px;
        line-height: 40px;
        text-align: center;
        cursor: pointer;
    }

    .weekDays-selector input[type=checkbox]:checked+label {
        background: #2AD705;
        color: #ffffff;
    }
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
                                <h2 style="text-align:center"> Fanga ruxsat berish </h2>
                            </h3>
                        </div>
                        <br>
                        <button style="    width: 164px; margin-left: 83.5%;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            Ruxsat berish
                        </button>
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document" style="max-width: 900px!important;">
                                <div class="modal-content">
                                    <?php $form = ActiveForm::begin(['action' =>['permission']]); ?>
                                    <div class="modal-header" >
                                        <h5 class="modal-title" id="exampleModalLabel">Ruxsat berish</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <?= $form->field($premm, 'faculty')->dropDownList($fackulty,['prompt'=>'-Fakultet tanlang-','onchange'=>'$.get( "'.Url::toRoute('permission/list').'", { id: $(this).val() } ).done(function( data ) {
                                        $( "#'.Html::getInputId($premm, 'group_id').'").html( data );});'])->label('Fakultet')?>
                                        <?= $form->field($premm, 'group_id')->dropDownList(['prompt'=>'-Grux Tanlang-'],[ 'onchange'=>'$.get( "'.Url::toRoute('permission/lists').'", { id: $(this).val() } ).done(function( data ) {
                                        $( "#'.Html::getInputId($premm, 'fan_id').'" ).html( data );});'])->label('Guruh') ?>
                                        <?= $form->field($premm, 'fan_id')->dropDownList(['prompt'=>'-Fan Tanlang-'])->label('Fan') ?>
                                        <?= $form->field($premm, 'exam_id')->dropDownList($exams,['prompt'=>'-Imtihon Tanlang-'])->label('Imtihon') ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Yopish</button>
                                        <button class="btn btn-success">Saqlash</button>
                                    </div>
                                    <?php ActiveForm::end(); ?>
                                </div>
                            </div>
                        </div>
                        <table id="example" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Guruh Nomi</th>
                                <th>Fan</th>
                                <th>Oraliq</th>
                                <th>Holati</th>
                                <th>Ruxsat</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $i =1;  foreach ($permission as $permissions): ?>
                                <?php
                                $exam = \common\models\Exam::find()->where(['id'=>$permissions->exam_id])->one();
                                $fan = \common\models\Fan::find()->where(['id'=>$permissions->fan_id])->one();
                                $group = \common\models\Group::find()->where(['id'=>$permissions->group_id])->one();
                                ?>
                                <tr>
                                    <?php $form = ActiveForm::begin(['action' =>['permissionup','g'=>$permissions->group_id, 'f'=>$permissions->fan_id, 'e'=>$permissions->exam_id]]); ?>
                                    <td><?=$i++?></td>
                                    <td><?=$group->name;?></td>
                                    <td><?=$fan->name;?></td>
                                    <td><?=$exam->name;?></td>
                                    <td><?php if($permissions->status==1){echo 'ochiq';}elseif ($permissions->status == 0){echo "yopiq";};?></td>
                                    <td>
                                        <?php if($permissions->status==1){?> <button class="btn btn-danger">Yopish</button><?php }elseif ($permissions->status == 0){};?>

                                    </td>
                                    <td><a href="<?=\yii\helpers\Url::to(['../permission/delete?id='.$permissions->id])?>"><span class="glyphicon glyphicon-trash"></span></a></td>
                                    <?php ActiveForm::end(); ?>
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

