<?php

    use yii\helpers\Html;
    use yii\grid\GridView;
    use yii\helpers\Url;
    use yii\bootstrap\Modal;
    use yii\widgets\Pjax;

    /* @var $this yii\web\View */

    $this->title = 'Role a práva';
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
                    <br>
                    <div style="margin-left: 4%">
                        <?= Html::button(
                            'Vytvorit rolu', [
                                'value' => Url::to(['create-role']),
                                'class'=>'btn btn-xs btn-info grid-button modalButton'
                            ]
                        ) ?>
                    </div>
                    <br>
                    <div style="width: 98%; margin-left: 1%">
<!--                        --><?php //Pjax::begin(); ?>
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'options' => ['style' => 'max-height:30px;',
                                'max-width:10px;'],
                            'summary' => '<br>',
                            'columns' => [
                                [
                                    'attribute'=>'NAME',
                                    'format'=>'raw',
                                    'value' => function($data)
                                    {
                                        return Html::a($data->NAME, ['view', 'id' => $data->NAME], ['title' => 'Zobraziť detail pre rolu ' . $data->NAME]);
                                    }
                                ],
                            ],
                        ]); ?>
<!--                        --><?php //Pjax::end(); ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<style>
    .panel {
        text-align: center;
        width: calc(25% - 25px);
        /*margin-left: 2%;*/
        background-color: whitesmoke;
        float: left;
        min-width: 250px;
        min-height: 250px;
        margin: 8px 25px 8px 0;
    }
    .panel:hover {
        /*border-width: thin;*/
        border-color: #00b3ee;
    }
    .operato-title {
        margin-top: 40px;
    }
    .operator-link {
        text-decoration: none;
        color: black;
    }
</style>