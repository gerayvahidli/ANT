<?php /** @noinspection PhpUndefinedFieldInspection */

namespace App\Http\Controllers;

use Adldap\Laravel\Facades\Adldap;
use App\StageResult;
use App\ApplicationStage;
use App\Bank;
use App\BankGuarantee;
use App\Certificate;
use App\City;
use App\Company;
use App\Country;
use App\Currency;
use App\Deposit;
use App\EducationForm;
use App\EducationLevel;
use App\EducationPaymentForm;
use App\EducationSection;
use App\Email;
use App\EPApplication;
use App\ExamLanguage;
use App\ExternalProgramApplication;
use App\Gender;
use App\JobInfo;
use App\LangLevel;
use App\MobileOperatorCode;
use App\Phone;
use App\Education;
use App\RealEstate;
use App\Region;
use App\Specialization;
use App\InternalProgramApplication;
use App\Mail\FromUserToTis;
use App\PreviousEducation;
use App\PreviousInternship;
use App\PreviousScholarship;
use App\ProgramType;
use App\Specialiation;
use App\ExternalProgram;
use App\SpecialityGroup;
use App\University;
use App\UserProgram;
use Carbon\Carbon;
use App\User, Auth;
use Illuminate\Http\Request, Form, Storage;
use Illuminate\Queue\Jobs\Job;
use League\Flysystem\Filesystem;
use League\Flysystem\ZipArchive\ZipArchiveAdapter;
use App\Helpers\Helper;
use DB;

class UserController extends Controller
{

    public function __construct()
    {
//        Auth::logout();
//        Auth::loginUsingId(1, true);
    }


