<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $person common\models\Person */
/* @var $user common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="site-login">
    <h3 style="text-align: center"><?= Html::encode($this->title) ?></h3>
    <br><br>
    <div class="row" >
        <div class="center" style="max-width: 500px; width: 40%; min-width: 300px; margin-left: 30%">
        <?php $form = ActiveForm::begin(['id' => 'form-create']); ?>

        <?= $form->field($role, 'NAME')->textInput() ?>

        <div class="form-group">
            <?= Html::submitButton($role->isNewRecord ? 'Vytvorit rolu' : 'Upraviť rolu',
                ['class' => 'btn btn-xs btn-info grid-button', 'name' => 'create-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>