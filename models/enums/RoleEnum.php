<?php

namespace app\models\enums;

use yii2mod\enum\helpers\BaseEnum;

class RoleEnum extends BaseEnum
{
    const MANAGER = 'manager';
    const LEADER = 'leader';
    const PROGRAMMER = 'programmer';
    const TESTER = 'tester';

    public static $list = [
        self::LEADER => 'Руководитель',
        self::MANAGER => 'Менеджер',
        self::PROGRAMMER => 'Программист',
        self::TESTER => 'Тестировщик',
    ];
}