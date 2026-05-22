<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
$user=\common\models\User::find()->where(['=', 'user.id', Yii::$app->user->id])->one();
$lang=\yii\helpers\ArrayHelper::map(\common\models\Lang::find()->all(), 'id', 'name');
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
                                <h2 style="text-align:center"> Guruh yaratish </h2>
                            </h3>
                        </div>
                        <br>
                        <div class="group-form">
                            <?php $form = ActiveForm::begin(); ?>
                                <div class="row">
                                    <div class="col-sm-6">
<!--                                        --><?php //if ($user->senario == 'create')
//                                        { ?>
<!--                                            --><?php //$fa =  \yii\helpers\ArrayHelper::map(common\models\Faculty::find()->where(["uni_id"=>$user->uni_id])->all(), 'id', 'name')?>
<!--                                            --><?php
//                                            $id = Yii::$app->request->get('id');
//                                            $dikk = common\models\Direction::find()->where(['id'=>$id])->andwhere(["uni_id"=>$user->uni_id])->one();
//                                            $fac = common\models\Faculty::find()->where(['id'=>$dikk->faculty_id])->andwhere(["uni_id"=>$user->uni_id])->one();
//                                            ?>
<!--                                            --><?//= $form->field($model, 'faculty_id')->dropDownList(
//                                                $fa,
//                                                    ['options' => [$fac->id => ['selected'=>true]],  'class' => 'browser-default head custom-select',
//                                                    'onchange'=>
//                                                        '$.get( "'.Url::toRoute('group/list').'", { id: $(this).val() } )
//                                                            .done(function( data ) {
//                                                                $( "#'.Html::getInputId($model, 'direction_id').'" ).html( data );
//                                                            }
//                                                        );'
//                                                    ]
//                                            ) ?>
<!--                                            --><?php
//                                            $id = Yii::$app->request->get('id');
//                                            $dir = \yii\helpers\ArrayHelper::map(common\models\Direction::find()->where(["uni_id"=>$user->uni_id])->all(), 'id', 'name');
//                                            ?>
<!---->
<!--                                            --><?//= $form->field($model, 'direction_id')->dropDownList($dir, ['options' => [$id => ['selected'=>true]]]);
//
//                                        }
////                                        else { ?>
                                            <?= $form->field($model, 'faculty_id')->dropDownList(
                                                \yii\helpers\ArrayHelper::map(common\models\Faculty::find()
                                                ->where(["uni_id"=>$user->uni_id])->all(), 'id', 'name'),
                                                [ 'class' => 'browser-default head custom-select',  'prompt' => 'Fakultet tanlang',
                                                'onchange'=>'
                                    
                                                            $.get( "'.Url::toRoute('group/list').'", { id: $(this).val() } )
                                                                .done(function( data ) {
                                                                    $( "#'.Html::getInputId($model, 'direction_id').'" ).html( data );
                                                                }
                                                            );'
                                                                            ]	)
                                                                        ?>

                                            <?= $form->field($model, 'direction_id')
                                            ->dropDownList( \yii\helpers\ArrayHelper::map(common\models\Direction::find()
                                            ->where(["uni_id"=>$user->uni_id])->all(), 'id', 'name'))?>
<!--                                        --><?php //} ?>
                                        <div class="row">
                                            
                                            <div class="col-sm-6">
                                                <?= $form->field($model, 'course_number')
                                                ->dropDownList( \yii\helpers\ArrayHelper::map(common\models\Course::find()
                                                ->where(["uni_id"=>$user->uni_id])->all(), 'name', 'name'))?>
                                            </div>
                                            <div class="col-sm-6">
                                                <?= $form->field($model, 'smester')
                                                ->dropDownList([1=>'1',2=>'2',3=>'3',4=>'4',5=>'5',6=>'6',7=>'7',8=>'8',9=>'9',10=>'10',11=>'11',12=>'12'])->label('Semester') ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                                            </div>
                                            <div class="col-sm-6">
                                                <?= $form->field($model, 'lang_id')->dropDownList($lang) ?>
                                            </div>
                                        </div>
                                        <?= $form->field($model, 'status')->dropDownList([1=>'Aktiv',0=>'Passiv']) ?>
                                        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success', 'style'=>'width:100%;margin-top:32px;']) ?>
                                    </div>
                                </div>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
