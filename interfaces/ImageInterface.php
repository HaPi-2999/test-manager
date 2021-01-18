<?php

namespace app\interfaces;

use app\models\Image;

interface ImageInterface
{
    const UPLOAD_PATH = 'uploads/img/';
    const TMP_PATH = 'uploads/tmp/';

    /***
     * Сохраняем одно изображение
     * @param string $attribute
     * @param string $namespace
     * @param int $fieldId
     */
    public function uploadImage(string $attribute, string $namespace, int $fieldId): void;

    /***
     * Сохраняем preview
     * @param Image $image
     * @param $file
     */
    public function uploadPreview(Image $image, $file): void;

    /***
     * Сохраняем изображение
     * @param string $attribute
     * @param string $namespace
     * @param int $fieldId
     */
    public function uploadImages(string $attribute, string $namespace, int $fieldId): void;

    /***
     * Удялем изображение
     * @param string $namespace
     * @param int $fieldId
     */
    public static function deleteImages(string $namespace, int $fieldId): void;

    /***
     * Создания имени файла
     * @param $filename
     * @param $ext
     * @return string
     */
    public static function generateFilename($filename, $ext): string;

    /***
     * Создания временного имени файла
     * @param $filename
     * @param $ext
     * @return string
     */
    public static function generateTmpName($filename, $ext): string;

    /***
     * Вернет все изображения нужного поля
     *
     * @param string $namespace
     * @param int $fieldId
     * @return mixed
     */
    public function getImages(string $namespace, int $fieldId);

    /***
     * Вернет превью нужного поля
     *
     * @param string $namespace
     * @param int $fieldId
     * @return mixed
     */
    public function getPreview(string $namespace, int $fieldId);
}