<?php


namespace app\models;


use app\models\enums\PriorityEnum;
use app\models\enums\StatusTaskEnum;
use Yii;
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
 * @property int $created_at
 * @property int $updated_at
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
            [['description', 'type'], 'required'],
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

    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->status = StatusTaskEnum::NEW;

            if (!$this->priority) {
                $this->priority = PriorityEnum::UNIMPORTANT;
            }
        }

        if ($this->is_error) {
            $this->priority = PriorityEnum::VERY_IMPORTANT;
        }

        return parent::beforeSave($insert);
    }

    public function asArray(): array
    {
        $data = [
            'id' => $this->id,
            'status' => $this->status,
            'description' => $this->description,
            'type' => $this->type,
            'priority' => $this->priority,
            'is_file_control' => (bool) $this->is_file_control,
            'is_production_update' => (bool) $this->is_production_update,
            'is_error' => (bool) $this->is_error,
        ];

        if ($this->project) {
            $data['project'] = $this->project->asArray();
        }

        if ($this->users) {
            foreach ($this->users as $user) {
                $data['users'][] = $user->asArray();
            }
        }

        $preview = $this->getPreview(Task::className(), $this->id);

        if ($preview) {
            $data['preview'] = [
                'url' => Yii::$app->request->hostInfo . '/uploads/img/' . $preview->path,
                'width' => 300,
                'height' => 300
            ];
        }

        $images = $this->getImages(Task::className(), $this->id);
        if ($images) {
            foreach ($images as $image) {
                $data['images'][] = [
                    'url' => Yii::$app->request->hostInfo . '/uploads/img/' . $image->path,
                    'width' => 900,
                    'height' => 900
                ];
            }
        }

        return $data;
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