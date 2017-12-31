<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Admin';
?>
<!--<div class="site-index">-->
<div class="container">
    <div class="row">
<!--    <div class="row row-head">-->
<!--        <div style="margin-left: 4%">-->
            <h1><?= $operator->NAME?></h1>
<!--        </div>-->
    </div>
    <div class="row" style="margin-top: 4%">
        <?= Html::a('<div class="col col-lg-2 panel operator-link" >'
                        .'<h2 class="operato-title ">'
                        .'<span class="glyphicon glyphicon-briefcase"></span> Zamestnanci'
                        .'</h2>'
                        .'<b><p style="margin-top: 30px; font-size: 20px"><h2>' .$employeeCount.'</h2></p></b>'
                      .' </div>',
            ['employee/index']
        )
        ?>
        <?= Html::a('<div class="col col-lg-2 panel operator-link" ><h2 class="operato-title"><span class="glyphicon glyphicon-user"></span> Zákazníci</h2><b><p style="margin-top: 30px; font-size: 20px"><h2>' .$customerCount.'</h2></p></b></div>',
            ['customer/index']
        )
        ?>
        <?= Html::a('<div class="col col-lg-2 panel operator-link" ><h2 class="operato-title"><span class="glyphicon glyphicon-list-alt"></span> Služby</h2><b><p style="margin-top: 30px; font-size: 20px"><h2>0</h2></p></b></div>',
            ['service/index']
        )
        ?>
        <?= Html::a('<div class="col col-lg-2 panel operator-link" ><h2 class="operato-title"><span class="glyphicon glyphicon-earphone"></span> Tel. cisla</h2><b><p style="margin-top: 30px; font-size: 20px"><h2>0</h2></p></b></div>',
            ['number/index']
        )
        ?>
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