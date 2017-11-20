<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Admin';
?>
<!--<div class="site-index">-->
<div class="container">
    <div class="row row-head">
        <div style="margin-left: 4%">
            <h1><?= $operator->NAME?></h1>
        </div>
    </div>
    <div class="row" style="margin-top: 4%">
        <?= Html::a('<div class="col col-lg-2 panel operator-link" ><h2 class="operato-title">Zamestnanci</h2><b><p style="margin-top: 30px; font-size: 20px">27 zamestnancov</p></b></div>',
            ['employee/index'],
            ['data' => [
                'method' => 'post',
                'params' =>
                    ['id_operator'=> $operator->ID_OPERATOR],
            ]])
        ?>
        <?= Html::a('<div class="col col-lg-2 panel operator-link" ><h2 class="operato-title">Zakaznici</h2><b><p style="margin-top: 30px; font-size: 20px">112 zakaznikov</p></b></div>',
            ['employee/index'],
            ['data' => [
                'method' => 'post',
                'params' =>
                    ['id_operator'=> $operator->ID_OPERATOR],
            ]])
        ?>

<!--        <a href="" class="operator-link">-->
<!--            <div class="col col-lg-2 panel" >-->
<!--                <h2 class="operato-title">Zakaznici</h2>-->
<!--                <b>-->
<!--                    <p style="margin-top: 30px; font-size: 20px">754 zakaznikov</p>-->
<!--                </b>-->
<!--            </div>-->
<!--        <a>-->
<!--        <a href="" class="operator-link">-->
<!--            <div class="col col-lg-2 panel" >-->
<!--                <h2 class="operato-title">Sluzby</h2>-->
<!--                <b>-->
<!--                    <p style="margin-top: 30px; font-size: 20px">14 sluzieb</p>-->
<!--                </b>-->
<!--            </div>-->
<!--        <a>-->
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
        margin: 8px 25px 0 0;
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