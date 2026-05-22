<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \dmstr\bootstrap\Tabs;
use yii\helpers\ArrayHelper;
use yii\helpers\StringHelper;

/**
* @var yii\web\View $this
* @var common\models\MaterialBase $model
* @var yii\widgets\ActiveForm $form
*/

?>

<div class="tarkibiy-bolinma-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php $dataCategory=ArrayHelper::map(\common\models\Building::find()->asArray()->all(), 'id', 'name');?>
    <?= $form->field($model, 'building_id')->dropDownList(
        $dataCategory,
        [
            'prompt' => 'Select',
            'onchange'=>'
             $.post( "lists?id='.'"+$(this).val(), function( data ) {
             $( "select#name" ).html( data );
              });'

        ]);?>

    <?php  $dataRoom = ArrayHelper::map(\common\models\Room::find()->asArray()->all(), 'id', 'name');

    echo $form->field($model, 'room_id')->dropDownList(
        $dataRoom,
        ['id'=>'name']
    );
    ?>
    
    <?= $form->field($model, 'inventar')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'count')->textInput()?>
    <?= $form->field($model, 'quantity_name')->textInput()?>



    <!-- attribute description -->
    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
    <!-- attribute inventor -->

    <?= $form->field($model, 'status')->dropDownList(\common\helpers\RoomHelper::getStatusList()) ?>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

