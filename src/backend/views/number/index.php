<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */

    $this->title = 'Telefónne čísla';
    $this->params['breadcrumbs'][] = $this->title;

?>

<div class="site-index">
    <div class="body-content">
        <div class="row row_container">
            <div class="col-lg-12">
                <div class="person-index">
                    <h1 style="margin-left: 4%"><?php echo Html::encode($this->title) ?></h1>
                    <br>
                    <div style="width: 98%; margin-left: 1%">
                        <?php Pjax::begin(); ?>
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel'  => $searchModel,
                            'options' => ['style' => 'max-height:30px;',
                                'max-width:10px;'],
                            'summary' => '<br>',
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                'PHONE_NUMBER',
                                'IDENTIFICATION_NUMBER',
                            ],
                        ]); ?>
                        <?php Pjax::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
