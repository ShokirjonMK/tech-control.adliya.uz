<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\FinalWork */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Final Works', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="final-work-view">

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
            'name',
            'group_id',
            'smester',
            'fan_id',
            'teacher_id',
            'student_id',
            'qr_code',
            'status',
            'created_at',
            'updated_at',
            'created_date',
            'updated_date',
            'answer_pdf',
            'description:ntext',
            'ball',
        ],
    ]) ?>

</div>
