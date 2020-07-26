@if($user->exists && count($user->previousEducations))
    <p class="lead"> ƏVVƏLKİ TƏHSİLLƏRİ</p>
    @foreach($user->previousEducations as $previousEducation)
        <p class="lead"> Əvvəlki təhsil {{$loop -> iteration}}</p>
        <div class="fieldGroup" id="fieldGroup{{ $loop->iteration }}">
            {{ Form::hidden('previous_education_id[]', $previousEducation->Id) }}

            <div class="form-group row">
                <label for="previous_education_level" class="col-4 col-form-label">Təhsil Pilləsi</label>
                <div class="col-8">
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
                    <select name="previous_education_country_id[]" id="ex_previous_education_country_id" class="form-control">
                        @foreach($countries as $country)
                            <option {{$user -> exists && $previousEducation -> university -> country -> Id == $country -> Id ? 'selected' : ''}} value="{{$country -> Id}}">{{$country -> Name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row universityDiv">
                <label for="university_id" class="col-4 col-form-label ">Universitet</label>
                <div class="col-8">
                    <select name="previous_education_university_id[]" id="ex_previous_education_university_id" class="form-control ex_previous_university">
                        @if($user -> exists  && $previousEducation -> university -> IsShow == 0)

                            @foreach(Helper::getUniversitiesByCountry ($previousEducation -> university -> country -> Id) as $university)
                                <option value="{{$university -> Id}}">{{$university -> Name}}</option>
                            @endforeach
                            <option value="other" selected>Digər</option>

                        @else

                            @foreach(Helper::getUniversitiesByCountry ($previousEducation -> university -> country -> Id) as $university)
                                <option {{$user -> exists && $previousEducation  -> UniversityId == $university -> Id ? 'selected' : ''}} value="{{$university -> Id}}">{{$university -> Name}}</option>
                            @endforeach
                            <option value="other">Digər</option>

                        @endif
                    </select>

                    @if($user -> exists  && $previousEducation -> university -> IsShow == 0)
                        <input type="text" class="form-control checkOtherUniversity" value="{{$previousEducation -> university -> Name}}" style="display: none">
                    @endif

                </div>
            </div>

            <div class="form-group row">
                <label for="edu_date" class="col-4 col-form-label">Təhsil müddəti(il)</label>
                <div class="col-4 form-group">
                    {{ Form::number('previous_education_BeginDate[]', $previousEducation->StartDate, ['class' => 'form-control here',
                    'required',
                    'id' => 'ex_previous_education_BeginDate',
                    'autocomplete' => 'none',
                    'min'=>'1900',
                    'max'=>'2100',
                    'onkeydown' =>'return event.keyCode !== 69 && event.keyCode !== 189',
                    "data-msg-required"=>'Başlama tarixi sahəsini boş buraxmayın',
                    "data-msg-max"=>'Başlama tarixi maksimum 2100 ola bilər',
                    "data-msg-min"=>'Başlama tarixi minimum 1900 ola bilər']) }}
                    <div class="help-block with-errors"></div>
                </div>
                <div class="col-4 form-group">
                    {{ Form::number('previous_education_EndDate[]', $previousEducation->EndDate, ['class' => 'form-control here',
                   'required',
                   'id' => 'ex_previous_education_EndDate',
                   'min'=>'1900',
                   'max'=>'2100',
                   'onkeydown' =>'return event.keyCode !== 69 && event.keyCode !== 189',
                   "data-msg-required"=>'Bitmə tarixi sahəsini boş buraxmayın',
                   "data-msg-max"=>'Bitmə tarixi maksimum 2100 ola bilər',
                   "data-msg-min"=>'Bitmə tarixi minimum 1900 ola bilər'   ]) }}
                    <div class="help-block with-errors"></div>
                </div>
            </div>

            <div class="form-group row">
                <label for="speciality" class="col-4 col-form-label">Fakültə</label>
                <div class="col-8">
                    {{ Form::text('previous_education_faculty[]', $previousEducation->Faculty, ['class' => 'form-control here',
                  'id'=> 'ex_previous_education_faculty',
                  'required',
                  'maxlength' => '500',
                  "data-msg-required"=>'Fakultə sahəsini boş buraxmayın']) }}
                </div>
            </div>


            <div class="form-group row">
                <label for="speciality" class="col-4 col-form-label">İxtisas</label>
                <div class="col-8">
                    {{ Form::text('previous_education_speciality[]', $previousEducation->Speciality, ['class' => 'form-control here',
                  'id'=> 'ex_previous_education_speciality',
                  'required',
                  'maxlength' => '500',
                  "data-msg-required"=>'İxtisas sahəsini boş buraxmayın'

                  ]) }}
                </div>
            </div>

            <div class="form-group row">
                <label for="previous_education_admission_score" class="col-4 col-form-label">Qəbul balı</label>
                <div class="col-8">
                    {{ Form::number('previous_education_admission_score[]',($user -> exists && isset($previousEducation->AdmissionScore)) ? str_replace(' ', '', $previousEducation->AdmissionScore)  : NULL, ['class' => 'form-control here',
                 'id' => 'ex_previous_education_admission_score',
                 'required',
                 'min' => '0',
                 'max' => '700',
                 'placeholder' => '0',
                 'onkeydown' =>'return event.keyCode !== 69 && event.keyCode !== 189',
                 'oninput'=> 'this.value = Math.round(this.value)',
                 "data-msg-required"=>'Qəbul balı sahəsini sahəsini boş buraxmayın',
                 "data-msg-max"=>'Qəbul balı maksimum 700 ola bilər',
                 "data-msg-min"=>'Qəbul balı minimum 0 ola bilər',
                 ]) }}
                </div>
            </div>

            <div class="form-group row">
                <label for="country" class="col-4 col-form-label">Bölmə</label>
                <div class="col-8">
                    {{--            {{ Form::select('previous_education_section_id[]', $educationSections, null,--}}
                    {{--                ['class' => 'form-control here', 'id' => 'previous_education_section_id', "data-required-error"=>'Bu sahəni boş buraxmayın']--}}
                    {{--            ) }}--}}
                    <select name="previous_education_section_id[]" id="ex_previous_education_section_id" class="form-control">
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
                        ['class' => 'form-control here', 'id' => 'ex_previous_education_form_id', "data-required-error"=>'Bu sahəni boş buraxmayın']
                    ) }}
                </div>
            </div>
            <div class="form-group row">
                <label for="country" class="col-4 col-form-label">Təhsil qrupu</label>
                <div class="col-8">
                    {{ Form::select('previous_education_payment_form_id[]', $educationPaymentForms, $previousEducation -> EducationPaymentFormId,
                        ['class' => 'form-control here', 'id' => 'ex_previous_education_payment_form_id', "data-required-error"=>'Bu sahəni boş buraxmayın']
                    ) }}
                </div>
            </div>

            <div class="form-group row">
                <label for="previous_education_GPA" class="col-4 col-form-label">Orta bal (GPA)</label>
                <div class="col-8">
                    {{ Form::number('previous_education_GPA[]', $previousEducation -> GPA, [
                 'class' => 'form-control here',
                 'id' => 'ex_previous_education_GPA',
                 'required',
                 'step' => 'any',
                 'min' => '0',
                 'max' => '100',
                 'placeholder' => '0',
                 'onkeydown' =>'return event.keyCode !== 69 && event.keyCode !== 189',
                 "data-msg-required"=>'Orta bal sahəsini sahəsini boş buraxmayın',
                 "data-msg-max"=>'Orta bal (GPA) maksimum 100 ola bilər',
                 "data-msg-min"=>'Orta bal (GPA) minimum 0 ola bilər',
                  ]) }}
                    <div class="help-block with-errors"></div>
                </div>
            </div>

            <hr>
            <div class="input-group-addon">
                <a href="javascript:void(0)" class="btn btn-danger remove" id="delete-previous-education"><span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span> Ləğv et</a>
            </div>
            <br>
        </div> {{--fieldGroup--}}
    @endforeach
@else

@endif
