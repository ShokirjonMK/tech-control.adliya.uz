<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?>

    <div class="pull-right">
        <?= Html::a(Yii::t('app', 'Back'), ['index'], ['class' => 'btn btn-warning']) ?>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], [
            'class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this user?'),
                'method' => 'post',
            ],
        ]) ?>
    </div>

    </h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
     
            //'password_hash',
            [
                'attribute'=>'status',
                'value' => $model->getStatusName(),
            ],
            [
                'attribute'=>'item_name',
                'value' => $model->getRoleName(),
            ],
            [
                'attribute' => 'password_hash',
                'value' => function ($img){
                    return '
                    <span id="item_v">t6148177</span>
                    <button class="btn btn-default" id="passwordshower"  data-idec='.$img->id.'>&nbsp;<i class="fa fa-eye"></i>Parolni korish</button>';
                },
                'format' => 'raw'
            ],
            //'auth_key',
            //'password_reset_token',
            //'account_activation_token',
            'created_at:date',
            'updated_at:date',
        ],
    ]) ?>
    <button class="btn btn-default" id="passwordshower" data-url="regionadmin" data-idec="222">&nbsp;<i class="fa fa-eye">Parolni ko'rish</i></button>

</div>
