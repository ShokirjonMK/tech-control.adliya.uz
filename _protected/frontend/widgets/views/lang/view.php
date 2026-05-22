<?php
use yii\helpers\Html;

?>


  <button class="lang-button" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php   $a=\Yii::$app->language; 
                
                if($a=='en'){
                	echo "O`zbek";
                }
             if($a=='uz'){
                	echo "Ўзбек";
                }
                 if($a=='ru'){
                	echo "Pусский ";
                }
                ?>
			    <i class="fa fa-angle-down" aria-hidden="true"></i>
			  </button>
<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <?php foreach ($langs as $lang):?>
            <?= Html::a($lang->name, '/'.$lang->url.Yii::$app->getRequest()->getLangUrl(),
             ['class' => 'dropdown-item', 'style' => 'margin-top:5px;']); ?>
        <?php endforeach; ?>
</div>
</div>