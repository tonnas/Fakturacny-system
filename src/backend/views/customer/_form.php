<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $person common\models\Person */
/* @var $user common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comment-form">

    <?php $form = ActiveForm::begin(['id' => 'form-create']); ?>

        <div class="container">
            <div class="row">
                <div class="col col-lg-5">
                    <h3>Osoba</h3>

                    <?= $form->field($person, 'IDENTIFICATION_NUMBER')->textInput() ?>

                    <?= $form->field($person, 'FIRST_NAME')->textInput() ?>

                    <?= $form->field($person, 'LAST_NAME')->textInput() ?>

                    <?= $form->field($person, 'CITY')->textInput() ?>

                    <?= $form->field($person, 'POST_CODE')->textInput() ?>

                    <?= $form->field($person, 'STREET')->textInput() ?>

                </div>
                <div class="col col-lg-4">
                    <h3>Pouzivatelsky ucet</h3>

                    <?= $form->field($user, 'username')->textInput() ?>

                    <?= $form->field($user, 'email')->textInput() ?>

                    <?= $form->field($user, 'password')->passwordInput() ?>

                </div>

            </div>
        </div>



        <div class="form-group">
            <?= Html::submitButton('Vytvorit zamestnanca', ['class' => 'btn btn-success', 'name' => 'create-button']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>