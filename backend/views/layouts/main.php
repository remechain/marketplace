<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'My Company',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Управление бизнес аккаунтом', 'items' => [
            ['label' => 'Управление бизнес аккаунтом', 'url' => ['/business-user-account/index']],
            ['label' => 'Управление компаниями', 'url' => ['/company/index']],
        ]],
        ['label' => 'Управление заявками ломоздатчика', 'url' => ['/request/index']],

        ['label' => 'Управление металлами', 'items' => [
                ['label' => 'Управление категории мет-ма', 'url' => ['/category-scrap/index']],
                ['label' => 'Категории мет-ма по ГОСТ', 'url' => ['/category-scrap-gost/index']],
                ['label' => 'Тип металлолома', 'url' => ['/type-scrap-gost/index']],
                ['label' => 'Страница металлолома', 'url' => ['/scrap-page/index']],
        ]],

        ['label' => 'Управление блогом', 'items' => [
                ['label' => 'Категории блога', 'url' => ['/category-blog/index']],
                ['label' => 'Страницы блога', 'url' => ['/blog-pages/index']],
        ]],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
