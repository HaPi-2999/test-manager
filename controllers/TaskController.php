<?php


namespace app\controllers;


use app\components\Helper;
use app\models\forms\TaskForm;
use app\models\Task;
use Yii;

class TaskController extends BaseRestController
{
    public function actionCreate()
    {
        $request = Yii::$app->request;

        $form = new TaskForm();
        $form->load($request->post(), '');

        if ($form->validate()) {
            $form->create();

            return ['task' => $form->asArray()];
        }

        return Helper::formatError($form->getFirstErrors());
    }

    public function actionUpdate()
    {
        $request = Yii::$app->request;

        $taskId = $request->post('task_id');
        if (!$taskId) {

            return Helper::setError('Заполните task_id.');
        }

        $form = TaskForm::findOne($taskId);

        if (!$form) {

            return Helper::setError('Такой задачи не существует');
        }

        if ($form->load($request->post(), '')) {
            $form->updateTask();

            return ['task' => $form->asArray()];
        }

        return Helper::formatError($form->getFirstErrors());
    }
}