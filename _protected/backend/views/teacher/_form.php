<?php
//use common\rbac\models\AuthItem;
//use nenad\passwordStrength\PasswordInput;
//use yii\helpers\Html;
//use yii\widgets\ActiveForm;
//
///* @var $this yii\web\View */
///* @var $user common\models\User */
///* @var $form yii\widgets\ActiveForm */
///* @var $role common\rbac\models\Role; */
//?>
<!---->
<!--<style>-->
<!--    input[type=checkbox] {-->
<!--        box-sizing: border-box;-->
<!--        padding: 0;-->
<!--        width: 50px;-->
<!--        height: 38px;-->
<!--    }-->
<!---->
<!--    .field-user-first {-->
<!--        margin-top: 25px;-->
<!--    }-->
<!---->
<!--    .weekDays-selector input {-->
<!--        display: none !important;-->
<!--    }-->
<!---->
<!--    .weekDays-selector input[type=checkbox]+label {-->
<!--        display: inline-block;-->
<!--        border-radius: 6px;-->
<!--        background: #dddddd;-->
<!--        height: 40px;-->
<!--        width: 30px;-->
<!--        margin-right: 3px;-->
<!--        line-height: 40px;-->
<!--        text-align: center;-->
<!--        cursor: pointer;-->
<!--    }-->
<!---->
<!--    .weekDays-selector input[type=checkbox]:checked+label {-->
<!--        background: #2AD705;-->
<!--        color: #ffffff;-->
<!--    }-->
<!--    td {-->
<!--        vertical-align: middle !important-->
<!--    }-->
<!--</style>-->
<!--<section class="content">-->
<!--    <div class="container-fluid">-->
<!--        <div class="row">-->
<!--            <div class="col-12">-->
<!--                <div class="course-teacher-view">-->
<!--                    <div class="card card-info" style="padding: 40px; overflow-x: scroll;">-->
<!--                        <div class="card-header" style="text-align: center;">-->
<!--                            <h3 class="card-title1 " style="text-align: center;">-->
<!--                                <h2 style="text-align:center"> Student yaratish </h2>-->
<!--                            </h3>-->
<!--                        </div>-->
<!--                        <br>-->
<!--                        <div class="user-form">-->
<!---->
<!--                            --><?php //$form = ActiveForm::begin(['id' => 'form-user']); ?>
<!---->
<!--                            --><?//= $form->field($user, 'username') ?>
<!---->
<!--                            <!--        -->--><?////= $form->field($user, 'email') ?>
<!---->
<!--                            --><?php //if ($user->scenario === 'create'): ?>
<!--                                --><?//= $form->field($user, 'password')->widget(PasswordInput::class, []) ?>
<!--                            --><?php //else: ?>
<!--                                --><?//= $form->field($user, 'password')->widget(PasswordInput::class, [])
//                                    ->passwordInput(['placeholder' => Yii::t('app', 'New pwd ( if you want to change it )')])
//                                ?>
<!--                            --><?php //endif ?>
<!---->
<!--                            <div class="row">-->
<!--                                <div class="col-lg-6">-->
<!---->
<!--                                    --><?//= $form->field($user, 'status')->dropDownList($user->statusList) ?>
<!---->
<!--                                    --><?php //foreach (AuthItem::getRoles() as $item_name): ?>
<!--                                        --><?php //$roles[$item_name->name] = $item_name->name ?>
<!--                                    --><?php //endforeach ?>
<!--                                    --><?//= $form->field($role, 'item_name')->dropDownList($roles) ?>
<!---->
<!--                                </div>-->
<!--                            </div>-->
<!---->
<!--                            <div class="form-group">-->
<!--                                --><?//= Html::submitButton($user->isNewRecord ? Yii::t('app', 'Create')
//                                    : Yii::t('app', 'Update'), ['class' => $user->isNewRecord
//                                    ? 'btn btn-success' : 'btn btn-primary']) ?>
<!---->
<!--                                --><?//= Html::a(Yii::t('app', 'Cancel'), ['user/index'], ['class' => 'btn btn-default']) ?>
<!--                            </div>-->
<!---->
<!--                            --><?php //ActiveForm::end(); ?>
<!---->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</section>-->
<!---->
