<?php


namespace app\models\enums;


use yii2mod\enum\helpers\BaseEnum;

class StatusTaskEnum extends BaseEnum
{
    const NEW = 'new';
    const ASSESSMENT = 'assessment';
    const AGREEMENT = 'agreement';
    const QUEUE_FOR_EXECUTION = 'queue_for_execution';
    const IN_WORK = 'in_work';
    const TESTING = 'testing';
    const IN_THE_UPDATE_QUEUE = 'in_the_update_queue';
    const IN_UPDATE = 'in_update';
    const CLOSED = 'closed';
    const CANCELED = 'canceled';

    public static $list = [
        self::NEW => 'Новая',
        self::ASSESSMENT => 'Оценка',
        self::AGREEMENT => 'Согласование',
        self::QUEUE_FOR_EXECUTION => 'В очередь на исполнение',
        self::IN_WORK => 'В работе',
        self::TESTING => 'В тестирование',
        self::IN_THE_UPDATE_QUEUE => 'В очередь на обновление',
        self::IN_UPDATE => 'На обновление',
        self::CLOSED => 'Закрыт',
        self::CANCELED => 'Отменена',
    ];
}