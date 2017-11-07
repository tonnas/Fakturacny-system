<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use kartik\sidenav\SideNav;

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

<!--<div class="wrap" style="height: 100%;">-->
<!--    --><?php
//        NavBar::begin([
//            'brandLabel' => 'Fakturacny system',
//            'brandUrl' => Yii::$app->homeUrl,
//            'options' => [
//                'class' => 'navbar-inverse navbar-fixed-top',
//            ],
//        ]);
//        $menuItems = [
//            ['label' => 'Home', 'url' => ['/site/index']],
//        ];
//        if (Yii::$app->user->isGuest) {
//            $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
//        } else {
//            $menuItems[] = '<li>'
//                . Html::beginForm(['/site/logout'], 'post')
//                . Html::submitButton(
//                    'Logout (' . Yii::$app->user->identity->USERNAME . ')',
//                    ['class' => 'btn btn-link logout']
//                )
//                . Html::endForm()
//                . '</li>';
//        }
//        echo Nav::widget([
//            'options' => ['class' => 'navbar-nav navbar-right'],
//            'items' => $menuItems,
//        ]);
//        NavBar::end();
//    ?>
    <div style="height: 100%;">
        <div class="mine-sitebar">
            <div class="sidebar-head">
                <h3 class="mine-sitebar-head-name">FS</h3>
            </div>
            <a href="<?= Url::to(['site/index']); ?>" style="text-decoration: none">
                <div class="mine-sitebar-item">
                    <div class="mine-sitebar-item-name">Domov</div>
                </div>
            </a>
            <a href="<?= Url::to(['person/index']); ?>" style="text-decoration: none">
                <div class="mine-sitebar-item">
                    <div class="mine-sitebar-item-name">Zamestnanci</div>
                </div>
            </a>
            <a href="#" style="text-decoration: none">
                <div class="mine-sitebar-item">
                    <div class="mine-sitebar-item-name">Zakaznici</div>
                </div>
            </a>
            <a href="#" style="text-decoration: none">
                <div class="mine-sitebar-item">
                    <div class="mine-sitebar-item-name">Faktury</div>
                </div>
            </a>
            <a href="<?= Url::to(['person/index']); ?>" style="text-decoration: none">
                <div class="mine-sitebar-item">
                    <div class="mine-sitebar-item-name">Logy</div>
                </div>
            </a>
        </div>
        <div class="mine-navbar">
            <?php
            if (Yii::$app->user->isGuest) {
                ?>
                <b class="mine-navbar-username">Login</b>
                <?php
            } else {
                ?>
                <div style="float: left; min-width: 200px; width: 20%; text-align: left; margin-left: 2%; height: 100%">
                    <b><?= date('Y-m-d') ?></b>
                </div>
                <div style="width: 95%; min-width: 140px; height: 100%">
                    <a>
                        <b class="mine-navbar-username"><?= 'Logout (' . Yii::$app->user->identity->USERNAME . ')' ?></b>
                    </a>
                </div>
                <?php
            }
            ?>
        </div>
        <div class="mine-content">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
        <div class=".mine-navbar-border">
        </div>
    </div>
    <div class="mine-footer"></div>
<!--</div>-->

<!--<footer class="footer">-->
<!--    <div class="container">-->
<!--        <p class="pull-left">&copy; Fakturacny system --><?//= date('Y') ?><!--</p>-->
<!---->
<!--        <p class="pull-right"> Tomas Illo</p>-->
<!--    </div>-->
<!--</footer>-->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
