<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use nenad\passwordStrength\PasswordInput;
//$user = \common\models\User::find()->where(['=', 'user.id', Yii::$app->user->id])->one();
//$teacher = \common\models\Teacher::find()->where(['uni_id', $user->uni_id])->all();
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
                        <br>
                        <div class="user-view">
                        <div class="container">
                            <div style="text-align:center; padding:0;"> <h2><?= $user->full_name  ?> </h2></div>
                            <hr>
                                <div class="row my-2">

                                    <div class="col-lg-8 order-lg-2">
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item">
                                                <a href="" data-target="#profile" data-toggle="tab" class="nav-link active">Shaxsiy ma'lumotlar</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="" data-toggle="modal" data-target="#myModal" class="nav-link">Parolni o'zgartirish</a>
                                            </li>
                                            <li class="nav-item"  style="margin-top: 9px;">
<!--                                                <a  href="" data-toggle="modal" data-target="#exampleModal">-->
<!--                                                    Rasimni o'zgartirish-->
<!--                                                </a>-->
                                            </li>
                                        </ul>
                                        <div class="tab-content py-4">
                                            <div class="tab-pane active" id="profile">
                                             <div class="row">
                                                <div class="col-md-12">
                                                    <table class="table table-sm table-hover table-striped">
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <strong>Tug'ulgan sana:</strong>
                                                                </td>
                                                                <td>
                                                                <? echo $user->birth_date; ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <strong>Tug'ulgan joy:</strong>
                                                                </td>
                                                                <td>
                                                                <? echo $user->address; ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <strong>Passport ma'lumoti:</strong>
                                                                </td>
                                                                <td>
                                                                <? echo $user->passport_number; ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <strong>Kafedra nomi</strong>
                                                                </td>
                                                                <td>
                                                                <? echo $kafedra->name; ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <strong>Foydalanuvchi nomi</strong>
                                                                </td>
                                                                <td>
                                                                <? echo $user->username; ?>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="modal fade" id="myModal" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content" id="edit">
                                                        <div class="modal-header">
                                                          <h4 class="modal-title">Parolni yangilash</h4>
                                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <?php $form = ActiveForm::begin(['id' => 'form-user']); ?>
                                                                <?= $form->field($user, 'password')->widget(PasswordInput::class, [])->label('Yangi parol') ?>
                                                            <div class="form-group" >
                                                            <?= Html::submitButton('O\'zgartir', ['class' => 'btn btn-primary', 'style'=>'width:100%; margin-top:32px']) ?>
                                                            </div>
                                                            <?php ActiveForm::end(); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel"><?= $user->full_name;?></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">

                                                            <form action="/backend/teacherprofile/index" method="post" enctype="multipart/form-data">
                                                                <input type="hidden" name="id" value="<?= $user->id ?>">
                                                                <input name="qweqw" type="file"  class="custom-file-input" id="exampleInputFile">
                                                                <label class="custom-file-label" for="exampleInputFile">Rasm tanlang</label>
<!--                                                                --><?//= $form->field($teacher, 'rasm')->fileInput()->label('Yangi parol') ?>
                                                                <button style="" type="submit" class="btn">saqlash</button>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 order-lg-1 text-center">
                                        <?php if (!empty($user->image)){?>
                                            <img src="<?=\yii\helpers\Url::to(["../../uploads/user_images/".$user->image], true)?>" class="mx-auto img-fluid img-circle d-block" style="width:80%;" alt="avatar">
                                        <?php }else{?>
                                            <img src="<?=\yii\helpers\Url::to(["../../uploads/user_images/default.png"], true)?>" class="mx-auto img-fluid img-circle d-block" style="width:80%;" alt="avatar">
                                        <?php }?>
                                        <br />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




