<?php

namespace app\components;

class Helper
{
    /**
     * Вернет ошибку
     * @param $message
     * @return array
     */
    public static function setError($message): array
    {
        return [
            'error' => [
                'code' => 422,
                'message' => $message
            ]
        ];
    }

    /**
     * Формирует ошибку из модели.
     * @param array $errors
     * @return array
     */
    public static function formatError(array $errors): array
    {
        $values = array_values($errors);

        return [
            'error' => [
                'code' => 422,
                'message' => $values[0]
            ]
        ];
    }
}