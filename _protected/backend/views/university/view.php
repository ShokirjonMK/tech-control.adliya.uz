<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Universities';
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
                                <h2 style="text-align:center"> Universitet</h2>
                            </h3>
                        </div>
                        <br>
                        <div>
                        <h1><a href="<?=\yii\helpers\Url::to(['../university/index'])?>"><button style="float: left;" class="btn btn-success">Bosh Sahifa</button></a></h1>
                        </div>
                        <table id="example" class="table table-striped table-bordered" >
                            <tbody>
                                    <tr>          <th>Nomi</th>
                                    <td><?=$university->name;?></td></tr>
                                    <tr>            <th>Bank nomi</th>
                                    <td><?= $university->bank_name;?></td></tr>
                                    <tr>            <th>Bank manzili</th>
                                    <td><?=$university->bank_adress;?></td></tr>
                                    <tr>            <th>Bank hisob raqami</th>
                                    <td><?=$university->bank_hisob;?></td></tr>
                                    <tr>            <th>INN</th>
                                    <td><?=$university->INN;?></td></tr>
                                    <tr>            <th>Shartnoma</th>
                                    <td><?=$university->shartnoma;?></td></tr>
                                    <tr>            <th>Raqami</th>
                                    <td><?=$university->number;?></td></tr>
                                    <tr>            <th>MFO</th>
                                    <td><?=$university->mfo;?></td>
                                </tr>
                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



