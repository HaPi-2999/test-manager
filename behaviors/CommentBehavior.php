<?php

namespace app\behaviors;

use app\models\Comment;
use app\models\User;
use yii\base\Behavior;
use yii\helpers\ArrayHelper;

class CommentBehavior extends Behavior
{
    public function tree(string $namespace, int $id): array
    {
        $data = ArrayHelper::index(Comment::find()
            ->select('id, text, parent_id, user_id')
            ->where(['field_id' => $id, 'namespace' => $namespace])
            ->asArray()
            ->all(), 'id');

        if (!$data) {
            return [];
        }

        return $this->mapTree($data);
    }

    public function mapTree(array $data): array
    {
        $tree = [];

        foreach ($data as $id => &$node) {
            if ($node['parent_id'] === null) {
                $node = $this->asArray($node);
                $tree[] = &$node;
            } else {
                if (!isset($data[$node['parent_id']]['children'])) {
                    $data[$node['parent_id']]['children'] = [];
                }

                $node = $this->asArray($node);
                $data[$node['parent_id']]['children'][] = &$node;
            }
        }

        return $tree;
    }

    private function asArray($node): array
    {
        $data = [
            'id' => (int)$node['id'],
            'text' => (string)$node['text'],
            'parent_id' => (int)$node['parent_id']
        ];

        $user = User::findOne($node['user_id']);

        if ($user) {
            $data['user'] = $user->asArray();
        }

        return $data;
    }
}
