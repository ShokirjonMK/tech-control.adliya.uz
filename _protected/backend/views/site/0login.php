<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = Yii::t('app', 'Login');
?>
<style>
    body{
        background-color: #EBEBEB;
    }
    .h1{
        border-bottom: 1px solid #BDBDBD;
        color: #3B3B3B;
        font-family: "Times New Roman",Helvetica, arial;
        font-size: 28px;
        font-style: normal;
        font-weight: normal;
        margin-bottom: 14px;
        padding-bottom: 16px;
        line-height: 30px;
        text-align: center;
    }
    .form1{
        background-color: #F5F5F5;
        border: 1px solid #E4E4E4;
        float: left;
        padding: 16px;
        width: 370px;
    }
    .h3{
        border-bottom: 1px solid #CFCFCF;
        color: #3B3B3B;
        font-size: 19px;
        font-weight: normal;
        margin-bottom: 13px;
        padding-bottom: 12px;
        border-bottom: none;
    }
    .p1{
        display: block;
        color: #747474;
        font-size: 15px;
        margin-bottom: -10px;!important;
    }
    .text{
        display: block;
        width: 100%;
        height: calc(2.25rem + 2px);
        padding: .375rem .75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: .25rem;
        box-shadow: inset 0 0 0 transparent;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }
    .column6-intro{
        font-size: 15px;
        line-height: 20px;
        color: #484848;
        text-align: justify;
        /* text-indent: 15px; */
        font-family: "Times New Roman",Verdana;
    }
    .h4{
        text-align: center;
        font-family: "Times New Roman",Verdana,"Times New Roman",Arial;
        font-weight: bolder;
        font-size: 17px;
        color: #3399FF;
        border-bottom: 1px solid #ccc;
    }
    .p2{
        font-family: "Times New Roman",Verdana,"Times New Roman",Arial;
        text-align: justify;
        font-size: 15px;
        padding-top: 3px
    }
</style>
<body>
<div class="login-box div1" style="width: 415px;!important;">
  <div class="card" style="background-color: rgba(255, 255, 255, 0.5) !important;background-color: #FFF;
        border: 1px solid #BDBDBD;">
    <div class="card-body login-card-body" style="background-color: rgba(255, 255, 255, 0.5) !important;">
        <h1 class="h1">Elektron universitet</h1>
        <div class="row" style="margin-top: 35px">
            <div class="col-sm-12">
                <div class="form1">
                    <div class="reg-header">
                        <h3 class="h3">Tizimga kirish<span class="switch"></span></h3>
                    </div>
                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                    <?php if ($model->scenario === 'lwe'): ?>
                        <?= $form->field($model, 'email')->label('Почта') ?>
                    <?php else: ?>
                        <p  class="p1">Foydalanuvchi nomi</p>
                        <?= $form->field($model, 'username')->label('') ?>
                    <?php endif ?>
                        <p class="p1">Parol</p>
                        <?= $form->field($model, 'password')->passwordInput()->label('') ?>
                        <?= Html::submitButton(Yii::t('app', 'Kirish'), ['class' => 'btn btn-success submit', 'name' => 'login-button','style' => 'width: 100%;']) ?>
                    <?php ActiveForm::end(); ?>
                </div>
                <div class="column6">
                    <div class="Tour">
                        <div class="evernote-tour">
                            <div class="tour-container">
                                <div class="tour3">
                                    <h4  class="h4">Yodda saqlang</h4><p  class="p2">Tizimga kirishni amalga oshirgandan so`ng chiqayotgan paytda albatta Chiqish( <i class="fas fa-sign-out-alt"></i> ) tugmasini bosgan holda chiqing.</div>
                                <div class="shadow"></div>
                            </div>
                        </div>
                        <div class="shadow aftertour"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</body>