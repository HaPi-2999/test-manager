<?php

use app\models\enums\RoleEnum;
use yii\db\Migration;

/**
 * Class m201228_202952_init_rbac
 */
class m201228_202952_init_rbac extends Migration
{
    public function safeUp()
    {
        $authManager = Yii::$app->authManager;

        $roleLeader = $authManager->createRole(RoleEnum::LEADER);
        $authManager->add($roleLeader);

        $roleTester = $authManager->createRole(RoleEnum::TESTER);
        $authManager->add($roleTester);

        $roleProgrammer = $authManager->createRole(RoleEnum::PROGRAMMER);
        $authManager->add($roleProgrammer);

        $roleManager = $authManager->createRole(RoleEnum::MANAGER);
        $authManager->add($roleManager);
    }

    public function safeDown()
    {
        return true;
    }
}
