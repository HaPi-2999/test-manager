<?php


namespace app\models;


use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * Class ChangeStatusTaskHistory
 * @package app\models
 *
 * @property int $id
 * @property int $task_id
 * @property int $user_id
 * @property int $status
 * @property-read Task $task
 * @property-read User $user
 */
class ChangeStatusTaskHistory extends BaseModel
{
    public static function tableName(): string
    {
        return 'change_status_task_history';
    }

    public function rules(): array
    {
        return ArrayHelper::merge(parent::rules(), [
           [['task_id', 'user_id'], 'string'],
           [['status'], 'string']
        ]);
    }

    public function attributeLabels(): array
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'task_id' => 'Задача',
            'user_id' => 'Пользователь',
            'status' => 'Статус задачи'
        ]);
    }

    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getTask(): ActiveQuery
    {
        return $this->hasOne(Task::class, ['id' => 'tasK_id']);
    }
}