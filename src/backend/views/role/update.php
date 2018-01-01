<?php

use softark\duallistbox\DualListbox;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
$this->title = 'Rola "' . $role->NAME . '"';
$this->params['breadcrumbs'][] = ['label' => 'Role', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-index">
    <div class="body-content">

        <?php if ($role->NAME != 'All') { ?>

        <?php $form = ActiveForm::begin(['id' => 'form-create']); ?>

        <div class="row row_container">
<!--        <div class="row row_container">-->
            <div class="col-sm-12">
                <div class="person-index">
                    <h1 style="margin-left: 4%">
                        <?php echo Html::encode($this->title) ?>
                    </h1>
                    <br>
                    <div style="width: 98%; margin-left: 1%">
                        <?= DualListbox::widget([
                            'name' => 'permissions',
                            'selection' => ArrayHelper::map($role_permissions, 'ID_PERMISSION', 'NAME'),
                            'items' => ArrayHelper::map($model, 'NAME', function ($value) {
                                return $value['NAME'];
                            }),
                            'options' => ['multiple' => true, 'size' => 10],
                            'clientOptions' => [
                                'moveOnSelect' => true,
                            ],
                        ]); ?>
                    </div>
                </div>
                <br>
                <div class="form-group" style="margin-left: 1%">
                    <?= Html::submitButton('Upraviť rolu',
                        ['class' => 'btn btn-info', 'name' => 'create-button']) ?>
                </div>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

        <?php } ?>

    </div>
</div>
