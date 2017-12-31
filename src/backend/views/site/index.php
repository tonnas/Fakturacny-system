<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'Admin';
?>
<div class="container">
    <div class="row" style="margin-top: 4%">
        <?php foreach ($operators as $operator) { ?>
        <a href="<?= Url::to(['operator', 'id_operator' => $operator->ID_OPERATOR])?>" class="operator-link">
            <div class="panel">
                <div class="panel-head">
                    <div class="panel-head-text"><?= $operator->NAME ?></div>
                </div>
                <div class="panel-content">
                    <table style="width:50%; margin-left: 25%; margin-top: 5%">
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <td>Zamestnanci:</td>
                            <td><b><?= $opCounts[$operator->ID_OPERATOR]['countOfEmployee'] ?></b></td>
                        </tr>
                        <tr>
                            <td>Zákazníci:</td>
                            <td><b><?= $opCounts[$operator->ID_OPERATOR]['countOfCustomers'] ?></b></td>
                        </tr>
                        <tr>
                            <td>Služby:</td>
                            <td><b>0</b></td>
                        </tr>
                    </table>
                </div>
            </div>
        <a>
        <?php } ?>
    </div>
</div>
<style>
    .panel {
        border: 1px solid black;
        /*text-align: center;*/
        width: calc(32% - 25px);
        /*background-color: white;*/
        float: left;
        min-width: 250px;
        min-height: 250px;
        margin: 8px 12px 12px 0;
    }
    .panel-head {
        background-color: #0a0a0a;
        color: white;
        height: 30px;
    }
    .panel-head-text {
        text-align: center;
        font-size: 17px;
        font-weight: bold;
    }
    .panel:hover {
        /*border-width: thin;*/
        border-color: #0b93d5;
    }
    .operator-link {
        text-decoration: none;
        color: black;
    }
</style>