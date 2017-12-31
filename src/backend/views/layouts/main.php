<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use kartik\sidenav\SideNav;


Modal::begin([
    'id'=>'modal',
    'size'=>'modal-xs',
]);
echo "<div id='modalContent'></div>";
Modal::end();

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>

    <div class="body">
        <div class="mine-navbar">
            <?php if (Yii::$app->user->isGuest) { ?>
            <?php } else { ?>
                <div class="sidebar-head">
<!--                    <h3 class="mine-sitebar-head-name">FS</h3>-->
                </div>
<!--                <div class="block-date">-->
<!--                    <b style="color: white">--><?//= date('Y-m-d') ?><!--</b>-->
<!--                </div>-->

                <a href="<?= Url::to(['site/logout']); ?>" data-method="post" style="text-decoration: none; color: white">
                    <div class="logout-button">
                        <div style="margin-top: 10px; font-weight: bold">
                            <?= 'Logout'?>
                        </div>
                    </div>
                </a>
            <?php } ?>
        </div>
        <div class="mine-sitebar">
            <div style="height: 7%"></div>
            <?php if (!Yii::$app->user->isGuest) { ?>

                <a href="<?= Url::to(['site/index']); ?>" style="text-decoration: none">
                    <div class="mine-sitebar-item">
                        <div class="mine-sitebar-item-name">
                            <span class="glyphicon glyphicon-home"></span>  Admin
                        </div>
                    </div>
                </a>
                <a href="<?= Url::to(['role/index']); ?>" style="text-decoration: none">
                    <div class="mine-sitebar-item">
                        <div class="mine-sitebar-item-name">
                            <span class="glyphicon glyphicon-lock"></span>  Role
                        </div>
                    </div>
                </a>
<!--                <a href="--><?//= Url::to(['number/index']); ?><!--" style="text-decoration: none">-->
<!--                    <div class="mine-sitebar-item">-->
<!--                        <div class="mine-sitebar-item-name">-->
<!--                            <span class="glyphicon glyphicon-earphone"></span>  T.čísla-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </a>-->
<!--                <a href="--><?php//= Url::to(['employee/index']); ?><!--" style="text-decoration: none">-->
<!--                    <div class="mine-sitebar-item">-->
<!--                        <div class="mine-sitebar-item-name">-->
<!--                            <span class="glyphicon glyphicon-list-alt"></span>  Zamestnanci-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </a>-->
<!--                <a href="--><?php//= Url::to(['customer/index']); ?><!--" style="text-decoration: none">-->
<!--                    <div class="mine-sitebar-item">-->
<!--                        <div class="mine-sitebar-item-name">-->
<!--                            <span class="glyphicon glyphicon-user"></span>  Zakaznici-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </a>-->
<!--                <a href="--><?php//= Url::to(['invoice/index']); ?><!--" style="text-decoration: none">-->
<!--                    <div class="mine-sitebar-item">-->
<!--                        <div class="mine-sitebar-item-name">-->
<!--                            <span class="glyphicon glyphicon-calendar"></span>  Faktury-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </a>-->
                <a href="<?= Url::to(['site/index']); ?>" style="text-decoration: none">
                    <div class="mine-sitebar-item">
                        <div class="mine-sitebar-item-name">
                            <span class="glyphicon glyphicon-alert"></span> Logy
                        </div>
                    </div>
                </a>
            <?php } else { ?>
                <a href="<?= Url::to(['site/login']); ?>" style="text-decoration: none">
                    <div class="mine-sitebar-item">
                        <div class="mine-sitebar-item-name">
                            <span class="glyphicon glyphicon-home"></span>  Super-Admin
                        </div>
                    </div>
                </a>
                <a href="<?= Url::to(['site/operators']); ?>" style="text-decoration: none">
                    <div class="mine-sitebar-item">
                        <div class="mine-sitebar-item-name">
                            <span class="glyphicon glyphicon-list-alt"></span>  Operator
                        </div>
                    </div>
                </a>
            <?php } ?>
        </div>
        <div class="mine-sitebar-hide"></div>
        <div class="mine-content">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
            <div style="height: 150px"></div>
        </div>
    </div>
<!--    <div class="mine-footer"></div>-->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
