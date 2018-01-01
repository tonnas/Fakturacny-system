<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;

/* @var $this yii\web\View */

$this->title = 'Zamestnanci';
$this->params['breadcrumbs'][] = ['label' => 'Operator', 'url' => ['site/operator', 'id_operator' => 1]];
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
                            'Vytvorit zamestnanca',
                            ['create'],
                            ['data' => [
                                'method' => 'post',
                                'params' => ['id_operator'=> $idOperator]
                            ]])
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
                                    'template'=>'{update}',
                                    'buttons'=>[
                                        'update' => function ($url, $model) {
                                            return Html::a('<span class="btn btn-info"><b>Upravit</b></span>', $url);
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
</div>
