<?php
/**
 * Author: Akhmedov Farkhod, a.farkhod@gmail.com
 * Date: 10.08.17
 * Time: 15:59
 */
namespace app\components\access\rules\roles;

use yii\rbac\Rule;

/**
 * Allow all for administrators
 */
class AdminRule extends Rule
{
    public $name = 'adminRole';
    
    /**
     * @inheritdoc
     */
    public function execute($userId, $item, $params)
    {
        return $userId == 1;
    }
}
