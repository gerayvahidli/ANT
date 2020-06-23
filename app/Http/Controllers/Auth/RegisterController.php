<?php

namespace App\Http\Controllers\Auth;

use App\Company;
use App\Country;
use App\EducationForm;
use App\EducationLevel;
use App\EducationPaymentForm;
use App\EducationSection;
use App\ExamLanguage;
use App\FinalEducation;
use App\Gender;
use App\MobileOperatorCode;
use App\PreviousEducation;
use App\PreviousScholarship;
use App\PreviousInternship;
use App\ProgramType;
use App\University;
use App\User;
use App\City;
use App\Phone;
use App\Email;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
//			'image'                                => 'required|image|mimes:jpeg,bmp,png',
//            'FirstName' => 'required|alpha|max:255',
//			'LastName'                             => 'required|alpha|max:255',
//			'FatherName'                           => 'required|alpha|max:255',
//			'gender'                               => 'required',
//			'mobilePhone.*.number'                 => 'digits:7',
            'email' => 'required|string|email|max:255|unique:users',
			'password'                             => 'required|string|min:6|confirmed',
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
        $countries = Country::pluck('Name', 'id');
        $companies = Company::all();
        $cities = City::all();
        $educationLevels = EducationLevel::pluck('Name', 'id');
        $universities = University::orderBy('Name', 'desc')->get()->pluck('Name', 'id');
        $educationForms = EducationForm::pluck('Name', 'id');
        $educationSections = EducationSection::pluck('Name', 'id');
        $educationPaymentForms = EducationPaymentForm::pluck('Name', 'id');
        $mobilePhoneOperatorCodes = MobileOperatorCode::pluck('Name', 'id');
        $genders = Gender::pluck('Name', 'id');


        return view('frontend.profile.form',
            compact('user', 'countries', 'companies', 'educationLevels', 'universities', 'educationForms', 'educationSections', 'cities', 'educationPaymentForms', 'mobilePhoneOperatorCodes', 'genders')
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
//        $data['dateOfBirth'] = '1996-10-22 00:00:00.000';
//        $data[ 'nationality' ] = 1;
//        $data['BirthCityId'] = 1;
//        $data[ 'gender' ] = 1;
//        $data[ 'Address' ] = 'Baki';
//        $data[ 'PassportNo' ] =  rand(5, 1500);
//        $data[ 'Pin' ] =  rand(5, 1500);




        $user = new User;

		$user -> ImagePath  = $this->createImage( $data[ 'image' ] );
        $user->email = $data['email'];
        $user->FirstName = $data['FirstName'];
        $user->LastName = $data['LastName'];
        $user->FatherName = $data['FatherName'];
        $user->GenderId = $data[ 'gender' ];
        $user->CitizenCountryId = $data[ 'nationality' ];
        $user->Dob =  $data['Dob'];
        $user->BirthCityId = $data['BirthCityId'];
        $user->password = \Hash::make($data['password']);
        $user->AddressMain                 = $data[ 'Address' ];
        $user->PassportNo      = $data[ 'idCardNumber' ];
        $user->Fin        = $data[ 'idCardPin' ];

        if ($data['BirthCityId'] == 'other'){
            $city = new City;
            $city -> Name = $data ['otherCity'];
            $city -> IsShow = 0 ;
            $city -> save();

            $user -> BirthCityId = $city -> id;
        }
        else{
            $user -> BirthCityId = $data['BirthCityId'];
        }

        $user->save();

        $homePhone = new Phone;
        $homePhone -> PhoneNumber = $data['homePhone'];
        $homePhone -> OperatorCodeId = 1;
        $homePhone -> UserId = $user->id;
        $homePhone -> PhoneTypeId = 1;
        $homePhone -> save();


        foreach ($data['mobilePhone'] as $mobilePhone) {

            $Phone = new Phone;
            $Phone -> PhoneNumber = $mobilePhone['number'];
            $Phone -> OperatorCodeId = $mobilePhone['operatorCode'];
            $Phone -> UserId = $user->id;
            $Phone -> PhoneTypeId = 2;

            $Phone -> save();
        }

        foreach ($data['email2'] as $email2) {

            $Email = new Email;
            $Email -> email = $email2;
            $Email -> UserId = $user -> id;
            $Email -> IsMain = 0;

            $Email -> save();
        }





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
        //		$finalEducation                     = new FinalEducation;
        //		$finalEducation->user_id            = $user->id;
        //		$finalEducation->education_level_id = $data[ 'education_level' ];
        //		$finalEducation->university_id      = $data[ 'university_id' ];
        //		$finalEducation->BeginDate          = $data[ 'BeginDate' ];
        //		$finalEducation->EndDate            = $data[ 'EndDate' ];
        //		$finalEducation->CurrentEduYear     = $data[ 'current_edu_year' ];
        //		$finalEducation->Faculty            = $data[ 'faculty' ];
        //		$finalEducation->Speciality         = $data[ 'speciality' ];
        //		$finalEducation->AdmissionScore     = ( isset( $data[ 'admission_score' ] ) ) ? $data[ 'admission_score' ] : 0;
        //		if ( $data[ 'education_section_id' ] == 4 && isset( $data[ 'education_section' ] ) ) {
        //			$educationSection         = new EducationSection;
        //			$educationSection->Name   = $data[ 'education_section' ];
        //			$educationSection->IsMain = 0;
        //			$educationSection->save();
        //			$finalEducation->education_section_id = $educationSection->id;
        //		} else {
        //			$finalEducation->education_section_id = $data[ 'education_section_id' ];
        //		}
        //		$finalEducation->education_form_id         = $data[ 'education_form_id' ];
        //		$finalEducation->education_payment_form_id = $data[ 'education_payment_form_id' ];
        //
        //		$finalEducation->save();
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
        $image->move('uploads/images/profile/', $imageName);

        return 'uploads/images/profile/' . $imageName;
    }
}
