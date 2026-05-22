<?php
use yii\helpers\Html;
?>

    <ul id="langs" style="display: inherit;">
         
     <a  href=" <?= ( '/backend/'.'ru'. '/'. Yii::$app->getRequest()->pathInfo) ?>">
    <img style="width: 30px;     margin-right: 10px;" src="/backend/themes/default/img/ru.svg"></a>
     <a  href=" <?= ( '/backend/'.'gb'. '/'. Yii::$app->getRequest()->pathInfo) ?>"> 
        <img style="width: 30px;    margin-right: 10px;" src="/backend/themes/default/img/gb.svg"></a>
     <a   href=" <?= ( '/backend/'.'uz'. '/'. Yii::$app->getRequest()->pathInfo) ?>">
        <img style="width: 30px;    margin-right: 10px;" src="/backend/themes/default/img/uz.svg"></a>
  
    </ul>
</div>