<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'Vytvoriť zamestnanca';
$this->params['breadcrumbs'][] = ['label' => 'Zamestnanci', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="employee-create">

    <?= $this->render('_form', [
        'person'  => $person,
        'user'    => $user,
        'address' => $address,
        'office'  => $office,
        'phone'  => $phone,
        'idOperator' => $idOperator
    ]) ?>

</div>
