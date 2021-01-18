<?php


namespace app\models;

use app\models\enums\ImageTypeEnum;
use yii\helpers\ArrayHelper;

/**
 * Class Image
 * @package app\models
 *
 * @property int $id
 * @property string $namespace
 * @property string $path
 * @property string $type
 * @property int $field_id
 * @property int $created_at
 * @property int $updated_at
 */
class Image extends BaseModel
{
    public static function tableName(): string
    {
        return 'images';
    }

    public function rules(): array
    {
        return ArrayHelper::merge(parent::rules(), [
            [['namespace', 'path', 'type'], 'string'],
            [['field_id'], 'integer']
        ]);
    }

    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            if (!$this->type) {
                $this->type = ImageTypeEnum::IMAGE;
            }
        }

        return parent::beforeSave($insert);
    }

    public function attributeLabels(): array
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'namespace' => 'Пространство имен',
            'path' => 'Путь',
            'type' => 'Тип',
            'description' => 'Описание',
            'phone' => 'Телефон',
        ]);
    }
}