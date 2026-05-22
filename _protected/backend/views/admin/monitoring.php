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
                                <h2 style="text-align:center">Tinglovchilar </h2>
                            </h3>
                        </div>
                        <br>
                        <table id="example" class="table table-striped table-bordered" >
                            <thead>
                            <tr>
                                <th style="text-align: center;">#</th>
                                <th>F.I.O</th>
                                <th style="text-align: center;">Qoldirilgan dars kunlari soni</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $i =1;  foreach ($monitoring as $monitorings): ?>
                            <?php
                                $user = $user=\common\models\User::find()->where(['=', 'user.id', Yii::$app->user->id])->one();
                                $query = (new \yii\db\Query())->from('monitoring')
                                    ->leftJoin('group', 'group.id=monitoring.group_id')
                                    ->where(['monitoring.uni_id'=>$user->uni_id, 'monitoring.student_id'=>$monitorings->id, 'group.smester'=>$smester_id]);
                                $sum = $query->count('student_id');

                                ?>
                                <tr>
                                    <td style="text-align: center;"><?=$i++?></td>
                                    <td><?=$monitorings->full_name;?></td>
                                    <td style="text-align: center;"><?php echo $sum;;?></td>
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
