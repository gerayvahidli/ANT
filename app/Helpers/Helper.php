<?php

namespace App\Helpers;

use League\Flysystem\Filesystem;
use League\Flysystem\ZipArchive\ZipArchiveAdapter;

class Helper
{
    public static function checkCertificateScore($request)
    {
        $count = 0;

        $arr = [];
        foreach ($request->language_education_certificate_id as $certificate) {

            array_push($arr, $certificate['certificate']);

            switch ($certificate['certificate']) {
                case 1:
                    ($certificate['writing'] >= 6.5 && $certificate['speaking'] >= 6.5 && $certificate['general'] >= 6) ? $count++ : '';
                case 2:
                    ($certificate['writing'] >= 23 || $certificate['speaking'] >= 23 || $certificate['general'] >= 80) ? $count++ : '';
            }

        }


        return !($count < 1 && array_intersect([1, 2], $arr) && !array_intersect([3, 4], $arr));

    }


    public static function checkFileTypeInZip($files)
    {
        $count = 0;

        foreach ($files as $file) {
            if ($file->getClientOriginalExtension() == "zip") {
                $filesystem = new Filesystem(new ZipArchiveAdapter($file));
                foreach ($filesystem->listContents() as $object) {
                    !(in_array($object['extension'], ['pdf', 'jpg'])) ? $count++ : '';
                }
            }
        }
        return $count < 1;
    }


}