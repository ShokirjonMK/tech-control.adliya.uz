<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use nenad\passwordStrength\PasswordInput;
use yii\bootstrap\Modal;


/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
    td {
        vertical-align: middle !important
    }
</style>
<h1><a href=<?=yii\helpers\Url::to(['teacher/index'])?>><button style="margin-left: 6px;" class="btn btn-success">Bosh sahifa</button></a></h1>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="course-teacher-view">
                    <div class="card card-info" style="padding: 40px; overflow-x: scroll;">

                        <br>

                        <div class="user-view">

                            <div class="container">
                                <div style="text-align:center;">
                                    <h2 style="margin-left: -150px"><?php
                                        $user = \common\models\User::find()->select('full_name')->where(['id'=>$teacher_id])->groupBy(['id'])->one();
                                        $user1 = \common\models\User::find()->where(['id'=>$teacher_id])->one();
                                        echo $user->full_name;
                                        ?>
                                    </h2>
                                </div>
                                <hr>
                                <div class="row my-2">

                                    <div class="col-lg-8 order-lg-2">
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item">
                                                <a href="" data-target="#profile" data-toggle="tab" class="nav-link active">Shaxsiy ma'lumotlar</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content py-4">
                                            <div class="tab-pane active" id="profile">
                                                <div class="row">

                                                    <div class="col-md-12">

                                                        <table class="table table-sm table-hover table-striped">
                                                            <tbody>
                                                            <tr>
                                                                <td>
                                                                    <strong>Kafedra:</strong>
                                                                </td>
                                                                <td>
                                                                        <p> <?php $teacher = \common\models\Teacher::find()
                                                                                ->select('kafedra_id')
                                                                                ->where(['user_id'=>$teacher_id])
                                                                                ->groupBy(['kafedra_id'])->one();
                                                                            $kafedra = \common\models\Kafedra::find()
                                                                                ->where(['id'=>$teacher->kafedra_id])->one();
                                                                            echo $kafedra->name;
                                                                            ?>
                                                                      </p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <strong>Login</strong>
                                                                </td>
                                                                <td>
                                                                    <p><?=$user1->username?></p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <strong>Tel:</strong>
                                                                </td>
                                                                <td>
                                                                    <p><?=$user1->number?></p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>

                                                                </td>
                                                                <td>
                                                                    <div class="row">
                                                                        <div class="col-sm-6"><strong>Fan</strong></div>
                                                                        <div class="col-sm-6"><strong>Tili</strong></div>
                                                                        <?php $fan = \common\models\Teacher::find()
                                                                        ->where(['user_id'=>$teacher_id])->all();
                                                                        foreach ($fan as $f):?>
                                                                        <?php
                                                                        $fan = \common\models\Fan::find()->where(['id'=>$f->fan_id])->one();
                                                                        $lang = \common\models\Lang::find()->where(['id'=>$f->lang_id])->one();
                                                                        ?>
                                                                        <div class="col-sm-6"><?=$fan->name;?></div>
                                                                        <div class="col-sm-6"><?=$lang->name;?></div>
                                                                        <?php endforeach; ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <!--/row-->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 order-lg-1 text-center">
                                        <?php  if (!empty($user1->image)){?>
                                            <img src="<?=\yii\helpers\Url::to(["../../uploads/".$user1->image], true)?>" class="mx-auto img-fluid img-circle d-block" style="width:80%;" alt="avatar">
                                        <?php }else{?>
                                            <img src="<?=\yii\helpers\Url::to(["../../uploads/user_images/default.png"], true)?>" class="mx-auto img-fluid img-circle d-block" style="width:80%;" alt="avatar">
                                        <?php }?>
                                        <br />
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

