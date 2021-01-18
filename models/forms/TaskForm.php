<?php


namespace app\models\forms;


use app\models\enums\StatusTaskEnum;
use app\models\Task;
use app\models\TaskUser;
use app\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

class TaskForm extends Task
{
    public $user_ids;

    public function rules(): array
    {
        return ArrayHelper::merge(parent::rules(), [
            [['user_ids'], 'required'],
            [['user_ids'], 'string'],
        ]);
    }

    public function create(): void
    {
        $this->save();

        $this->uploadImages('images', Task::className(), $this->id);

        $userIds = Json::decode($this->user_ids);

        foreach ($userIds as $userId) {
            $this->linkUserTask($userId);
        }
    }

    public function updateTask(): void
    {
        $this->save(false);

        $this->uploadImages('images', Task::className(), $this->id);

        $userIds = Json::decode($this->user_ids);

        if ($userIds) {
            TaskUser::deleteAll(['task_id' => $this->id]);

            foreach ($userIds as $userId) {
                $this->linkUserTask($userId);
            }
        }
    }

    private function linkUserTask(int $id): void
    {
        $user = User::findOne($id);

        if ($user) {
            $userTask = new TaskUser();

            $userTask->task_id = $this->id;
            $userTask->user_id = $user->id;
            $userTask->status = StatusTaskEnum::NEW;

            $userTask->save();
        }
    }
}