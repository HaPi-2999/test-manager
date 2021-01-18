<?php


namespace app\models\enums;


use yii2mod\enum\helpers\BaseEnum;

class ImageTypeEnum extends BaseEnum
{
    const IMAGE = 'image';
    const PREVIEW = 'preview';

    public static $list = [
        self::IMAGE => 'Иозбражения',
        self::PREVIEW => 'Превью',
    ];
}