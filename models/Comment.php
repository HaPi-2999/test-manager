<?php


namespace app\models;


use app\behaviors\CommentBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * Class Comment
 * @package app\models
 *
 * @property integer $id
 * @property string $namespace
 * @property string $text
 * @property integer $field_id
 * @property integer $parent_id
 * @property integer $user_id
 * @property integer $created_at
 * @property integer $updated_at
 */
class Comment extends BaseModel
{
    public static function tableName(): string
    {
        return 'comments';
    }

    public function behaviors(): array
    {
        return ArrayHelper::merge(parent::behaviors(), [
            CommentBehavior::class
        ]);
    }

    public function rules(): array
    {
        return ArrayHelper::merge(parent::rules(), [
            [['text', 'namespace', 'field_id', 'user_id'], 'required'],
            [['namespace', 'text'], 'string'],
            [['field_id', 'parent_id', 'created_at', 'updated_at', 'user_id'], 'integer']
        ]);
    }
}