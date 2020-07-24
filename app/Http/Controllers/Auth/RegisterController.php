<?php

namespace App\Http\Controllers\Auth;

use App\Company;
use App\Country;
use App\EducationForm;
use App\EducationLevel;
use App\EducationPaymentForm;
use App\EducationSection;
use App\ExternalProgramProgram;
use App\Region;
use App\UserProgram;
use App\ExternalProgram;
use App\Education;
use App\JobInfo;
use App\Gender;
use App\MobileOperatorCode;
use App\PreviousEducation;
use App\PreviousScholarship;
use App\PreviousInternship;
use App\ProgramType;
use App\University;
use App\Program;
use App\User;
use App\City;
use App\Phone;
use App\Email;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Request;
use GuzzleHttp;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/profile';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'image' => 'required|image|mimes:jpeg,bmp,png',
            'FirstName' => 'required|max:255',
            'LastName' => 'required|max:255',
            'FatherName' => 'required|max:255',
            'gender' => 'required',
            'Dob' => 'required|date',
            'Address' => 'required',
            'homePhone' => 'required|digits:7',
            'mobilePhone.0.number' => 'required|digits:7',
            'email' => 'required|string|email|max:255|unique:user',
            'email2.0' => 'required|string|email|max:255',

//            'email.*' => 'required|string|email|max:255',

            'password' => 'required|string|min:6|confirmed',
            'BeginDate' => 'required|digits:4|integer|min:1900|max:20100',
            'EndDate' => 'required|digits:4|integer|min:1900|max:2100',
            'faculty' => 'required',
            'speciality' => 'required',
            'admission_score' => 'required',
            'GPA' => 'required|between:0,99.99',
            'department' => 'required',
            'position' => 'required',
            'StartDate' => 'required',
            'tabel_number' => 'required|numeric',

            'idCardPin' => 'required|max:7|unique:user,Fin',
            'idCardNumber' => 'required|max:8|unique:user,PassportNo',


