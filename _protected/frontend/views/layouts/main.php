<?php
use frontend\assets\AppAsset;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
Yii::$app->language = Yii::$app->languageId->url ? Yii::$app->languageId->url : 'ru';
$this->title = "OOPS Hatolik";
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<meta charset="<?= Yii::$app->charset ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta property="og:site_name" content="tech-control.adliya.uz">
<meta property="og:title" content="tech-control.adliya.uz">
<meta property="og:locale" content="uz-UZ">
<meta property="og:type" content="page">
<meta property="og:url" content="http://tech-control.adliya.uz/">
<meta property="og:image" content="<?=\yii\helpers\Url::to(["../themes/default/image/logotip.jpg"], true)?>">
<meta property="og:description"
content="Universitet">
    <?= Html::csrfMetaTags() ?>
    <title>Online Center</title>
<link rel="shortcut icon" href="<?=\yii\helpers\Url::to(["../themes/default/image/logo1.png"], true)?>" />

    <?php $this->head() ?>
</head>

<body>
    
    <?php $this->beginBody() ?>

<div  class="wrapper container">


<div class="site-error">
<div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?php echo $massage = "Server bilan muammo sodir bo`ldi!!!";
        ?>
    </div>

    <!-- <p class="text-center"><?= Html::a('Orqaga', ['course/index'], ['class' => 'btn  btn-secondary']) ?></p> -->
</div>
      
        <?= $content ?>

</div>
  

    <?php $this->endBody() ?>

</body>

</html>
<?php $this->endPage() ?>