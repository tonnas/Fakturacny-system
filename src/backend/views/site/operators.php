<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Admin';
?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">
<!--<div class="site-index">-->
<div class="container">
    <div class="row" style="margin-top: 4%">
        <?php foreach ($operators as $operator) { ?>

            <?= Html::button(
                    $operator->NAME, [
                        'value' => Url::to(['site/login-operator', 'operator' => $operator->ID_OPERATOR]),
                        'class'=>'btn btn-xs btn-info grid-button modalButton'
                    ]
            ) ?>

        <?php } ?>
    </div>
</div>
<style>
    .panel {
        text-align: center;
        width: calc(25% - 25px);
        margin-left: 2%;
        background-color: whitesmoke;
        float: left;
        min-width: 250px;
        min-height: 250px;
        /*margin: 8px 25px 0 0;*/
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
    .modalButton {
        font-size: 30px;
        height: 200px;
        width: 200px;
    }
    .modal-backdrop {
        display: none;
    }
</style>