//            'password' => [
//                'required',
//                'string',
//                'min:6',             // must be at least 10 characters in length
//                'regex:/[a-z]/',      // must contain at least one lowercase letter
//                'regex:/[A-Z]/',      // must contain at least one uppercase letter
//                'regex:/[0-9]/',      // must contain at least one digit
//                'regex:/[@$!%*#?&]/', // must contain a special character
//            ],
//
        ]);
    }

    /**
     * @param \App\User $user
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showRegistrationForm(User $user)
    {
        $countries = Country::all();
        $companies = Company::where('IsSocar', 1)->get();
        $cities = City::where('IsShow', 1)->orderBy('Name')->get();
        $regions = Region::where('IsShow', 1)->orderBy('Name')->get();
        $educationLevels = EducationLevel::all();
        $universities = University::where('IsShow', 1)->orderBy('Name', 'desc')->get()->pluck('Name', 'id');
        $educationForms = EducationForm::pluck('Name', 'id');
        $educationSections = EducationSection::all();
        $educationPaymentForms = EducationPaymentForm::pluck('Name', 'id');
        $mobilePhoneOperatorCodes = MobileOperatorCode::where('Name','!=','012') ->pluck('Name', 'id');
        $genders = Gender::all();


        return view('frontend.profile.form',
            compact('user', 'countries', 'companies', 'educationLevels', 'universities', 'educationForms', 'educationSections', 'cities', 'regions', 'educationPaymentForms', 'mobilePhoneOperatorCodes', 'genders')
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     *
     * @return \App\User
     */
    protected function create(array $data)
    {

//        $data['FirstName'] = 'test';
//        $data['LastName'] = 'test';
//        $data['FatherName'] = 'test';
//        $data['Dob'] = '1996-10-22';
//        $data[ 'nationality' ] = 1;
//        $data['BirthCityId'] = 1;
//        $data[ 'gender' ] = 1;
//        $data[ 'Address' ] = 'Baki';
//        $data[ 'idCardNumber' ] =  rand(5, 1500);
//        $data[ 'idCardPin' ] =  rand(5, 1500);
//        $data['mobilePhone'] = array([
//            'number'=>  '5555555',
//            'operatorCode' => 1
//        ]) ;
//        $data['homePhone'] = '4444444';


        $user = new User;

        $user->ImagePath = $this->createImage($data['image']);
        $user->email = $data['email'];
        $user->FirstName = $data['FirstName'];
        $user->LastName = $data['LastName'];
        $user->FatherName = $data['FatherName'];
        $user->GenderId = $data['gender'];
        $user->CitizenCountryId = $data['nationality'];
        $user->Dob = $data['Dob'];
//        $user->BirthCityId = $data['BirthCityId'];
        $user->password = \Hash::make($data['password']);
        $user->AddressMain = $data['Address'];
        $user->Address2 = $data['Address2'];
        $user->PassportNo = $data['idCardNumber'];
        $user->Fin = $data['idCardPin'];

        if ($data['BirthCityId'] == 'other') {
            $city = new City;
            $city->Name = $data ['otherCity'];
            $city->IsShow = 0;
            $city->save();

            $user->BirthCityId = $city->id;
        } else {
            $user->BirthCityId = $data['BirthCityId'];
        }

        if ($data['address_region'] == 'other') {
            $region = new Region;
            $region->Name = $data ['other_address_region'];
            $region->IsShow = 0;
            $region->save();

            $user->RegionId = $region->Id;
        } else {
            $user->RegionId = $data['address_region'];
        }


        $user->save();

        $homePhone = new Phone;
        $homePhone->PhoneNumber = $data['homePhone'];
        $homePhone->OperatorCodeId = 1;
        $homePhone->UserId = $user->id;
        $homePhone->PhoneTypeId = 1;
        $homePhone->save();


        foreach ($data['mobilePhone'] as $mobilePhone) {

            if (!empty($mobilePhone['number'])) {
                $Phone = new Phone;
                $Phone->PhoneNumber = $mobilePhone['number'];
                $Phone->OperatorCodeId = $mobilePhone['operatorCode'];
                $Phone->UserId = $user->id;
                $Phone->PhoneTypeId = 2;

                $Phone->save();
            }
        }

        foreach ($data['email2'] as $email2) {
            if (!empty($email2)) {
                $Email = new Email;
                $Email->email = $email2;
                $Email->UserId = $user->id;
                $Email->IsMain = 0;

                $Email->save();
            }
        }



        if ($data['university_id'] == 'other'){

            $university = new University;
            $university -> Name = $data['otherUniversity'];
            $university -> IsAvailable = 0;
            $university -> CountryId = $data['country_id'];
            $university -> IsShow = 0;
            $university -> save();

        }

        $finalEducation = new Education;
        $finalEducation->UserId = $user->id;
        $finalEducation->EducationLevelId = $data['education_level'];
        $finalEducation->UniversityId = $data['university_id'] == 'other'? $university -> Id  : $data['university_id'];
        $finalEducation->StartDate = $data['BeginDate'];
        $finalEducation->EndDate = $data['EndDate'];
        $finalEducation->Faculty = $data['faculty'];
        $finalEducation->Speciality = $data['speciality'];
        $finalEducation->AdmissionScore = (isset($data['admission_score'])) ? $data['admission_score'] : 0;
        $finalEducation->EducationFormId = $data['education_form_id'];
        $finalEducation->EducationSectionId = $data['education_section_id'];
        $finalEducation->EducationPaymentFormId = $data['education_payment_form_id'];
        $finalEducation->GPA = $data['GPA'];
        $finalEducation->IsCurrent = 1;

        $finalEducation->save();

        if (isset($data['previous_education_country_id'])) {
            foreach ($data['previous_education_country_id'] as $i => $previousEducationCountryId) {
                if ($data['previous_education_faculty'][$i] != '' &&
                    $data['previous_education_speciality'][$i] != '') {
                    $date = '0000';
                    $previousEducation = new Education;
                    $previousEducation->UserId = $user->id;
                    $previousEducation->EducationLevelId = $data['previous_education_level'][$i];
                    $previousEducation->UniversityId = $data['previous_education_university_id'][$i];
                    $previousEducation->StartDate = ($data['previous_education_BeginDate'][$i]) ? $data['previous_education_BeginDate'][$i] : $date;
                    $previousEducation->EndDate = ($data['previous_education_EndDate'][$i]) ? $data['previous_education_EndDate'][$i] : $date;
                    $previousEducation->Faculty = $data['previous_education_faculty'][$i];
                    $previousEducation->Speciality = $data['previous_education_speciality'][$i];
                    $previousEducation->AdmissionScore = (isset($data['previous_education_admission_score'][$i])) ? $data['previous_education_admission_score'][$i] : 0;
                    $previousEducation->EducationFormId = $data['previous_education_form_id'][$i];
                    $previousEducation->EducationSectionId = $data['previous_education_section_id'][$i];
                    $previousEducation->EducationPaymentFormId = $data['previous_education_payment_form_id'][$i];
                    $previousEducation->GPA = (isset($data['previous_education_GPA'][$i])) ? $data['previous_education_GPA'][$i] : 0;
                    $previousEducation->IsCurrent = 0;

                    $previousEducation->save();

                }
            }
        }


        $jobInfo = new JobInfo;
        $jobInfo->UserId = $user->id;
        $jobInfo->CompanyId = $data['company_id'];
        $jobInfo->Department = $data['department'];
        $jobInfo->Organization = $data['organization'];
        $jobInfo->Position = $data['position'];
        $jobInfo->StartDate = $data['StartDate'];
        $jobInfo->TabelNo = $data['tabel_number'];
        $jobInfo->IsCurrent = 1;

        $jobInfo->save();


        if (isset($data['previous_company_id'])) {
            foreach ($data['previous_company_id'] as $i => $previous_company_id) {
                if ($data['previous_department'][$i] != '' && $data['previous_position'][$i] != '') {
                    $date = \DateTime::createFromFormat('Y-m-d H:i:s', '2000-00-00 00:00:00');
                    $previousJobInfo = new JobInfo;
                    $previousJobInfo->UserId = $user->id;
                    if ($data['previous_company_id'][$i] == 'other') {
                        $company = new Company;
                        $company->Name = $data['otherCompany'][$i];
                        $company->IsSocar = 0;
                        $company->save();
                        $previousJobInfo->CompanyId = $company->id;
                    } else {
                        $previousJobInfo->CompanyId = $data['previous_company_id'][$i];
                    }
                    $previousJobInfo->Department = $data['previous_department'][$i];
                    $previousJobInfo->Organization = $data['previous_organization'][$i];
                    $previousJobInfo->Position = $data['previous_position'][$i];
                    $previousJobInfo->StartDate = isset($data['previous_StartDate'][$i]) ? $data['previous_StartDate'][$i] : $date;
                    $previousJobInfo->EndDate = isset($data['previous_EndDate'][$i]) ? $data['previous_EndDate'][$i] : '';
//                  $previousJobInfo->TabelNo = $data['previous_tabel_number'][$i];
                    $previousJobInfo->IsCurrent = 0;

                    $previousJobInfo->save();


                }
            }
        }


//        $activeProgram = ExternalProgram::where('IsActive',1) ->first();

        $userProgram = new UserProgram;

        $userProgram->UserId = $user->id;
        $userProgram->ProgramId = null;
        $userProgram->UserProgramStatusId = 1;
        $userProgram->save();


        return $user;

        //		if ( $data[ 'City_id' ] == 52 && isset( $data[ 'customCity' ] ) ) {
        //			$city         = new City;
        //			$city->Name   = $data[ 'customCity' ];
        //			$city->IsMain = 0;
        //			$city->save();
        //			$user->city_id = $city->id;
        //		} else {
        //			$user->city_id = $data[ 'City_id' ];
        //		}


        //		$user->MaidenSurname           = $data[ 'MaidenSurname' ];
        //		$user->IsCurrentlyWorking      = $data[ 'is_currently_working' ];
        //		$user->IsCurrentlyWorkAtSocar  =
        //			( isset( $data[ 'is_currently_working_at_socar' ] ) && $data[ 'is_currently_working_at_socar' ] !== '' ) ?
        //				$data[ 'is_currently_working_at_socar' ] : null;
        //		$user->hasAppliedToScholarship =
        //			( isset( $data[ 'hasAppliedToScholarship' ] ) && $data[ 'hasAppliedToScholarship' ] !== '' ) ?
        //				$data[ 'hasAppliedToScholarship' ] : null;
        //		$user->PersonalNumber          =
        //			( isset( $data[ 'personal_number' ] ) && $data[ 'personal_number' ] !== '' ) ? $data[ 'personal_number' ] :
        //				null;
        //		$user->WorkCompany             =
        //			( isset( $data[ 'work_company' ] ) && $data[ 'work_company' ] !== '' ) ? $data[ 'work_company' ] : null;
        //		$user->WorkExperienceYears     =
        //			( isset( $data[ 'work_experience' ] ) && $data[ 'work_experience' ] !== '' ) ? $data[ 'work_experience' ] :
        //				null;
        //		$user->exam_language_id        = $data[ 'exam_language_id' ];
        //		$user->save();
        //
        //
        //		foreach ( $data[ 'mobilePhone' ] as $mobilePhone ) {
        //
        //			$MobilePhone                          = new MobilePhone;
        //			$MobilePhone->mobile_operator_code_id = $mobilePhone[ 'operatorCode' ];
        //			$MobilePhone->PhoneNumber             = $mobilePhone[ 'number' ];
        //			$MobilePhone->user_id                 = $user->id;
        //			$MobilePhone->save();
        //		}
        //

        //		if ( $data[ 'education_section_id' ] == 4 && isset( $data[ 'education_section' ] ) ) {
        //			$educationSection         = new EducationSection;
        //			$educationSection->Name   = $data[ 'education_section' ];
        //			$educationSection->IsMain = 0;
        //			$educationSection->save();
        //			$finalEducation->education_section_id = $educationSection->id;
        //		} else {
        //			$finalEducation->education_section_id = $data[ 'education_section_id' ];
        //		}

        //
        //		if ( isset( $data[ 'previous_education_country_id' ] ) ) {
        //			foreach ( $data[ 'previous_education_country_id' ] as $i => $previousEducationCountryId ) {
        //				if ( isset( $data[ 'previous_education_university_id' ][ $i ] ) &&
        //				     $data[ 'previous_education_university_id' ][ $i ] != '' ) {
        //					$date = \DateTime::createFromFormat('Y-m-d H:i:s', '1800-01-01 00:00:00');
        //					$previousEducation = PreviousEducation::create(
        //						[
        //							'user_id'            => $user->id,
        //							'education_level_id' => $data[ 'previous_education_level' ][ $i ],
        //							'university_id'      => $data[ 'previous_education_university_id' ][ $i ],
        //							'BeginDate'          => ($data[ 'previous_education_BeginDate' ][ $i ]) ? $data[ 'previous_education_BeginDate' ][ $i ] : $date,
        //							'EndDate'            => ($data[ 'previous_education_EndDate' ][ $i ]) ? $data[ 'previous_education_EndDate' ][ $i ] : $date,
        //							'Speciality'         => $data[ 'previous_education_speciality' ][ $i ],
        //							'AdmissionScore'     => ( isset( $data[ 'previous_education_admission_score' ][ $i ] ) ) ? $data[ 'previous_education_admission_score' ][ $i ] : 0,
        //						]
        //					);
        //				}
        //			}
        //		}
        //
        //
        //		if ( isset( $data[ 'haveBeenIntern' ] ) && $data[ 'haveBeenIntern' ] == 0 ) {
        //			$previousInternships = PreviousInternship::where( 'user_id', $user->id )->get();
        //			foreach ( $previousInternships as $i => $previousInternship ) {
        //				$previousInternship->delete();
        //			}
        //		}
        //
        //		if ( isset( $data[ 'haveBeenIntern' ] ) && $data[ 'haveBeenIntern' ] == 1 && isset( $data[ 'internship_department' ][ 0 ] ) ) {
        //			foreach ( $data[ 'internship_department' ] as $i => $previousInternshipDepartment ) {
        //				if ( isset( $data[ 'internship_id' ][ $i ] ) ) {
        //					$previousInternship                  = PreviousInternship::where( 'user_id', $user->id )->find( $data[ 'internship_id' ][ $i ] );
        //					$previousInternship->department      = $data[ 'internship_department' ][ $i ];
        //					$previousInternship->internship_date = $data[ 'internship_date' ][ $i ];
        //					$previousInternship->save();
        //				} else {
        //					$previousInternship                  = new PreviousInternship;
        //					$previousInternship->user_id         = $user->id;
        //					$previousInternship->department      = $data[ 'internship_department' ][ $i ];
        //					$previousInternship->internship_date = $data[ 'internship_date' ][ $i ];
        //					$previousInternship->save();
        //				}
        //			}
        //		}
        //
        //
        //		if ( $data[ 'hasAppliedToScholarship' ] != 1 || ( isset( $data[ 'haveBeenScholar' ] ) && $data[ 'haveBeenScholar' ] != 1 ) ) {
        //			$previousScholarships = PreviousScholarship::where( 'user_id', $user->id )->get();
        //			foreach ( $previousScholarships as $previousScholarship ) {
        //				$previousScholarship->delete();
        //			}
        //		}
        //
        //		if ( isset( $data[ 'hasAppliedToScholarship' ] ) && isset( $data[ 'haveBeenScholar' ] ) && $data[ 'hasAppliedToScholarship' ] == 1 && $data[ 'haveBeenScholar' ] == 1 && $data[ 'previous_scholarship_type' ] ) {
        //			foreach ( $data[ 'previous_scholarship_type' ] as $key => $previous_scholarship_type ) {
        //				if ( isset( $data[ 'previous_scholarship_id' ][ $key ] ) ) {
        //					if ( isset( $data[ 'previous_scholarship_date' ][ $key ] ) ) {
        //						$previousScholarship                   = PreviousScholarship::where( 'user_id', $user->id )->find( $data[ 'previous_scholarship_id' ][ $key ] );
        //						$previousScholarship->program_type_id  = $data[ 'previous_scholarship_type' ][ $key ];
        //						$previousScholarship->scholarship_date = $data[ 'previous_scholarship_date' ][ $key ];
        //						$previousScholarship->save();
        //					}
        //				} else {
        //					if ( isset( $data[ 'previous_scholarship_date' ][ $key ] ) ) {
        //						$previousScholarship                   = new PreviousScholarship;
        //						$previousScholarship->user_id          = $user->id;
        //						$previousScholarship->program_type_id  = $data[ 'previous_scholarship_type' ][ $key ];
        //						$previousScholarship->scholarship_date = $data[ 'previous_scholarship_date' ][ $key ];
        //						$previousScholarship->save();
        //					}
        //				}
        //			}
        //		}
        //
        //		if ( $user->exists && isset( $finalEducation ) && isset( $mobilePhone ) ) {
        //			flash()->overlay( 'Qeydiyyatdan uğurlu tamamlandı' );
        //
        //			return $user;
        //		}


//        return back();

//        return User::create([
//            'name'     => $data[ 'name' ],
//            'email'    => $data[ 'email' ],
//            'password' => Hash::make($data[ 'password' ]),
//        ]);


    }

    public function createImage($image)
    {
        $extension = $image->getClientOriginalExtension();
        $imageName = time() . '.' . $extension;
        $image->move(public_path('uploads/images/profile/'), $imageName);

        return 'uploads/images/profile/' . $imageName;
    }

    public function getPrametersByFin(Request $request)
    {

        $data = $request::all();

        $fin = $data['fin'];

        define('API_WSDL', 'http://192.168.17.47:8000/sap/bc/srt/wsdl/flv_10002A101AD1/bndg_url/sap/bc/srt/rfc/sap/yws_scholarship/430/yws_scholarship/yws_scholarship?sap-client=430');
        ini_set("soap.wsdl_cache_enabled", "0");

        try {
            $client = new \SoapClient(API_WSDL, array(
                'trace' => true,
                'login' => 'hrregister',
                'password' => 'HR@reg20',
            ));
            $res = $client->YfmScholarship(array(
                'ImFincode' => $fin
            ));
            return response(json_encode($res));
        } catch (SoapFault $exception) {
            echo "<pre>faultcode: '" . $exception->faultcode . "'</pre>";
            echo "<pre>faultstring: '" . $exception->getMessage() . "'</pre>";
            $err = 1;
        }

    }
}
