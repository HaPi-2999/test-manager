<?php


namespace app\models\enums;


use yii2mod\enum\helpers\BaseEnum;

class GenderEnum extends BaseEnum
{
    const MAN = 'man';
    const WOMAN = 'woman';

    public static $list = [
        self::MAN => 'Мужчина',
        self::WOMAN => 'Женщина',
    ];
}