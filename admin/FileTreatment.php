<?php

/**
 * Created by PhpStorm.
 * User: Maps_red
 * Date: 06/08/2016
 * Time: 00:02
 */

/**
 * Class FileTreatment
 */
class FileTreatment
{
    /** @var string $targetDir */
    private $targetDir = __DIR__."/../medias/";
    /** @var string $targetFile */
    private $targetFile;
    /** @var array $photo */
    private $photo;

    /**
     * FileTreatment constructor.
     * @param array $photo
     */
    public function __construct(array $photo)
    {
        $this->photo = $photo;
        $this->targetFile = $this->targetDir . basename($photo["name"]);
    }

    /**
     * @return bool
     */
    private function isImage()
    {
        $check = getimagesize($this->photo["tmp_name"]);

        return is_array($check);
    }

    /**
     * @return bool
     */
    private function isFormatValid()
    {
        $imageFileType = pathinfo($this->targetFile,PATHINFO_EXTENSION);

        return in_array($imageFileType, ['jpg', 'png', 'jpeg','gif']);
    }

    /**
     * @return bool
     */
    private function isExisting()
    {
        return file_exists($this->targetFile);
    }

    /**
     * @return bool
     */
    private function isOnSize()
    {
        return $this->photo["size"] < 500000;
    }

    /**
     * @return bool|string
     */
    public function isValid()
    {
        if (!$this->isImage()) {
            return "Le fichier uploadé n'est pas une image";
        }elseif (!$this->isFormatValid()) {
            return "Le format du fichier uploadé n'est pas valide";
        }elseif (!$this->isOnSize()) {
            return "Le fichier uploadé est trop gros";
        }

        return true;
    }

    /**
     * @return bool
     */
    public function moveFile()
    {
        return $this->isExisting() ? true : move_uploaded_file($this->photo["tmp_name"], $this->targetFile);
    }

    public function getTargerFile()
    {
        return $this->targetFile;
    }
}