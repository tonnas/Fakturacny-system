<?php

    use yii\helpers\Html;
    use yii\grid\GridView;
    use yii\helpers\Url;
    use yii\bootstrap\Modal;
    use yii\widgets\Pjax;

    /* @var $this yii\web\View */

    $this->title = 'Zakaznici';
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

        <div class="row row_container">
            <div class="col-lg-12">
                <div class="person-index">
                    <h1 style="margin-left: 4%">
                        <?php echo Html::encode($this->title) ?>
                    </h1>
                    <div style="margin-left: 4%">
                        <?= Html::a(
                            'Vytvoriť zákazníka',
                            ['create'],
                            ['data' => [
                                'method' => 'post',
                                'params' => ['id_operator'=> $idOperator]
                            ]]
//                            ['class'=>'btn btn-info grid-button'],
                        )
                        ?>
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
                                    'template'=>'{view}{update}',
                                    'buttons'=>[
                                        'view' => function ($url, $model) {
                                            return Html::button('', ['value' => $url,'class'=>'btn btn-xs btn-info glyphicon glyphicon-open-eye']);
                                        },
                                        'update' => function ($url, $model) {
                                            return Html::a('<span class="btn btn-xs btn-warning glyphicon glyphicon-cog"></span>', $url);
                                        },
//                                        'delete' => function ($url, $model) {
//                                            return Html::button('R', ['value' => $url,'class'=>'btn btn-xs btn-danger grid-button']);
//                                        },
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
</div>
