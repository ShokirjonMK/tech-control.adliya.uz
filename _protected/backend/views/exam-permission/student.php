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
                                <h2 style="text-align:center">Barcha Adminlar</h2>
                            </h3>
                        </div>
                        <br>
                        <h1>
                            <a href="<?=\yii\helpers\Url::to(['../admin/create'])?>">
                                <button  class="btn btn-success" style="width: 20%; float: right">
                                    Adminlar yaratish
                                </button>
                            </a>
                         </h1>
                        <table id="example" class="table table-striped table-bordered" >
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Ism Familiya</th>
                                <th>Guruh </th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $i =1;  foreach ($student as $students):
                                $user = \common\models\User::find()->where(['id'=>$students->student_id])->one();
                                $student1 = \common\models\Student::find()->where(['user_id'=>$students->student_id])->one();
                                $group = \common\models\Group::find()->where(['id'=>$student1->group_id])->one();
                                ?>

                                <tr>
                                    <td><?=$i++?></td>
                                    <td><?=$user->full_name;?></td>
                                    <td><?=$group->name.'-guruh';?></td>
                                    <td><?=$usr->role_id;?></td>

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
