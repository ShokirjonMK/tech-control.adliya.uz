<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = Yii::t('app', 'Login');
?>
<style type="text/css">
    body {
            background: hsl(207, 59%, 93%);
    }
    
</style>
<body>

    <div class="adliya-text">
        <div><p>Adliya Elektron Nazorat Markazi</p> </div>
    </div>

<div class="kirish">

    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <h1>Tizimga kirish</h1>
        <?php if ($model->scenario === 'lwe'): ?>
        <?= $form->field($model, 'email')->label('Почта') ?>
        <?php else: ?>

                <div class="input-text" id="login">
                    <p>Login</p>
        <?= $form->field($model, 'username', [
                'inputOptions' => [
                    'class' => 'login',
                    'placeholder' => "Login",
                ],
            ])->label(false);
         ?>
        <?php endif ?>
                
            </div>

            <div class="input-text" id="parol">
                <p>Parol</p>
                <?= $form->field($model, 'password', [
                    'inputOptions' => [
                        'class' => 'parol',
                        'placeholder' => 'Parol',
                    ],
                ])->passwordInput()->label(false) ?>
            </div>

            <div class="input-submit">
               <?= Html::submitButton(Yii::t('app', 'Kirish'), ['class' => 'input', 'name' => 'login-button','style' => '']) ?>
                <a href="#">Parolni unutdingizmi?</a>
            </div>

            <div class="text-content">
                <p>
                    Tizimga kirishni amalga oshirgandan so`ng chiqayotgan paytda albatta  
                    <span><i class="fas fa-sign-out-alt"></i>
                    Chiqish</span> tugmasini bosgan holda chiqing.
                </p>
            </div>
    <?php ActiveForm::end(); ?>

</div>
</body>