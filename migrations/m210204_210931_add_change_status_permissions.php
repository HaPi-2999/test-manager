<?php

use app\models\enums\ChangeStatusTaskPermissionEnum;
use yii\db\Migration;

/**
 * Class m210204_210931_add_change_status_permissions
 */
class m210204_210931_add_change_status_permissions extends Migration
{
    public function safeUp()
    {
        $authManager = Yii::$app->authManager;

        $perm1 = $authManager->createPermission(ChangeStatusTaskPermissionEnum::CHANGE_ON_AGREEMENT);
        $perm1->description = ChangeStatusTaskPermissionEnum::getLabel(ChangeStatusTaskPermissionEnum::CHANGE_ON_AGREEMENT);

        $perm2 = $authManager->createPermission(ChangeStatusTaskPermissionEnum::CHANGE_ON_ASSESSMENT);
        $perm2->description = ChangeStatusTaskPermissionEnum::getLabel(ChangeStatusTaskPermissionEnum::CHANGE_ON_ASSESSMENT);

        $perm3 = $authManager->createPermission(ChangeStatusTaskPermissionEnum::CHANGE_ON_CANCELED);
        $perm3->description = ChangeStatusTaskPermissionEnum::getLabel(ChangeStatusTaskPermissionEnum::CHANGE_ON_CANCELED);

        $perm4 = $authManager->createPermission(ChangeStatusTaskPermissionEnum::CHANGE_ON_CLOSED);
        $perm4->description = ChangeStatusTaskPermissionEnum::getLabel(ChangeStatusTaskPermissionEnum::CHANGE_ON_CLOSED);

        $perm5 = $authManager->createPermission(ChangeStatusTaskPermissionEnum::CHANGE_ON_IN_THE_UPDATE_QUEUE);
        $perm5->description = ChangeStatusTaskPermissionEnum::getLabel(ChangeStatusTaskPermissionEnum::CHANGE_ON_IN_THE_UPDATE_QUEUE);

        $perm6 = $authManager->createPermission(ChangeStatusTaskPermissionEnum::CHANGE_ON_IN_UPDATE);
        $perm6->description = ChangeStatusTaskPermissionEnum::getLabel(ChangeStatusTaskPermissionEnum::CHANGE_ON_IN_UPDATE);

        $perm7 = $authManager->createPermission(ChangeStatusTaskPermissionEnum::CHANGE_ON_IN_WORK);
        $perm7->description = ChangeStatusTaskPermissionEnum::getLabel(ChangeStatusTaskPermissionEnum::CHANGE_ON_IN_WORK);

        $perm8 = $authManager->createPermission(ChangeStatusTaskPermissionEnum::CHANGE_ON_NEW);
        $perm8->description = ChangeStatusTaskPermissionEnum::getLabel(ChangeStatusTaskPermissionEnum::CHANGE_ON_NEW);

        $perm9 = $authManager->createPermission(ChangeStatusTaskPermissionEnum::CHANGE_ON_QUEUE_FOR_EXECUTION);
        $perm9->description = ChangeStatusTaskPermissionEnum::getLabel(ChangeStatusTaskPermissionEnum::CHANGE_ON_QUEUE_FOR_EXECUTION);

        $perm10 = $authManager->createPermission(ChangeStatusTaskPermissionEnum::CHANGE_ON_TESTING);
        $perm10->description = ChangeStatusTaskPermissionEnum::getLabel(ChangeStatusTaskPermissionEnum::CHANGE_ON_TESTING);


        $authManager->add($perm1);
        $authManager->add($perm2);
        $authManager->add($perm3);
        $authManager->add($perm4);
        $authManager->add($perm5);
        $authManager->add($perm6);
        $authManager->add($perm7);
        $authManager->add($perm8);
        $authManager->add($perm9);
        $authManager->add($perm10);
    }

    public function safeDown()
    {
        return true;
    }
}
