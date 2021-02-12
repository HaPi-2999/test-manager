<?php


namespace app\models\enums;


use yii2mod\enum\helpers\BaseEnum;

class ChangeStatusTaskPermissionEnum extends BaseEnum
{
    const CHANGE_ON_NEW = 'change_on_new';
    const CHANGE_ON_ASSESSMENT = 'change_on_assessment';
    const CHANGE_ON_AGREEMENT = 'change_on_agreement';
    const CHANGE_ON_QUEUE_FOR_EXECUTION = 'change_on_queue_for_execution';
    const CHANGE_ON_IN_WORK = 'change_on_in_work';
    const CHANGE_ON_TESTING = 'change_on_testing';
    const CHANGE_ON_IN_THE_UPDATE_QUEUE = 'change_on_in_the_update_queue';
    const CHANGE_ON_IN_UPDATE = 'change_on_in_update';
    const CHANGE_ON_CLOSED = 'change_on_closed';
    const CHANGE_ON_CANCELED = 'change_on_canceled';

    public static $list = [
        self::CHANGE_ON_NEW => 'Изменить на новая',
        self::CHANGE_ON_ASSESSMENT => 'Изменить на оценка',
        self::CHANGE_ON_AGREEMENT => 'Изменить на согласование',
        self::CHANGE_ON_QUEUE_FOR_EXECUTION => 'Изменить на в очередь на исполнение',
        self::CHANGE_ON_IN_WORK => 'Изменить на в работе',
        self::CHANGE_ON_TESTING => 'Изменить на в тестирование',
        self::CHANGE_ON_IN_THE_UPDATE_QUEUE => 'Изменить на в очередь на обновление',
        self::CHANGE_ON_IN_UPDATE => 'Изменить на на обновление',
        self::CHANGE_ON_CLOSED => 'Изменить на закрыт',
        self::CHANGE_ON_CANCELED => 'Изменить на отменена',
    ];
}