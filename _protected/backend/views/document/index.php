<?php
use common\helpers\CssHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use common\models\User;
use common\models\Document;
use common\models\ExamQuestion;
use yii\widgets\ActiveForm;
$model = new Document();
use yii\web\UploadedFile;
$document = \common\models\Document::findOne(['user_id'=>Yii::$app->user->id]);
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
                                <h2 style="text-align:center">Hujjatlarim</h2>
                            </h3>
                        </div> <br />
                        <table id="example" class="table table-striped table-bordered" style="margin-top: 30px;">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Hujjat nomi</th>
                                <th style="text-align: center;">Fayl tanlang va yuklang</th>
                                <th style="text-align: center;">Ko`rish(yuklab olish)</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td style="text-align: center;">1</td>
                                <td>Shartnoma</td>
                                <td style="text-align: center;">
                                <form action="../document/mydoc1" method="post" enctype="multipart/form-data">
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input required="" name="Document[file]" type="file" class="custom-file-input" accept=".pdf" id="exampleInputFile">
                                                <label class="custom-file-label" for="exampleInputFile">Faylni tanlang</label>
                                            </div>
                                            <button class="btn" type="submit"><i style="color: #0056b3;font-size:25px;" class="fa fa-upload" aria-hidden="true"></i></button>
                                        </div>

                                    </td>


                                </form>
                                <td style="text-align: center;">
                                    <?php if(!empty($document->shartnoma)){ ?>
                                    <a href="<?= \yii\helpers\Url::to(['../../uploads/document/shartnoma/'.$document->shartnoma], true) ?>">
                                        <i style="color: #0056b3;font-size:25px;" class="fa fa-download" aria-hidden="true"></i>
                                    </a>
                                    <?php }?>
                                </td>
                            </tr>
                            <tr>
                                    <td style="text-align: center;">2</td>
                                    <td>Obyektivka</td>
                                    <td style="text-align: center;">
                                <form action="../document/mydoc2" method="post" enctype="multipart/form-data">

                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input required="" name="Document[file]" type="file" class="custom-file-input" accept=".pdf" id="exampleInputFile2">
                                                <label class="custom-file-label" for="exampleInputFile2">Faylni tanlang</label>
                                            </div>
                                            <button class="btn" type="submit"><i style="color: #0056b3;font-size:25px;" class="fa fa-upload" aria-hidden="true"></i></button>
                                        </div>

                                </form>

                                    </td>


                                <td style="text-align: center;">
                                    <?php if(!empty($document->ob)){ ?>
                                    <a href="<?= \yii\helpers\Url::to(['../../uploads/document/ob/' . $document->ob], true) ?>">
                                        <i style="color: #0056b3;font-size:25px;" class="fa fa-download" aria-hidden="true"></i>
                                    </a>
                                    <?php }?>
                                </td>
                            </tr>
                            <tr>
                                    <td style="text-align: center;">3</td>
                                    <td >Passport</td>
                                    <td style="text-align: center;">
                                <form action="../document/mydoc3" method="post" enctype="multipart/form-data">

                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input required="" name="Document[file]" type="file" class="custom-file-input" accept=".pdf" id="exampleInputFile3">
                                                <label class="custom-file-label" for="exampleInputFile3">Faylni tanlang</label>
                                            </div>
                                        <button class="btn" type="submit"><i style="color: #0056b3;font-size:25px;" class="fa fa-upload" aria-hidden="true"></i></button>
                                        </div>
                                </form>

                                    </td>

                                <td style="text-align: center;">
                                    <?php if(!empty($document->pos)){ ?>
                                    <a href="<?= \yii\helpers\Url::to(['../../uploads/document/pos/' . $document->pos], true) ?>">
                                        <i style="color: #0056b3;font-size:25px;" class="fa fa-download" aria-hidden="true"></i>
                                    </a>
                                    <?php }?>
                                </td>
                            </tr>
                            <tr>
                                    <td style="text-align: center;">4</td>
                                    <td>INN</td>
                                    <td style="text-align: center;">
                                <form action="../document/mydoc4" method="post" enctype="multipart/form-data">

                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input required="" name="Document[file]" type="file" class="custom-file-input" accept=".pdf" id="exampleInputFile4">
                                                <label class="custom-file-label" for="exampleInputFile4">Faylni tanlang</label>
                                            </div>
                                        <button class="btn" type="submit"><i style="color: #0056b3;font-size:25px;" class="fa fa-upload" aria-hidden="true"></i></button>
                                        </div>

                                </form>
                                    </td>



                                <td style="text-align: center;">
                                    <?php if(!empty($document->inn)){ ?>
                                    <a href="<?= \yii\helpers\Url::to(['../../uploads/document/inn/' . $document->inn], true) ?>">
                                        <i style="color: #0056b3;font-size:25px;" class="fa fa-download" aria-hidden="true"></i>
                                    </a>
                                    <?php }?>
                                </td>
                            </tr>
                            <tr>
                                    <td style="text-align: center;">5</td>
                                    <td>INPS</td>
                                    <td style="text-align: center;">
                                <form action="../document/mydoc5" method="post" enctype="multipart/form-data">

                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input required="" name="Document[file]" type="file" class="custom-file-input" accept=".pdf" id="exampleInputFile5">
                                                <label class="custom-file-label" for="exampleInputFile5">Faylni tanlang</label>
                                            </div>
                                        <button class="btn" type="submit"><i style="color: #0056b3;font-size:25px;" class="fa fa-upload" aria-hidden="true"></i></button>
                                        </div>

                                </form>

                                    </td>


                                <td style="text-align: center;">
                                    <?php if(!empty($document->inps)){ ?>
                                    <a href="<?= \yii\helpers\Url::to(['../../uploads/document/inps/' . $document->inps], true) ?>">
                                        <i style="color: #0056b3;font-size:25px;" class="fa fa-download" aria-hidden="true"></i>
                                    </a>
                                    <?php }?>
                                </td>
                            </tr>
                            <tr>
                                    <td style="text-align: center;">6</td>
                                    <td>Diplom</td>
                                    <td style="text-align: center;">
                                <form action="../document/mydoc6" method="post" enctype="multipart/form-data">

                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input required="" name="Document[file]" type="file" class="custom-file-input" accept=".pdf" id="exampleInputFile6">
                                                <label class="custom-file-label" for="exampleInputFile6">Faylni tanlang</label>
                                            </div>
                                        <button class="btn" type="submit"><i style="color: #0056b3;font-size:25px;" class="fa fa-upload" aria-hidden="true"></i></button>
                                        </div>

                                </form>

                                    </td>


                                <td style="text-align: center;">
                                    <?php if(!empty($document->diplom)){ ?>
                                    <a href="<?= \yii\helpers\Url::to(['../../uploads/document/diplom/' . $document->diplom], true) ?>">
                                        <i style="color: #0056b3;font-size:25px;" class="fa fa-download" aria-hidden="true"></i>
                                    </a>
                                    <?php }?>
                                </td>
                            </tr>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


