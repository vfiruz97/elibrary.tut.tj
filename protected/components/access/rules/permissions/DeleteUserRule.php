<?php
/**
 * Author: Akhmedov Farkhod, a.farkhod@gmail.com
 * Date: 10.08.17
 * Time: 15:59
 */
namespace app\components\access\rules\permissions;

use yii\rbac\Rule;

/**
 * DeleteUserRule
 * 
 * Правило запрещает удалять администратора системы 
 */
class DeleteUserRule extends Rule
{
    public $name = 'deleteUser';
    
    /**
     * @inheritdoc
     */
    public function execute($userId, $item, $params)
    {
        return isset($params['deletableUser']) ? $params['deletableUser']->getId() != 1 : true;
    }
}
