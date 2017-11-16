<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'Vytvorit osobu';
$this->params['breadcrumbs'][] = ['label' => 'Comments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="person-create">

    <?= $this->render('_form', [
        'person'   => $person,
        'user'     => $user,
    ]) ?>

</div>
