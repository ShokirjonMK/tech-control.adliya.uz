<?php
use common\helpers\CssHelper;
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
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
                                <h2 style="text-align:center">Guruh fanlari</h2>
                            </h3>
                        </div>
                        <table class="table table-hover mb-0">
                            <thead>
                            <tr>
                                <th><label for="checkbox4" class="mr-2 label-table"></label></th>
                                <th class="th-lg"><a>Fanlar<i class="fas fa-sort ml-1"></i></a></th>
                                <th class="th-lg"><a>Semester<i class="fas fa-sort ml-1"></i></a></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($fan as $statistikas):?>
                                <?php
                                $user =\common\models\User::find()->where(['=', 'user.id', Yii::$app->user->id])->one();
                                $group = \common\models\Group::find()->andWhere(['id'=>$statistikas->group_id])->one();
                                $fan = \common\models\Fan::find()->andWhere(['uni_id'=>$user->uni_id, 'id'=>$statistikas->fan_id])->one();
                                ?>
                                <tr>
                                    <th scope="row"><label for="checkbox5" class="label-table"></label></th>
                                    <td><?=$fan->name;?></td>
                                    <td><?=$group->smester.'-Semester';?></td>
                                    <td><a href="<?=\yii\helpers\Url::to(['../admin/mark?id='.$statistikas->group_id.'&exam_id='.$group->smester.'&fan_id='.$statistikas->fan_id])?>"><span class="glyphicon glyphicon-eye-open"></span></a></td>
                                </tr>
                            <?php endforeach;?>
                            </tbody>
                            <!--Table body-->
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
