@if($user->exists && isset($user->finalEducation))
    {{ Form::hidden('final_education_id', $user->finalEducation->id) }}
@endif
<div class="form-group row">
    <label for="education_level" class="col-4 col-form-label">Təhsil Pilləsi</label>
    <div class="col-8">
        {{--{{ dd($user->finalEducation) }}--}}
        {{ Form::select('education_level', $educationLevels, ($user->exists) ? $user->finalEducation->education_level_id : old('education_level'),
           ['class' => 'form-control here', 'placeholder' => '---- Təhsil Pilləsini seç ----', 'required']
        ) }}
    </div>
</div>

<div class="fieldGroup" id="fieldGroup">
    <div class="form-group row">
        <label for="country" class="col-4 col-form-label">Ölkə seç</label>
        <div class="col-8">
            {{ Form::select('country_id', $countries, ($user->exists) ? $user->finalEducation->university->country_id : old('country_id'),
                ['class' => 'form-control here', 'id' => 'country_id', 'placeholder' => '---- Ölkə seç ----', 'required'])
            }}
        </div>
    </div>

    <div class="form-group row">
        <label for="university_id" class="col-4 col-form-label">Universitet</label>
        <div class="col-8">
            {{ Form::select('university_id', ['' => '---- Universitet seç ----'], ($user->exists) ? $user->finalEducation->university_id : old('university_id'),
                ['class' => 'form-control here', 'id' => 'university_id', 'required'])
            }}
        </div>
    </div>

    <div class="form-group row">
        <label for="edu_date" class="col-4 col-form-label">Təhsil müddəti</label>
        <div class="col-4">
            {{ Form::date('BeginDate', ($user->exists) ? $user->finalEducation->BeginDate : old('BeginDate'), ['class' => 'form-control here', 'required']) }}
        </div>
        <div class="col-4">
            {{ Form::date('EndDate', ($user->exists) ? $user->finalEducation->EndDate : old('EndDate'), ['class' => 'form-control here', 'required']) }}
        </div>
    </div>
    <div class="form-group row">
        <label for="current_edu_year" class="col-4 col-form-label">Kurs</label>
        <div class="col-8">
            {{ Form::text('current_edu_year', ($user->exists) ? $user->finalEducation->CurrentEduYear : old('current_edu_year'), ['class' => 'form-control here', 'required']) }}
        </div>
    </div>

    <div class="form-group row">
        <label for="faculty" class="col-4 col-form-label">Fakültə</label>
        <div class="col-8">
            {{ Form::text('faculty', ($user->exists) ? $user->finalEducation->Faculty : old('faculty'), ['class' => 'form-control here', 'required']) }}
        </div>
    </div>

    <div class="form-group row">
        <label for="speciality" class="col-4 col-form-label">İxtisas</label>
        <div class="col-8">
            {{ Form::text('speciality', ($user->exists) ? $user->finalEducation->Speciality : old('speciality'), ['class' => 'form-control here', 'required']) }}
        </div>
    </div>

    <div class="form-group row">
        <label for="admission_score" class="col-4 col-form-label">Qəbul balı</label>
        <div class="col-8">
            {{ Form::text('admission_score', ($user->exists) ? $user->finalEducation->AdmissionScore : old('admission_score'), ['class' => 'form-control here', 'required']) }}
        </div>
    </div>


    <div class="form-group row">
        <label for="education_section_id" class="col-4 col-form-label">Bölmə</label>
        <div class="col-8">
            {{ Form::select('education_section_id', $educationSections, ($user->exists) ? $user->finalEducation->education_section_id : old('education_section_id'), ['class' => 'form-control here', 'required']) }}
        </div>
    </div>

    <div class="form-group row">
        <label for="education_form_id" class="col-4 col-form-label">Təhsil forması</label>
        <div class="col-8">
            {{ Form::select('education_form_id', $educationForms, ($user->exists) ? $user->finalEducation->education_form_id : old('education_form_id'), ['class' => 'form-control here', 'required']) }}
        </div>
    </div>

    <div class="form-group row">
        <label for="education_payment_form_id" class="col-4 col-form-label">Təhsil qrupu</label>
        <div class="col-8">
            {{ Form::select('education_payment_form_id', $educationPaymentForms, ($user->exists) ? $user->finalEducation->education_payment_form_id : old('education_payment_form_id'), ['class' => 'form-control here', 'required']) }}
        </div>
    </div>
    <hr>

</div> {{--fieldGroup--}}