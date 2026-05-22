<?php
use common\helpers\CssHelper;
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
    
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
                            <a href="<?=\yii\helpers\Url::to(['../user'])?>">
                                <button  class="btn btn-success" style="width: 30%; float: left">
                                    Orqaga
                                </button>
                            </a>
                        </div>
                            <div class="col-md-6">
                       
                            <a href="<?=\yii\helpers\Url::to(['../user/update?id='.$user->id])?>">
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
                                <td><?=$user->birth_date ?></td>
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
                                <td><?= Yii::$app->formatter->asDate($user->created_at); ?></td>
                            </tr>
                            

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>