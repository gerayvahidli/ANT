<?php /** @noinspection PhpUndefinedFieldInspection */

namespace App\Http\Controllers;

use Adldap\Laravel\Facades\Adldap;
use App\ApplicationStageResult;
use App\City;
use App\Country;
use App\EducationForm;
use App\EducationLevel;
use App\EducationPaymentForm;
use App\EducationSection;
use App\ExamLanguage;
use App\ExternalProgramApplication;
use App\Gender;
use App\MobileOperatorCode;
use App\MobilePhone;
use App\FinalEducation;
use App\InternalProgramApplication;
use App\Mail\FromUserToTis;
use App\PreviousEducation;
use App\PreviousInternship;
use App\PreviousScholarship;
use App\ProgramType;
use App\University;
use App\User, Auth;
use Illuminate\Http\Request, Form, Storage;

class UserController extends Controller
{

	public function __construct ()
	{
//        Auth::logout();
//        Auth::loginUsingId(1, true);
	}


	public function index ()
	{
		$user           =
			User::with( 'country','gender', 'city', 'finalEducation', 'phones.operatorCode', 'previousInternships', 'previousScholarships' )
				->find( \Auth::user()->id );
		$finalEducation = FinalEducation::
		with( 'university.country', 'educationLevel', 'educationSection', 'educationForm', 'educationPaymentForm' )
			->where( 'user_id', $user->id )->first();
//        dd($finalEducation);
		$previousEducations = PreviousEducation::
		with( 'university.country', 'educationLevel', 'educationSection', 'educationForm', 'educationPaymentForm' )
			->where( 'user_id', $user->id )->get();

		$externalProgramApplication =
			ExternalProgramApplication::with( [
				'placementStatus',
				'firstStageResult',
				'testStageResult',
				'interviewStageResult',
				'first_stage_note',
			] )->where( 'user_id', $user->id )->get();

		$internalProgramApplication =
			InternalProgramApplication::with( [
				'placementStatus',
				'firstStageResult',
				'testStageResult',
				'interviewStageResult',
				'first_stage_note',
			] )->where( 'user_id', $user->id )->get();

		return view( 'frontend.profile.index', compact( 'user', 'finalEducation', 'previousEducations', 'externalProgramApplication', 'internalProgramApplication' ) );
	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function showFeedbackForm ()
	{
		$user = User::with( 'country', 'city', 'phones.operatorCode' )->find( \Auth::user()->id );

		return view( 'frontend.profile.feedbackForm', compact( 'user' ) );
	}

	/**
	 * @param \Illuminate\Http\Request $request
	 */
	public function sendFeedbackMailToTis ( Request $request )
	{
		//    return new FromUserToTis($request);
		$request->validate( [
			'message' => 'required|string|min:3',
			'file'    => 'nullable|mimes:jpeg,bmp,png,pdf,doc,docx,xls,xlsx,rar,zip',
		] );
		$userData = [
			'full_name'    => Auth::user()->LastName . ' ' . Auth::user()->FirstName . ' ' . Auth::user()->FatherName,
			'id_pin'       => Auth::user()->IdentityCardCode,
			'email'        => Auth::user()->email,
			'date'         => date( "Y-m-d H:i:s" ),
			'message'      => $request->message,
			'file'         => ($request->has('file')) ? $request->file : null,
			'phone_number' => $request->phone_number
		];
		\Mail::to( 'tis@socar.az' )->send( new FromUserToTis( $userData ) );
//		\Mail::to( 'ilkin.fleydanli@socar.az' )->send( new FromUserToTis( $userData ) );

		return redirect( route( 'profile.index' ) );
	}


	/**
	 * @param \App\User $user
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function registration ( User $user )
	{
		$countries                = Country::all()->pluck( 'Name', 'id' );
		$cities                   = City::where( 'IsMain', true )->get()->pluck( 'Name', 'id' );
		$educationLevels          = EducationLevel::all()->where( 'id', '<', 3 )->pluck( 'Name', 'id' );
		$universities             = University::orderBy('Name', 'desc')->get()->pluck( 'Name', 'id' );
		$educationForms           = EducationForm::all()->pluck( 'Name', 'id' );
		$educationSections        = EducationSection::where( 'IsMain', true )->get()->pluck( 'Name', 'id' );
		$educationPaymentForms    = EducationPaymentForm::all()->pluck( 'Name', 'id' );
		$examLanguages            = ExamLanguage::all()->pluck( 'Name', 'id' );
		$mobilePhoneOperatorCodes = MobileOperatorCode::all()->pluck( 'Code', 'id' );
		$programTypes             = ProgramType::where( 'id', '<', 3 )->get()->pluck( 'Name', 'id' );

		return view( 'frontend.profile.form',
			compact( 'user', 'countries', 'educationLevels', 'universities', 'educationForms', 'educationSections', 'cities', 'examLanguages', 'educationPaymentForms', 'mobilePhoneOperatorCodes', 'programTypes' )
		);
	}

	/**
	 * @param \App\User $user
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function edit ( User $user )
	{
		if ( $user->id != Auth::user()->id ) {
			return redirect( route( 'profile.edit', Auth::user() ) );
		}
		$user->load( 'finalEducation.university', 'previousEducations.university.country', 'phones.operatorCode' );
		$countries       = Country::all()->pluck( 'Name', 'id' );
		$cities          = City::where( 'IsMain', true )->orWhere( 'id', $user->city_id )->get()->pluck( 'Name', 'id' );
		$educationLevels = EducationLevel::all()->where( 'id', '<', 3 )->pluck( 'Name', 'id' );
		$universities             = University::orderBy('Name', 'desc')->get()->pluck( 'Name', 'id' );
		$educationForms  = EducationForm::all()->pluck( 'Name', 'id' );
		if ( isset( $user->finalEducation->education_section_id ) ) {
			$educationSections = EducationSection::where( 'IsMain', true )->orWhere( 'id', $user->finalEducation->education_section_id )->get()->pluck( 'Name', 'id' );
		} else {
			$educationSections = EducationSection::where( 'IsMain', true )->get()->pluck( 'Name', 'id' );
		}
		$educationPaymentForms    = EducationPaymentForm::all()->pluck( 'Name', 'id' );
		$examLanguages            = ExamLanguage::all()->pluck( 'Name', 'id' );
		$mobilePhoneOperatorCodes = MobileOperatorCode::all()->pluck( 'Code', 'id' );
		$programTypes             = ProgramType::where( 'id', '<', 3 )->get()->pluck( 'Name', 'id' );
		$genders                  = Gender::all()->pluck( 'Name', 'id' );;

		return view( 'frontend.profile.form',
			compact( 'user', 'countries', 'educationLevels', 'universities', 'educationForms', 'educationSections', 'cities', 'examLanguages', 'educationPaymentForms', 'mobilePhoneOperatorCodes', 'programTypes','genders' )
		);
	}

	/**
	 * @param \Illuminate\Http\Request $request
	 */
	public function store ( Request $request )
	{


		$user                         = new User;
		$user->Email                  = $request->email;
		$user->FirstName              = $request->FirstName;
		$user->LastName               = $request->LastName;
		$user->FatherName             = $request->FatherName;
		$user->Email                  = $request->email;
		$user->Password               = $request->password;
		$user->Dob                    = $request->dateOfBirth;
		$user->city_id                = 1;
		$user->country_id             = 1;
		$user->Address                = $request->Address;
		$user->IdentityCardNumber     = $request->idCardNumber;
		$user->IdentityCardCode       = $request->idCardPin;
		$user->MaidenSurname          = $request->MaidenSurname;
		$user->IsCurrentlyWorking     = $request->is_currently_working;
		$user->IsCurrentlyWorkAtSocar = $request->is_currently_working_at_socar;
		$user->PersonalNumber         = $request->personal_number;
		$user->WorkCompany            = $request->work_company;
		$user->WorkExperienceYears    = $request->work_experience;
		$user->exam_language_id       = 1;
		$user->save();
		$finalEducation = $this->storeFinalEducation( $request, $user );

		return [
			'user'           => $user,
			'finalEducation' => $finalEducation,
		];

	}

	public function storeFinalEducation ( Request $request, $user )
	{
		$finalEducation                     = new FinalEducation;
		$finalEducation->user_id            = $user->id;
		$finalEducation->education_level_id = $request->education_level;
		$finalEducation->university_id      = $request->university_id;
		$finalEducation->BeginDate          = $request->BeginDate;
		$finalEducation->EndDate            = $request->EndDate;
		$finalEducation->CurrentEduYear     = $request->current_edu_year;
		$finalEducation->Faculty            = $request->faculty;
		$finalEducation->Speciality         = $request->speciality;
		$finalEducation->AdmissionScore     = $request->admission_score;
		if ( $request->education_section_id == 4 && isset( $request->education_section_id ) ) {
			$educationSection         = new EducationSection;
			$educationSection->Name   = $request->education_section_id;
			$educationSection->IsMain = 0;
			$educationSection->save();
			$finalEducation->education_section_id = $educationSection->id;
		} else {
			$finalEducation->education_section_id = $request->education_section_id;
		}
		$finalEducation->education_form_id         = $request->education_form_id;
		$finalEducation->education_payment_form_id = $request->education_payement_form_id;
		$finalEducation->save();

		return $finalEducation;
	}


	/**
	 * @param \Illuminate\Http\Request $request
	 * @param \App\User                $user
	 */
	public function update ( Request $request, User $user )
	{

        if ( $user->id != Auth::user()->id ) {
            return redirect( route( 'profile.edit', Auth::user() ) );
        }
        
		//return $request;
		$request->validate( [
			'image'                                => 'image|mimes:jpeg,bmp,png',
			'FirstName'                            => 'required|alpha|max:255',
			'LastName'                             => 'required|alpha|max:255',
			'FatherName'                           => 'required|alpha|max:255',
			'gender'                               => 'required',
			//            'mobilePhone.*.operatorCode'      => 'required|digits:7',
			'mobilePhone.*.number'                 => 'digits:7',
			//			'email'                                => 'required|string|email|max:255|unique:user',
			//			'password'                             => 'required|string|min:6|confirmed',
			'nationality'                          => 'required',
			'dateOfBirth'                          => 'required|date|before:' . now() . '|after:' . date( 'Y-m-d', strtotime( '-200 years' ) ),
			'City_id'                              => 'required',
			'customCity'                           => 'required_if:City_id,52|string|nullable',
			'Address'                              => 'required|string',
			'idCardNumber'                         => 'required|string|min:6',
			'idCardPin'                            => 'nullable|string|size:7',
			'MaidenSurname'                        => 'required|string',
			//final education
			'education_level'                      => 'required',
			'country_id'                           => 'required|integer',
			'university_id'                        => 'required|integer',
			'BeginDate'                            => 'required|date|before:' . now() . '|after:' . date( 'Y-m-d', strtotime( '-200 years' ) ),
			'EndDate'                              => 'required|date|after:BeginDate',
			'current_edu_year'                     => 'required|integer',
			'faculty'                              => 'required|string',
			'speciality'                           => 'required|string',
			'admission_score'                      => 'integer|between:0,700|nullable',
			'education_section_id'                 => 'sometimes|integer',
			'education_section'                    => 'required_if:education_section_id,4|string|nullable',
			'education_form_id'                    => 'required|integer',
			'education_payment_form_id'            => 'required|integer',
			//previous education
			'previous_education_level.*'           => 'sometimes|integer',
			'previous_education_country_id.*'      => 'sometimes|integer',
			'previous_education_university_id.*'   => 'sometimes|integer',
			'previous_education_BeginDate.*'       => 'nullable|sometimes|date|before:' . now() . '|after:' . date( 'Y-m-d', strtotime( '-200 years' ) ),
			'previous_education_EndDate.*'         => 'nullable|sometimes|date|after:previous_education_BeginDate.*',
			'previous_education_speciality.*'      => 'sometimes|string',
			'previous_education_admission_score.*' => 'integer|between:0,700|nullable',
			// work
			'is_currently_working'                 => 'required|boolean',
			'is_currently_working_at_socar'        => 'sometimes|nullable',
			'personal_number'                      => 'sometimes|nullable|string',
			'work_company'                         => 'nullable|string',
			'work_experience'                      => 'nullable|integer',
			// scholarship
			'hasAppliedToScholarship'              => 'required|boolean',
			'haveBeenScholar'                      => 'sometimes|boolean|nullable',
			'previous_scholarship_type.*'          => 'sometimes|integer|nullable',
			'previous_scholarship_date.*'          => 'sometimes|date|before:' . now() . '|after:' . date( 'Y-m-d', strtotime( '-200 years' ) ),
			// internship
			'haveBeenIntern'                       => 'required|boolean',
			'internship_department.*'              => 'string|max:300',
			'internship_date.*'                    => 'date|before:' . now() . '|after:' . date( 'Y-m-d', strtotime( '-200 years' ) ),
			// exam language
			'exam_language_id'                     => 'required',
		] );

		$user->image = $this->createImage( $request, $user->image );
//		$user->email      = $request->email;
		$user->FirstName  = $request->FirstName;
		$user->LastName   = $request->LastName;
		$user->FatherName = $request->FatherName;
        $user->gender_id= $request->gender;
//		$user->Email      = $request->email;
//		$user->password = \Hash::make( $request->password );
		$user->Dob = $request->dateOfBirth;
		if ( $request->City_id == 52 && $request->has( 'customCity' ) ) {
			$city         = new City;
			$city->Name   = $request->customCity;
			$city->IsMain = 0;
			$city->save();
			$user->city_id = $city->id;
		} else {
			$user->city_id = $request->City_id;
		}
		$user->country_id         = $request->nationality;
		$user->Address            = $request->Address;
		$user->IdentityCardNumber = $request->idCardNumber;
//		$user->IdentityCardCode   = $request->idCardPin;
		$user->MaidenSurname      = $request->MaidenSurname;
		$user->IsCurrentlyWorking = $request->is_currently_working;
		if ( $request->is_currently_working != 1 ) {
			$user->IsCurrentlyWorkAtSocar = null;
			$user->PersonalNumber         = null;
			$user->WorkCompany            = null;
		} else {
			if ( $request->is_currently_working_at_socar != 1 ) {
				$user->PersonalNumber = null;
			} else {
				$user->PersonalNumber = $request->personal_number;
			}
			$user->IsCurrentlyWorkAtSocar = $request->is_currently_working_at_socar;
			$user->WorkCompany            = $request->work_company;
		}
		$user->WorkExperienceYears     = $request->work_experience;
		$user->hasAppliedToScholarship = $request->hasAppliedToScholarship;
		$user->exam_language_id        = $request->exam_language_id;
		$user->save();

		$finalEducation      = $this->updateFinalEducation( $request, $user );
		$previousEducation   = $this->updatePreviousEducation( $request, $user );
		$previousInternship  = $this->savePreviousInternship( $request, $user );
		$previousScholarship = $this->savePreviousScholarship( $request, $user );
		$mobilePhone         = $this->saveMobilePhone( $request, $user );

		flash()->overlay( 'Profildə dəyişiklikər uğurla tamamlandı' );

//		return response()->json( [
//			'status' => 'success',
//			'msg'    => 'Okay',
//		], 201 );

		return redirect( route( 'profile.index' ) );
	}

	public function updateFinalEducation ( Request $request, $user )
	{
		if ( isset( $request->final_education_id ) ) {
			$finalEducation = FinalEducation::where( 'user_id', $user->id )->find( $request->final_education_id );
		} else {
			$finalEducation          = new FinalEducation;
			$finalEducation->user_id = $user->id;
		}

		$finalEducation->education_level_id = $request->education_level;
		$finalEducation->university_id      = $request->university_id;
		$finalEducation->BeginDate          = $request->BeginDate;
		$finalEducation->EndDate            = $request->EndDate;
		$finalEducation->CurrentEduYear     = $request->current_edu_year;
		$finalEducation->Faculty            = $request->faculty;
		$finalEducation->Speciality         = $request->speciality;
		$finalEducation->AdmissionScore     = $request->admission_score;
		if ( $request->education_section_id == 4 && $request->has( 'education_section' ) ) {
			$educationSection         = new EducationSection;
			$educationSection->Name   = $request->education_section;
			$educationSection->IsMain = 0;
			$educationSection->save();
			$finalEducation->education_section_id = $educationSection->id;
		} else {
			if ( isset( $request->education_section_id ) ) {
				$finalEducation->education_section_id = $request->education_section_id;
			}
		}
		if ( isset( $request->education_form_id ) ) {
			$finalEducation->education_form_id = $request->education_form_id;
		}
		if ( isset( $request->education_payment_form_id ) ) {
			$finalEducation->education_payment_form_id = $request->education_payment_form_id;
		}
		$finalEducation->save();

		return $finalEducation;
	}

	public function updatePreviousEducation ( Request $request, $user )
	{
		$previousEducationData = [];

		if ( isset( $request->previous_education_country_id ) ) {

			foreach ( $request->previous_education_country_id as $i => $previousEducationCountryId ) {
				// make array from form
				if ( isset( $request->previous_education_university_id[ $i ] ) &&
				     $request->previous_education_university_id[ $i ] != '' ) {
					$date                        = \DateTime::createFromFormat( 'Y-m-d H:i:s', '1800-01-01 00:00:00' );
					$previousEducationData[ $i ] = [
						'user_id'            => $user->id,
						'id'                 => ( isset( $request->previous_education_id[ $i ] ) ) ? $request->previous_education_id[ $i ] : null,
						'education_level_id' => $request->previous_education_level[ $i ],
						'university_id'      => $request->previous_education_university_id[ $i ],
						'BeginDate'          => ( $request->previous_education_BeginDate[ $i ] ) ? $request->previous_education_BeginDate[ $i ] : $date,
						'EndDate'            => ( $request->previous_education_EndDate[ $i ] ) ? $request->previous_education_EndDate[ $i ] : $date,
						'Speciality'         => $request->previous_education_speciality[ $i ],
						'AdmissionScore'     => ( $previousEducationCountryId == 5 ) ? $request->previous_education_admission_score[ $i ] : 0,
					];
				}
			}
			// go through previous educations array - if element of this array(previous education) is exists then update else create new previous education
			foreach ( $previousEducationData as $previousEdu ) {
				if ( isset( $previousEdu[ 'id' ] ) ) {
					$previousEducation =
						PreviousEducation::where( 'user_id', $user->id )->find( $previousEdu[ 'id' ] );
					$previousEducation->update( [
						'university_id'      => $previousEdu[ 'university_id' ],
						'education_level_id' => $previousEdu[ 'education_level_id' ],
						'BeginDate'          => $previousEdu[ 'BeginDate' ],
						'EndDate'            => $previousEdu[ 'EndDate' ],
						'Speciality'         => $previousEdu[ 'Speciality' ],
						'AdmissionScore'     => $previousEdu[ 'AdmissionScore' ],
					] );
				} else {
					$previousEducation = PreviousEducation::create(
						[
							'user_id'            => $user->id,
							'university_id'      => $previousEdu[ 'university_id' ],
							'education_level_id' => $previousEdu[ 'education_level_id' ],
							'BeginDate'          => $previousEdu[ 'BeginDate' ],
							'EndDate'            => $previousEdu[ 'EndDate' ],
							'Speciality'         => $previousEdu[ 'Speciality' ],
							'AdmissionScore'     => $previousEdu[ 'AdmissionScore' ],
						]
					);
				}
			}
		}
	}

	public function saveMobilePhone ( Request $request, $user )
	{
		foreach ( $request->mobilePhone as $mobilePhone ) {
			$phone = MobilePhone::updateOrCreate(
				[
					'user_id'     => $user->id,
					'PhoneNumber' => $mobilePhone[ 'number' ],
				], [ 'mobile_operator_code_id' => $mobilePhone[ 'operatorCode' ] ]
			);
		}
	}

	public function savePreviousInternship ( Request $request, $user )
	{
		if ( isset( $request->haveBeenIntern ) && $request->haveBeenIntern == 0 ) {
			$previousInternships = PreviousInternship::where( 'user_id', $user->id )->get();
			foreach ( $previousInternships as $i => $previousInternship ) {
				$previousInternship->delete();
			}
		}

		if ( isset( $request->haveBeenIntern ) && $request->haveBeenIntern == 1 && isset( $request->internship_department[ 0 ] ) ) {
			foreach ( $request->internship_department as $i => $previousInternshipDepartment ) {
				if ( isset( $request->internship_id[ $i ] ) ) {
					$previousInternship                  = PreviousInternship::where( 'user_id', $user->id )->find( $request->internship_id[ $i ] );
					$previousInternship->department      = $request->internship_department[ $i ];
					$previousInternship->internship_date = $request->internship_date[ $i ];
					$previousInternship->save();
				} else {
					$previousInternship                  = new PreviousInternship;
					$previousInternship->user_id         = $user->id;
					$previousInternship->department      = $request->internship_department[ $i ];
					$previousInternship->internship_date = $request->internship_date[ $i ];
					$previousInternship->save();
				}
			}
		}

	}

	public function savePreviousScholarship ( Request $request, $user )
	{

		if ( $request->hasAppliedToScholarship != 1 || ( isset( $request->haveBeenScholar ) && $request->haveBeenScholar != 1 ) ) {
			$previousScholarships = PreviousScholarship::where( 'user_id', $user->id )->get();
			foreach ( $previousScholarships as $previousScholarship ) {
				$previousScholarship->delete();
			}
		}

		if ( isset( $request->hasAppliedToScholarship ) && isset( $request->haveBeenScholar ) && $request->hasAppliedToScholarship == 1 && $request->haveBeenScholar == 1 && $request->has( 'previous_scholarship_type' ) ) {
			foreach ( $request->get( 'previous_scholarship_type' ) as $key => $previous_scholarship_type ) {
				if ( isset( $request->previous_scholarship_id[ $key ] ) ) {
					if ( isset( $request->previous_scholarship_date[ $key ] ) ) {
						$previousScholarship                   = PreviousScholarship::where( 'user_id', $user->id )->find( $request->previous_scholarship_id[ $key ] );
						$previousScholarship->program_type_id  = $request->previous_scholarship_type[ $key ];
						$previousScholarship->scholarship_date = $request->previous_scholarship_date[ $key ];
						$previousScholarship->save();
					}
				} else {
					if ( isset( $request->previous_scholarship_date[ $key ] ) ) {
						$previousScholarship                   = new PreviousScholarship;
						$previousScholarship->user_id          = $user->id;
						$previousScholarship->program_type_id  = $request->previous_scholarship_type[ $key ];
						$previousScholarship->scholarship_date = $request->previous_scholarship_date[ $key ];
						$previousScholarship->save();
					}
				}
			}
		}
	}

	/**
	 * @param \App\User $user
	 */
	public function editPassword ( User $user )
	{
		return view( 'frontend.profile.passwordChange', compact( 'user' ) );
	}

	/**
	 * @param \Illuminate\Http\Request $request
	 * @param \App\User                $user
	 */
	public function changePassword ( Request $request, User $user )
	{
		if ( \Hash::check( $request->old_password, $user->password ) ) {
			$user->password = $request->password;
			$user->save();
			flash( 'Şifrə müvəffəqiyyətlə dəyişdirildi!' )->success();

			return redirect( route( 'profile.index' ) );
		}
		flash( 'Cari şifrə düzgün daxil edilməyib, zəhmət olmasa düzgün şifrəni daxil edərək bir daha yoxlayın!' )->error();

		return back();
	}

	public function createImage ( Request $request, $oldImage )
	{
		if ( $request->hasFile( 'image' ) ) {
			$image     = $request->image;
			$extension = $image->getClientOriginalExtension();
			$imageName = time() . '.' . $extension;
			$image->move( 'uploads/images/profile/', $imageName );

			return 'uploads/images/profile/' . $imageName;
		}

		return $oldImage;
	}

	/**
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return  $universities
	 */
	public function getUniversitiesByCountry ( Request $request )
	{
		if ( $request->ajax() ) {
			$universities = University::where( 'CountryId', $request->country_id )->pluck( 'Name', 'id' );

			return json_encode( $universities );
		}

	}

	public function checkUniqueEmail ( Request $request )
	{
		if ( $request->ajax() ) {
			$email = $request->email;
			$user  = User::where( 'email', $email )->first();
//            return json_encode($user);
			if ( $user ) {
				return \Response::json( [ 'msg' => 'Belə bir istifadəçi artıq mövcuddur!' ], 400 );
//                return json_encode(array("exists" => true));
			} else {
				return \Response::json( [ 'msg' => '' ], 200 );
			}
		}
	}

	public function checkUniquePinCode ( Request $request )
	{
		if ( $request->ajax() ) {
			$identityCardCode = $request->idCardPin;
			$user             = User::where( 'identityCardCode', $identityCardCode )->first();
//            return json_encode($user);
			if ( $user ) {
				return \Response::json( [ 'msg' => 'Bu FİN kod ilə artıq müraciət daxil olmuşdur!' ], 400 );
//                return json_encode(array("exists" => true));
			} else {
				return \Response::json( [ 'msg' => '' ], 200 );
			}
		}
	}


	public function deletePreviousEducation ( Request $request )
	{
		$previous_education = PreviousEducation::find( $request->previous_education_id );
		$result             = $previous_education->delete();
		if ( $result ) {
			return [ 'status' => 'ok', 'message' => 'Əvvəlki təhsil silindi' ];
		}
		return [ 'status' => 'error', 'message' => 'Xəta baş verdi' ];
	}

	public function deleteInternship ( Request $request )
	{
		$internship = PreviousInternship::find( $request->internship_id );
		$result     = $internship->delete();
		if ( $result ) {
			return [ 'status' => 'ok', 'message' => 'Əvvəlki təcrübə silindi' ];
		}
		return [ 'status' => 'error', 'message' => 'Xəta baş verdi' ];
	}

	public function deleteScholarship ( Request $request )
	{
		$scholarship = PreviousScholarship::find( $request->scholarship_id );
		$result      = $scholarship->delete();
		if ( $result ) {
			return [ 'status' => 'ok', 'message' => 'Əvvəlki təqaüd silindi' ];
		}
		return [ 'status' => 'error', 'message' => 'Xəta baş verdi' ];
	}

	public function loginLdap ()
	{
		try {
			if ( Adldap::auth()->attempt( 'ilkin.fleydanli@socar.az', 'if21ll01ke88', $bindAsUser = true ) ) {
				dump( \Auth::user() ); // the result always null
				dd( 'Credentials were correct' );
			} else {
				dd( 'Credentials were incorrect' );
			}

		} catch ( \Adldap\Auth\UsernameRequiredException $e ) {
			dd( 'The user didn\'t supply a username' );
		} catch ( \Adldap\Auth\PasswordRequiredException $e ) {
			dd( 'The user didn\'t supply a password' );
		}

//        $user = Adldap::search()->users()->get();
//        $login = Adldap::auth()->attempt('ilkin.fleydanli@socar.az', 'if21ll01ke88', $bindAsUser = true);
//        dd($login);
//        dd($user);
	}

	/* public function applyScholarship($slug, User $user)
	 {
		 $reasons = \App\ArmyAvoidReason::pluck('Name', 'id')->toArray();

		 $array = array();
		 foreach ($reasons as $key => $value) {

			 $from_sql  = ["{0}", "{n}+1"];
			 $after_sql = [date('Y'), date('Y') + 1];

			 $text          = str_replace($from_sql, $after_sql, $value);
			 $array[ $key ] = $text;
		 }

		 $request->reasons_array' ] = $array;


		 return view('frontend.profile.apply.' . $slug . 'Scholarship', $data);
	 }
 */


	public function applyInternalScholarship ( $slug = 'internal', User $user )
	{


		$reasons = \App\ArmyAvoidReason::pluck( 'Name', 'id' )->toArray();

		$array = [];
		foreach ( $reasons as $key => $value ) {

			$from_sql  = [ "{0}", "{n}+1" ];
			$after_sql = [ date( 'Y' ), date( 'Y' ) + 1 ];

			$text          = str_replace( $from_sql, $after_sql, $value );
			$array[ $key ] = $text;
		}

		$data[ 'reasons_array' ] = $array;

		//      Storage::download('file.jpg');

		return view( 'frontend.profile.apply.internalScholarship', $data );
	}


	public function applyExternalScholarship ( $slug = 'external', User $user )
	{


		$reasons = \App\ArmyAvoidReason::pluck( 'Name', 'id' )->toArray();

		$array = [];
		foreach ( $reasons as $key => $value ) {

			$from_sql  = [ "{0}", "{n}+1" ];
			$after_sql = [ date( 'Y' ), date( 'Y' ) + 1 ];

			$text          = str_replace( $from_sql, $after_sql, $value );
			$array[ $key ] = $text;
		}

		$data[ 'reasons_array' ] = $array;

		//      Storage::download('file.jpg');

		return view( 'frontend.profile.apply.externalScholarship', $data );
	}


	public function applyPaidScholarship ( $slug = 'paid', User $user )
	{


		$reasons = \App\ArmyAvoidReason::pluck( 'Name', 'id' )->toArray();

		$array = [];
		foreach ( $reasons as $key => $value ) {

			$from_sql  = [ "{0}", "{n}+1" ];
			$after_sql = [ date( 'Y' ), date( 'Y' ) + 1 ];

			$text          = str_replace( $from_sql, $after_sql, $value );
			$array[ $key ] = $text;
		}

		$data[ 'reasons_array' ] = $array;

		//      Storage::download('file.jpg');

		return view( 'frontend.profile.apply.paidScholarship', $data );
	}


	public function relCity ( Request $req )
	{
		return Form::select( 'university_id', \App\University::where( 'country_id', $req->related_city )
			->pluck( 'Name', 'id' )
			->toArray(), null, [
			'class' => 'form-control',
			'id'    => 'university_id',
		] );
	}


	public function uploadArchiveFile ( \App\Http\Requests\ArchiveFileValidation $req, $slug )
	{
		$storagePath =
			Storage::disk( 'public' )->put( 'application/' . $slug . '/' . Auth::user()->id . '/temp', $req->file( 'file' ) );
// Extract the filename
		$storageName = basename( $storagePath );

		// $path= Storage::disk('public')-> $req->file('file')->store('application/external');
		return $storageName;
	}

	public function storeExternal ( \App\Http\Requests\ExternalApplicationValidation $req )
	{

		$external_program_app                                       = new \App\ExternalProgramApplication;
		$external_program_app->specialty_id                         = $req->specialty_id;
		$external_program_app->specialty_name                       = $req->specialty_name;
		$external_program_app->program_id                           = $req->program_id;
		$external_program_app->placement_status_id                  = 3;
		$external_program_app->HasScholarshipFromOtherCompany       = Auth::user()->hasAppliedToScholarship;
		$external_program_app->user_id                              = Auth::user()->id;
		$external_program_app->country_id                           = $req->country_id;
		$external_program_app->city_name                            = $req->city_name;
		$external_program_app->university_id                        = $req->university_id;
		$external_program_app->main_modules                         = $req->main_modules;
		$external_program_app->EducationBeginDate                   =
			date( 'Y-m-d H:i:s', strtotime( $req->EducationBeginDate ) );
		$external_program_app->EducationEndDate                     =
			date( 'Y-m-d H:i:s', strtotime( $req->EducationEndDate ) );
		$external_program_app->education_fee                        = $req->education_fee;
		$external_program_app->education_language                   = $req->education_language;
		$external_program_app->language_education_certificate_id    = $req->language_education_certificate_id;
		$external_program_app->language_education_certificate_score = $req->language_education_certificate_score;
		$external_program_app->deposit_object_id                    = $req->deposit_object_id;
		$external_program_app->located_city                         = $req->located_city;
		$external_program_app->work_experience_details              = $req->work_experience_details;
		$external_program_app->achievements                         = $req->achievements;
		$external_program_app->about_family                         = $req->about_family;
		$external_program_app->filename                             = $req->filename;
		$external_program_app->AuditInsertedUserId                  = 1;
		$external_program_app->AuditInsertedDateTime                = date( 'Y-m-d H:i:s' );

		$external_program_app->save();


		$temp_folder        = 'application/external/' . Auth::user()->id . '/temp';
		$application_folder = 'application/external/' . Auth::user()->id . '/' . $external_program_app->id;


		Storage::disk( 'public' )->move( $temp_folder . '/' . $req->filename, $application_folder . '/' . $req->filename );

		Storage::disk( 'public' )->deleteDirectory( $temp_folder );

		return view( 'frontend.profile.apply.result' );
	}


	public function removeFile ( Request $req )
	{
		Storage::disk( 'public' )->delete( 'application/' . $req->slug . '/' . Auth::user()->id . '/temp/' . $req->name );

		return $req->name;
	}

	public function storeInternal ( \App\Http\Requests\InternalApplicationValidation $req, $program_id )
	{
		$internalProgram = new \App\InternalProgramApplication;

		$internalProgram->HasScholarshipFromOtherCompany = $req->HasScholarshipFromOtherCompany;
		$internalProgram->user_id                        = Auth::user()->id;
		$internalProgram->program_id                     = $req->program_id;
		$internalProgram->placement_status_id            = null;
		$internalProgram->HasBeenAtArmy                  = 0;
		$internalProgram->filename                       = $req->filename;
		$internalProgram->AuditInsertedUserId            = 1;
		$internalProgram->AuditInsertedDateTime          = date( 'Y-m-d H:i:s' );
		//$internalProgram->RowVersion=timestamp();
		$internalProgram->save();


		$temp_folder        = 'application/internal/' . Auth::user()->id . '/temp';
		$application_folder = 'application/internal/' . Auth::user()->id . '/' . $internalProgram->id;


		Storage::disk( 'public' )->move( $temp_folder . '/' . $req->filename, $application_folder . '/' . $req->filename );

		Storage::disk( 'public' )->deleteDirectory( $temp_folder );


		return view( 'frontend.profile.apply.result' );

	}

	public function storePaid ( \App\Http\Requests\SummerInternshipApplicationValidation $req )
	{
		$summerInternship                                 = new \App\SummerInternshipApplication;
		$summerInternship->user_id                        = Auth::user()->id;
		$summerInternship->program_id                     = $req->program_id;
		$summerInternship->HasScholarshipFromOtherCompany = 0;
		$summerInternship->HasBeenAtArmy                  = $req->HasBeenAtArmy;
		$summerInternship->ArmyAvoidReasonId              = $req->army_avoid_reason_id;
		$summerInternship->filename                       = $req->filename;
		$summerInternship->AuditInsertedUserId            = 1;
		$summerInternship->AuditInsertedDateTime          = date( 'Y-m-d H:i:s' );
		$summerInternship->save();


		$temp_folder        = 'application/paid/' . Auth::user()->id . '/temp';
		$application_folder = 'application/paid/' . Auth::user()->id . '/' . $summerInternship->id;


		Storage::disk( 'public' )->move( $temp_folder . '/' . $req->filename, $application_folder . '/' . $req->filename );

		Storage::disk( 'public' )->deleteDirectory( $temp_folder );


		return view( 'frontend.profile.apply.result' );
	}


	public function DownloadExtFile ( Request $req )
	{

		return new \App\Http\Resources\External( \App\ExternalProgramApplication::find( $req->app_id ) );
		/// return new \App\Http\Resources\FileDownload(\App\ExternalProgramApplication::find($req->app_id));
		//     return Storage::disk('public')->path('app/file.txt');

	}

	public function DownloadIntFile ( Request $req )
	{
//		return new \App\Http\Resources\Internal( \App\InternalProgramApplication::where()->first() );
		return new \App\Http\Resources\Internal( \App\InternalProgramApplication::find( $req->app_id ) );
		// return new \App\Http\Resources\FileDownload('internal',\App\InternalProgramApplication::find($req->app_id));
		//     return Storage::disk('public')->path('app/file.txt');

	}


	public function DownloadPaidFile ( Request $req )
	{
		return new \App\Http\Resources\Paid( \App\SummerInternshipApplication::find( $req->app_id ) );
		// return new \App\Http\Resources\FileDownload(\App\SummerInternshipApplication::find($req->app_id));
		//     return Storage::disk('public')->path('app/file.txt');
	}

	public static function dot_color ( $string, $prog_type )
	{
		if ( isset( $prog_type->first()->$string->Name ) && $prog_type->first()->$string->Name === "Seçildi" ) {
			$dot_color = 'green-dot';
		} elseif ( isset( $prog_type->first()->$string->Name ) && $prog_type->first()->$string->Name === "Seçilmədi" ) {
			$dot_color = 'red-dot';
		} elseif ( isset( $prog_type->first()->$string->Name ) && $prog_type->first()->$string->Name === "Baxılır" ) {
			$dot_color = 'yellow-dot';
		} else {
			$dot_color = '';
		}

		return $dot_color;
	}

}