<?php
use common\helpers\CssHelper;
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
$university = \common\models\University::findOne($user->uni_id);
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

    .weekDays-selector input {
        display: none !important;
    }

    .weekDays-selector input[type=checkbox]+label {
        display: inline-block;
        border-radius: 6px;
        background: #dddddd;
        height: 40px;
        width: 30px;
        margin-right: 3px;
        line-height: 40px;
        text-align: center;
        cursor: pointer;
    }

    .weekDays-selector input[type=checkbox]:checked+label {
        background: #2AD705;
        color: #ffffff;
    }
    td {
        vertical-align: middle !important
    }
</style>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="course-teacher-view">
                    <div class="card card-info" style="padding: 40px; overflow-x: scroll;">
                        <div class="card-header" style="text-align: center;">
                            <h3 class="card-title1 " style="text-align: center;">
                                <h2 style="text-align:center"><?=$user->full_name?></h2>
                            </h3>
                        </div>
                        <br>
                        <div class="row">
                        <div class="col-md-6">
                            <a href="<?=\yii\helpers\Url::to(['../admin'])?>">
                                <button  class="btn btn-success" style="width: 30%; float: left">
                                    Orqaga
                                </button>
                            </a>
                        </div>
                            <div class="col-md-6">
                       
                            <a href="<?=\yii\helpers\Url::to(['../admin/update?id='.$user->id])?>">
                                <button  class="btn btn-primary" style="width: 30%; float: right">
                                    Tahrirlash
                                </button>
                            </a>
                        </div>
                        </div>
                       <br>
                        <table class="table table-striped table-bordered" >
                             <tbody>
                            <tr>
                                <td>University</td>
                                <td><?=$university->name; ?></td>
                            </tr>
                            <tr>
                                <td>Login</td>
                                <td><?=$user->username ?></td>
                            </tr>
                            <tr>
                                <td>Ism familiya</td>
                                <td><?=$user->full_name ?></td>
                            </tr>
                            <tr>
                                <td>Rol</td>
                                <td><?=$user->role_id ?></td>
                            </tr>
                            <tr>
                                <td>Parol</td>
                                <td>
                                <span id="item_v">t6148177</span>
                    <button class="btn btn-default" id="passwordshower"  data-idec='<?=$user->id?>'>&nbsp;<i class="fa fa-eye"></i>Parolni korish</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Tug`ulgan sana</td>
                                <td><?=Yii::$app->formatter->asDate($user->birth_date) ?></td>
                            </tr>
                            <tr>
                                <td>Passport</td>
                                <td><?=$user->passport_number ?></td>
                            </tr>
                            <tr>
                                <td>Manzil</td>
                                <td><?=$user->address ?></td>
                            </tr>
                            <tr>
                                <td>Yaratilgan vaqt</td>
                                <td><?= Yii::$app->formatter->asDate($user->created_at) ?></td>
                            </tr>
                            

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>