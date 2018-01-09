<?php

use kartik\select2\Select2;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */

    $this->title = 'Pobocka';
    $this->params['breadcrumbs'][] = $this->title;

?>
<div class="site-index">
    <div class="body-content">

        <div class="row row_container">
            <div class="col-lg-12">
                <div class="person-index">
                    <h1><?php echo Html::encode($this->title) ?></h1>
                    <div>
                        <?= Html::a('Vytvorit pobocku', ['create-office']) ?>
                    </div>
                    <br>
                    <div>
                        <?php Pjax::begin(); ?>
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel'  => $searchModel,
                            'options' => ['style' => 'max-height:30px;',
                                'max-width:10px;'],
                            'summary' => '<br>',
                            'columns' => [
//                                ['class' => 'yii\grid\SerialColumn'],
                                [
                                    'attribute' => 'ID_ADDRESS',
                                    'headerOptions' => ['style' => 'width:10%; text-align:center'],
                                ],
                                [
                                    'label' => 'Mesto',
                                    'value' => function($data) {
                                        return \common\models\Office::getCity($data->ID_ADDRESS);
                                    },
                                    'filter' => Select2::widget([
                                        'name' => 'ObjectSearch[type]',
                                        'data' => \common\models\City::getAutocomleteData(),
//                                        'theme' => Select2::THEME_BOOTSTRAP,
//                                        'hideSearch' => true,
                                        'options' => [
                                            'placeholder' => 'Hladat mesto',
                                            'value' => isset($_GET['ObjectSearch[type]']) ? $_GET['ObjectSearch[type]'] : null
                                        ]
                                    ]),
                                    'headerOptions' => ['style' => 'width:40%'],
                                ],
                                [
                                    'label' => 'Ulica',
                                    'value' => function($data) {
                                        return \common\models\Office::getStreet($data->ID_ADDRESS);
                                    },
                                    'filter' => 0,
                                    'headerOptions' => ['style' => 'width:50%'],
                                ]
                            ],
                        ]); ?>
                        <?php Pjax::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
