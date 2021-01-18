<?php


namespace app\models\forms;


use app\models\enums\RoleEnum;
use app\models\User;
use Yii;
use yii\helpers\ArrayHelper;

class UserForm extends User
{
    public $role;

    public function rules(): array
    {
        return ArrayHelper::merge(parent::rules(), [
            [['role'], 'required'],
            [['role'], 'string'],
            [['role'], 'checkRole', 'skipOnEmpty' => true]
        ]);
    }

    public function checkRole($attr)
    {
        if (!isset(RoleEnum::$list[$this->role])) {
            $this->addError($attr, 'Такой роли не существует');
        }
    }

    public function register()
    {
        $this->save();

        $this->setRole();
    }

    private function setRole()
    {
        $authManager = Yii::$app->authManager;

        $role = $authManager->getRole($this->role);
        $authManager->assign($role, $this->id);
    }
}