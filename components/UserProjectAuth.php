<?php

namespace app\modules\api\components;

use app\models\User;
use yii\filters\auth\AuthMethod;
use yii\web\BadRequestHttpException;
use yii\web\UnauthorizedHttpException;

/**
 * UserProjectAuth
 *
 * Авторизация по токену пользователя
 */
class UserProjectAuth extends AuthMethod
{
    /** @var User */
    public static $userModel;

    public $userToken = 'token';

    public function authenticate($user, $request, $response): bool
    {
        if ($request->isPost) {
            $accessToken = $request->post($this->userToken);
        } else {
            $accessToken = $request->get($this->userToken);
        }

        if (is_string($accessToken)) {
            self::$userModel = User::findOne(['access_token' => $accessToken, 'active' => true]);

            if (self::$userModel) {
                return true;
            }
        }

        throw new UnauthorizedHttpException('Неверный токен доступа.');
    }

    public function handleFailure($response)
    {
        throw new BadRequestHttpException('Некорректное значение «key».');
    }
}
