<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;

/**
 * Инициализатор RBAC выполняется в консоли php yii rbac/init
 */
class RbacController extends Controller {

    public function actionInit() {
        $auth = Yii::$app->authManager;

        $auth->removeAll(); //На всякий случай удаляем старые данные из БД...

        // Создадим роли админа и редактора новостей
        $admin = $auth->createRole('admin');
        $editor = $auth->createRole('editor');
        $moderator = $auth->createRole('moderator');
        $user = $auth->createRole('user');

        // запишем их в БД
        $auth->add($admin);
        $auth->add($editor);
        $auth->add($moderator);
        $auth->add($user);

        // Создаем разрешения. Например, просмотр админки viewAdminPage и редактирование новости updateNews
        $viewControlPanel = $auth->createPermission('viewControlPanel');
        $viewControlPanel->description = 'View control panel';

        $adminUpdateBot = $auth->createPermission('adminUpdateBot');
        $adminUpdateBot->description = 'Edit the bot';

        $userAddBot = $auth->createPermission('userAddBot');
        $userAddBot->description = 'Adding a bot by the user';

        // Запишем эти разрешения в БД
        $auth->add($viewControlPanel);
        $auth->add($adminUpdateBot);
        $auth->add($userAddBot);

        // Теперь добавим наследования. Для роли editor мы добавим разрешение adminUpdateBot,
        // а для админа добавим наследование от роли editor и еще добавим собственное разрешение viewAdminPage

        // Роли «Редактор ботов» присваиваем разрешение «Редактирование ботов»
        $auth->addChild($editor, $adminUpdateBot);
        $auth->addChild($editor, $viewControlPanel);

        // админ наследует роль редактора новостей. Он же админ, должен уметь всё! :D
        $auth->addChild($admin, $editor);

        // User
        $auth->addChild($user, $userAddBot);

        // Назначаем роль admin пользователю с ID 1
        $auth->assign($admin, 343142692); // voinmerk id
        $auth->assign($user, 343142692); // voinmerk id
    }
}
