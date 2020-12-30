<?php

namespace app\models;

use app\models\enums\GenderEnum;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;

/**
 * Class User
 * @package app\models
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $patronymic
 * @property string $access_token
 * @property string $auth_key
 * @property string $email
 * @property string $gender
 * @property boolean $active
 * @property int $created_at
 * @property int $updated_at
 */
class User extends BaseModel implements IdentityInterface
{
    public static function tableName(): string
    {
        return 'users';
    }

    public function rules(): array
    {
        return ArrayHelper::merge(parent::rules(), [
            [['first_name', 'last_name', 'patronymic', 'access_token', 'auth_key', 'email'], 'required'],
            [['first_name', 'last_name', 'patronymic', 'access_token', 'auth_key', 'email', 'gender'], 'string'],
            [['active'], 'boolean']
        ]);
    }

    public function beforeSave($insert): bool
    {
        $security = Yii::$app->security;

        if ($this->isNewRecord) {
            $this->access_token = $security->generateRandomString();
            $this->auth_key = $security->generateRandomString();
            $this->active = true;
        }

        return parent::beforeSave($insert);
    }

    public function attributeLabels(): array
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'patronymic' => 'Отчество',
            'email' => 'Почта',
            'gender' => 'Пол',
        ]);
    }

    public function asArray(): array
    {
        $data = [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'patronymic' => $this->patronymic,
            'access_token' => $this->access_token,
            'email' => $this->email,
            'active' => $this->active,
        ];

        if ($this->gender) {
            $this->gender = GenderEnum::getLabel($this->gender);
        }

        return $data;
    }


    //============================== IDENTITY INTERFACES METHODS ==============================//

    public static function findIdentity($id): self
    {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null): self
    {
        return self::findOne(['access_token' => $token]);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getAuthKey(): string
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey): bool
    {
        return $this->auth_key === $authKey;
    }
}