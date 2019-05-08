<?php
/**
 * Author: Akhmedov Farkhod, a.farkhod@gmail.com
 * Date: 13.09.17
 * Time: 12:50
 */
namespace app\components\access\rules\permissions;

use yii\rbac\Rule;
use app\models\Base;

class UpdateRule extends Rule
{
    public $name = 'update';
    
    /**
     * @inheritdoc
     */
    public function execute($userId, $item, $params)
    {
        if (isset($params['model']) && $params['model'] instanceof Base) {
            $model = $params['model'];
            if ($model->hasAttribute('status') && $model->status == 0) {
                return false;
            }
        }

        return true;
    }
}
