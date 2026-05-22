<?php
use common\rbac\models\AuthItem;
use nenad\passwordStrength\PasswordInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $user common\models\User */
/* @var $role common\rbac\models\Role */
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$university = \yii\helpers\ArrayHelper::map(common\models\University::find()->all(), 'id', 'name');
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
            <h3 class="card-title1 " style="text-align: center;">Admin yaratish</h3>
        </div>
        <br>
        <?php $form = ActiveForm::begin(['id' => 'form-user']); ?>
            <div class="row">
                <div class="col-lg-6">
                    <?= $form->field($user, 'username') ?>
                    <?= $form->field($user, 'full_name') ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <?= $form->field($user, 'birth_date')->textInput(['type' => 'date', 'value' => "2000-01-01"]) ?>
                        </div>
                        <div class="col-lg-12">
                            <?= $form->field($user, 'address')->label('Manzilni kiriting') ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-lg-12" style="margin-top: -1px;">
                            <?php if ($user->scenario === 'create') : ?>
                                <?= $form->field($user, 'password')->widget(PasswordInput::classname(), []) ?>
                            <?php endif ?>
                            <?php $itemNames = AuthItem::find()->all(); ?>
                            <?php foreach ($itemNames as $item_name) : ?>
                                <?php $roles[$item_name->name] = $item_name->name ?>
                            <?php endforeach ?>
                            <div class="row">
                                <div class="col-lg-12" style="display: none;    margin-top: -8px;">
                                    <?= $form->field($role, 'item_name')->dropDownList($roles) ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12" style="    margin-top: -8px;">
                                    <?= $form->field($user, 'university')->dropDownList($university) ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <?= $form->field($user, 'gender')
                                        ->dropDownList(
                                            [
                                                '1' => 'Erkak',
                                                '0' => 'Ayol'
                                            ]
                                        ) ?>
                                </div>
                                    <div class="col-lg-6">
                                        <?= $form->field($user, 'rasm')->fileInput(['value' => $model->logo_link, 'style' => 'width:100%', 'class' => 'btn btn'])->label('Rasm') ?>
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
                <?= Html::submitButton($user->isNewRecord ? Yii::t('app', 'Saqlash')
                    : Yii::t('app', 'Update'), ['class' => $user->isNewRecord
                    ? 'btn btn-success' : 'btn btn-primary', 'style' => '    width: 100%;']) ?>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
