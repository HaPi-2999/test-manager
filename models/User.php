<?php

namespace app\models;

use app\components\Helper;
use app\models\enums\GenderEnum;
use app\models\enums\RoleEnum;
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
 * @property string $password
 * @property boolean $active
 * @property int $created_at
 * @property-read string $authKey
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
            [['first_name', 'last_name', 'patronymic', 'email', 'password'], 'required'],
            [['first_name', 'last_name', 'patronymic', 'access_token', 'auth_key', 'email', 'gender'], 'string'],
            [['password'], 'string'],
            [['active'], 'boolean'],
            [['email'], 'unique', 'message' => 'Пользователь уже существует']
        ]);
    }

    public function beforeSave($insert): bool
    {
        $security = Yii::$app->security;

        if ($this->isNewRecord) {
            $this->access_token = $security->generateRandomString();
            $this->auth_key = $security->generateRandomString();
            $this->password = $security->generatePasswordHash($this->password);
            $this->active = true;
        }

        return parent::beforeSave($insert);
    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->uploadImages('images', User::className(), $this->id);

        parent::afterSave($insert, $changedAttributes);
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

        $roles = Yii::$app->authManager->getRolesByUser($this->id);

        if ($roles) {
            foreach ($roles as $role) {
                $data['roles'][] = [
                    'key' => $role->name,
                    'name' => RoleEnum::$list[$role->name]
                ];
            }
        }

        $preview = $this->getPreview(User::className(), $this->id);

        if ($preview) {
            $data['preview'] = [
                'url' => Yii::$app->request->hostInfo . '/uploads/img/' . $preview->path,
                'width' => 300,
                'height' => 300
            ];
        }

        $images = $this->getImages(User::className(), $this->id);

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

    public function asArrayShort(): array
    {
        $data = [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'patronymic' => $this->patronymic,
            'email' => $this->email,
        ];

        if ($this->gender) {
            $this->gender = GenderEnum::getLabel($this->gender);
        }

        $preview = $this->getPreview(User::className(), $this->id);

        if ($preview) {
            $data['preview'] = [
                'url' => Yii::$app->request->hostInfo . '/uploads/img/' . $preview->path,
                'width' => 300,
                'height' => 300
            ];
        }

        return $data;
    }

    //================================= AUTH =============================//

    /***
     * @param string $token
     * @return array
     */
    public static function loginByToken(string $token): array
    {
        $user = self::findOne(['users.access_token' => $token, 'users.active' => true]);

        if (!$user) {
            return Helper::setError('Пользователя с таким токеном не существует.');
        }

        Yii::$app->user->login($user);

        return ['user' => $user->asArray()];
    }

    /***
     * @param string $login
     * @param string $password
     * @return array
     */
    public static function loginByEmailAndPassword(string $login, string $password): array
    {
        $user = self::findOne(['users.email' => $login, 'users.active' => true]);


        if (!$user || !$user->validatePassword($password)) {
            return Helper::setError('Неверный логин или пароль.');
        }

        Yii::$app->user->login($user);

        return ['user' => $user->asArray()];
    }


    //============================== IDENTITY INTERFACES METHODS ==============================//

    public static function findIdentity($id)
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

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }
}