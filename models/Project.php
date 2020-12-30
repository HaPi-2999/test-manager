<?php


namespace app\models;

use yii\helpers\ArrayHelper;

/**
 * Class Project
 * @package app\models
 *
 * @property int $id
 * @property string $name
 * @property string $contact_person
 * @property string $email
 * @property string $description
 * @property int $phone
 * @property int $created_at
 * @property int $updated_at
 */
class Project extends BaseModel
{
    public static function tableName(): string
    {
        return 'projects';
    }

    public function rules(): array
    {
        return ArrayHelper::merge(parent::rules(), [
            [['name', 'contact_person', 'email', 'description'], 'string'],
            [['phone'], 'integer']
        ]);
    }

    public function attributeLabels(): array
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'name' => 'Название',
            'contact_person' => 'Контактное лицо',
            'email' => 'Телефон',
            'description' => 'Описание',
            'phone' => 'Телефон',
        ]);
    }
}