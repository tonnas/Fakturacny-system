<?php

    use yii\helpers\Html;
    use yii\grid\GridView;
    use yii\helpers\Url;
    use yii\bootstrap\Modal;
    use yii\widgets\Pjax;

    /* @var $this yii\web\View */

    $this->title = 'Zamestnanci';
    $this->params['breadcrumbs'][] = $this->title;

    Modal::begin([
        'id'=>'modal',
        'size'=>'modal-lg',
    ]);
    echo "<div id='modalContent'></div>";
    Modal::end();

?>
<div class="site-index">
    <div class="body-content">

        <div class="row">
            <div class="col-lg-12">
                <div class="person-index">
                    <h1><?php echo Html::encode($this->title) ?></h1>

                    <?= Html::button(
                            'Vytvorit zamestnanca',
                            ['value'=>Url::to(['create']),'class'=>'btn btn-info grid-button, modalButton'])
                    ?>
                    <?= Yii::$app->session->getFlash('warning'); ?>
                    <?= Yii::$app->session->getFlash('success'); ?>
                    <?php Pjax::begin(); ?>
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel'  => $searchModel,
                        'options' => ['style' => 'max-height:30px;',
                            'max-width:10px;'],
                        'summary' => '<br>',
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            'IDENTIFICATION_NUMBER',
                            'FIRST_NAME',
                            'LAST_NAME',
                            [
                                'label' => 'Užívateľské meno',
                                'attribute' => 'username',
                                'value' => function ($data){ return $data->username->USERNAME; },
                            ],
                            [
                                'label' => '@ Email',
                                'attribute' => 'email',
                                'value' => function ($data){ return $data->email->EMAIL; },
                            ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'template'=>'{view}{update}{delete}',
                                'buttons'=>[
                                    'view' => function ($url, $model) {
                                        return Html::button('V', ['value' => $url,'class'=>'btn btn-xs btn-info grid-button,    modalButton']);
                                    },
                                    'update' => function ($url, $model) {
                                        return Html::button('U', ['value' => $url,'class'=>'btn btn-xs btn-warning grid-button, modalButton']);
                                    },
                                    'delete' => function ($url, $model) {
                                        return Html::button('R', ['value' => $url,'class'=>'btn btn-xs btn-danger grid-button']);
                                    },
                                ]
                            ],
                        ],
                    ]); ?>
                    <?php Pjax::end(); ?>
                </div>
            </div>
        </div>

    </div>
</div>
