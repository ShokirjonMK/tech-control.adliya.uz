<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use nenad\passwordStrength\PasswordInput;
use yii\bootstrap\Modal;

//$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
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
                        
                        <br>
                        
<div class="user-view">
<?php $siteuser = \common\models\User::findOne(['id'=>Yii::$app->user->id]); if($siteuser->role_id == "theCreator" || $siteuser->role_id == "Admin") : ?>
<a href="<?=\yii\helpers\Url::to(['../student'])?>">
                                <button  class="btn btn-primary" style="width: 20%; float: left">
                                    Orqaga
                                </button>
                            </a>
<?php endif; ?>
<div class="container">
<div style="text-align:center; padding:0;"> <h2><?= $user->full_name  ?> </h2></div>
<hr>
    <div class="row my-2">
        
        <div class="col-lg-8 order-lg-2">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a href="" style="z-index: 0 !important;" data-target="#profile" data-toggle="tab" class="nav-link active">Shaxsiy ma'lumotlar</a>
                </li>

                <li class="nav-item">
                    <a href="" style="z-index: 0 !important;" data-toggle="modal" data-target="#myModal" class="nav-link">Parolni o'zgartirish</a>
                </li>
            </ul>
            <div class="tab-content py-4">
                <div class="tab-pane active" id="profile">
                     <div class="row">
                       
                        <div class="col-md-12">
                            
                            <table class="table table-sm table-hover table-striped">
                                <tbody>                                    
                                    <tr>
                                        <td>
                                            <strong>Tug'ulgan sana:</strong>
                                        </td>
                                        <td>
                                        <?php echo $user->birth_date; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Tug'ulgan joy:</strong>
                                        </td>
                                        <td>
                                        <?php echo $user->address; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Passport ma'lumoti:</strong>
                                        </td>
                                        <td>
                                        <?php echo $user->passport_number; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Kursi</strong>
                                        </td>
                                        <td>
                                        <?php echo $student->group->course_number; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Guruh</strong>
                                        </td>
                                        <td>
                                        <?php echo $student->group->name; ?>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>
                                            <strong>Yo'nalishi</strong>
                                        </td>
                                        <td>
                                        <?php echo $student->group->direction->name; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Foydalanuvchi nomi</strong>
                                        </td>
                                        <td>
                                        <?php echo $user->username; ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--/row-->
                </div>
                <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">     
                <div class="modal-content" id="edit">
                <div class="modal-header">
         
          <h4 class="modal-title">Parolni yangilash</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
                    <?php $form = ActiveForm::begin(['id' => 'form-user']); ?>                    
                        <?= $form->field($user, 'password')->widget(PasswordInput::class, [])->label('Yangi parol') ?>
                    <div class="form-group" >
                    <?= Html::submitButton('O\'zgartir', ['class' => 'btn btn-primary', 'style'=>'width:100%; margin-top:32px']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                    </div>
      </div>
      </div>
  </div>
  
               
            </div>
        </div>
        <div class="col-lg-4 order-lg-1 text-center">
            <?php if (!empty($user->image)){?>
                <img src="<?=\yii\helpers\Url::to(["../../uploads/user_images/".$user->image], true)?>" class="mx-auto img-fluid img-circle d-block" style="width:80%;" alt="avatar">
            <?php }else{?>
                <img src="<?=\yii\helpers\Url::to(["../../uploads/user_images/default.png"], true)?>" class="mx-auto img-fluid img-circle d-block" style="width:80%;" alt="avatar">
            <?php }?>
            <br/>
        </div>
    </div>
</div>

</div>
<?php $siteuser = \common\models\User::findOne(['id'=>Yii::$app->user->id]); if($siteuser->role_id == "theCreator" || $siteuser->role_id == "Admin") : ?>

 <div class="fixvh"></div>

<div class="table2">
    
    <div class="table table1 hovt">
        
        <div class="eslat open_eslat" style="
    padding-left: 18px; margin: -12px 0px; z-index: 10; background: #6c94ec; border-radius: 15px 0px 0px 0px;">
    <h4>Eslatma:</h4>
    <a style="margin-top: -8px; float: right;" href="/backend/uz/../studentprofile/export?id=<?=$user->id?>"><button class="btn">Export <span> <i class="fa fa-file-pdf" aria-hidden="true"></i></span></button></a> <span class="open_eslat"><i class="fa fa-angle-up"></i></span></div>
        

        <div class="por">
            
        <div class="shokir2">
          <div style="    height: 269px;
    overflow-y: scroll;">
                <table id="example_note" class="display view select" widht="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th class="def"><div><span class="active_th"><i class="fa fa-arrow-up" aria-hidden="true"></i></span> Date</div></th>
                    <th><div><span><i class="fa fa-arrow-up" aria-hidden="true"></i></span> Description</div></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php $i=0; foreach ($std_note as $stdN) : ?>
                <tr class="togclick">
                    <td><?php echo ++$i; ?></td>
                    <td><?=$stdN->date?></td>
                    <td><?php echo \yii\helpers\StringHelper::truncate($stdN->note, 20, '...'); ?></td>
                    <td><i class="fa fa-angle-down"></i></td>
                </tr>
                
                <tr class="info">
                    <td colspan="4" class="one_td"><?=$stdN->note; ?></td>
                </tr>
                <?php endforeach; ?>
                
            </tbody>
            
        </table>
          </div>
<form action="../studentprofile/stdnote" method="POST" enctype='multipart/form-data'>
                <div class="input_zaf">
                    <input type="text" name="description">
                    <input type="hidden" name="student_id" value="<?=$user->id?>">
                    <button class="jonat_z" type="submit">Send</button>
                </div>
</form>
        </div>
        </div>

    </div>

</div>
<?php endif ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
<!--  -->
   
<!--  -->
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
    
$(document).ready(function(){

   $("div.table1 table thead th").click(function(){
        $(this).find("span.active_th").toggleClass("rotate_th");
        $(this).find("span").addClass("active_th");
        $("div.table1 table thead th").not(this).find("span").removeClass("active_th");
        $("div.table1 table thead th").not(this).find("span").removeClass("rotate_th");
    });
    
    $("span.open_eslat").click(function(){
        $("div.table2 div.table div.shokir2").slideToggle(0);
        $(this).toggleClass("rotate_g");
    });

    $("tbody tr.togclick").click(function(){

        $("tbody tr.togclick").not(this).next().slideUp(0);

        $("tbody tr.togclick").not(this).find(".fa-angle-down").removeClass("rotate_g");
        $("tbody tr.togclick").not(this).find("td:nth-child(3)").css({
            'opacity': '1'
        });
        
        $(this).next().slideToggle(0);
        $(this).find(".fa-angle-down").toggleClass("rotate_g");
        if($(this).next().is(":hidden") < 1){
            $(this).find("td:nth-child(3)").css({
                'opacity': '0'
            });
        }
        else{
            $(this).find("td:nth-child(3").css({
                'opacity': '1'
            });
        }
        
    });
        $('#myInput').on('keyup change', function () {
        $('#example_note').DataTable().search(this.value).draw();
    });

    $('#example_note').DataTable({
        "ordering": true,
        "order": [[ 1, "asc" ]],
        "paging": false
    });

});
</script>