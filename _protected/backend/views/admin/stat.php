<?php
use http\Url;
?>
<style>
    td {
        vertical-align: middle !important
    }
</style>
<!--Accordion wrapper-->
<div class="accordion md-accordion accordion-blocks" id="accordionEx78" role="tablist"
     aria-multiselectable="true">

    <!-- Accordion card -->
    <div class="card">

        <!-- Card header -->
        <div class="card-header" role="tab" id="heading79">

            <!--Options-->
            <div class="dropdown float-left">
                <button class="btn btn-info btn-sm m-0 mr-3 p-2 " ><i class="fas fa-object-group" style="font-size: 20px;width: 28px;"></i>
                </button>
            </div>

            <!-- Heading -->
            <a data-toggle="collapse" data-parent="#accordionEx78" href="#collapse79" aria-expanded="true"
               aria-controls="collapse79">
                <h5 class="mt-1 mb-0">
                    <span>Guruh ballari</span>
                    <i class="fas fa-angle-down rotate-icon"></i>
                </h5>
            </a>

        </div>

        <!-- Card body -->
        <div id="collapse79" class="collapse show" role="tabpanel" aria-labelledby="heading79"
             data-parent="#accordionEx78">
            <div class="card-body">
                <div class="table-responsive mx-3">
                    <table class="table table-hover mb-0">
                        <thead>
                        <tr>
                            <th><label for="checkbox4" class="mr-2 label-table"></label></th>
                            <th class="th-lg"><a>Guruhlar</a></th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($statistika as $statistikas): ?>
                        <?php
                            $user =\common\models\User::find()->where(['=', 'user.id', Yii::$app->user->id])->one();
                            $group = \common\models\Group::find()->andWhere(['uni_id'=>$user->uni_id, 'id'=>$statistikas->group_id])->one();
                            $fan = \common\models\Fan::find()->andWhere(['uni_id'=>$user->uni_id, 'id'=>$statistikas->fan_id])->one();
                            ?>
                        <tr>
                            <th scope="row"><label for="checkbox5" class="label-table"></label></th>
                            <td><?=$group->name.'-Guruh';?></td>
                            <td><?=$fan->name;?></td>
                            <td><a href="<?=\yii\helpers\Url::to(['../admin/fan?id='.$statistikas->group_id])?>"><span class="glyphicon glyphicon-eye-open"></span></a></td>
                        </tr>
                        <?php endforeach;?>
                        </tbody>
                        <!--Table body-->
                    </table>
                    <!--Table-->
                </div>
                <!-- Table responsive wrapper -->

            </div>
        </div>
    </div>
    <!-- Accordion card -->

    <!-- Accordion card -->
    <div class="card">

        <!-- Card header -->
        <div class="card-header" role="tab" id="heading80">
            <!--Options-->
            <div class="dropdown float-left">
                <button class="btn btn-info btn-sm m-0 mr-3 p-2" ><i class="glyphicon glyphicon-screenshot" style="font-size: 20px;width: 28px;"></i>
                </button>
            </div>

            <!-- Heading -->
            <a data-toggle="collapse" data-parent="#accordionEx78" href="#collapse80" aria-expanded="true"
               aria-controls="collapse80">
                <h5 class="mt-1 mb-0">
                    <span>Guruh davomati</span>
                    <i class="fas fa-angle-down rotate-icon"></i>
                </h5>
            </a>
        </div>

        <!-- Card body -->
        <div id="collapse80" class="collapse" role="tabpanel" aria-labelledby="heading80"
             data-parent="#accordionEx78">
            <div class="card-body">

                <!-- Table responsive wrapper -->
                <div class="table-responsive mx-3">
                    <!--Table-->
                    <table class="table table-hover mb-0">

                        <!--Table head-->
                        <thead>
                        <tr>
                            <th><label for="checkbox4" class="mr-2 label-table"></label></th>
                            <th class="th-lg"><a>Guruhlar</a></th>
                            <th>Smester</th>
                            <th>Kurish</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $group =    \common\models\Group::find()->where(['uni_id'=>$user->uni_id])->all();
                        foreach ($group as $groups): ?>
                            <tr>
                                <th scope="row"><label for="checkbox5" class="label-table"></label></th>
                                <td><?=$groups->name.'-Guruh';?></td>
                                <td><?=$groups->smester.'-Smester';?></td>
                                <td><a href="<?=\yii\helpers\Url::to(['../admin/monitoring?id='.$groups->id.'&smester_id='.$groups->smester])?>"><span class="glyphicon glyphicon-eye-open"></span></a></td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                        <!--Table body-->
                    </table>
                    <!--Table-->
                </div>
                <!-- Table responsive wrapper -->

            </div>
        </div>
    </div>


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="course-teacher-view">
                        <div class="card card-info" style="padding: 40px; overflow-x: scroll;">
                            <div class="card-header" style="text-align: center;">
                                <h3 class="card-title1 " style="text-align: center;">
                                    <h2 style="text-align:center">Foydalanuvchilar soni</h2>
                                </h3>
                            </div>
                            <div class="container">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nomi</th>
                                        <th>Soni</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Adminlar</td>
                                        <td><?=$admin?> ta</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>O'qitivchilar</td>
                                        <td><?=$teacher?> ta</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Tinglovchilar</td>
                                        <td><?=$student?> ta</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Guruhlar</td>
                                        <td><?=$group1?> ta</td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



