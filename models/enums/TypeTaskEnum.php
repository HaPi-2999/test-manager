<?php


namespace app\models\enums;

use yii2mod\enum\helpers\BaseEnum;

class TypeTaskEnum extends BaseEnum
{
    const PROJECT_WORK = 'project_work';
    const SUPPORT = 'support';

    public static $list = [
        self::PROJECT_WORK => 'Проектная работа',
        self::SUPPORT => 'Техническая поддержка',
    ];
}