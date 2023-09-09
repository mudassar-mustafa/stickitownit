<?php

namespace App\Traits;

use Symfony\Component\HttpFoundation\File\UploadedFile;

//use Intervention\Image\Facades\Image;

trait UploadFile
{
    /**
     * @param UploadedFile $file
     * @param string $uploadDirectory
     * @return string
     */
    public function upload(UploadedFile $file, string $uploadDirectory): string
    {
        $random_id = substr(str_shuffle(str_repeat($x = '0123456789', ceil(10 / strlen($x)))), 1, 10);
        $fileName = $file->getClientOriginalName();
        $fileName = time() . $random_id . $fileName;
        $destinationPath = public_path("/storage/uploads/" . $uploadDirectory);

        $filePath = $destinationPath . "/" . $fileName;
        $file->move($destinationPath, $fileName);
        return $fileName;
    }

    /**
     * @param array $files
     * @param string $uploadDirectory
     * @return array
     */
    public function multipleUpload(array $files, string $uploadDirectory): array
    {
        $fileNames = [];
        foreach ($files as $file) {
            /** @var $file UploadedFile */
            $fileName = $file->getClientOriginalName();
            $fileName = time() . $fileName;
            $destinationPath = public_path("/storage/uploads/" . $uploadDirectory);

            $filePath = $destinationPath . "/" . $fileName;
            $file->move($destinationPath, $fileName);
            $fileNames[] = $fileName;
        }
        return $fileNames;
    }

    /**
     * @param UploadedFile $file
     * @param string $uploadDirectory
     * * @param array $size
     * @return array
     */
//    public function uploadThumbnail(UploadedFile $file,array $sizes, string $uploadDirectory): array
//    {
//        $imageArr = [];
//
//        $fileName = time().'.'.$file->getClientOriginalExtension();
//
//        foreach ($sizes as $size_key => $size) {
//            $fileNameThumbnail = time().'Thumbnail-'.''.$size[0].'X'.$size[1].''.'.'.$file->getClientOriginalExtension();
//            $destinationPath = public_path('/storage/uploads/productThumbnail');
//            $imgFile = Image::make($file->getRealPath());
//            $imgFile->resize($size[0], $size[1], function ($constraint) {
//                $constraint->aspectRatio();
//            })->save($destinationPath.'/'.$fileNameThumbnail);
//            $sizeString = ''.$size[0].'X'.$size[1].'';
//            $obj = ['size' => $sizeString,'fileName' => $fileNameThumbnail];
//            array_push($imageArr,$obj);
//        }
//
//        $obj = ['size' => '0','fileName' => $fileName];
//        array_push($imageArr,$obj);
//
//        $destinationPath = public_path('/storage/uploads/product');
//        $file->move($destinationPath, $fileName);
//        return $imageArr;
//    }
}
