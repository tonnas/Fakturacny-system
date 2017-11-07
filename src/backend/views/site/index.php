<?php

/* @var $this yii\web\View */

$this->title = 'Admin';
?>
<!--<div class="site-index">-->
    <div class="container">
        <div class="row row-head">
            <div style="margin-left: 4%">
                <h1>Administracia</h1>
                <p> Sem hodim nejake info ako pocet zamestnancov, zakaznikov, zisk, naklady</p>
            </div>
        </div>
        <div class="row row_container">
        </div>
        <div class="row">

        </div>
    </div>

<!--</div>-->

<style>
    .container {
        height: 100%;
    }
    .check_item {
        border-radius: 3%;
        /*border: groove;*/
        float: left;
        text-align: center;
        margin-left: 3%;
        margin-top: 3%;
        height: 100px;
        background-color: #00b3ee;
        box-shadow: -1px 1px 15px 1px #000;
    }
    .check_item:hover {
        background-color: cyan;
    }
    .title-item {
        margin-top: 20%;
        font-weight: bold;
        font-size: 150%;
    }
    .row_container {
        background-color: whitesmoke;
        text-align: center;
        margin-top: 2%;
        height: 75%;
    }
    .row-head {
        background-color: whitesmoke;
        /*text-align: center;*/
        height: 20%;
    }
</style>