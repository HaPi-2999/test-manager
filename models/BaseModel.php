<?php


namespace app\models;


use app\interfaces\ImageInterface;
use app\models\enums\ImageTypeEnum;
use himiklab\thumbnail\EasyThumbnailImage;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class BaseModel extends ActiveRecord implements ImageInterface
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

    public function uploadImage(string $attribute, string $namespace, int $fieldId): void
    {
        $file = UploadedFile::getInstanceByName($attribute);

        if ($file) {
            self::deleteImages($namespace, $fieldId);

            $fileTmp = self::TMP_PATH . self::generateTmpName($file->name, $file->extension);

            if ($file->saveAs($fileTmp)) {
                $filename = EasyThumbnailImage::thumbnailFileUrl(
                    dirname(__DIR__) . '/web/' . $fileTmp,
                    900,
                    900,
                    EasyThumbnailImage::THUMBNAIL_INSET_BOX
                );

                $name = self::generateFilename($file->name, $file->extension);

                $image = new Image();
                $image->path = $name;
                $image->namespace = $namespace;
                $image->field_id = $fieldId;

                $image->save();

                unlink($fileTmp);

                copy(Yii::getAlias('@app') . '/web' . $filename, Yii::getAlias('@app') . '/web/' . self::UPLOAD_PATH . $name);

                $this->uploadPreview($image, $file);
            }
        }
    }

    public function uploadImages(string $attribute, string $namespace, int $fieldId): void
    {
        $files = UploadedFile::getInstancesByName($attribute);

        $count = 0;

        if ($files) {
            self::deleteImages($namespace, $fieldId);

            foreach ($files as $file) {
                if ($file) {
                    $fileTmp = self::TMP_PATH . self::generateTmpName($file->name, $file->extension);

                    if ($file->saveAs($fileTmp)) {
                        $filename = EasyThumbnailImage::thumbnailFileUrl(
                            dirname(__DIR__) . '/web/' . $fileTmp,
                            900,
                            900,
                            EasyThumbnailImage::THUMBNAIL_INSET_BOX
                        );

                        $name = self::generateFilename($file->name, $file->extension);

                        $image = new Image();
                        $image->path = $name;
                        $image->namespace = $namespace;
                        $image->field_id = $fieldId;

                        $image->save();

                        unlink($fileTmp);

                        copy(Yii::getAlias('@app') . '/web' . $filename, Yii::getAlias('@app') . '/web/' . self::UPLOAD_PATH . $name);

                        if ($count === 0) {
                            $this->uploadPreview($image, $file);
                        }

                        $count++;
                    }
                }
            }
        }
    }

    public static function deleteImages(string $namespace, int $fieldId): void
    {
        $images = Image::findAll(['namespace' => $namespace, 'field_id' => $fieldId]);

        foreach ($images as $image) {
            if (file_exists('uploads/img/' . $image->path)) {

                unlink('uploads/img/' . $image->path);
                $image->delete();
            }
        }
    }

    public static function generateFilename($filename, $ext): string
    {
        $date = date('Y/m/d/');

        FileHelper::createDirectory(self::UPLOAD_PATH . $date);

        return $date . md5(time() . $date . $filename) . '.' . $ext;
    }

    public static function generateTmpName($filename, $ext): string
    {
        FileHelper::createDirectory(self::TMP_PATH);

        return uniqid($filename, true) . '.' . $ext;
    }

    public function uploadPreview(Image $image, $file): void
    {
        if (file_exists(self::UPLOAD_PATH . $image->path)) {
            $filename = EasyThumbnailImage::thumbnailFileUrl(
                dirname(__DIR__) . '/web/' . self::UPLOAD_PATH . $image->path,
                300,
                300,
                EasyThumbnailImage::THUMBNAIL_INSET_BOX
            );

            $name = self::generateFilename($file->name . 'Preview', $file->extension);

            $imagePreview = new Image();
            $imagePreview->path = $name;
            $imagePreview->namespace = $image->namespace;
            $imagePreview->field_id = $image->field_id;
            $imagePreview->type = ImageTypeEnum::PREVIEW;

            $imagePreview->save();


            copy(Yii::getAlias('@app') . '/web' . $filename, Yii::getAlias('@app') . '/web/' . self::UPLOAD_PATH . $name);
        }
    }

    public function getImages(string $namespace, int $fieldId)
    {
        return Image::findAll(['namespace' => $namespace, 'field_id' => $fieldId, 'type' => ImageTypeEnum::IMAGE]);
    }

    public function getPreview(string $namespace, int $fieldId)
    {
        return Image::findOne(['namespace' => $namespace, 'field_id' => $fieldId, 'type' => ImageTypeEnum::PREVIEW]);
    }

    public function asArray()
    {
        return $this->attributes;
    }
}