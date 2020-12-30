<?php


namespace app\models;


use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class BaseModel extends ActiveRecord
{
    public function behaviors(): array
    {
        return [TimestampBehavior::class];
    }

    public function attributeLabels(): array
    {
        return [
            'created_at' => 'Время создания',
            'updated_at' => 'Время обновления',
        ];
    }

    public function rules(): array
    {
        return [
            [['created_at', 'updated_at'], 'integer']
        ];
    }
}