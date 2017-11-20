<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $person common\models\Person */
/* @var $user common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employee-form">

    <?php $form = ActiveForm::begin(['id' => 'form-create']); ?>

        <div class="container">
            <div class="row">
                <div class="col col-lg-3 panel" >
                    <h3>Zamestnanec</h3>

                    <?= $form->field($person, 'IDENTIFICATION_NUMBER')->textInput() ?>

                    <?= $form->field($person, 'FIRST_NAME')->textInput() ?>

                    <?= $form->field($person, 'LAST_NAME')->textInput() ?>

                </div>
                <div class="col col-lg-3 panel">
                    <h3>Adresa</h3>

                    <?= $form->field($address, 'ID_CITY')->widget(\yii\jui\AutoComplete::classname(), [
                        'clientOptions' => [
                            'source' => \common\models\City::getAutocomleteData(),
                            'options' => ['class' => 'form-control', 'z-index' => 100]
                        ],
                    ])->textInput() ?>

                    <?= $form->field($address, 'STREET')->textInput() ?>

                    <?= $form->field($address, 'STREET_NUMBER')->textInput() ?>

                </div>
                <div class="col col-lg-3 panel">
                    <h3>Používateľský účet</h3>

                    <?= $form->field($user, $person->isNewRecord ? 'username' : 'USERNAME')->textInput() ?>

                    <?= $form->field($user, $person->isNewRecord ? 'email' : 'EMAIL')->textInput() ?>

                    <?= $form->field($user, 'ID_OPERATOR')->hiddenInput(['value'=> $idOperator])->label(false) ?>

                    <?php if ($person->isNewRecord) { ?>
                        <?= $form->field($user, 'password')->passwordInput() ?>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col col-lg-3 panel">
                    <h3>Pobočka</h3>

                    <?= $form->field($office, 'ID_OFFICE')->textInput() ?>

                </div>
            </div>

            <div class="form-group">
                <?= Html::submitButton($person->isNewRecord ? 'Vytvorit zamestnanca' : 'Upraviť zamestnanca',
                    ['class' => 'btn btn-success', 'name' => 'create-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

</div>
<style>
    .panel {
        width: calc(33% - 25px);
        margin-left: 2%;
        background-color: whitesmoke;
        float: left;
        min-width: 350px;
        /*margin: 8px 25px 0 0;*/
    }
    .panel:hover {
        /*border-width: thin;*/
        border-color: #00b3ee;
    }
</style>