<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Fans';
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
                                <h2 style="text-align:center"> Fanlar </h2>
                            </h3>
                        </div>
                        <br>
                        <h1><a href="<?=\yii\helpers\Url::to(['../fan/create'])?>"><button class="btn btn-success" style="width: 20%; float: right"> Fan qo`shish</button></a></h1>
                        <table id="example" class="table table-striped table-bordered" >
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nomi</th>
                                <th>Inventar</th>
                                <th>Parametri</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $i =1;  foreach ($tex as $TexOne): ?>
                                <?php  $unversitet = \common\models\University::find()->where(['id'=>$fans->uni_id])->one();?>
                                <?php  $kafedra = \common\models\Kafedra::find()->where(['id'=>$fans->kafedra_id])->one();?>
                                <tr>
                                    <td><?=$i++?></td>
                                    <td><?=$TexOne->tipi->name;?></td>
                                    <td><?=$TexOne->inventar_ichki;?></td>
                                    <td><?=$TexOne->parametr;?></td>

                                </tr>
                            <?php  endforeach; ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

