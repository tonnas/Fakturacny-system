<?php

    use yii\helpers\Html;
    use yii\grid\GridView;
    use yii\helpers\Url;
    use yii\bootstrap\Modal;
    use yii\widgets\Pjax;

    /* @var $this yii\web\View */

    $this->title = 'Osoby';
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
                            'Create User',
                            ['value'=>Url::to(['create']),'class'=>'btn btn-info grid-button, modalButton']) ?>
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
                            'CITY',
                            'POST_CODE',
                            'STREET',
                        ],
                    ]); ?>
                    <?php Pjax::end(); ?>
                </div>
            </div>
        </div>

    </div>
</div>
