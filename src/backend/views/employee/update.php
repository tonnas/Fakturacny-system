<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'Upraviť zamestnanca';
$this->params['breadcrumbs'][] = ['label' => 'Zamestnanci', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="employee-create">

    <?= $this->render('_form', [
        'person'  => $person,
        'user'    => $user,
        'address' => $address,
        'office'  => $office,
        'phone'   => $phone,
        'roles'   => $roles,
        'idOperator'   => $idOperator,
        'phoneNumbers' => $phoneNumbers,
    ]) ?>

</div>