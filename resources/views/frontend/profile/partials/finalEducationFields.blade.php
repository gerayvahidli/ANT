<p class="lead">
    Təhsil Haqqında Məlumat
</p>
@if($user->exists && isset($user->finalEducation))
    {{ Form::hidden('final_education_id', $user->finalEducation->id) }}
@endif
<div class="form-group row required">
    <label for="education_level" class="col-4 col-form-label">Təhsil Pilləsi</label>
    <div class="col-8">
        {{--{{ dd($user->finalEducation) }}--}}
        {{--        {{ Form::select('education_level', $educationLevels, ($user->exists && isset($user->finalEducation->education_level_id)) ? $user->finalEducation->education_level_id : old('education_level'),--}}
        {{--           ['class' => 'education_level  form-control here', 'placeholder' => '---- Təhsil Pilləsini seç ----', '', "data-required-error"=>'Təhsil Pilləsi sahəsini boş buraxmayın']--}}
        {{--        ) }}--}}
        <select name="education_level" id="education_level" class="form-control">
            @foreach($educationLevels as $educationLevel)
                <option value="{{$educationLevel -> Id}}">{{$educationLevel -> Name}}</option>
            @endforeach
        </select>

        <div class="help-block with-errors"></div>
    </div>
</div>

<div class="fieldGroup" id="fieldGroup">
    <div class="form-group row required">
        <label for="country" class="col-4 col-form-label">Ölkə seç</label>
        <div class="col-8">
            {{--            {{ Form::select('country_id', $countries, ($user->exists && isset($user->finalEducation->education_level_id)) ? $user->finalEducation->university->country_id : old('country_id'),--}}
            {{--                ['class' => 'form-control here', 'id' => 'country_id', 'placeholder' => '---- Ölkə seç ----', '',"data-required-error"=>'Ölkə sahəsini boş buraxmayın'])--}}
            {{--            }}--}}
            <select name="country_id" id="country_id" class="form-control">
                @foreach($countries as $country)
                    <option value="{{$country -> Id}}">{{$country -> Name}}</option>
                @endforeach
            </select>

            <div class="help-block with-errors"></div>
        </div>
    </div>

    <div class="form-group row required">
        <label for="university_id" class="col-4 col-form-label">Universitet</label>
        <div class="col-8">

