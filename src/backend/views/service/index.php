<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
    use yii\grid\GridView;
    use yii\helpers\Url;
    use yii\bootstrap\Modal;
    use yii\widgets\Pjax;

    /* @var $this yii\web\View */

    $this->title = 'Služby';
    $this->params['breadcrumbs'][] = $this->title;

?>

<div class="site-index">
    <div class="body-content">
        <div class="row row_container">
            <div class="col-lg-12">
                <div class="person-index">
                    <h1 style="margin-left: 4%">
                        <?php echo Html::encode($this->title) ?>
                    </h1>
                    <div style="margin-left: 4%">
                        <?= Html::a('Vytvorit službu', ['create']) ?>
                    </div>
                    <br>
                    <div style="width: 98%; margin-left: 1%">
                        <?php Pjax::begin(); ?>
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel'  => $searchModel,
                            'options' => ['style' => 'max-height:30px;',
                                'max-width:10px;'],
                            'summary' => '<br>',
                            'rowOptions' => function ($model, $key, $index, $grid) {
                                $u= \yii\helpers\StringHelper::basename(get_class($model));
                                $u= yii\helpers\Url::toRoute(['/'.strtolower($u).'/update']);
                                return [
                                    'id' => $model['ID_SERVICE'],
                                    'onclick' => 'location.href="'.$u.'?id="+(this.id)',
                                    'onmouseover' => 'this.classList.add("success")',
                                    'onmouseout' => 'this.classList.remove("success")'
                                ];
                            },
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                'NAME',
                                [
                                    'attribute' => 'DATE_FROM',
                                    'format' => ['date', 'php:d.m.Y h:i:s'],
                                    'filter' => DatePicker::widget([
                                        'model' => $searchModel,
                                        'name' => 'start_date',
                                        'value' => '',
                                        'pluginOptions' => [
                                            'format' => 'dd-mm-yyyy',
                                            'autoclose' => true,
                                        ]
                                    ])
                                ],
                            ],
                        ]); ?>
                        <?php Pjax::end(); ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>