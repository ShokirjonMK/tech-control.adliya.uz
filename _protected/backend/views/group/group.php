<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

?>



<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header ">
                <ul class="nav nav-pills ml-auto p-2">
                    <?php $i=1; foreach($course as $course_one): ?>
                        <li class="nav-item"><a class="nav-link <?php if($i==1) echo"active"; ?>" href="#tab<?=$course_one['value']?>"
                                                data-toggle="tab"><?=$course_one['name']?></a></li>
                        <?php $i++;  endforeach?>

                </ul>
            </div><!-- /.card-header -->

            <div class="card-body">
                <div class="tab-content">
                    <?php  $i=1; foreach($course as $course_one): ?>
                        <div class="tab-pane <?php if($i==1) echo "active"; ?>" id="tab<?=$course_one['value']?>">
                            <?php $form = ActiveForm::begin(['action' => ['group/group'],'options' => [ 'method' => 'post']]) ?>
                            <div class="kurs_smester">
                                <?php if($i==1){?>
                                    <select name="kurs">
                                        <option value="1">1-kurs</option>
                                        <option value="2">2-kurs</option>
                                    </select>
                                    <select name="semest">
                                        <option value="1">1-semest</option>
                                        <option value="2">2-semest</option>
                                        <option value="3">3-semest</option>
                                    </select>

                                <?php } if($i==2){?>
                                    <select name="kurs">
                                        <option value="2">2-kurs</option>
                                        <option value="3">3-kurs</option>
                                    </select>
                                    <select name="semest">
                                        <option value="3">3-semest</option>
                                        <option value="4">4-semest</option>
                                        <option value="5">5-semest</option>
                                    </select>

                                <?php } if($i==3){?>
                                    <select name="kurs">
                                        <option value="3">3-kurs</option>
                                        <option value="4">4-kurs</option>
                                    </select>
                                    <select name="semest">
                                        <option value="6">6-semest</option>
                                        <option value="7">7-semest</option>
                                        <option value="8">8-semest</option>
                                    </select>
                                <?php } if($i==4){?>
                                    <select name="kurs">
                                        <option value="4">4-kurs</option>
                                        <option value="5">5-kurs</option>

                                    </select>
                                    <select name="semest">
                                        <option value="7">7-semest</option>
                                        <option value="8">8-semest</option>
                                        <option value="9">9-semest</option>

                                    </select>

                                <?php } if($i==5){?>
                                    <select name="kurs">
                                        <option value="5">5-kurs</option>
                                        <option value="6">6-kurs</option>

                                    </select>
                                    <select name="semest">
                                        <option value="9">9-semest</option>
                                        <option value="10">10-semest</option>
                                        <option value="11">11-semest</option>
                                    </select>
                                <?php } if($i==6){?>
                                    <select name="kurs">
                                        <option value="6">6-kurs</option>
                                        <option value="7">7-kurs</option>
                                    </select>
                                    <select name="semest">
                                        <option value="11">11-semest</option>
                                        <option value="12">12-semest</option>
                                        <option value="13">13-semest</option>
                                    </select>
                                <?php } if($i==7){?>
                                    <select name="kurs">
                                        <option value="7">7-kurs</option>
                                    </select>
                                    <select name="semest">
                                        <option value="13">13-semest</option>
                                        <option value="14">14-semest</option>
                                    </select>
                                <?php }?>
                            </div>
                            <input type="hidden" name = "faculty_id" value ='<?=$faculty_id?>'>

                            <div class="row1">
                                <table class="table table-striped examplesort table-bordered" >
                                    <thead>
                                    <tr>

                                        <th>#</th>
                                        <th>Nomi</th>
                                        <th>Semester</th>
                                        <th>status</th>

                                        <th id="tableCheck11<?=$i?> ">

                                            <input style="top:0;" id="tableCheck<?=$i?>" type="checkbox" class="option-input radio" />
                                        </th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $a=1; foreach($groups as $group):?>
                                        <?php if($group->course_number == $course_one['value']){?>

                                            <tr>
                                                <td><?=$a?></td>
                                                <td><?=$group->name;?></td>

                                                <td><?=$group->smester;?></td>
                                                <td>
                                                    <?php if($group->status == 1){
                                                        echo "Aktiv";
                                                    }else{
                                                        echo "Passiv";
                                                    }
                                                    ?>
                                                </td>

                                                <td id="tableDefaultCheck<?=$course_one['value']?>">

                                                    <input style="top:0;"  name ="check[<?=$group->id?>]" value = "1"   type="checkbox" class="option-input radio check<?=$i?>" />

                                                </td>

                                            </tr>



                                            <?php $a++;}?>

                                    <?php  endforeach; ?>
                                    </tbody>
                                </table>

                            </div>  <!-- /.row -->
                            <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success', 'style'=>'width:100%;margin-top:32px;']) ?>
                            <?php ActiveForm::end(); ?>
                        </div>
                        <?php $i++; endforeach?>  <!-- /.tab-pane -->

                </div> <!-- /.tab-content -->

            </div>




        </div>
    </div>