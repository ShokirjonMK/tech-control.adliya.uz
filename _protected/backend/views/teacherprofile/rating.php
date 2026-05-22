<?php
use yii\helpers\Html;
use yii\grid\GridView;
$this->title = 'Exam Students';
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
                                <h2 style="text-align:center"> Baholash </h2>
                            </h3>
                        </div>
                        <br>
                        <table id="example" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Guruh nomi</th>
                                        <th>Fan</th>
                                        <th>Semester</th>
                                        <th>Kirish</th>
                                    </tr>
                                </thead>
                                <tbody>
                                       <?php $i = 1;
                                         foreach ($groups as $group): ?>
                                        <?php
                                        $user=\common\models\User::find()->where(['=', 'user.id', Yii::$app->user->id])->one();
                                        $groupe = \common\models\Group::find()->where(['uni_id'=>$user->uni_id])->andWhere(['id'=>$group->group_id])->one();
                                        $fan = \common\models\Fan::find()->where(['uni_id'=>$user->uni_id])->andWhere(['id'=>$group->fan_id])->one();
                                        if ($groupe->smester == $group->smester) :
                                        ?>

                                    <tr>
                                        <td><?=$i++;?></td>
                                        <td><?=$groupe->name;?></td>
                                        <td><?=$fan->name?></td>
                                        <td valign="center"><?=$group->smester?></td>

                                        <td valign="center">
                                        <a href="<?=\yii\helpers\Url::to(['exam-student/index?group_id='.$group->group_id.'&'.'fan_id='.$group->fan_id], true)?>"><span class="glyphicon glyphicon-eye-open"></span></a>
                                        </td>
                                    </tr>
                                    <? endif; endforeach;?>
                                 </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
</section>
