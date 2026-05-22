<?php
use common\helpers\CssHelper;
use yii\helpers\Html;
use yii\grid\GridView;
//echo "<pre>";
//print_r($natija);exit();

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
$user = \common\models\User::find()->where(['id'=>Yii::$app->user->id])->one();
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
                                <h2 style="text-align:center">Fanlar buyicha Natijalar</h2>
                            </h3>
                        </div>
                        <br>
                        <a class="p-3" href="<?=\yii\helpers\Url::to(['../exam-permission/exam'])?>">
                                <button  class="btn btn-success" style="width: 30%; float: left">
                                    Orqaga
                                </button>
                            </a>
                        <table id="example" class="table table-striped table-bordered" >
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>O'qitivchilar</th>
                                <?php foreach($natija1 as $natij):
                                    $natija = \common\models\Fan::find()->where(['id'=>$natij->fan_id])->groupby('id')->one();
                                    ?>
                                <th><?=$natija->name; ?> <p style="font-size: 13px;font: -webkit-small-control;">Tekshirildi/Barchasi</p></th>
                                <?php endforeach;?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i =1; foreach ($natija2 as $natijaa): ?>
                            <?php
                                $natijas = \common\models\User::find()->where(['id'=>$natijaa->teacher_id])->one();
                            ?>
                                <tr>
                                    <td><?=$i++?></td>
                                    <td>
                                        <a href="<?=\yii\helpers\Url::to(['../teacher/view?id='.$natijas->id])?>"><?=$natijas->full_name;?></a>
                                    </td>
                                    <?php foreach($natija1 as $natij):
                                        $count   = \common\models\ExamCheck::find()
                                            ->where(['teacher_id'=>$natijaa->teacher_id, 'fan_id'=>$natij->fan_id])
                                            ->andWhere(['!=', 'mark', "0"])->count();
                                        $count1   = \common\models\ExamCheck::find()
                                            ->where(['teacher_id'=>$natijaa->teacher_id, 'fan_id'=>$natij->fan_id])
                                            ->count();
                                    ?>
                                    <td class="text-center"><?php if($count1 != 0 || $count != 0){echo $count .'/'. $count1;}?></td>
                                    <?php endforeach;?>
                                </tr>
                                    <?php endforeach; ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
