<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'Admin';
?>
<!--<div class="site-index">-->
<div class="container">
    <div class="row row-head">
        <div style="margin-left: 4%">
            <h1>Administracia</h1>
        </div>
    </div>
    <div class="row" style="margin-top: 4%">
        <?php foreach ($operators as $operator) { ?>
        <a href="<?= Url::to(['operator', 'id_operator' => $operator->ID_OPERATOR])?>" class="operator-link">
                <div class="col col-lg-2 panel" >
                    <h3 class="operato-title"><?= $operator->NAME ?></h3>
                    <p style="margin-top: 30px"> Sem hodim napriklad pocet aktivnych cisiel, pocet zamestnancov, pobociek a podobne</p>
                </div>
            <a>
        <?php } ?>
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