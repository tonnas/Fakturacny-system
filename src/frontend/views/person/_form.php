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

                    <?= $form->field($person, 'ID_USER')->textInput(['autofocus' => true]) ?>

                    <?= $form->field($person, 'FIRST_NAME')->textInput( ['value' => ' ']) ?>

                    <?= $form->field($person, 'LAST_NAME')->textInput( ['value' => ' ']) ?>

                    <?= $form->field($person, 'CITY')->textInput( ['value' => ' ']) ?>

                    <?= $form->field($person, 'POST_CODE')->textInput( ['value' => ' ']) ?>

                    <?= $form->field($person, 'STREET')->textInput( ['value' => ' ']) ?>

                </div>
                <div class="col col-lg-4">
                    <h3>Pouzivatelsky ucet</h3>

                    <?= $form->field($user, 'username')->textInput( ['value' => ' ']) ?>

                    <?= $form->field($user, 'email')->textInput( ['value' => ' ']) ?>

                    <?= $form->field($user, 'password')->passwordInput() ?>

                </div>

            </div>
        </div>



        <div class="form-group">
            <?= Html::submitButton('create', ['class' => 'btn btn-primary', 'name' => 'create-button']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>