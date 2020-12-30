<?php


namespace app\models;


use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * Class Task
 * @package app\models
 *
 * @property int $id
 * @property string $description
 * @property string $status
 * @property string $type
 * @property string $priority
 * @property int $project_id
 * @property bool $is_file_control
 * @property bool $is_production_update
 * @property-read User[] $users
 * @property-read ChangeStatusTaskHistory[] $changeStatusHistory
 * @property-read Project $project
 * @property bool $is_error
 */
class Task extends BaseModel
{
    public static function tableName(): string
    {
        return 'tasks';
    }

    public function rules(): array
    {
        return ArrayHelper::merge(parent::rules(), [
            [['description', 'status', 'type', 'priority'], 'string'],
            [['project_id'], 'integer'],
            [['is_file_control', 'is_production_update', 'is_error'], 'boolean']
        ]);
    }

    public function attributeLabels(): array
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'status' => 'Текущий полный статус',
            'description' => 'Описание',
            'type' => 'Вид',
            'priority' => 'Приоритет',
            'project_id' => 'Проект',
            'is_file_control' => 'Контроль задачи через файл',
            'is_production_update' => 'Обновление в прод',
            'is_error' => 'ОШИБКА',
        ]);
    }

    public function getProject(): ActiveQuery
    {
        return $this->hasOne(Project::class, ['id' => 'project_id']);
    }

    public function getUsers(): ActiveQuery
    {
        return $this->hasMany(TaskUser::class, ['task_id' => 'id']);
    }

    public function getChangeStatusHistory(): ActiveQuery
    {
        return $this->hasMany(ChangeStatusTaskHistory::class, ['task_id' => 'id']);
    }
}