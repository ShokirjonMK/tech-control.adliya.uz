<?php

use yii\helpers\Html;
use yii\grid\GridView;

$id1 = Yii::$app->request->get('id');
$this->title = 'Exam Permissions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exam-permission-index">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="course-teacher-view">
                        <div class="card card-info" style="padding: 40px; overflow-x: scroll;">
                            <div class="card-header" style="text-align: center;">
                                <h3 class="card-title1 " style="text-align: center;">
                                    <h2 style="text-align:center"><?=$direction->name?></h2>
                                </h3>
                            </div>
                            <br>
                            <div>

                                <a href="<?= \yii\helpers\Url::to(['/exam-permission/javoblar?id='.$examName->id]) ?>" style="width: 25%;float: left; margin:5px;" class="btn btn-success">
                                   Orqaga
                                </a>
                                <span style="float: right; margin:5px; cursor: default;" class="btn btn-primary">
                                    Imtihon: <?=$examName->title?>
                                </span>
                            </div>
                            <br>
                            <table id="example" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Guruhlar</th>
                                        <th>Javoblar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($examPer as $ep) : ?>
                                        <?php
                                       $group = \common\models\Group::find()->where(['id'=>$ep->group_id])->one();

                                        $direction_new = \common\models\Direction::find()->where(['=', 'id', $ep->direction_id])->one();
                                       
                                        ?>
                                        <tr>
                                            <td><?=$i++;?></td>
                                            <td>
                                                <?= $group->name ?>
                                            </td>
                                            <td>
                                                <a href="<?= \yii\helpers\Url::to(['/exam-permission/ansstd?en=' . $examName->id.'&gr='.$group->id], true) ?>">Kirish</a>
                                            </td>
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

</div>