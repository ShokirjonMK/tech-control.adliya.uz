<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TexMainBase */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tex Main Bases', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tex-main-base-view m-3">

    <h1 style="text-align: center"><?= $model->inventar_ichki ?></h1>



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'tartib_raqami',
            'uzasbo_nomi',
            [    'label' => 'Tip',
                 'value' => $model->tipi()->name,
            ],
            'biriktirilgan',
            'parametr:ntext',
            'parametr_full:ntext',
            'bino',
            [    'label' => 'Takiriy bo\'linma',
                'value' => $model->tarkibiyBolinma->name,
            ],
            'inventar_ichki',
            'yili',
            [    'label' => 'Holati',
                'value' => $model->holati()->name,
            ],
            [    'label' => 'Yaroqliligi',
                'value' => $model->yaroqliligi()->name,
            ],
            'inventar_b',
            'partiya',
            'bino_qushimcha',
//            [    'label' => 'Kelganligi',
//                'value' => $model->how_come()->name,
//            ],
           
        ],
    ]) ?>

</div>
