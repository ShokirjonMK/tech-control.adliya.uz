<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
?>

<style>
    td {
        vertical-align: middle !important
    }
</style>
<?php $now_user=\common\models\User::find()->where(['=', 'user.id', Yii::$app->user->id])->one(); ?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="course-teacher-view">
                    <div class="card card-info" style="padding: 40px; overflow-x: scroll;">
                        <div class="card-header" style="text-align: center;">
                            <h3 class="card-title1 " style="text-align: center;">
                                <h2 style="text-align:center"><?=$fan->name; ?></h2>
                            </h3>
                        </div>
                        <br>
                        <?php if (($now_user->role_id == "Admin") || ($now_user->role_id == "theCreator") || ($now_user->role_id == "Teacher") ) : ?>
                        <div class="col-xs-12 col-md-12 mb-2"> 
                            <h1><a href="<?=\yii\helpers\Url::to(['../library/create?id='.$fan->id])?>"><button style="float: right;" class="btn btn-success">Kategoriya yaratish</button></a></h1>
                        <?php endif; ?>
                        <?php if (($now_user->role_id == "Admin") || ($now_user->role_id == "theCreator") || ($now_user->role_id == "Teacher") ) : ?>

                            <h1><a href="<?=\yii\helpers\Url::to(['../library/index'])?>"><button style="float: left;" class="btn btn-primary">Orqaga</button></a></h1>
                        </div>
                        <?php if ( ! empty($category)) { ?>
                        <a href="#myModal" class="btn btn-primary" data-toggle="modal">Fayl yuklash</a>
                       <?php } ?>
                    <?php endif; ?>
                        <ul class="nav nav-tabs md-tabs" id="myTabMD" role="tablist">
                        <?php foreach ($category as $key => $cat) : ?>
                        <?php if ($key == 0) : ?>
                              <li class="nav-item">
                                <a class="nav-link active" id="tab<?=$cat->id ?>-tab-md" data-toggle="tab" href="#tab<?=$cat->id?>-md" role="tab" aria-controls="tab<?=$cat->id ?>-md"
                                  aria-selected="true"><?=$cat->name ?></a>
                              </li>
                        <?php endif; ?>
                        <?php if ($key != 0) : ?>
                              <li class="nav-item">
                                <a class="nav-link" id="tab<?=$cat->id ?>-tab-md" data-toggle="tab" href="#tab<?=$cat->id?>-md" role="tab" aria-controls="tab<?=$cat->id ?>-md"
                                  aria-selected="true"><?=$cat->name ?></a>
                              </li>
                        <?php endif; ?>

                        <?php endforeach; ?>
                    </ul>

                <div class="tab-content card pt-5" id="myTabContentMD">
                        <?php 
                        foreach ($category as $key => $cat) : ?>

                    <?php if ($key == 0) : ?>
                   <div>
                        
                    </div>
                  <div class="tab-pane fade show active" id="tab<?=$cat->id?>-md" role="tabpanel" aria-labelledby="tab<?=$cat->id ?>-tab-md">
                    
        
                    <table class="table table-striped table-bordered" >
                            <thead>
                            <tr>
                                <th style="text-align: center;">#</th>
                                <th style="text-align: center;">Nomi</th>
                                <th style="text-align: center;">Kurs</th>
                                <th style="text-align: center;">Yuklab olish</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $i =0;  foreach ($lib as $l): ?>
                            <?php if ($l->category == $cat->id) : ?>
                                <tr>
                                    <td  style="text-align: center;"><?=++$i?></td>
                                    <td><?= $l->name ?></td>
                                    <td style="text-align: center;"><?php echo $l->course_id; ?></td>
                                    <td style="text-align: center;">
                                        <a href="<?= \yii\helpers\Url::to(['../../uploads/library/' . $l->fayl], true) ?>">
                                            <i style="color: #0056b3;font-size:25px;" class="fa fa-download" aria-hidden="true">
                                            </i>
                                        </a>
                                    </td>
                                </tr>

                            <?php endif; endforeach; ?>
                            </tbody>
                        </table>
                    
                  </div>
              <?php endif; ?>
                  <?php if ($key != 0) : ?>

                  <div class="tab-pane fade" id="tab<?=$cat->id?>-md" role="tabpanel" aria-labelledby="tab<?=$cat->id ?>-tab-md">
                    <table class="table table-striped table-bordered" >
                            <thead>
                            <tr>
                                <th style="text-align: center;">#</th>
                                <th style="text-align: center;">Nomi</th>
                                <th style="text-align: center;">Kurs</th>
                                <th style="text-align: center;">Yuklab olish</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $i =0;  foreach ($lib as $l): ?>
                            <?php if ($l->category == $cat->id) : ?>
                                <?php $course12 = \common\models\Course::findOne(['id'=>$l->course_id]); ?>
                                <tr>
                                    <td  style="text-align: center;"><?=++$i?></td>
                                    <td><?= $l->name ?></td>
                                    <td style="text-align: center;"><?php echo $course12->name; ?></td>
                                    <td style="text-align: center;">
                                        <a href="<?= \yii\helpers\Url::to(['../../uploads/library/' . $l->fayl], true) ?>">
                                            <i style="color: #0056b3;font-size:25px;" class="fa fa-download" aria-hidden="true">
                                            </i>
                                        </a>
                                    </td>
                                </tr>

                            <?php endif; endforeach; ?>
                            </tbody>
                        </table>
                  </div>
              <?php endif; ?>
                        <?php  endforeach; ?>

                </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<form action="../library/uploadfayl" method="POST" enctype='multipart/form-data'>
    <?php // $form = ActiveForm::begin([ 'options' => ['enctype' => 'multipart/form-data', 'action'=>'../library/uploadfayl']  ]) ?>
<div class="container">

<!-- Button to trigger modal -->
 
  <!-- Modal -->
  <div class="modal fade" id="myModal"  aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Fayl yuklash</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        </div>
        <div class="modal-body">
                        <div class="col-xs-12 col-md-12">
                            <div class="form-group">
                                <label class="control-label" for="group-name">Nomini kiriting</label>
                                <input required class="form-control" style="width: 100%;" name="name">
                                <input type="hidden" name="fan" value="<?=$fan->id?>">
                            </div>
                        </div>
                      <div class="row">
                      <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="group-name">Kursni tanlang</label>
                                <select required class="form-control select2" style="width: 100%;" name="course">
                                    <option selected="" value="0">-Kursni tanlang-</option>
                                    <?php foreach ($course as $c) : ?>
                                        <option type="checkbox" value="<?= $c->id ?>">
                                            <?= $c->name ?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="group-name">Kategoriya tanlang</label>
                                <select required class="form-control select2" style="width: 100%;" name="category">
                                    <option selected="" value="0">-Kategoriya tanlang-</option>
                                    <?php foreach ($category as $c) : ?>
                                        <option type="checkbox" value="<?= $c->id ?>">
                                            <?= $c->name ?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        </div>
                <div class="form-group">
                    <label class="control-label" for="exampleInputFile">Faylni yuklang</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input required name="Library[file]" type="file" class="custom-file-input"  accept=".pdf" id="exampleInputFile">
                            <label class="custom-file-label" for="exampleInputFile">Faylni tanlang</label>
                        </div>
                    </div>
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Yopish</button>
          <button class="btn btn-primary">Saqlash</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  
  
</div>

<?php // ActiveForm::end(); ?>
</form>