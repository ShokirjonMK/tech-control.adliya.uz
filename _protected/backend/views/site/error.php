<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = "OOPS Hatolik";
?>
<div class="site-error">
<div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?php echo $massage = "Ushbu harakatni amalga oshirish uchu sizda yetarli huquqlar yo`q";
//        $user = \common\models\User::find()->where(['id'=>Yii::$app->user->id]);
//        var_dump($user->username);
        ?>
    </div>

    <!-- <p class="text-center"><?= Html::a('Orqaga', ['course/index'], ['class' => 'btn  btn-secondary']) ?></p> -->
</div>
