
@if($user->exists && count($user->previousEducations))
    @foreach($user->previousEducations as $previousEducation)
        <div class="fieldGroup" id="fieldGroup{{ $loop->iteration }}">
            {{ Form::hidden('previous_education_id[]', $previousEducation->id) }}

            <div class="form-group row">
                <label for="previous_education_level" class="col-4 col-form-label">Təhsil Pilləsi</label>
                <div class="col-8">
                    {{--{{ dd($user->finalEducation) }}--}}
{{--                    {{ Form::select('previous_education_level[]', $educationLevels, ($user->exists && isset($previousEducation->education_level_id)) ? $previousEducation->education_level_id : old('education_level'),--}}
{{--                       ['class' => 'form-control here', 'placeholder' => '---- Təhsil Pilləsini seç ----', 'required', "data-required-error"=>'Təhsil Pilləsi sahəsini boş buraxmayın']--}}
{{--                    ) }}--}}

                    <select name="previous_education_level[]" id="education_level" class="form-control">
                        @foreach($educationLevels as $educationLevel)
                            <option {{$user -> exists && $previousEducation -> EducationLevelId == $educationLevel -> Id ? 'selected' : ''}} value="{{$educationLevel -> Id}}">{{$educationLevel -> Name}}</option>
                        @endforeach
                    </select>

                    <div class="help-block with-errors"></div>
                </div>
            </div>

            <div class="form-group row">
                <label for="country" class="col-4 col-form-label">Ölkə seç</label>
                <div class="col-8">
                    {{--            {{ Form::select('previous_education_country_id[]', $countries, null,--}}
                    {{--                ['class' => 'form-control here', 'placeholder'=>'---- Ölkə seç ----', 'id' => 'previous_education_country_id', "data-required-error"=>'Bu sahəni boş buraxmayın']--}}
                    {{--            ) }}--}}
                    <select name="previous_education_country_id[]" id="ex_previous_education_country_id" class="form-control">
                        @foreach($countries as $country)
                            <option {{$user -> exists && $previousEducation -> university -> country -> Id == $country -> Id ? 'selected' : ''}} value="{{$country -> Id}}">{{$country -> Name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="university_id" class="col-4 col-form-label">Universitet</label>
                <div class="col-8">
                    {{--            {{ Form::select('previous_education_university_id[]', ['' => '---- Universitet seç ----'], null,--}}
                    {{--                ['class' => 'form-control here', 'id' => 'previous_education_university_id', "data-required-error"=>'Bu sahəni boş buraxmayın'])--}}
                    {{--            }}--}}
                    <select name="previous_education_university_id[]" id="ex_previous_education_university_id" class="form-control">
                        @foreach($universities as $university)
                            <option {{$user -> exists && $previousEducation -> university -> Id == $university -> Id ? 'selected' : ''}} value="{{$university -> Id}}">{{$university -> Name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

{{--            <div class="form-group row">--}}
{{--                <label for="country" class="col-4 col-form-label">Ölkə seç</label>--}}
{{--                <div class="col-8">--}}
{{--                    --}}{{--{{ dd($countries) }}--}}
{{--                    <select name="previous_education_country_id[]" id="ex_previous_education_country_id" class="form-control here"  data-required-error="Bu sahəni boş buraxmayın">--}}
{{--                        @foreach($countries as $country => $name)--}}
{{--                            <option value="{{ $country }}" {{ ($country == $previousEducation->university) ? 'selected' : '' }}>{{ $name }}</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                    --}}{{--{{ Form::select('previous_education_country_id[]', $countries, $previousEducation->university->country_id,--}}
{{--                        --}}{{--['class' => 'form-control here', 'placeholder'=>'---- Ölkə seç ----', 'id' => 'ex_previous_education_country_id' ]--}}
{{--                    --}}{{--) }}--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="form-group row">--}}
{{--                <label for="university_id" class="col-4 col-form-label">Universitet</label>--}}
{{--                <div class="col-8">--}}
{{--                    {{ Form::select('previous_education_university_id[]',\App\University::where('country_id', $previousEducation->university)->pluck('Name','id')->toArray() , $previousEducation->university->id,--}}
{{--                                ['class' => 'form-control here', 'id' => 'ex_previous_education_university_id', "data-required-error"=>'Universitet sahəsini boş buraxmayın'])--}}
{{--                    }}--}}
{{--                </div>--}}
{{--            </div>--}}

            <div class="form-group row">
                <label for="edu_date" class="col-4 col-form-label">Təhsil müddəti(il)</label>
                <div class="col-4">
                    {{ Form::number('previous_education_BeginDate[]', $previousEducation->StartDate, ['class' => 'form-control here', 'id' => 'datePicker111', "data-required-error"=>'Bu sahəni boş buraxmayın']) }}
                </div>
                <div class="col-4">
                    {{ Form::number('previous_education_EndDate[]', $previousEducation->EndDate, ['class' => 'form-control here', 'id' => 'datePicker111', "data-required-error"=>'Bu sahəni boş buraxmayın']) }}
                </div>
            </div>

            <div class="form-group row">
                <label for="speciality" class="col-4 col-form-label">Fakültə</label>
                <div class="col-8">
                    {{ Form::text('previous_education_faculty[]', $previousEducation->Faculty, ['class' => 'form-control here', 'id'=> 'previous_education_speciality','required',"data-required-error"=>'İxtisas sahəsini boş buraxmayın']) }}
                </div>
            </div>

            <div class="form-group row">
                <label for="speciality" class="col-4 col-form-label">İxtisas</label>
                <div class="col-8">
                    {{ Form::text('previous_education_speciality[]', $previousEducation->Speciality, ['class' => 'form-control here', 'id'=> 'previous_education_speciality', "data-required-error"=>'Bu sahəni boş buraxmayın']) }}
                </div>
            </div>

            <div class="form-group row">
                <label for="previous_education_admission_score" class="col-4 col-form-label">Qəbul balı</label>
                <div class="col-8">
                    {{ Form::number('previous_education_admission_score[]', $previousEducation->AdmissionScore, ['class' => 'form-control here', 'id' => 'previous_education_admission_score']) }}
                </div>
            </div>

            <div class="form-group row">
                <label for="country" class="col-4 col-form-label">Bölmə</label>
                <div class="col-8">
                    {{--            {{ Form::select('previous_education_section_id[]', $educationSections, null,--}}
                    {{--                ['class' => 'form-control here', 'id' => 'previous_education_section_id', "data-required-error"=>'Bu sahəni boş buraxmayın']--}}
                    {{--            ) }}--}}
                    <select name="previous_education_section_id[]" id="previous_education_section_id" class="form-control">
                        @foreach($educationSections as $educationSection)
                            <option {{$user -> exists && $previousEducation -> EducationSectionId  == $educationSection -> Id ? 'selected' : ''}} value="{{$educationSection -> Id}}">{{$educationSection -> Name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="country" class="col-4 col-form-label">Təhsil forması</label>
                <div class="col-8">
                    {{ Form::select('previous_education_form_id[]', $educationForms, $previousEducation -> EducationFormId,
                        ['class' => 'form-control here', 'id' => 'previous_education_form_id', "data-required-error"=>'Bu sahəni boş buraxmayın']
                    ) }}
                </div>
            </div>
            <div class="form-group row">
                <label for="country" class="col-4 col-form-label">Təhsil qrupu</label>
                <div class="col-8">
                    {{ Form::select('previous_education_payment_form_id[]', $educationPaymentForms, $previousEducation -> EducationPaymentFormId,
                        ['class' => 'form-control here', 'id' => 'previous_education_payment_form_id', "data-required-error"=>'Bu sahəni boş buraxmayın']
                    ) }}
                </div>
            </div>

            <div class="form-group row">
                <label for="previous_education_GPA" class="col-4 col-form-label">Orta bal (GPA)</label>
                <div class="col-8">
                    {{ Form::number('previous_education_GPA[]', $previousEducation -> GPA, ['class' => 'form-control here', 'id' => 'previous_education_GPA','step' => '0.1','min' => '1']) }}
                </div>
            </div>

            <hr>
            <div class="input-group-addon">
                <a href="javascript:void(0)" class="btn btn-danger remove" id="delete-previous-education"><span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span> Ləğv et</a>
            </div>
        </div> {{--fieldGroup--}}
    @endforeach
@else
    {{--<div class="card card-body fieldGroupCopy" id="fieldGroupCopy" style="display: none">--}}

        {{--<div class="form-group row">--}}
            {{--<label for="country" class="col-4 col-form-label">Ölkə seç</label>--}}
            {{--<div class="col-8">--}}
                {{--{{ Form::select('previous_education_country_id[]', $countries, null,--}}
                    {{--['class' => 'form-control here', 'placeholder'=>'---- Ölkə seç ----', 'id' => 'previous_education_country_id']--}}
                {{--) }}--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--<div class="form-group row">--}}
            {{--<label for="university_id" class="col-4 col-form-label">Universitet</label>--}}
            {{--<div class="col-8">--}}
                {{--{{ Form::select('previous_education_university_id[]', ['' => '---- Universitet seç ----'], null,--}}
                    {{--['class' => 'form-control here', 'id' => 'previous_education_university_id'])--}}
                {{--}}--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--<div class="form-group row">--}}
            {{--<label for="edu_date" class="col-4 col-form-label">Təhsil müddəti</label>--}}
            {{--<div class="col-4">--}}
                {{--{{ Form::date('previous_education_BeginDate[]', date("Y-m-d", time() - 86400), ['class' => 'form-control here', 'id' => 'datePicker']) }}--}}
            {{--</div>--}}
            {{--<div class="col-4">--}}
                {{--{{ Form::date('previous_education_EndDate[]', now(), ['class' => 'form-control here', 'id' => 'datePicker']) }}--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--<div class="form-group row">--}}
            {{--<label for="speciality" class="col-4 col-form-label">İxtisas</label>--}}
            {{--<div class="col-8">--}}
                {{--{{ Form::text('previous_education_speciality[]', null, ['class' => 'form-control here']) }}--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--<div class="form-group row">--}}
            {{--<label for="admission_score" class="col-4 col-form-label">Qəbul balı</label>--}}
            {{--<div class="col-8">--}}
                {{--{{ Form::text('previous_education_admission_score[]', null, ['class' => 'form-control here']) }}--}}
            {{--</div>--}}
        {{--</div>--}}
            {{--<div class="input-group-addon">--}}
                {{--<a href="javascript:void(0)" class="btn btn-danger remove"><span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span> Ləğv et</a>--}}
            {{--</div>--}}
        {{--<hr>--}}
    {{--</div> --}}{{--fieldGroup--}}
@endif
