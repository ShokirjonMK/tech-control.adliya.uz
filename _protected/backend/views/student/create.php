<?php

use common\rbac\models\AuthItem;
use nenad\passwordStrength\PasswordInput;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$user1 = \common\models\User::find()->where(['=', 'user.id', Yii::$app->user->id])->one();
$id = Yii::$app->request->get('id');
//$group = \common\models\Group::find()->where(['id' => $id])->andWhere(['uni_id' => $user1->uni_id])->one();
$direction = \common\models\Direction::find()->where(['uni_id' => $user1->uni_id])->one();

//$direction = \common\models\Direction::find()->where(['id' => $group->direction_id])->one();
$faculty = \common\models\Faculty::find()->where(['id' => $direction->faculty_id])->one();

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
                    <h3 class="card-title1 " style="text-align: center;">Tinglovchi yaratish</h3>
                </div>
                <br>
                <?php $form = ActiveForm::begin(['id' => 'form-user']); ?>
                <div class="row">
                    <div class="col-lg-6">
                        <?php if ($user->scenario === 'create') {
                            $create_username = \common\models\User::find()
                            ->where(['role_id'=>'Student'])
                            ->count();
                            $ID = $create_username + 1 + 10000;
                            $username = "S" . $ID;
                        }
                        ?>
                        <h5><?= $form->field($user, 'username')
                                ->textInput(['value' => $username, 'readonly' => true])->label('Username') ?></h5>
                        <?= $form->field($user, 'full_name') ?>
                        <div class="row">
                            <div class="col-sm-4">
                                <?php $fac = \yii\helpers\ArrayHelper::map(\common\models\Faculty::find()->where(['id' => $faculty->id])->all(), 'id', 'name') ?>
                                <?= $form->field($user, 'fakultet')->dropDownList(
                                    $fac,
                                    [
                                        'options' => [$faculty->id => ['selected' => true]],
                                        'class' => 'browser-default head custom-select',
                                        'prompt'=>'-Fakultet tanlang-',
                                        'onchange' => '
                                            $.get( "' . Url::toRoute('student/list') . '", { id: $(this).val() } ).done(function( data ) {
                                                    $( "#' . Html::getInputId($user, 'yunalish') . '" ).html( data );
                                                }
                                            );'
                                    ]
                                )->label('Fakultet')
                                ?>
                            </div>
                            <div class="col-sm-4">
                                <?php $dir = \yii\helpers\ArrayHelper::map(\common\models\Direction::find()->where(['id' => $direction->id])->all(), 'id', 'name') ?>
                                <?= $form->field($user, 'yunalish')->dropDownList(
                                    $dir,
                                    [
                                        'options' => [$direction->id => ['selected' => true]],
                                        'class' => 'browser-default head custom-select',
                                        'prompt' => '-Yunalish tanlang-',

                                        'onchange' => '
                                            $.get( "' . Url::toRoute('student/lists') . '", { id: $(this).val() } )
                                                .done(function( data ) {
                                                    $( "#' . Html::getInputId($user, 'group_id') . '" ).html( data );
                                                }
                                            );'
                                    ]
                                )->label('Mutaxasislik')
                                ?>
                            </div>
                            <div class="col-sm-4">
                                <?php $group1 = \yii\helpers\ArrayHelper::map(\common\models\Group::find()->where(['id' => $id])->all(), 'id', 'name') ?>

                                <?= $form->field($user, 'group_id')->dropDownList($group1, ['options' => [$faculty->id => ['selected' => true]]])->label('Guruh nomi') ?>



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
                                <?php if ($user->scenario === 'create') : ?>
                                    <?= $form->field($user, 'password')->widget(PasswordInput::class, []) ?>
                                <?php else : ?>
                                <?php endif ?>
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
                                        <?= $form->field($user, 'rasm')->fileInput(['style' => 'width:100%', 'class' => 'btn btn'])->label('Rasm') ?>
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
            <!-- ./card -->
        </div>
        <!-- /.col -->
    </div>
</div>
