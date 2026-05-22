<?php

use common\rbac\models\AuthItem;
use nenad\passwordStrength\PasswordInput;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$user1 = \common\models\User::find()->where(['=', 'user.id', Yii::$app->user->id])->one();
$id = Yii::$app->request->get('id1');
$this->title = Yii::t('app', 'Update User') . ': ' . $user->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $user->username, 'url' => ['view', 'id' => $user->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<style>
    input[type=checkbox] {
        box-sizing: border-box !important;
        padding: 0 !important;
        width: 50px !important;
        height: 38px !important;
        display: block !important;
    }
</style>
<div class="user-create">
    <div class="row">
        <div class="col-md-1">
        </div>
        <div class="col-md-12">
            <div class="row">
            </div>
            <div class="card card-info" style="padding: 40px;">
                <div class="card-header" style="text-align: center;">
                    <h3 class="card-title1 " style="text-align: center;">Tahrirlash</h3>
                </div>
                <br>
                <?php $form = ActiveForm::begin(['id' => 'form-user']); ?>
                <div class="row">
                    <div class="col-lg-6">
                        <?= $form->field($user, 'username') ?>
                        <?= $form->field($user, 'full_name') ?>
                        <div class="row">
                            <div class="col-sm-4">
                                <?php  ?>
                                <?php $student = \common\models\Student::find()->where(['id' => $id])->one(); ?>
                                <?php $group = \common\models\Group::find()->where(['id' => $student->group_id, 'uni_id'=>$user1->uni_id])->one(); ?>
                                <?php $direction = \common\models\Direction::find()->where(['id' => $group->direction_id, 'uni_id'=>$user1->uni_id])->one(); ?>
                                <?php $faculty = \common\models\Faculty::find()->where(['id' => $direction->faculty_id, 'uni_id'=>$user1->uni_id])->one(); ?>
                                <?php $faculty1 = \yii\helpers\ArrayHelper::map(\common\models\Faculty::find()->where(['uni_id'=>$user1->uni_id])->all(), 'id', 'name') ?>
                                <?= $form->field($user, 'fakultet')->dropDownList($faculty1,
                                    ['options' => [$direction->faculty_id => ['selected' => true]],
                                        'prompt'=>'-Fakultet tanlang-',
                                        'onchange' => '
                                            $.get( "' . Url::toRoute('student/list') . '", { id: $(this).val() } )
                                                .done(function( data ) {
                                                    $( "#' . Html::getInputId($user, 'yunalish') . '" ).html( data );
                                                }
                                            );'
                                        ])->label('Fakultet') ?>
                            </div>
                            <div class="col-sm-4">
                                <?php $direction1 =   \yii\helpers\ArrayHelper::map(\common\models\Direction::find()->where(['faculty_id' => $faculty->id])->all(), 'id', 'name'); ?>
                                <?= $form->field($user, 'yunalish')->dropDownList($direction1,
                                    ['options' => [$group->direction_id => ['selected' => true]],
                                        'prompt'=>'-Yunalish tanlang-',
                                        'onchange' => '
                                            $.get( "' . Url::toRoute('student/lists') . '", { id: $(this).val() } )
                                                .done(function( data ) {
                                                    $( "#' . Html::getInputId($user, 'group_id') . '" ).html( data );
                                                }
                                            );'
                                    ])->label('Yunalish') ?>
                            </div>
                            <div class="col-sm-4">
                                <?php $group1 =   \yii\helpers\ArrayHelper::map(\common\models\Group::find()->where(['direction_id' => $direction->id])->all(), 'id', 'name'); ?>
                                <?= $form->field($user, 'group_id')->dropDownList($group1,
                                    ['options' => [$group->id => ['selected' => true]],
                                    'prompt'=>'-Guruh tanlang-',
                                    ]) ?>
                            </div>
                        </div>

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
                            <div class="col-lg-12" style="margin-top: -3px;">
                                <?= $form->field($user, 'password')->widget(PasswordInput::class, []) ?>
                                <?php foreach (AuthItem::getRoles() as $item_name) : ?>
                                    <?php $roles[$item_name->name] = $item_name->name ?>
                                <?php endforeach ?>
                                <div class="row" style="display: none;">
                                    <div class="col-lg-12">
                                        <?php foreach (AuthItem::getRoles() as $item_name) : ?>
                                            <?php if ($item_name->name == "Student") : ?>
                                                <?php $roles[$item_name->name] = $item_name->name ?>
                                            <?php endif ?>
                                        <?php endforeach ?>
                                        <div class="row " style="display: none;margin-top: -1px;">
                                            <div class="col-lg-12">
                                                <?= $form->field($role, 'item_name')->dropDownList($roles) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <?= $form->field($user, 'gender')
                                            ->dropDownList(
                                                [
                                                    '1' => 'Erkak',
                                                    '0' => 'Ayol'
                                                ]
                                            ) ?>
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
                                <div class="row">
                                    <div class="col-sm-6">
                                        <?= $form->field($user, 'finance_type')->dropDownList([1 => 'Grant', 0 => 'Shartnoma'])->label('Moliya turi') ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <?= $form->field($user, 'status')->dropDownList([1 => 'Aktiv', 0 => 'Passiv']) ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <?= $form->field($user, 'rasm')->fileInput([ 'style' => 'width:100%', 'class' => 'btn '])->label('Rasm') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <?= Html::submitButton($user->isNewRecord ? Yii::t('app', 'Saqlash')
                        : Yii::t('app', 'Saqlash'), ['class' => $user->isNewRecord
                        ? 'btn btn-success' : 'btn btn-primary', 'style' => '    width: 100%;']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>