<?php


namespace app\models\enums;


use yii2mod\enum\helpers\BaseEnum;

class PriorityEnum extends BaseEnum
{
    const UNIMPORTANT = 'unimportant';
    const IMPORTANT = 'important';
    const VERY_IMPORTANT = 'very_important';

    public static $list = [
        self::UNIMPORTANT => 'Неважная',
        self::IMPORTANT => 'Важная',
        self::VERY_IMPORTANT => 'Очень важная',
    ];
}