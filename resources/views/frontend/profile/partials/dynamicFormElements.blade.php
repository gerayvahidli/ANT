{{--field group for previous education--}}
<div class="card card-body fieldGroupCopy" id="fieldGroupCopy" style="">

    <div class="form-group row required">
        <label for="previous_education_level" class="col-4 col-form-label">Təhsil Pilləsi</label>
        <div class="col-8">

            <select name="previous_education_level[]" id="previous_education_level" class="form-control">
                @foreach($educationLevels as $educationLevel)
                    <option value="{{$educationLevel -> Id}}">{{$educationLevel -> Name}}</option>
                @endforeach
            </select>
            <div class="help-block with-errors"></div>
        </div>
    </div>

    <div class="form-group row">
        <label for="country" class="col-4 col-form-label">Ölkə seç</label>
        <div class="col-8">

            <select name="previous_education_country_id[]" id="previous_education_country_id" class="form-control">
                @foreach($countries as $country)
                    <option value="{{$country -> Id}}">{{$country -> Name}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label for="university_id" class="col-4 col-form-label ">Universitet</label>
        <div class="col-8">
            <select name="previous_education_university_id[]" id="previous_education_university_id" class="form-control previous_university">
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label for="edu_date" class="col-4 col-form-label">Təhsil müddəti</label>
        <div class="col-4">
            {{ Form::number('previous_education_BeginDate[]', '', ['class' => 'form-control here',
         'required',
         'id' => 'previous_education_BeginDate',
         'autocomplete' => 'none',
         'min'=>'1900',
         'max'=>'2100',
         'onkeydown' =>'return event.keyCode !== 69 && event.keyCode !== 189',
         "data-msg-required"=>'Başlama tarixi sahəsini boş buraxmayın',
         "data-msg-max"=>'Başlama tarixi maksimum 2100 ola bilər',
         "data-msg-min"=>'Başlama tarixi minimum 1900 ola bilər']) }}
        </div>
        <div class="col-4">
            {{ Form::number('previous_education_EndDate[]', '', ['class' => 'form-control here',
          'required',
          'id' => 'previous_education_EndDate',
          'min'=>'1900',
          'max'=>'2100',
          'onkeydown' =>'return event.keyCode !== 69 && event.keyCode !== 189',
          "data-msg-required"=>'Bitmə tarixi sahəsini boş buraxmayın',
          "data-msg-max"=>'Bitmə tarixi maksimum 2100 ola bilər',
          "data-msg-min"=>'Bitmə tarixi minimum 1900 ola bilər'   ]) }}
        </div>
    </div>
    <div class="form-group row">
        <label for="speciality" class="col-4 col-form-label">Fakültə</label>
        <div class="col-8">
            {{ Form::text('previous_education_faculty[]', null, ['class' => 'form-control here',
          'id'=> 'previous_education_faculty',
          'required',
          'maxlength' => '500',
          "data-msg-required"=>'Fakultə sahəsini boş buraxmayın']) }}
        </div>
    </div>


    <div class="form-group row">
        <label for="speciality" class="col-4 col-form-label">İxtisas</label>
        <div class="col-8">
            {{ Form::text('previous_education_speciality[]', null, ['class' => 'form-control here',
          'id'=> 'previous_education_speciality',
          'required',
          'maxlength' => '500',
          "data-msg-required"=>'İxtisas sahəsini boş buraxmayın'

          ]) }}
        </div>
    </div>

    <div class="form-group row">
        <label for="previous_education_admission_score" class="col-4 col-form-label">Qəbul balı</label>
        <div class="col-8">
            {{ Form::number('previous_education_admission_score[]', 0, ['class' => 'form-control here',
         'id' => 'previous_education_admission_score',
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

            <select name="previous_education_section_id[]" id="previous_education_section_id" class="form-control">
                @foreach($educationSections as $educationSection)
                    <option value="{{$educationSection -> Id}}">{{$educationSection -> Name}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label for="country" class="col-4 col-form-label">Təhsil forması</label>
        <div class="col-8">
            {{ Form::select('previous_education_form_id[]', $educationForms, null,
                ['class' => 'form-control here', 'id' => 'previous_education_form_id', "data-required-error"=>'Bu sahəni boş buraxmayın']
            ) }}
        </div>
    </div>
    <div class="form-group row">
        <label for="country" class="col-4 col-form-label">Təhsil qrupu</label>
        <div class="col-8">
            {{ Form::select('previous_education_payment_form_id[]', $educationPaymentForms, null,
                ['class' => 'form-control here', 'id' => 'previous_education_payment_form_id', "data-required-error"=>'Bu sahəni boş buraxmayın']
            ) }}
        </div>
    </div>

    <div class="form-group row">
        <label for="previous_education_GPA" class="col-4 col-form-label">Orta bal (GPA)</label>
        <div class="col-8">
            {{ Form::number('previous_education_GPA[]', null, ['class' => 'form-control here',
         'id' => 'previous_education_GPA',
         'required',
         'step' => 'any',
         'min' => '0',
         'max' => '100',
         'placeholder' => '0',
         'onkeydown' =>'return event.keyCode !== 69 && event.keyCode !== 189',
         "data-msg-required"=>'Orta bal sahəsini sahəsini boş buraxmayın',
         "data-msg-max"=>'Orta bal (GPA) maksimum 100 ola bilər',
         "data-msg-min"=>'Orta bal (GPA) minimum 0 ola bilər',
         'id' => 'previous_education_GPA',
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
        </div>
    </div>
    <div class="input-group-addon">
        <a href="javascript:void(0)" class="btn btn-danger remove"><span class="glyphicon glyphicon glyphicon-remove"
                                                                         aria-hidden="true"></span> Ləğv et</a>
    </div>
    <hr>
</div>


{{--fieldGroup for previous work--}}

<div class="card card-body previousWorkFieldGroupCopy" id="previousWorkFieldGroupCopy" style="">
    <hr>
    <div class="form-group row required">
        <label for="previous_company_id" class="col-4 col-form-label">Müəssisə</label>
        <div class="col-8">

            <select class="form-control" id="previous_company_id" name="previous_company_id[]">
                @foreach($companies as $company)
                    <option value="{{$company -> Id}}">{{$company -> Name}}</option>
                @endforeach
                <option value="other">Digər</option>
            </select>
        </div>
    </div>
    <div class="form-group row ">
        <label for="previous_organization" class="col-4 col-form-label">Təşkilat</label>
        <div class="col-8">
            <input class="form-control" type="text" name="previous_organization[]" id="previous_organization">
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="form-group row required ">
        <label for="previous_department" class="col-4 col-form-label">Struktur Bölmə</label>
        <div class="col-8">
            <input class="form-control" type="text" name="previous_department[]" id="">
            <div class="help-block with-errors"></div>
        </div>
    </div>

    <div class="form-group row required">
        <label for="previous_position" class="col-4 col-form-label">Vəzifə</label>
        <div class="col-8">
            <input class="form-control" type="text" name="previous_position[]" id="previous_position">
            <div class="help-block with-errors"></div>
        </div>
    </div>

    <div class="form-group row required">
        <label for="previous_StartDate" class="col-4 col-form-label">İşə qəbul tarixi</label>
        <div class="col-8">
            <input class="form-control" type="date" name="previous_StartDate[]" id="previous_StartDate">
            <div class="help-block with-errors"></div>
        </div>
    </div>

    <div class="form-group row required">
        <label for="previous_EndDate" class="col-4 col-form-label">İşdən ayrılma tarixi</label>
        <div class="col-8">
            <input class="form-control" type="date" name="previous_EndDate[]" id="previous_EndDate">
            <div class="help-block with-errors"></div>
        </div>
    </div>

{{--    <div class="form-group row required">--}}
{{--        <label for="previous_tabel_number" class="col-4 col-form-label">Tabel nömrəniz</label>--}}
{{--        <div class="col-8">--}}
{{--            <input class="form-control" type="text" name="previous_tabel_number[]" id="previous_tabel_number">--}}
{{--            <div class="help-block with-errors"></div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <div class="input-group-addon">
        <a href="javascript:void(0)" class="btn btn-danger removeWork"><span
                    class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span> Ləğv et</a>
    </div>

</div>
{{-- end fieldGroup for previous internships --}}

{{--Form--}}



