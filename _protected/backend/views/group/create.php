<?php

use yii\helpers\Html;

$this->title = '';
$senario = 'create';
?>
<div class="group-create">
    
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'senario' => $senario,
    ]) ?>

</div>
