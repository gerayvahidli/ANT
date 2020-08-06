<?php

namespace App\Helpers;

use App\Country;
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

        foreach ($files as $key => $file) {
            if ($file->getClientOriginalExtension() == "zip") {

                $filesystem = new Filesystem(new ZipArchiveAdapter($file));

                $fileEmpty =  empty($filesystem->listContents());

                foreach ($filesystem->listContents() as $object) {

                    (!isset($object['extension'] ) || !in_array($object['extension'], ['pdf', 'jpg']) ) ?  $count++ : '';

                }

                if ($count > 0 || $fileEmpty ) {

                    return array([
                        'name' => $key,
                        'count' => $count,
                        'status' => 'error',
                        'code' => '403',
                        'fileEmpty' => $fileEmpty
                    ]);
                }

            }
        }

    }


    public static function getUniversitiesByCountry  ($countryId)
    {
       return Country::find($countryId)-> universities->where('IsShow',1) ;

    }



    public static function checkUserApplied ()
    {
        return \Auth::user() -> userPrograms -> last() -> UserProgramStatusId == 1 ;
    }


}