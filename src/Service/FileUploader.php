<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    /**
     * @var
     */
    private $targetDirectoryActualite;

    /**
     * @var
     */
    private $targetDirectorySpectacle;


    /**
     * FileUploader constructor.
     * @param $targetDirectoryActualite
     * @param $targetDirectorySpectacle
     */
    public function __construct($targetDirectoryActualite, $targetDirectorySpectacle) {
        $this->targetDirectoryActualite = $targetDirectoryActualite;
        $this->targetDirectorySpectacle = $targetDirectorySpectacle;

    }

    /**
     * @param UploadedFile $file
     * @return string
     */
    public function uploadImgActualite(UploadedFile $file)
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = transliterator_transliterate(
            'Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()',
            $originalFilename
        );
        $fileName = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

        try {
            $file->move($this->getTargetDirectoryActulite(), $fileName);
        } catch (FileException $e) {
            // ... handle exception if something happens during file upload
        }

        return $fileName;
    }

    /**
     * @param UploadedFile $file
     * @return string
     */
    public function uploadImgSpectacle(UploadedFile $file)
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = transliterator_transliterate(
            'Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()',
            $originalFilename
        );
        $fileName = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

        try {
            $file->move($this->getTargetDirectorySpectacle(), $fileName);
        } catch (FileException $e) {
            // ... handle exception if something happens during file upload
        }

        return $fileName;
    }

    /**
     * @return mixed
     */
    public function getTargetDirectoryActulite()
    {
        return $this->targetDirectoryActualite;
    }

    /**
     * @return mixed
     */
    public function getTargetDirectorySpectacle()
    {
        return $this->targetDirectorySpectacle;
    }

}
