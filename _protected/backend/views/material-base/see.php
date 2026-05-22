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
<style>

    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }

</style>
<div class="tex-main-base-view m-3">

    <h5 style="text-align: right">Tasdiqlayman

        O'zbekiston Respublikasi Adliya vazirligi prayrektori A.Iminov <br>
        <?php echo date('Y') ?> - yil
    </h5>

    <h5 style="text-align: center;">O'zbekiston Respublikasi Adliya vazirligi <?php echo $building->name ?>
        si <?php echo $room->name ?>da mavjud invertarlar</h5>
    <h3 style="text-align: center;"> ROʻYXATI </h3>
    <table style="width: 100%; ">
        <tr>
            <th style="width:5%; text-align: center;">#</th>
            <th style="width:20%">Inventar nomi</th>
            <th style="width:20%">Inv. raqami</th>
            <th style="width:20%">Soni</th>
        </tr>

        <?php $i = 0;
        foreach ($material as $materialOne) {
            echo '<tr> <td style="text-align: center;">' . ++$i . '</td>';
            echo '<td>' . $materialOne->name . '</td>';
            echo '<td style="text-align: center">' . $materialOne->inventar . '</td>';
            echo '<td style="text-align: center">' . $materialOne->count . '</td>';

            '</tr>';
        }
        ?>
        <?php foreach ($texnika as $texnikaOne) {
            echo '<tr> <td style="text-align: center;">' . ++$i . '</td>';
            echo '<td>' . $texnikaOne->tipi->name . '</td>';
            echo '<td style="text-align: center">' . $texnikaOne->inventar_b . '</td>';
            echo '<td style="text-align: center"> 1 </td>';

            '</tr>';
        }
        ?>
    </table>    <br>
    <hr>
    <table style="border: none; width: 100%;">
        <tr style="margin-bottom: 2rem;">
            <th style="width:20%; border:none;">Topshirildi</th>

            <th style="width:20%; border:none; text-align: right; ">Maʼsul shaxs</th>

        </tr>

        <tr style="border: none; margin-top: 2rem">
            <td style="border: none"> <?php echo $building->commandant ?></td>
            <td style="text-align: right;border: none"> <?php echo $room->responce_persion ?></td>
        </tr>

        <tr style="border: none; margin-top: 2rem">

            <td style="border: none"> A.Karimov</td>
            <td style="text-align: right;border: none"></td>
        </tr>
    </table>


</div>
