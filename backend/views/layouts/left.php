<?php

$menuItems = [
    // Main menu
    ['label' => 'Меню', 'options' => ['class' => 'header']],
    ['label' => 'Панель состояния', 'icon' => 'tachometer', 'url' => ['/site/index']],
    [
        'label' => 'Каталог',
        'icon' => 'newspaper-o',
        'url' => '#',
        'items' => [
            ['label' => 'Категории', 'icon' => 'circle-o', 'url' => ['/category']],
            ['label' => 'Боты', 'icon' => 'circle-o', 'url' => ['/bot']],
            ['label' => 'Комментарии', 'icon' => 'circle-o', 'url' => ['/comment']],
        ],
    ],
    [
        'label' => 'Локализация',
        'icon' => 'newspaper-o',
        'url' => '#',
        'items' => [
            ['label' => 'Тексты', 'icon' => 'circle-o', 'url' => ['/message']],
        ],
    ],

    // Development
    ['label' => 'Разработка', 'options' => ['class' => 'header']],
    ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
    /*['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
    [
        'label' => 'Some tools',
        'icon' => 'share',
        'url' => '#',
        'items' => [
            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
            [
                'label' => 'Level One',
                'icon' => 'circle-o',
                'url' => '#',
                'items' => [
                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                    [
                        'label' => 'Level Two',
                        'icon' => 'circle-o',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                        ],
                    ],
                ],
            ],
        ],
    ],*/
];

?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= $user->username ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> В сети</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Искать..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget([
            'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
            'items' => $menuItems
        ]); ?>

    </section>

</aside>
