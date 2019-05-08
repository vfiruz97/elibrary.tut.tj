<?php
/**
 * Author: Akhmedov Farkhod, a.farkhod@gmail.com
 * Date: 11.08.17
 * Time: 00:08
 */
namespace app\console\controllers;

use Yii;
use yii\console\Controller;
use app\components\access\rules\permissions\DeleteUserRule;
use app\components\access\rules\permissions\UpdateRule;
use app\components\access\rules\roles\AdminRule;
use app\models\User;

class RbacController extends Controller
{
    /**
     * Init roles and permissions
     */
    public function actionInit()
    {
        $auth = Yii::$app->getAuthManager();
        $auth->removeAll();

        // Создание роли
        $adminRole = $auth->createRole('adminRole');
        $adminRole->description = 'Администратор';

        // Правило расширяющее права для роли "Администратор"
        $adminRoleRule = new AdminRule();
        $auth->add($adminRoleRule);

        $adminRole->ruleName = $adminRoleRule->name;
        $auth->add($adminRole);

        $userRole = $auth->createRole('userRole');
        $userRole->description = 'Пользователь';
        $auth->add($userRole);

        $updateRule = new UpdateRule();
        $auth->add($updateRule);

        // Создание разрешений
        $showDeletedRows = $auth->createPermission('showDeletedRows');
        $showDeletedRows->description = 'Просмотр удаленных записей';
        $auth->add($showDeletedRows);

       


        $readSettings = $auth->createPermission('readSettings');
        $readSettings->description = 'Настройки';
        $auth->add($readSettings);

        $readUsers = $auth->createPermission('readUsers');
        $readUsers->description = 'Управление пользователями';
        $auth->add($readUsers);

        $createUser = $auth->createPermission('createUser');
        $createUser->description = 'Создание пользователя';
        $auth->add($createUser);

        $updateUser = $auth->createPermission('updateUser');
        $updateUser->description = 'Редактирование пользователя';
        $auth->add($updateUser);

        $deleteUser = $auth->createPermission('deleteUser');
        $deleteUser->description = 'Удаление пользователя';

        $deleteUserRule = new DeleteUserRule();
        $auth->add($deleteUserRule);

        $deleteUser->ruleName = $deleteUserRule->name;
        $auth->add($deleteUser);
        
        $mainPage = $auth->createPermission('mainPage');
        $readSettings->description = 'Главная страница';
        $auth->add($mainPage);
        
        $readBook = $auth->createPermission('readBook');
        $readBook->description = 'Посмотрение книги';
        $auth->add($readBook);

        $addBook = $auth->createPermission('addBook');
        $addBook->description = 'Добавление книги';
        $auth->add($addBook);

        $updateBook = $auth->createPermission('updateBook');
        $updateBook->description = 'Редактирование книги';
        $auth->add($updateBook);
        
        $deleteBook = $auth->createPermission('deleteBook');
        $deleteBook->description = 'Удаление книги';
        $auth->add($deleteBook);
        
        $readCategory = $auth->createPermission('readCategory');
        $readCategory->description = 'Посмотрение категории';
        $auth->add($readCategory);

        $addCategory = $auth->createPermission('addCategory');
        $addCategory->description = 'Добавление категории';
        $auth->add($addCategory);

        $updateCategory = $auth->createPermission('updateCategory');
        $updateCategory->description = 'Редактирование категории';
        $auth->add($updateCategory);
        
        $deleteCategory = $auth->createPermission('deleteCategory');
        $deleteCategory->description = 'Удаление категории';
        $auth->add($deleteCategory);
        
        $updateComment = $auth->createPermission('updateComment');
        $updateComment->description = 'Редактирование коментарии';
        $auth->add($updateComment);
        
        $deleteComment = $auth->createPermission('deleteComment');
        $deleteComment->description = 'Удаление коментарии';
        $auth->add($deleteComment);
        
        $createDarhost = $auth->createPermission('createDarhost');
        $createDarhost->description = 'Dархост';
        $auth->add($createDarhost);
        
        $deleteDarhost = $auth->createPermission('deleteDarhost');
        $deleteDarhost->description = 'Удаление дархост';
        $auth->add($deleteDarhost);
        
        $readReport = $auth->createPermission('readReport');
        $readReport->description = 'Посмотрение отчетов';
        $auth->add($readReport);

        

        // Даем роли "Администратор области" разрешения
        $auth->addChild($adminRole, $readSettings);
        $auth->addChild($adminRole, $readUsers);
        $auth->addChild($adminRole, $createUser);
        $auth->addChild($adminRole, $updateUser);
        $auth->addChild($adminRole, $deleteUser);
        $auth->addChild($adminRole, $mainPage);
        
        $auth->addChild($adminRole, $readBook);
        $auth->addChild($adminRole, $addBook);
        $auth->addChild($adminRole, $updateBook);
        $auth->addChild($adminRole, $deleteBook);
        
        $auth->addChild($adminRole, $readCategory);
        $auth->addChild($adminRole, $addCategory);
        $auth->addChild($adminRole, $updateCategory);
        $auth->addChild($adminRole, $deleteCategory);
        
        $auth->addChild($adminRole, $updateComment);
        $auth->addChild($adminRole, $deleteComment);
        
        $auth->addChild($adminRole, $createDarhost);
        $auth->addChild($adminRole, $deleteDarhost);
        
        $auth->addChild($adminRole, $readReport);

        // Даем роли "Пользователь организации" разрешения
        $auth->addChild($userRole, $readSettings);
        $auth->addChild($userRole, $updateUser);
        $auth->addChild($userRole, $mainPage);
        $auth->addChild($userRole, $createDarhost);

        // Назначаем роль "Администратор области" для пользователя
        $defaultUser = User::findOne(1);
        if ($defaultUser) {
            $auth->assign($adminRole, $defaultUser->getId());
        }
    }
}