    public function index()
    {
        $user =
            User::with('country', 'gender', 'BirthCity', 'phones', 'emails', 'finalEducation', 'previousEducations'
                , 'currentJob', 'previousJobs')
                ->find(\Auth::user()->id);
        $homePhone = $user->phones->where('PhoneTypeId', 1)->first();
        $active_program_id = ExternalProgram::where('IsActive', 1)->first()->Id;
        $user_active_program = $user->userPrograms->where('ProgramId', $active_program_id)->first();
        $last_application = $user -> applications -> last()   ;

//        return $last_application ;


        !empty($user_active_program) ? $user_active_program_status = $user_active_program->UserProgramStatusId : $user_active_program_status = [];


        return view('frontend.profile.index', compact('user', 'homePhone', 'user_active_program_status','last_application'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showFeedbackForm()
    {
        $user = Auth::user();

        return view('frontend.profile.feedbackForm', compact('user'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     */
    public function sendFeedbackMailToTis(Request $request)
    {
        //    return new FromUserToTis($request);
        $request->validate([
            'message' => 'required|string|min:3',
            'file' => 'nullable|mimes:jpeg,bmp,png,pdf,doc,docx,xls,xlsx,zip|max:5120',
        ]);

        // file adding
        if ($request->has('file') ) {
            $file = $request -> file('file');

            $file_extension = $file->getClientOriginalExtension();
            $filename = Auth::user()->id . "_file_". str_random('5') . '.' . $file_extension;


            Storage::put('public/feedbackDocuments/' . $filename, (string)file_get_contents($file), 'public');

            $filepath = '/storage/feedbackDocuments/'.$filename;
        }

        $userData = [
            'full_name' => Auth::user()->LastName . ' ' . Auth::user()->FirstName . ' ' . Auth::user()->FatherName,
            'id_pin' => Auth::user()->Fin,
            'email' => Auth::user()->email,
            'date' => date("Y-m-d H:i:s"),
            'message' => $request->message,
            'file' => ($request->has('file')) ? $filepath : null,
            'phone_number' => $request->phone_number
        ];
        \Mail::to('tis@socar.az')->send(new FromUserToTis($userData));
//		\Mail::to( 'ilkin.fleydanli@socar.az' )->send( new FromUserToTis( $userData ) );

        return redirect(route('profile.index'));
    }




    /**
     * @param \App\User $user
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user)
    {

        if ($user->id != Auth::user()->id) {
            return redirect(route('profile.edit', Auth::user()));
        }

        $user->load('finalEducation', 'previousEducations', 'phones.operatorCode', 'BirthCity', 'emails', 'currentJob', 'previousJobs');
        $countries = Country::all();
        $cities = City::where('IsShow', 1)->get();
        $regions = Region::where('IsShow', 1)->get();
        $educationLevels = EducationLevel::where('IsShow',1)->get();
        $universities = University::where('IsShow', 1)->get();
        $educationForms = EducationForm::pluck('Name', 'id');
        $educationSections = EducationSection::all();
        $educationPaymentForms = EducationPaymentForm::pluck('Name', 'id');
//		$examLanguages            = ExamLanguage::all()->pluck( 'Name', 'id' );
        $mobilePhoneOperatorCodes = MobileOperatorCode::where([['Name','!=','012'],['IsShow','=',1]])->pluck('Name', 'id');
//		$programTypes             = ProgramType::where( 'id', '<', 3 )->get()->pluck( 'Name', 'id' );
        $genders = Gender::all();
        $companies = Company::where('IsSocar', 1)->get();


        return view('frontend.profile.form',
            compact('user', 'countries', 'cities', 'regions', 'genders', 'mobilePhoneOperatorCodes', 'educationLevels', 'universities', 'educationForms', 'educationSections', 'educationPaymentForms', 'companies')
        );
    }



    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\User $user
     */
    public function update(Request $request, User $user)
    {
//        return $request;


//       return $this->createImage($request, $user->image)  ;


        if ($user->id != Auth::user()->id) {
            return redirect(route('profile.edit', Auth::user()));
        }



//		return $request;
		$request->validate( [
            'FirstName' => 'required|max:255',
            'LastName' => 'required|max:255',
            'FatherName' => 'required|max:255',
            'gender' => 'required',
            'Dob' => 'required|date',
            'Address' => 'required',
            'otherCity' => 'required_if:BirthCityId,other',
            'other_address_region' => 'required_if:address_region,other',
            'homePhone' => 'required|digits:7',
            'mobilePhone.*.number' => 'required|digits:7',
//            'email' => 'required|string|email|max:255|unique:user',
            'email2.*' => 'required|string|email|max:255',
//            'password' => 'required|string|min:6|confirmed',
//            'idCardPin' => 'required|max:7|unique:user,Fin',
//            'passport_no' => 'required|max:8|unique:user,PassportNo',


            'BeginDate' => 'required|digits:4|integer|min:1900|max:2100',
            'EndDate' => 'required|digits:4|integer|min:1900|max:2100',
            'faculty' => 'required|max:500',
            'speciality' => 'required|max:500',
            'admission_score' => 'sometimes|required|integer|between:0,700',
            'GPA' => 'required|numeric|max:100',
            'otherUniversity' => 'required_if:university_id,other|max:500',

            'previous_education_BeginDate.*' => 'required|digits:4|integer|min:1900|max:2100',
            'previous_education_BeginDate.*' => 'required|digits:4|integer|min:1900|max:2100',
            'previous_education_faculty.*' => 'required|max:500',
            'previous_education_speciality.*' => 'required|max:500',
            'previous_education_admission_score.*' => 'sometimes|required|integer|between:0,700',
            'previous_education_GPA.*' => 'required|numeric|max:100',
            'previous_otherUniversity.*' => 'required|max:500',


            'department' => 'required|max:500',
            'position' => 'required|max:500',
            'StartDate' => 'required',
            'tabel_number' => 'required|numeric',


            'previous_department.*' => 'required|max:500',
            'previous_organization.*' => 'max:500|nullable',
            'previous_position.*' => 'required|max:500',
            'previous_StartDate.*' => 'required',
            'previous_tabel_number.*' => 'required|numeric',
            'otherCompany.*' => 'max:500|nullable'


        ] );

        $user->ImagePath = $this->createImage($request, $user->ImagePath) ;
//		$user->email      = $request->email;
        $user->FirstName = $request->FirstName;
        $user->LastName = $request->LastName;
        $user->FatherName = $request->FatherName;
        $user->GenderId = $request->gender;
        $user->Dob = $request->Dob;
        if ($request->BirthCityId == 'other') {
            $city = new City;
            $city->Name = $request->otherCity;
            $city->IsShow = 0;
            $city->save();

            $user->BirthCityId = $city->id;
        } else {
            $user->BirthCityId = $request->BirthCityId;
        }

        if ($request->address_region == 'other') {
            $region = new Region;
            $region->Name = $request->other_address_region;
            $region->IsShow = 0;
            $region->save();

            $user->RegionId = $region->Id;
        } else {
            $user->RegionId = $request->address_region;
        }


        $user->CitizenCountryId = $request->nationality;
        $user->AddressMain = $request->Address;
        $user->Address2 = $request->Address2;
//        $user->PassportNo =  $request -> passport_no;
//        $user->Fin = $request -> idCardPin;

        $user -> AuditLastModifiedUserId = 1;
        $user -> AuditLastModifiedDateTime = date("Y-m-d h:i:s");

        $user->save();

        Helper::userLog($user,'update');


        $mobilePhone = $this->saveMobilePhone($request, $user);
        $emails = $this->saveEmails($request, $user);
        $finalEducation = $this->updateFinalEducation($request, $user);
        $previousEducation = $this->updatePreviousEducation($request, $user);

        $finalJob = $this->updateJob($request, $user);
        $previousJob = $this->updatePreviousJob($request, $user);




        flash()->overlay('Profildə dəyişiklikər uğurla tamamlandı');

//		return response()->json( [
//			'status' => 'success',
//			'msg'    => 'Okay',
//		], 201 );

        return redirect(route('profile.index'));
    }

    public function updateFinalEducation(Request $request, $user)
    {
        if (isset($request->final_education_id)) {
            $finalEducation = Education::where('UserId', $user->id)->find($request->final_education_id);
        } else {
            $finalEducation = new FinalEducation;
            $finalEducation->UserId = $user->id;
        }
        $universities = University::all()->pluck('Name')->toArray();

        if ($request->university_id == 'other' && !in_array($request->otherUniversity, $universities)) {
            $university = new University;
            $university->Name = $request->otherUniversity;
            $university -> CountryId = $request->country_id;
            $university->IsAvailable = 0;
            $university->IsShow = 0;
            $university->save();
            $university_id = $university->Id;
        } elseif ($request->university_id == 'other' && in_array($request->otherUniversity, $universities)) {
            $university_id = University::where('name', $request->otherUniversity)->first()->Id;
        } elseif ($request->university_id != 'other') {
            $university_id = $request->university_id;
        }



        $finalEducation->EducationLevelId = $request->education_level;
        $finalEducation->UniversityId = $university_id;
        $finalEducation->StartDate = $request->BeginDate;
        $finalEducation->EndDate = $request->EndDate;
        $finalEducation->Faculty = $request->faculty;
        $finalEducation->Speciality = $request->speciality;
        $finalEducation->AdmissionScore = ($request->country_id == 1) ? $request->admission_score : 0;
        $finalEducation->EducationFormId = $request->education_form_id;
        $finalEducation->EducationSectionId = $request->education_section_id;
        $finalEducation->EducationPaymentFormId = $request->education_payment_form_id;
        $finalEducation->GPA = $request->GPA;
        $finalEducation->IsCurrent = 1;

        $finalEducation->save();

        return $finalEducation;
    }

    public function updatePreviousEducation(Request $request, $user)
    {
        $previousEducationData = [];

        if (isset($request->previous_education_country_id)) {

            foreach ($request->previous_education_country_id as $i => $previousEducationCountryId) {

                $universities = University::all()->pluck('Name')->toArray();

                if ($request->previous_education_university_id[$i] == 'other' && !in_array($request->previous_otherUniversity[$i], $universities)) {
                    $university = new University;
                    $university->Name = $request->previous_otherUniversity[$i];
                    $university -> CountryId = $request->previous_education_country_id[$i];
                    $university->IsAvailable = 0;
                    $university->IsShow = 0;
                    $university->save();
                    $university_id = $university->Id;
                } elseif ($request->previous_education_university_id[$i] == 'other' && in_array($request->previous_otherUniversity[$i], $universities)) {
                    $university_id = University::where('name', $request->previous_otherUniversity[$i])->first()->Id;
                } elseif ($request->previous_education_university_id[$i] != 'other') {
                    $university_id = $request->previous_education_university_id[$i];
                }


                // make array from form
                if (isset($request->previous_education_university_id[$i]) &&
                    $request->previous_education_university_id[$i] != ''
                    && $request->previous_education_faculty[$i] != ''
                    && $request->previous_education_speciality[$i] != ''
                ) {
                    $date = 0000;
                    $previousEducationData[$i] = [
                        'user_id' => $user->id,
                        'id' => (isset($request->previous_education_id[$i])) ? $request->previous_education_id[$i] : null,
                        'education_level_id' => $request->previous_education_level[$i],
                        'university_id' => $university_id,
                        'BeginDate' => ($request->previous_education_BeginDate[$i]) ? $request->previous_education_BeginDate[$i] : $date,
                        'EndDate' => ($request->previous_education_EndDate[$i]) ? $request->previous_education_EndDate[$i] : $date,
                        'Faculty' => $request->previous_education_faculty[$i],
                        'Speciality' => $request->previous_education_speciality[$i],
                        'AdmissionScore' => $request->previous_education_country_id[$i] == 1 ? $request->previous_education_admission_score[$i] : 0,
                        'education_section_id' => $request->previous_education_section_id[$i],
                        'education_form_id' => $request->previous_education_form_id[$i],
                        'education_payment_form_id' => $request->previous_education_payment_form_id[$i],
                        'GPA' => $request->previous_education_GPA[$i]


                    ];
                }
            }


            // go through previous educations array - if element of this array(previous education) is exists then update else create new previous education
            foreach ($previousEducationData as $previousEdu) {
                if (isset($previousEdu['id'])) {
                    $previousEducation =
                        Education::where('UserId', $user->id)->find($previousEdu['id']);
                    $previousEducation->update([
                        'UniversityId' => $previousEdu['university_id'],
                        'EducationLevelId' => $previousEdu['education_level_id'],
                        'StartDate' => $previousEdu['BeginDate'],
                        'EndDate' => $previousEdu['EndDate'],
                        'Faculty' => $previousEdu['Faculty'],
                        'Speciality' => $previousEdu['Speciality'],
                        'AdmissionScore' => $previousEdu['AdmissionScore'],
                        'EducationSectionId' => $previousEdu['education_section_id'],
                        'EducationFormId' => $previousEdu['education_form_id'],
                        'EducationPaymentFormId' => $previousEdu['education_payment_form_id'],
                        'GPA' => $previousEdu['GPA']

                    ]);
                } else {
                    $previousEducation = Education::create(
                        [
                            'UserId' => $user->id,
                            'UniversityId' => $previousEdu['university_id'],
                            'EducationLevelId' => $previousEdu['education_level_id'],
                            'StartDate' => $previousEdu['BeginDate'],
                            'EndDate' => $previousEdu['EndDate'],
                            'Faculty' => $previousEdu['Faculty'],
                            'Speciality' => $previousEdu['Speciality'],
                            'AdmissionScore' => $previousEdu['AdmissionScore'],
                            'EducationSectionId' => $previousEdu['education_section_id'],
                            'EducationFormId' => $previousEdu['education_form_id'],
                            'EducationPaymentFormId' => $previousEdu['education_payment_form_id'],
                            'GPA' => $previousEdu['GPA'],
                            'IsCurrent' => 0
                        ]
                    );
                }
            }
        }
    }


    public function updateJob(Request $request, $user)
    {

        if (isset($request->final_job_id)) {
            $jobInfo = JobInfo::where('UserId', $user->id)->find($request->final_job_id);
        } else {
            $jobInfo = new JobInfo;
            $jobInfo->UserId = $user->id;
        }

        $jobInfo->CompanyId = $request->company_id;
        $jobInfo->Department = $request->department;
        $jobInfo->Organization = $request->organization;
        $jobInfo->Position = $request->position;
        $jobInfo->StartDate = $request->StartDate;
        $jobInfo->TabelNo = $request->tabel_number;
        $jobInfo->IsCurrent = 1;

        $jobInfo->save();


        return $jobInfo;
    }

    public function updatePreviousJob(Request $request, $user)
    {
        $previousJobData = [];

        if (isset($request->previous_company_id)) {

            foreach ($request->previous_company_id as $i => $previousCompanyId) {
                $companies = Company::all()->pluck('Name')->toArray();

                if ($request->previous_company_id[$i] == 'other' && !in_array($request->otherCompany[$i], $companies)) {
                    $company = new Company;
                    $company->Name = $request->otherCompany[$i];
                    $company->IsSocar = 0;
                    $company->save();
                    $company_id = $company->Id;
                } elseif ($request->previous_company_id[$i] == 'other' && in_array($request->otherCompany[$i], $companies)) {
                    $company_id = Company::where('name', $request->otherCompany[$i])->first()->Id;
                } elseif ($request->previous_company_id[$i] != 'other') {
                    $company_id = $request->previous_company_id[$i];
                }


                // make array from form
                if (isset($request->previous_company_id[$i]) &&
                    $request->previous_company_id[$i] != '' && $request->previous_department[$i] && $request->previous_position[$i]) {
                    $date = \DateTime::createFromFormat('Y-m-d H:i:s', '2000-00-00 00:00:00');
                    $previousJobData[$i] = [
                        'user_id' => $user->id,
                        'company_id' => $company_id,
                        'id' => (isset($request->previous_job_id[$i])) ? $request->previous_job_id[$i] : null,
                        'organization' => $request->previous_organization[$i] != '' ? $request->previous_organization[$i] : null,
                        'department' => $request->previous_department[$i],
                        'position' => $request->previous_position[$i],
                        'start_date' => isset( $request->previous_StartDate[$i]) ?  $request->previous_StartDate[$i] : $date ,
                        'end_date' => $request->previous_EndDate[$i],
                    ];
                }
            }


            // go through previous educations array - if element of this array(previous education) is exists then update else create new previous education
            foreach ($previousJobData as $previousJob) {
                if (isset($previousJob['id'])) {
                    $previousJobInfo =
                        JobInfo::where('UserId', $user->id)->find($previousJob['id']);
                    $previousJobInfo->update([
                        'Department' => $previousJob['department'],
                        'CompanyId' => $previousJob['company_id'],
                        'Organization' => $previousJob['organization'],
                        'Position' => $previousJob['position'],
                        'StartDate' => $previousJob['start_date'],
                        'EndDate' => $previousJob['end_date'],
                    ]);
                } else {
                    $previousJobInfo = JobInfo::create(
                        [
                            'UserId' => $user->id,
                            'Department' => $previousJob['department'],
                            'CompanyId' => $previousJob['company_id'],
                            'Organization' => $previousJob['organization'],
                            'Position' => $previousJob['position'],
                            'StartDate' => $previousJob['start_date'],
                            'EndDate' => $previousJob['end_date'],
                            'IsCurrent' => 0
                        ]
                    );
                }
            }
        }
    }


    public function saveMobilePhone(Request $request, $user)
    {
        Phone::where('UserId', $user->id)->where('PhoneTypeId', 2)->delete();

        foreach ($request->mobilePhone as $mobilePhone) {
            if ($mobilePhone['number'] != '') {
                $Phone = new Phone;
                $Phone->PhoneNumber = $mobilePhone['number'];
                $Phone->OperatorCodeId = $mobilePhone['operatorCode'];
                $Phone->UserId = $user->id;
                $Phone->PhoneTypeId = 2;

                $Phone->save();
            }
        }
    }

    public function saveEmails(Request $request, $user)
    {
        Email::where('UserId', $user->id)->delete();

        foreach ($request->email2 as $email) {
            if (!empty($email)) {
                $Phone = new Email();
                $Phone->UserId = $user->id;
                $Phone->email = $email;

                $Phone->save();
            }
        }
    }


    /**
     * @param \App\User $user
     */
    public function editPassword(User $user)
    {

        return view('frontend.profile.passwordChange', compact('user'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\User $user
     */
    public function changePassword(Request $request)
    {

        $this->validate($request, [
            'password' => 'required|confirmed|min:6',
        ]);

        $user = Auth::user();
        if (\Hash::check($request->current_password, $user->password)) {
            $user->password = \Hash::make($request->password);
            $user->save();
            flash('Şifrə müvəffəqiyyətlə dəyişdirildi!')->success();

            return redirect(route('profile.index'));
        }
        flash('Cari şifrə düzgün daxil edilməyib, zəhmət olmasa düzgün şifrəni daxil edərək bir daha yoxlayın!')->error();

        return back();
    }

    public function createImage(Request $request, $oldImage)
    {
        if ($request->hasFile('image')) {
            $image = $request->image;
            $extension = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $extension;
            $image->move(public_path('uploads/images/profile/') , $imageName);

            return 'uploads/images/profile/' . $imageName;
        }

        return $oldImage;
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return  $universities
     */
    public function getUniversitiesByCountry(Request $request)
    {
        if ($request->ajax()) {
            $universities = University::where([['CountryId','=',$request->country_id],['IsShow','=', 1]])->pluck('Name', 'id');

            return json_encode($universities);
        }

    }

    public function checkUniqueEmail(Request $request)
    {
        if ($request->ajax()) {
            $email = $request->email;
            $user = User::where('email', $email)->first();
//            return json_encode($user);
            if ($user) {
                return \Response::json(['msg' => 'Belə bir istifadəçi artıq mövcuddur!'], 400);
//                return json_encode(array("exists" => true));
            } else {
                return \Response::json(['msg' => ''], 200);
            }
        }
    }

    public function checkUniquePinCode(Request $request)
    {
        if ($request->ajax()) {
            $identityCardCode = $request->idCardPin;
            $user = User::where('identityCardCode', $identityCardCode)->first();
//            return json_encode($user);
            if ($user) {
                return \Response::json(['msg' => 'Bu FİN kod ilə artıq müraciət daxil olmuşdur!'], 400);
//                return json_encode(array("exists" => true));
            } else {
                return \Response::json(['msg' => ''], 200);
            }
        }
    }


    public function deletePreviousEducation(Request $request)
    {
        $previous_education = Education::find($request->previous_education_id);
        $result = $previous_education->delete();
        if ($result) {
            return ['status' => 'ok', 'message' => 'Əvvəlki təhsil silindi'];
        }
        return ['status' => 'error', 'message' => 'Xəta baş verdi'];
    }

    public function deletePreviousJob(Request $request)
    {
        $previous_job = JobInfo::find($request->previous_job_id);
        $result = $previous_job->delete();
        if ($result) {
            return ['status' => 'ok', 'message' => 'Əvvəlki təhsil silindi'];
        }
        return ['status' => 'error', 'message' => 'Xəta baş verdi'];
    }


    public function loginLdap()
    {
        try {
            if (Adldap::auth()->attempt('ilkin.fleydanli@socar.az', 'if21ll01ke88', $bindAsUser = true)) {
                dump(\Auth::user()); // the result always null
                dd('Credentials were correct');
            } else {
                dd('Credentials were incorrect');
            }

        } catch (\Adldap\Auth\UsernameRequiredException $e) {
            dd('The user didn\'t supply a username');
        } catch (\Adldap\Auth\PasswordRequiredException $e) {
            dd('The user didn\'t supply a password');
        }

//        $user = Adldap::search()->users()->get();
//        $login = Adldap::auth()->attempt('ilkin.fleydanli@socar.az', 'if21ll01ke88', $bindAsUser = true);
//        dd($login);
//        dd($user);
    }

    public function showApplyScholarshipForm(User $user)
    {
        $currencies = Currency::orderBy('name')->get();
        $certificates = Certificate::where('IsShow', 1)->get();
        $deposites = Deposit::all();
        $banks = Bank::where('IsActive',1) -> get();
        $speciality_groups = SpecialityGroup::where('Active',1) -> get();

        return view('frontend.profile.apply.externalScholarship', compact('currencies', 'certificates', 'deposites','banks','speciality_groups'));
    }


    public function applyScholarship(Request $request)
    {


        //check user applied current active program
        if (!Helper::checkUserApplied()) {
            abort(403, 'Unauthorized action.');
        }


        //check user ielts or toefl requirements
        if (!Helper::checkCertificateScore($request)) {
            return response()->json([
                'status' => 'error',
                'code' => '400'
            ]);
        }


//        //check file types in zip
//        if (isset(Helper::checkFileTypeInZip($request -> file())[0]) && (Helper::checkFileTypeInZip($request -> file())[0]['count'] > 0 || Helper::checkFileTypeInZip($request -> file())[0]['fileEmpty'] == true))
//        {
//            return response()->json(Helper::checkFileTypeInZip($request -> file())[0]);
//        }




        $request->validate([
            'specialization_name' => 'required|max:500',
            'city_name' => 'required|max:100',
            'country_id' => 'required',
            'university_id' => 'required',
            'language_education_certificate_id.0.otherCertificate_name' => 'required_if:language_education_certificate_id.0.certificate,4|max:50',
            'EducationBeginDate' => 'required|numeric|digits:4',
            'EducationEndDate' => 'required|numeric|digits:4',
            'bank_guarantee' => 'required_without:realEstate',
            'realEstate' => 'required_without:bank_guarantee',
            'realEstate_located_city' => 'required_if:realEstate,on|max:3000',
            'realEstate_owner' => 'required_if:realEstate,on|max:100',
            'realEstate_owner_contact' => 'required_if:realEstate,on|max:50',
            'realEstate_owner_email' => 'required|max:100|email|nullable',
            'realEstateSNO.serial' => 'required_if:realEstate,on|max:50',
            'realEstateSNO.number' => 'required_if:realEstate,on|max:50',
            'realEstate_registry' => 'required_if:realEstate,on|max:100',
            'realEstate_registry_date' => 'required_if:realEstate,on',
            'realEstate_registry' => 'required_if:realEstate,on|max:100',
            'bank_fee.amount' => 'required_if:bank_guarantee,on',

            'achievements' => 'required',
            'about_family' => 'required',

            'passport_copy' => 'required|mimes:jpeg,jpg,zip,pdf|max:1024',
            'certificate_document' => 'required|mimes:jpeg,jpg,zip,pdf|max:10240',
            'university_document' => 'required|mimes:jpeg,jpg,zip,pdf|max:10240',
            'biography' => 'required|mimes:jpeg,jpg,zip,pdf|max:10240',
            'medical_certificate' => 'required|mimes:jpeg,jpg,zip,pdf|max:10240',
            'psychological_dispensary' => 'required|mimes:jpeg,jpg,zip,pdf|max:10240',
            'academic_transcript' => 'required|mimes:jpeg,jpg,zip,pdf|max:10240',
            'realEstate_document' => 'required|mimes:jpeg,jpg,zip,pdf|max:10240',
            'owner_passport' => 'nullable|mimes:jpeg,jpg,zip,pdf|max:10240',
            'testimonial' => 'required|mimes:jpeg,jpg,zip,pdf|max:10240',


        ]);


        $application = new EPApplication;
        $application->ProgramId = ExternalProgram::where('IsActive', 1)->first()->Id;
        $application->UserId = Auth::user()->id;
        $application->Speciality = $request->specialization_name;
        $application->SpecializationId = isset($request->specialization_id) ? $request->specialization_id : null;
        $application->SpecialityGroupId = $request->speciality_id;
        $application->CountryId = $request->country_id;
        $application->UniversityId = $request->university_id;
        $application->city = $request->city_name;
        $application->MainModule = $request->main_modules;
        $application->AdditionalModule = $request->additional_modules;
        $application->StartTime = date('Y-m-d', strtotime($request->education_start_date));
        $application->Amount = $request->education_fee['amount'];
        $application->CurrencyId = $request->education_fee['currency'];
        $application->EducationLang = $request->education_language;
        $application->Achievments = $request->achievements;
        $application->FamilyInfo = $request->about_family;
        $application->ApplyDate = date("Y-m-d H:i:s");
        $application->EdEduLevelId = 2;
        $application->StartDate = $request->EducationBeginDate;
        $application->EndDate = $request->EducationEndDate;
        $application->CurrentStageId = 3;
        $application->LastStageId = 3;
        $application->CurrentStageSending = true;

        $request->hasFile('passport_copy') ? $application->PassportDocPath = $this->uploadDocuments($request->file('passport_copy'), 'pass') : '';
        $request->hasFile('biography') ? $application->AboutCandidateDocPath = $this->uploadDocuments($request->file('biography'), 'bio') : '';
        $request->hasFile('university_document') ? $application->AcceptDocPath = $this->uploadDocuments($request->file('university_document'), 'uniDoc') : '';
        $request->hasFile('certificate_document') ? $application->CertificateDocPath = $this->uploadDocuments($request->file('certificate_document'), 'cerDoc') : '';
        $request->hasFile('medical_certificate') ? $application->MedicalDocPath = $this->uploadDocuments($request->file('medical_certificate'), 'medCer') : '';
        $request->hasFile('realEstate_document') ? $application->depositDocPath = $this->uploadDocuments($request->file('realEstate_document'), 'reDoc') : '';
        $request->hasFile('testimonial') ? $application->ReferenceDocPath = $this->uploadDocuments($request->file('testimonial'), 'ref') : '';
        $request->hasFile('psychological_dispensary') ? $application->PsychologicalDispensaryPath = $this->uploadDocuments($request->file('psychological_dispensary'), 'pd') : '';
        $request->hasFile('owner_passport') ? $application->OwnerPassportDocPath = $this->uploadDocuments($request->file('owner_passport'), 'pd') : '';
        $request->hasFile('academic_transcript') ? $application->AcademicTranscriptPath = $this->uploadDocuments($request->file('academic_transcript'), 'at') : '';


        $application -> AuditInsertedUserId = 1;
        $application -> AuditInsertedDateTime  = date("Y-m-d h:i:s");


        DB::connection('sqlsrv') ->  transaction(function() use ($request,$application) {
            $application->save();

            $this->storeLanguageCertificate($application, $request);
            isset($request->realEstate) ? $this->storeRealEstate($application, $request) : '';
            isset($request->bank_guarantee) ? $this->storeBankGuarantee($application, $request) : '';


            $userProgram = UserProgram::where('UserId', Auth::user()->id)->first();

            $userProgram->ProgramId = $application->ProgramId;
            $userProgram->UserProgramStatusId = 2;
            $userProgram->save();
        });

        return response()->json(['status' => 'success']);

    }


    public function uploadDocuments($file, $prefix)
    {

        $file_extension = $file->getClientOriginalExtension();
        $filename = Auth::user()->id . "_" . $prefix . "_" . str_random('5') . '.' . $file_extension;


        Storage::put('public/ApplicationDocuments/' . $filename, (string)file_get_contents($file), 'public');
//       return $file_path = Storage::url('ApplicationDocuments/' . $filename);

        return $filename;
    }


    public function storeRealEstate($application, $request)
    {
        $realEstate = new RealEstate;

        $realEstate -> ApplicationId = $application -> Id;
        $realEstate -> DepositId = $request -> realEstate_deposit_object_id;
        $realEstate -> Address = $request -> realEstate_located_city;
        $realEstate -> Owner = $request -> realEstate_owner;
        $realEstate -> Phone = $request -> realEstate_owner_contact;
        $realEstate -> Email = $request -> realEstate_owner_email;
        $realEstate -> SerialNo = $request -> realEstateSNO['serial'] . $request->realEstateSNO['number'];
        $realEstate -> ReyestrNo = $request -> realEstate_reyester;
        $realEstate -> RegistrNo = $request -> realEstate_registry;
        $realEstate -> RegistrDate = $request -> realEstate_registry_date;

        $realEstate -> Acceptable = 1;
        $realEstate -> AuditInsertedUserId = 1;
        $realEstate -> AuditInsertedDateTime  = date("Y-m-d h:i:s");

        $realEstate->save();

    }

    public function storeBankGuarantee($application, $request)
    {
        $bankGuarantee = new BankGuarantee;

        $bankGuarantee->ApplicationId = $application->Id;
        $bankGuarantee->BankId = $request->bank_id;
        $bankGuarantee->Amount = $request->bank_fee['amount'];
        $bankGuarantee->CurrencyId = $request->bank_fee['currency'];

        $bankGuarantee -> Acceptable = 1;
        $bankGuarantee -> AuditInsertedUserId = 1;
        $bankGuarantee -> AuditInsertedDateTime  = date("Y-m-d h:i:s");

        $bankGuarantee->save();

    }

    public function storeLanguageCertificate($application, $request)
    {

        foreach ($request->language_education_certificate_id as $certificate) {
            if (!empty($certificate['certificate'])) {

                if (!empty($certificate['otherCertificate_name'])) {

                    $newCertificate = new Certificate();
                    $newCertificate->Name = $certificate['otherCertificate_name'];
                    $newCertificate->IsShow = 0;
                    $newCertificate->save();
                }
                $languageCertificate = new LangLevel();

                $languageCertificate->ApplicationId = $application->Id;
                $languageCertificate->CertificateId = !empty($certificate['otherCertificate_name']) ? $newCertificate->Id : $certificate['certificate'];
                $languageCertificate->Listening = $certificate ['listening'];
                $languageCertificate->Writting = $certificate ['writing'];
                $languageCertificate->Reading = $certificate ['reading'];
                $languageCertificate->Speaking = $certificate ['speaking'];
                $languageCertificate->FinalScore = !empty($certificate['otherCertificate_name']) ? $certificate['otherCertificate_point'] : $certificate ['general'];


                $languageCertificate->save();
            }

        }
    }





    public function relCountry(Request $req)
    {
        $specialization = Specialization::find($req->specialization_id);
        $universities = $specialization->universities;

        return $universitiesWithCountries = $universities->filter(function ($uni) {
            return $uni->country;
        });

    }

    public function relUniversity(Request $req)
    {
//        return $req;

        if (isset($req->specialization_id)) {
            $specialization = Specialization::find($req->specialization_id);
        } else {
            $specialization = SpecialityGroup::find($req->speciality_id)->specializations->first();

        }


        $universities = $specialization->universities;


        $unis = $universities->filter(function ($uni) use ($req) {
            return $uni->CountryId == $req->country_id;
        });

        return $unis;
    }

    public function relSpecialization(Request $req)
    {
        $speciality = SpecialityGroup::find($req->speciality_id);
        $specializations = $speciality->specializations;

        $specialization_select_options = '';
        foreach ($specializations as $specialization) {
            $specialization_select_options .= '<option value="' . $specialization->Id . '">' . $specialization->Name . '</option>';
        }
        $specialization_select = '<select name="specialization_id" id="specialization_id" class="form-control specialization_select">' . $specialization_select_options . '</select>';

        $universitiesWithCountry = $specializations->filter(function ($specializations) {
            return $specializations->universities->filter(function ($university) {
                return $university->country;
            });
        });

        return response()->json([
            'count' => $specializations->count(),
            'specializations' => $specialization,
            'specializations_select' => $specialization_select,
            'universitiesWithCountry' => $universitiesWithCountry->first()
        ]);

    }


    public function uploadArchiveFile(\App\Http\Requests\ArchiveFileValidation $req, $slug)
    {
        $storagePath =
            Storage::disk('public')->put('application/' . $slug . '/' . Auth::user()->id . '/temp', $req->file('file'));
// Extract the filename
        $storageName = basename($storagePath);

        // $path= Storage::disk('public')-> $req->file('file')->store('application/external');
        return $storageName;
    }


    public function removeFile(Request $req)
    {
        Storage::disk('public')->delete('application/' . $req->slug . '/' . Auth::user()->id . '/temp/' . $req->name);

        return $req->name;
    }




    public function DownloadExtFile(Request $req)
    {

        return new \App\Http\Resources\External(\App\ExternalProgramApplication::find($req->app_id));
        /// return new \App\Http\Resources\FileDownload(\App\ExternalProgramApplication::find($req->app_id));
        //     return Storage::disk('public')->path('app/file.txt');

    }



}