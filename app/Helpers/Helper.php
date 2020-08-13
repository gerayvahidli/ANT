<?php

namespace App\Helpers;

use App\City;
use App\Country;
use App\Region;
use App\User;
use App\UserLog;
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
                    ($certificate['writing'] >= 23 && $certificate['speaking'] >= 23 && $certificate['general'] >= 80) ? $count++ : '';
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

                    (!isset($object['extension'] ) || !in_array($object['extension'], ['pdf', 'jpg','jpeg']) ) ?  $count++ : '';

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


    public static function userLog($user,$operation)
    {
        $userLog = new UserLog;

        $userLog -> ImagePath        = $user -> ImagePath;
        $userLog -> email            = $user -> email;
        $userLog -> FirstName        = $user -> FirstName;
        $userLog -> LastName         = $user -> LastName;
        $userLog -> FatherName       = $user -> FatherName;
        $userLog -> GenderId         = $user -> GenderId;
        $userLog -> CitizenCountryId = $user -> CitizenCountryId;
        $userLog -> Dob              = $user -> Dob;
        $userLog -> BirthCityId      = $user -> BirthCityId;
        $userLog -> RegionId         = $user -> RegionId;
        $userLog -> Password         = $user -> password;
        $userLog -> AddressMain      = $user -> AddressMain;
        $userLog -> Address2         = $user -> Address2;
        $userLog -> PassportNo       = $user -> PassportNo;
        $userLog -> Fin              = $user -> Fin;

        $userLog -> remember_token   = "sadsdadasdasda";
        $userLog -> Id               = $user -> id;
        $userLog -> LogUserId        = 1;
        $userLog -> LogDateTime      = date("Y-m-d h:i:s");
        $operation == "create" ? $userLog -> LogOperationId = 1 : $userLog -> LogOperationId = 2    ;

        $user -> logs() -> save($userLog);

    }



}