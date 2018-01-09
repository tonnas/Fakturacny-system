<?php

use common\models\PhoneNumber;
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'Vytvoriť službu';
$this->params['breadcrumbs'][] = ['label' => 'Služby', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="employee-create">

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
