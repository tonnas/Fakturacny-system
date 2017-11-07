<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
$this->title = $person->FIRST_NAME . ' ' . $person->LAST_NAME;
$this->params['breadcrumbs'][] = ['label' => 'ZAMESTNANCI', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="person-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $person,
        'attributes' => [
            'IDENTIFICATION_NUMBER',
            'FIRST_NAME',
            'LAST_NAME',
            'CITY',
            'POST_CODE',
            'STREET',
        ],
    ]) ?>
    <?= DetailView::widget([
        'model' => $user,
        'attributes' => [
            'USERNAME',
            'EMAIL'
        ],
    ]) ?>
</div>
