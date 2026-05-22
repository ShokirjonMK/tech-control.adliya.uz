<?php

use yii\helpers\Html;

/**
* @var yii\web\View $this
* @var common\models\MaterialBase $model
*/

$this->title = Yii::t('models', 'Material Base');
$this->params['breadcrumbs'][] = ['label' => Yii::t('models', 'Material Bases'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="giiant-crud material-base-create">
    <div class="crud-navigation d-flex" style="justify-content:space-between" >
        <div>
            <h1>
                <?= Yii::t('models', 'Material Base') ?>
                <small>
                    <?= Html::encode($model->name) ?>
                </small>
            </h1>
        </div>
     <div >
         <?= Html::a('<span class="glyphicon glyphicon-file"></span> ' . 'index', ['index',], ['class' => 'btn btn-info']) ?>

     </div>
    </div>




    <?= $this->render('_form', [
        'model' => $model,
    ]); ?>

</div>
