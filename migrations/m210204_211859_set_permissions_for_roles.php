<?php

use app\models\enums\ChangeStatusTaskPermissionEnum;
use app\models\enums\RoleEnum;
use yii\db\Migration;

/**
 * Class m210204_211859_set_permissions_for_roles
 */
class m210204_211859_set_permissions_for_roles extends Migration
{
    public function safeUp()
    {
        $authManager = Yii::$app->authManager;

        $manager = $authManager->getRole(RoleEnum::MANAGER);
        $programmer = $authManager->getRole(RoleEnum::PROGRAMMER);
        $tester = $authManager->getRole(RoleEnum::TESTER);
        $leader = $authManager->getRole(RoleEnum::LEADER);

        $testing = $authManager->getPermission(ChangeStatusTaskPermissionEnum::CHANGE_ON_TESTING);
        $queueForExecution = $authManager->getPermission(ChangeStatusTaskPermissionEnum::CHANGE_ON_QUEUE_FOR_EXECUTION);
        $new = $authManager->getPermission(ChangeStatusTaskPermissionEnum::CHANGE_ON_NEW);
        $new = $authManager->getPermission(ChangeStatusTaskPermissionEnum::CHANGE_ON_NEW);
    }

    public function safeDown()
    {
        return true;
    }
}