{{--            @if(old('country_id')!=null)--}}
{{--                {{ Form::select('university_id',\App\University::where('country_id',old('country_id'))->pluck('Name','id')->toArray() , ($user->exists) ? $user->finalEducation->university_id : old('university_id'),--}}
{{--                            ['class' => 'form-control here', 'id' => 'university_id', '',"data-required-error"=>'Universitet sahəsini boş buraxmayın'])--}}
{{--                }}--}}
{{--            @elseif ($user->exists && isset($user->finalEducation->university_id))--}}
{{--                {{ Form::select('university_id', \App\University::where('country_id', $user->finalEducation->university->country_id )->pluck('Name','id')->toArray(), $user->finalEducation->university_id,--}}
{{--                            ['class' => 'form-control here', 'id' => 'university_id'])--}}
{{--                }}--}}
{{--            @else--}}
{{--                {{ Form::select('university_id', ['' => '---- Universitet seç ----'], ($user->exists && isset($user->finalEducation)) ? $user->finalEducation->university_id : old('university_id'),--}}
{{--                            ['class' => 'form-control here', 'id' => 'university_id'])--}}
{{--                }}--}}
{{--            @endif--}}
            <select name="university_id" id="university_id" class="form-control"></select>

        </div>
    </div>

    <div class="form-group row required">
        <label for="edu_date" class="col-4 col-form-label">Təhsil müddəti</label>
        <div class="col-4 form-group">
            {{ Form::text('BeginDate', ($user->exists && isset($user->finalEducation)) ? $user->finalEducation->BeginDate->format('Y-m-d') : old('BeginDate'), ['class' => ($errors->has('BeginDate')) ? 'form-control is-invalid' :'form-control', '',"data-required-error"=>'Bu sahəni boş buraxmayın','id'=> 'BeginDate','autocomplete' => 'none']) }}
            @if ($errors->has('BeginDate'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('BeginDate') }}</strong>
                </div>
            @endif

            <div class="help-block with-errors"></div>

        </div>
        <div class="col-4 form-group">
            {{ Form::text('EndDate', ($user->exists && isset($user->finalEducation)) ? $user->finalEducation->EndDate->format('Y-m-d') : old('EndDate'), ['class' => ($errors->has('EndDate')) ? 'form-control is-invalid' :'form-control', '',"data-required-error"=>'Bu sahəni boş buraxmayın','id'=> 'EndDate','autocomplete' => 'none']) }}
            @if ($errors->has('EndDate'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('EndDate') }}</strong>
                </div>
            @endif

            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="form-group row required">
        <label for="faculty" class="col-4 col-form-label">Fakültə</label>
        <div class="col-8">
            {{ Form::text('faculty', ($user->exists && isset($user->finalEducation)) ? $user->finalEducation->Faculty : old('faculty'), ['class' => ($errors->has('faculty')) ? 'form-control is-invalid' :'form-control', '',"data-required-error"=>'Fakultə sahəsini boş buraxmayın']) }}
            @if ($errors->has('faculty'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('faculty') }}</strong>
                </div>
            @endif

            <div class="help-block with-errors"></div>
        </div>
    </div>

    <div class="form-group row required">
        <label for="speciality" class="col-4 col-form-label">İxtisas</label>
        <div class="col-8">
            {{ Form::text('speciality', ($user->exists && isset($user->finalEducation)) ? $user->finalEducation->Speciality : old('speciality'), ['class' => ($errors->has('speciality')) ? 'form-control is-invalid' :'form-control', '',"data-required-error"=>'İxtisas sahəsini boş buraxmayın']) }}
            @if ($errors->has('speciality'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('speciality') }}</strong>
                </div>
            @endif

            <div class="help-block with-errors"></div>
        </div>
    </div>

    <div class="form-group row required">
        <label for="admission_score" class="col-4 col-form-label">Qəbul balı</label>
        <div class="col-8">
            {{ Form::number('admission_score',
                ($user->exists && isset($user->finalEducation)) ? $user->finalEducation->AdmissionScore : old('admission_score'),
             ['class' => 'form-control', '',"data-required-error"=>'Qəbul balı sahəsini düzgün qeyd edin',"data-error"=>'Qəbul balı maksimum 700-dən yuxarı olmamamalıdır','maxlength'=>3,'max'=>"700", 'id' => 'admission_score',
             ]) }}
            @if ($errors->has('admission_score'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('admission_score') }}</strong>
                </div>
            @endif

            <div class="help-block with-errors"></div>
        </div>
    </div>


    <div class="form-group row required">
        <label for="education_section_id" class="col-4 col-form-label">Bölmə</label>
        <div class="col-8">
            {{--            {{ Form::select('education_section_id', $educationSections, ($user->exists && isset($user->finalEducation->education_section_id)) ? $user->finalEducation->education_section_id : old('education_section_id'), ['class' => 'form-control here', 'id' => 'education_section_id', '']) }}--}}
            <select name="education_section_id" id="education_section_id" class="form-control">
                @foreach($educationSections as $educationSection)
                    <option value="{{$educationSection -> Id}}">{{$educationSection -> Name}}</option>
                @endforeach
            </select>
            <div class="help-block with-errors"></div>
        </div>
    </div>

    <div class="form-group row" style="display: none" id="customEducationSection">
        <label for="education_section" class="col-4 col-form-label">Bölməni daxil edin</label>
        <div class="col-8">
            {{ Form::text('education_section', ($user->exists && isset($user->finalEducation)) ? $user->finalEducation->educationSection->Name : old('education_section'), ['class' => 'form-control here'] ) }}
            <div class="help-block with-errors"></div>
        </div>
    </div>

    <div class="form-group row required">
        <label for="education_form_id" class="col-4 col-form-label">Təhsil forması</label>
        <div class="col-8">
            {{ Form::select('education_form_id', $educationForms, ($user->exists && isset($user->finalEducation)) ? $user->finalEducation->education_form_id : old('education_form_id'), ['class' => 'form-control here', '']) }}

            <div class="help-block with-errors"></div>
        </div>
    </div>

    <div class="form-group row required">
        <label for="education_payment_form_id" class="col-4 col-form-label">Təhsil qrupu</label>
        <div class="col-8">
            {{ Form::select('education_payment_form_id', $educationPaymentForms, ($user->exists && isset($user->finalEducation)) ? $user->finalEducation->education_payment_form_id : old('education_payment_form_id'), ['class' => 'form-control here', '']) }}
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="form-group row required">
        <label for="GPA" class="col-4 col-form-label">Orta bal (GPA)</label>
        <div class="col-8">
            {{ Form::number('GPA',
                ($user->exists && isset($user->finalEducation)) ? $user->finalEducation->AdmissionScore : old('GPA'),
             ['class' => 'form-control', 'step' => '0.1', '',"data-required-error"=>'Qəbul balı sahəsini düzgün qeyd edin',"data-error"=>'Qəbul balı maksimum 700-dən yuxarı olmamamalıdır','maxlength'=>3,'max'=>"700", 'id' => 'GPA',
             ]) }}
            @if ($errors->has('GPA'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('GPA') }}</strong>
                </div>
            @endif

            <div class="help-block with-errors"></div>
        </div>
    </div>
    <hr>

</div> {{--fieldGroup--}}
