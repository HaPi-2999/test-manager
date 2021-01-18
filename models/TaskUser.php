<?php


namespace app\models;


use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * Class TaskUser
 * @package app\models
 *
 * @property int $id
 * @property int $scheduled_execution_time
 * @property int $actual_execution_time
 * @property int $created_at
 * @property int $updated_at
 * @property int $task_id
 * @property int $user_id
 * @property-read User $user
 * @property-read Task $task
 * @property string $status
 */
class TaskUser extends BaseModel
{
    public static function tableName(): string
    {
        return 'tasks_users';
    }

    public function rules(): array
    {
        return ArrayHelper::merge(parent::rules(), [
            [['status'], 'string'],
            [['scheduled_execution_time', 'actual_execution_time', 'task_id', 'user_id'], 'integer']
        ]);
    }

    public function attributeLabels(): array
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'status' => 'Статус',
            'scheduled_execution_time' => 'Плановое время на исполнение',
            'actual_execution_time' => 'Фактическое время исполнения',
            'task_id' => 'Задача',
            'user_id' => 'Пользователь',
        ]);
    }

    public function asArray(): array
    {
        $data = [
           'status'  => $this->status,
           'scheduled_execution_time'  => $this->scheduled_execution_time,
           'actual_execution_time'  => $this->actual_execution_time,
        ];

        if ($this->user) {
            $data['user'] = $this->user->asArrayShort();
        }

        return $data;
    }

    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getTask(): ActiveQuery
    {
        return $this->hasOne(Task::class, ['id' => 'task_id']);
    }
}