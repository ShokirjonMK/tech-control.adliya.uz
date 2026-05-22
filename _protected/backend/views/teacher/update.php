<?php

use common\rbac\models\AuthItem;
use nenad\passwordStrength\PasswordInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
//$degree = \yii\helpers\arrayHelper::mapp(\common\models\Degree::find()->all(), 'id', 'name');
$id = Yii::$app->request->get('id');
$user_sayt = \common\models\User::find()
    ->where(['=', 'user.id', Yii::$app->user->id])
    ->one();
$uni_id = $user_sayt->uni_id;



$lang = \common\models\Lang::find()->all();
$fan = \common\models\Fan::find()->where(['=', 'fan.uni_id', $uni_id])->groupBy('name')->all();
$this->title = Yii::t('app', '');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
            <h3 class="card-title1 " style="text-align: center;"><?=$user->full_name?></h3>
        </div>
        <br>
        <?php $form = ActiveForm::begin(['id' => 'form-user']); ?>
        <div class="row">
            <div class="col-lg-6">
                <?= $form->field($user, 'username') ?>
                <?= $form->field($user, 'full_name') ?>
                <div class="col-lg-12">
                    <?= $form->field($user, 'birth_date')->textInput(['type' => 'date', 'value' => "2000-01-01"]) ?>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <?= $form->field($user, 'address')->label('Manzilni kiriting') ?>
                    </div>
                    <div class="col-lg-6">
                        <?= $form->field($user, 'degree_id')->dropDownList($degree)->label('Lavozim kiriting') ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-12" style="margin-top: -1px;">
                        <?php if ($user->scenario === 'create') : ?>
                            <?= $form->field($user, 'password')->widget(PasswordInput::class, []) ?>
                        <?php else : ?>
                            <?= $form->field($user, 'password')->widget(PasswordInput::class, [])
                                ->passwordInput(['placeholder' => Yii::t('app', 'New pwd ( if you want to change it )')])
                            ?>
                        <?php endif ?>

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
                                <?php $kafedra = \yii\helpers\ArrayHelper::map(\common\models\Kafedra::find()->where(['uni_id'=>$uni_id])->all(), 'id', 'name'); ?>
                                <?php $student = \common\models\Teacher::find()->andWhere(['user_id'=>$id])->one(); ?>
                                <?= $form->field($user, 'kafedra_id')->dropDownList($kafedra, ['options' => [$student->kafedra_id => ['selected' => true]]])->label('Kafedra') ?>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6" style="    margin-top: -8px;">
                                <?= $form->field($user, 'status')->dropDownList([1 => 'Aktiv', 0 => 'Passiv']) ?>
                            </div>
                            <div class="col-lg-6">
                                <?= $form->field($user, 'rasm')->fileInput([ 'style' => 'width:100%', 'class' => 'btn btn'])->label('Rasm') ?>
                            </div>
                        </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <?php echo $form->field($user, 'passport_number', [
                                        'inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control transparent']
                                        ])->textInput()->input('passport', ['placeholder' => "AA1234567"])->label("Pasport Seriyasi"); ?>
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
                : Yii::t('app', 'Saqlash'), ['class' => $user->isNewRecord
                ? 'btn btn-success' : 'btn btn-primary', 'style' => '    width: 100%;']) ?>
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
                                    <?php
                                    $teacher = \common\models\Teacher::find()->where(['user_id' => $id, 'fan_id' => $f->id, 'lang_id' => $l->id])->one();
                                    if (!empty($teacher)) { ?>
                                        <input checked style="width: 38px; height: 38px;" type="checkbox" class="option-input radio day18" value="<?= $l->id ?>" name="<?= $f->id ?>fan<?= $l->id ?>">
                                    <?php } else { ?>
                                        <input style="width: 38px; height: 38px;" type="checkbox" class="option-input radio day18" value="<?= $l->id ?>" name="<?= $f->id ?>fan<?= $l->id ?>">
                                    <?php } ?>
                                </label>
                            </td>
                        <?php endforeach ?>
                    </tr>
                <?php $i++;
                endforeach ?>
                </tfoot>
        </table>

        <!-- ./card -->
    </div>
    <!-- /.col -->
</div>



<?php ActiveForm::end(); ?>

<!--
</div>
