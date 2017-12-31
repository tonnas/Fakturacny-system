<?php

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
        <div class="row">
            <div class="col-lg-12">
                <h1 style="margin-left: 2%">
                    <?php echo Html::encode($this->title) ?>
                </h1>
            </div>
        </div>

        <div class="row" style="margin-top: 4%">
            <?= Html::a('<div class="col col-lg-2 panel operator-link" ><h2 class="operato-title ">Párové služby</h2><b><p style="margin-top: 30px; font-size: 20px"></p></b></div>',
                ['service/pair'])
            ?>
            <?= Html::a('<div class="col col-lg-2 panel operator-link" ><h2 class="operato-title">Minútové služby</h2><b><p style="margin-top: 30px; font-size: 20px"></p></b></div>',
                ['service/minute'])
            ?>
            <?= Html::a('<div class="col col-lg-2 panel operator-link" ><h2 class="operato-title">Sms služby</h2><b><p style="margin-top: 30px; font-size: 20px"></p></b></div>',
                ['service/sms'])
            ?>
            <?= Html::a('<div class="col col-lg-2 panel operator-link" ><h2 class="operato-title ">Internetové služby</h2><b><p style="margin-top: 30px; font-size: 20px"></p></b></div>',
                ['service/net'])
            ?>
            <?= Html::a('<div class="col col-lg-2 panel operator-link" ><h2 class="operato-title">Balíčky služieb</h2><b><p style="margin-top: 30px; font-size: 20px"></p></b></div>',
                ['service/package'])
            ?>
            <?= Html::a('<div class="col col-lg-2 panel operator-link" ><h2 class="operato-title">Cenník služieb</h2><b><p style="margin-top: 30px; font-size: 20px"></p></b></div>',
                ['service/tariff'])
            ?>
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