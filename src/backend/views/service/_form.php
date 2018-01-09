<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employee-form">

    <?php $form = ActiveForm::begin(['id' => 'form-create']); ?>

        <div class="container">
            <div class="row">
                <div class="col col-lg-3 panel" >

                    <?= $form->field($model, 'NAME')->textInput() ?>

                </div>
            </div>
            <div class="row">
                <div class="col col-lg-3 panel" >
                    minuty
                </div>
                <div class="col col-lg-3 panel" >
                    sms
                </div>
            </div>
            <div class="row">
                <div class="col col-lg-3 panel" >
                    mms
                </div>
                <div class="col col-lg-3 panel" >
                    internet
                </div>
            </div>
            <div class="row">
                <div class="col col-lg-2 outer">
                    <div class="inner">
                        <?= Html::submitButton($model->isNewRecord ? 'Vytvoriť službu' : 'Upraviť službu',
                            ['class' => 'btn btn-success', 'name' => 'create-button'])
                        ?>
                    </div>
                    <div class="inner">
                        <?= Html::a('Zmazať službu',
                            ['delete', 'id' => $model->ID_SERVICE],
                            ['class' => 'btn btn-danger',
                                'data' => [
                                    'confirm' => "Are you sure you want to delete service?",
                                    'method' => 'post',
                                ],
                            ]
                        ) ?>
                    </div>
               </div>
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
    .outer {
        width:100%;
    }
    .inner {
        display: inline-block;
    }
</style>
