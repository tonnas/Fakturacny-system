<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */

$this->title = 'Osoby';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">
    <div class="body-content">

        <div class="row">
            <div class="col-lg-12">
                <div class="article-index">

                    <h1><?php echo Html::encode($this->title) ?></h1>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'options' => ['style' => 'max-height:30px;',
                            'max-width:10px;'],
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            'IDENTIFICATION_NUMBER',
                            'FIRST_NAME',
                            'LAST_NAME',
                            'STREET',
                            'POST_CODE'
                        ],
                    ]); ?>

                </div>
            </div>
        </div>

    </div>
</div>
