<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\TexMainBase */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tex-main-base-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php $dataCategory=ArrayHelper::map(\common\models\Building::find()->asArray()->all(), 'id', 'name');?>
    <?= $form->field($model, 'building_id')->dropDownList(
        $dataCategory,
        [
            'prompt' => 'Binoni tanlang',
            'onchange'=>'
        $.post( "lists?id='.'"+$(this).val(), function( data ) {
        $( "select#name" ).html( data );
        });
        '
        ]);

    $dataRoom=ArrayHelper::map(\common\models\Room::find()->asArray()->all(), 'id', 'name');
    echo $form->field($model, 'room_id')->dropDownList(
        $dataRoom,
        ['id'=>'name']
    ); ?>

    <?= $form->field($model, 'biriktirilgan')->textInput() ?>
    
    <?= $form->field($model, 'tartib_raqami')->textInput() ?>

    <?= $form->field($model, 'uzasbo_nomi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipi_id')->textInput() ?>

<!--    --><?//= $form->field($model, 'biriktirilgan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parametr')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'parametr_full')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'bino')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'tarkibiy_bolinma_id')->textInput() ?>

    <?= $form->field($model, 'tarkibiy_bolinma_id')
        ->dropDownList(
            \yii\helpers\ArrayHelper::map(
                \common\models\TarkibiyBolinma::find()
                    ->all(), 'id', 'name'),
            ['prompt' => '-Tarkibiy bo\'linma-', 'required' => 'required'])
        ->label(false)
    ?>
    <?= $form->field($model, 'inventar_ichki')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'yili')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'holati_id')->textInput() ?>

    <?= $form->field($model, 'yaroqliligi_id')->textInput() ?>

    <?= $form->field($model, 'inventar_b')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'partiya')->textInput() ?>

    <?= $form->field($model, 'dona_narx')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'partiya_narx')->textInput() ?>

    <?= $form->field($model, 'bino_qushimcha')->textInput() ?>

    <?= $form->field($model, 'how_come_id')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
