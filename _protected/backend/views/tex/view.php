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
<div class="tex-main-base-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'tartib_raqami',
            'uzasbo_nomi',
           [    'label' => 'Tip',
                 'value' => $model->tipi()->name,
            ],
            'parametr:ntext',
            'bino',
             [    'label' => 'Takiriy bo\'linma',
                'value' => $model->tarkibiyBolinma->name,
            ],

            [
                'label' => 'bino',
                'value' => $model->building->name
            ],

            [
                'label' => 'Xona',
                'value' => $model->room->name
            ],
            'biriktirilgan',

            'inventar_ichki',
//            'biriktirilgan',
            'yili',
            [    'label' => 'Holati',
                'value' => $model->holati()->name,
            ],
            [    'label' => 'Yaroqliligi',
                'value' => $model->yaroqliligi()->name,
            ],
            'inventar_b',
            'partiya',
            'dona_narx',
            'partiya_narx',
            'bino_qushimcha',
            [    'label' => 'Kelganligi',
                'value' => $model->how_come()->name,
            ],
            'status',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
        ],
    ]) ?>

</div>
