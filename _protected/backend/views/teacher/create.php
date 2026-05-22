<?php

use common\rbac\models\AuthItem;
use nenad\passwordStrength\PasswordInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $user common\models\User */
/* @var $role common\rbac\models\Role */

$this->title = Yii::t('app', '');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$user1 = \common\models\User::find()->where(['id' => Yii::$app->user->id])->one();
$kafedra = \yii\helpers\ArrayHelper::map(\common\models\Kafedra::find()->where(['uni_id' => $user1->uni_id])->all(), 'id', 'name');

$create_username = \common\models\User::find()
    ->where(['role_id'=>'Teacher'])
    ->count();
$ID = $create_username + 1 + 10000;
$username = "T" .$user1->uni_id. $ID;
$degree = \yii\helpers\arrayHelper::map(\common\models\Degree::find()->all(), 'id', 'name');
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
</style>


<div class="user-create">
    <div class="card card-info" style="padding: 40px;">
        <div class="card-header" style="text-align: center;">
            <h3 class="card-title1 " style="text-align: center;">O'qituvchi qo`shish</h3>
        </div>
        <br>
        <?php $form = ActiveForm::begin(['id' => 'form-teacher']); ?>
        <div class="row">
            <div class="col-lg-6">
                <?= $form->field($user, 'username')->textInput(['value' => $username, 'readonly' => true])->label('Login') ?>
                <?= $form->field($user, 'full_name') ?>
                <div class="row">
                    <div class="col-lg-6">
                        <?= $form->field($user, 'birth_date')->textInput(['type' => 'date', 'value' => "2000-01-01"]) ?>
                    </div>
                    <div class="col-lg-16">
                        <?= $form->field($user, 'gender')
                            ->dropDownList(
                                [
                                    '1' => 'Erkak',
                                    '0' => 'Ayol'
                                ], ['style'=>'width: 244px']
                            ) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <?= $form->field($user, 'kafedra_id')->dropDownList($kafedra)->label('Kafedra') ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-12" style="margin-top: -1px;">
                            <?= $form->field($user, 'password')->widget(PasswordInput::classname(), []) ?>

                        <?php foreach (AuthItem::getRoles() as $item_name) : ?>
                            <?php $roles[$item_name->name] = $item_name->name ?>
                        <?php endforeach ?>
                        <div class="row">

                            <div class="col-lg-6" style="    margin-top: -8px;">
                                <?= $form->field($user, 'status')->dropDownList([1 => 'Aktiv', 0 => 'Passiv']) ?>

                            </div>
                            <div class="col-lg-6">
                                <?= $form->field($user, 'rasm')->fileInput(['style' => 'width:100%; margin-top: -14px;', 'class' => 'btn btn'])->label('Rasm') ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6" style=" margin-top: -8px; display: none">
                                <?= $form->field($role, 'item_name')->dropDownList($roles) ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <?= $form->field($user, 'address')->label('Manzilni kiriting') ?>
                            </div>
                            <div class="col-lg-6">
                                <?= $form->field($user, 'degree_id')->dropDownList($degree)->label('Ilmiy daraja') ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <?= $form->field($user, 'passport_number')->widget(\yii\widgets\MaskedInput::className(), [
                                    'mask' => 'A{1,2}9{1,7}'
                                ]) ?>
                            </div>
                            <div class="col-lg-6">
                                <?= $form->field($user, 'number')->widget(\yii\widgets\MaskedInput::className(), [
                                    'mask' => '(+99999)-999-99-99',
                                ]) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <button class="btn btn-primary" style="width: 100%;">Saqlash</button>
        </div>
        <table id="example6" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th># <i style="float: right;" class="fa fa-sort" aria-hidden="true"></i></th>
                    <th>Fanlar nomi<i style="float: right;" class="fa fa-sort" aria-hidden="true"></i></th>
                    <?php foreach ($lang as $l) : ?>
                        <th style="text-align: center;"><?= $l->name ?></th>
                    <?php endforeach ?>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1;
                foreach ($fan as $f) : ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= $f->name ?></td>
                        <?php foreach ($lang as $l) : ?>
                            <td>
                                <label>
                                    <input style="width: 38px; height: 38px;" type="checkbox" class="option-input radio day18" value="<?= $l->id ?>" name="<?= $f->id ?>fan<?= $l->id ?>">
                                </label>
                            </td>
                        <?php endforeach ?>
                    </tr>
                <?php $i++;
                endforeach ?>
                </tfoot>
        </table>
        <div class="form-group">
            <button class="btn btn-primary" style="width: 100%;">Saqlash</button>
        </div>
        <!-- ./card -->
    </div>
    <!-- /.col -->
</div>
<?php ActiveForm::end(); ?>
