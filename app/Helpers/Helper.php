<?php

namespace App\Helpers;

use App\City;
use App\Country;
use App\ExternalProgram;
use App\Region;
use App\User;
use App\UserLog;
use League\Flysystem\Filesystem;
use League\Flysystem\ZipArchive\ZipArchiveAdapter;
use Carbon\Carbon;
use Auth;

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
         $active_program = ExternalProgram::where([
            ['BeginDate', '<', date('Y-m-d')],
            ['EndDate', '>', date('Y-m-d')],
            ['IsActive', '=', 1],
        ])->first();

         if(count (Auth::user() -> applications ) > 1){
          return Auth::user() -> userPrograms -> where('ProgramId',$active_program -> Id);
         } else{
             return Auth::user() -> userPrograms -> first();
         }
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
        $userLog -> UserStatusId     = $user -> UserStatusId;

        $userLog -> remember_token   = "sadsdadasdasda";
        $userLog -> Id               = $user -> id;
        $userLog -> LogUserId        = 1;
        $userLog -> LogDateTime      = date("Y-m-d h:i:s");
        $operation == "create" ? $userLog -> LogOperationId = 1 : $userLog -> LogOperationId = 2    ;

        $user -> logs() -> save($userLog);

    }


    public static function checkUserAge($dob)
    {
        $current_year = date('Y-m-d');
        $user_year = date('Y-m-d', strtotime($dob));

        return $difference = Carbon::parse($user_year)->diffInYears(Carbon::parse($current_year)) <= 40;
    }


    public static function checkUserSOCARemployee($fin,$tabel_number)
    {


        define('API_WSDL', 'http://192.168.17.51:8000/sap/bc/srt/wsdl/flv_10002A101AD1/bndg_url/sap/bc/srt/rfc/sap/yws_scholarship/600/yws_scholarship/yws_scholarship?sap-client=600');
        ini_set("soap.wsdl_cache_enabled", "0");

        try {
            $client = new \SoapClient(API_WSDL, array(
                'trace' => true,
                'login' => 'HRREGISTER',
                'password' => 'HR@reg20',
                'location' => 'http://192.168.17.51:8000/sap/bc/srt/rfc/sap/yws_scholarship/600/yws_scholarship/yws_scholarship'
            ));
            $res = $client->YfmScholarship(array(
                'ImFincode' => $fin
            ));


            if (strlen($fin)<1)
            {
                return response(json_encode([
                    'problem' => '403',
                    'content' => 'Zəhmət olmasa şəxsiyyət vəsiqənizin fin kodunu daxil edin'
                ]));
            }



            if (strlen($tabel_number)<1)
            {
                return response(json_encode([
                    'problem' => '403',
                    'content' => 'Zəhmət olmasa tabel nömrənizi daxil edin'
                ]));
            }


            if ( $res -> OutParams -> Pernr != $tabel_number)
            {
                return response(json_encode([
                    'problem' => '403',
                    'content' => 'Təqdim etdiyiniz tabel nömrəsi tapılmadı. Məlumatların dəqiqləşdirilməsi üçün müəssiənizin (təşkilatınızın) İnsan Resursları/Kadrlar şöbəsinə yaxınlaşa bilərsiniz.'
                ]));
            }



            if ($res -> OutParams -> Status === "0" )
            {
                return response(json_encode([
                    'problem' => 'employee',
                    'content' => 'Siz hal hazırda SOCAR işçisi olmadığınız üçün proqrama müraciət edə bilməzsiniz!'
                    ]));
            }
           elseif ($res -> OutParams -> Status == "" )
            {
                return response(json_encode([
                    'problem' => 'employee',
                    'content' => $res -> ErrMsg -> ErrorMessage
                ]));
            }

            else{
                return response(json_encode([
                    'problem' => 'no',
                    'content' => 'success'
                ]));
            }

        } catch (SoapFault $exception) {
            echo "<pre>faultcode: '" . $exception->faultcode . "'</pre>";
            echo "<pre>faultstring: '" . $exception->getMessage() . "'</pre>";
            $err = 1;
        }

    }







}