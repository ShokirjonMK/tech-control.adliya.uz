<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TarkibiyBolinma */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tarkibiy Bolinmas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tarkibiy-bolinma-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('index', ['index'], ['class' => 'btn btn-primary']) ?>
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
            [
                'attribute' => 'building_id',
                'value' => function ($model) {
                    return $model->building->name;
                },
            ],
            'name',
            'responce_persion',

            [
                'attribute' => 'tarkibiy_bolinma_id',
                'value' => function ($model) {
                    return $model->tarkibiyBolinma->name;
                },
            ],

            [
                'attribute' => 'status',
                'value' => function (\common\models\Room $model) {
                    return \common\helpers\RoomHelper::getStatusLabel($model->status);
                },
                'format'=>'html'
            ],

        ],
    ]) ?>

</div>
