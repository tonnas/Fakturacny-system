<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

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
                    <h3>Osobné údaje</h3>
                    <div title="Musi obsahovat 10 cislic bez lomitka">
                        <?= $form->field($person, 'IDENTIFICATION_NUMBER')->textInput() ?>
                    </div>

                    <?= $form->field($person, 'FIRST_NAME')->textInput() ?>

                    <?= $form->field($person, 'LAST_NAME')->textInput() ?>

                </div>
                <div class="col col-lg-3 panel">
                    <h3>Adresa</h3>

                    <?= $form->field($address, 'ID_CITY')->widget(Select2::classname(), [
                            'data' => \common\models\City::getAutocomleteData(),
                            'language' => 'sk',
                            'options' => ['placeholder' => 'Vyber mesto...'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]); ?>

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
            <div class="row">
                <div class="col col-lg-3 panel">
                    <h3>Telefónne číslo</h3>

                    <?= $form->field($phone, 'PHONE_NUMBER')->widget(Select2::classname(), [
                        'data' => $phoneNumbers,
                        'language' => 'sk',
                        'options' => ['placeholder' => 'Vyber telefonne cislo...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]); ?>

                </div>
                <div class="col col-lg-3 panel">
                    <h3>Pobočka</h3>
                    <?= $form->field($office, 'ID_OFFICE')->widget(Select2::classname(), [
                        'data' => \common\models\Office::getOperatorOfficies(1),
                        'language' => 'sk',
                        'options' => ['placeholder' => 'Vyber pobocku'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]); ?>

                </div>
                <div class="col col-lg-3 panel">
                    <h3>Rola</h3>
                    <?= $form->field($user, $person->isNewRecord ? 'role_name' : 'ROLE_NAME')->dropDownList(ArrayHelper::map($roles, 'NAME', 'NAME'), [
                        'prompt' => '',
                        'onchange' => 'set_role_permissions()',
                        'class' => 'selectpicker form-control',
                        'multiple' => false,
                        //'size' => 10
                    ])->label(Yii::t('app', 'Role'))
                    ?>
                </div>
            </div>
            <br>

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
