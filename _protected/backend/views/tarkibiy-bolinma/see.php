<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TexMainBase */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tex Main Bases', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tex-main-base-view m-3">

     <style>


table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
  }
th {
    text-align: center;
}

</style>

        <h5 style="text-align: center;"> <?php echo $model->name ?></h5>
        <table id="" class="table table-striped table-bordered" >
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nomi</th>
                                <th>Inventar</th>
                                <th>Parametri</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i =0;  foreach ($tex as $TexOne): ?>
                               <tr>
                                    <td><?=++$i?></td>
                                    <td><?=$TexOne->tipi->name;?></td>
                                    <td><?=$TexOne->inventar_ichki;?></td>
                                    <td><?=$TexOne->parametr;?></td>

                                </tr>
                            <?php  endforeach; ?>
                            </tbody>

                        </table>

         <p style="text-align: right"> Qabul qildi: <?php echo $One->biriktirilgan ?></p>

</div>
