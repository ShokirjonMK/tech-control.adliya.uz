<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

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
                                <h2 style="text-align:center"> Ilmiy darajalar </h2>
                            </h3>
                        </div>
                        <br>
                        <h1><a href="<?=\yii\helpers\Url::to(['../degree/create'])?>"><button style="float: right;" class="btn btn-success">Ilmiy daraja qo`shish</button></a></h1>
                        <table id="example" class="table table-striped table-bordered" >
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nomi</th>
                                <th>Holati</th>
                                <th  style="text-align: center;"><span class="glyphicon glyphicon-cog"></span></th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $i =0;  foreach ($degree as $degrees): ?>

                                <tr>
                                    <td><?= ++$i?></td>
                                    <td><?= $degrees->name;?></td>

                                    <td>
                                        <?php if($degrees->status == 1){
                                            echo "Aktiv";
                                        }else{
                                            echo "Passiv";
                                        }
                                        ?>
                                    </td>

                                    <td  style="text-align: center;">
                                        <a href="<?=\yii\helpers\Url::to(['../degree/update?id='.$degrees->id])?>"><span class="glyphicon glyphicon-edit"></span></a>
                                    </td>
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
