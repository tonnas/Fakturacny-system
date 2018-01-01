<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="office-create">

    <?php $form = ActiveForm::begin(['id' => 'form-create']); ?>

    <div class="row" >
        <div class="center" style="max-width: 500px; width: 40%; min-width: 300px; margin-left: 30%">
            <h3>Adresa</h3>

            <?= $form->field($address, 'ID_CITY')->widget(Select2::classname(), [
                'name' => 'state_40',
                'data' => \common\models\City::getAutocomleteData(),
                'options' => ['placeholder' => 'Vyber mesto...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])?>

            <?= $form->field($address, 'STREET')->textInput() ?>

            <?= $form->field($address, 'STREET_NUMBER')->textInput() ?>

            <br>
            <div class="form-group">
                <?= Html::submitButton($office->isNewRecord ? 'Vytvorit pobocku' : 'Upraviť pobocku',
                    ['class' => 'btn btn-success', 'name' => 'create-button']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
