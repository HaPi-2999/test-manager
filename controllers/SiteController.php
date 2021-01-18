<?php

namespace app\controllers;

use app\components\Helper;
use app\models\forms\UserForm;
use app\models\User;
use Yii;
use yii\rest\Controller;

class SiteController extends Controller
{
    public function actionLogin()
    {
        $request = Yii::$app->request;

        $token = $request->post('token');
        if ($token) {

            return User::loginByToken($token);
        }

        $login = $request->post('email');
        if (!$login) {

            return Helper::setError('Заполните Логин.');
        }

        $password = $request->post('password');
        if (!$password) {

            return Helper::setError('Заполните Пароль.');
        }

        return User::loginByEmailAndPassword($login, $password);
    }

    public function actionRegistration()
    {
        $form = new UserForm();
        $form->active = true;
        $form->load(Yii::$app->request->post(), '');

        if ($form->validate()) {
            $form->register();
            return ['user' => $form->asArray()];
        }

        return Helper::formatError($form->getFirstErrors());
    }
}