<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'Vytvoriť rolu';
$this->params['breadcrumbs'][] = ['label' => 'Role', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="role-create">
    <?= $this->render('_form', [
        'role'  => $role,
    ]) ?>
</div>
