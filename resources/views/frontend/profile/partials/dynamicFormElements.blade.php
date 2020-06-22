{{--field group for previous education--}}
<div class="card card-body fieldGroupCopy" id="fieldGroupCopy" style="">

    <div class="form-group row required">
        <label for="previous_education_level" class="col-4 col-form-label">Təhsil Pilləsi</label>
        <div class="col-8">

            {{ Form::select('previous_education_level[]', $educationLevels, null,
               ['class' => 'form-control here', 'placeholder' => '---- Təhsil Pilləsini seç ----', 'required', "data-required-error"=>'Təhsil Pilləsi sahəsini boş buraxmayın']
            ) }}

            <div class="help-block with-errors"></div>
        </div>
    </div>

    <div class="form-group row">
        <label for="country" class="col-4 col-form-label">Ölkə seç</label>
        <div class="col-8">
            {{ Form::select('previous_education_country_id[]', $countries, null,
                ['class' => 'form-control here', 'placeholder'=>'---- Ölkə seç ----', 'id' => 'previous_education_country_id', "data-required-error"=>'Bu sahəni boş buraxmayın']
            ) }}
        </div>
    </div>

    <div class="form-group row">
        <label for="university_id" class="col-4 col-form-label">Universitet</label>
        <div class="col-8">
            {{ Form::select('previous_education_university_id[]', ['' => '---- Universitet seç ----'], null,
                ['class' => 'form-control here', 'id' => 'previous_education_university_id', "data-required-error"=>'Bu sahəni boş buraxmayın'])
            }}
        </div>
    </div>

    <div class="form-group row">
        <label for="edu_date" class="col-4 col-form-label">Təhsil müddəti</label>
        <div class="col-4">
            {{ Form::text('previous_education_BeginDate[]', '', ['class' => 'form-control here', "data-required-error"=>'Bu sahəni boş buraxmayın','id' => 'previous_education_BeginDate']) }}

        </div>
        <div class="col-4">
            {{ Form::text('previous_education_EndDate[]', '', ['class' => 'form-control here', "data-required-error"=>'Bu sahəni boş buraxmayın','id' => 'previous_education_EndDate']) }}
        </div>
    </div>
    <div class="form-group row">
        <label for="speciality" class="col-4 col-form-label">Fakültə</label>
        <div class="col-8">
            {{ Form::text('previous_education_faculty[]', null, ['class' => 'form-control here', 'id'=> 'previous_education_faculty', "data-required-error"=>'Bu sahəni boş buraxmayın']) }}
        </div>
    </div>


    <div class="form-group row">
        <label for="speciality" class="col-4 col-form-label">İxtisas</label>
        <div class="col-8">
            {{ Form::text('previous_education_speciality[]', null, ['class' => 'form-control here', 'id'=> 'previous_education_speciality', "data-required-error"=>'Bu sahəni boş buraxmayın']) }}
        </div>
    </div>

    <div class="form-group row">
        <label for="admission_score" class="col-4 col-form-label">Qəbul balı</label>
        <div class="col-8">
            {{ Form::text('previous_education_admission_score[]', null, ['class' => 'form-control here', 'id' => 'previous_education_admission_score']) }}
        </div>
    </div>

    <div class="form-group row">
        <label for="country" class="col-4 col-form-label">Bölmə</label>
        <div class="col-8">
            {{ Form::select('previous_education_section_id[]', $educationSections, null,
                ['class' => 'form-control here', 'id' => 'previous_education_section_id', "data-required-error"=>'Bu sahəni boş buraxmayın']
            ) }}
        </div>
    </div>

    <div class="form-group row">
        <label for="country" class="col-4 col-form-label">Təhsil forması</label>
        <div class="col-8">
            {{ Form::select('previous_education_form[]', $educationForms, null,
                ['class' => 'form-control here', 'id' => 'previous_education_form', "data-required-error"=>'Bu sahəni boş buraxmayın']
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
        <label for="admission_score" class="col-4 col-form-label">Orta bal (GPA)</label>
        <div class="col-8">
            {{ Form::text('previous_education_admission_score[]', null, ['class' => 'form-control here', 'id' => 'previous_education_admission_score']) }}
        </div>
    </div>
    <div class="input-group-addon">
        <a href="javascript:void(0)" class="btn btn-danger remove"><span class="glyphicon glyphicon glyphicon-remove"
                                                                         aria-hidden="true"></span> Ləğv et</a>
    </div>
    <hr>
</div> {{--fieldGroup for previous education--}}

{{-- fieldGroup for previous internships --}}
<div class="card card-body previousInternshipFieldGroupCopy" id="previousInternshipFieldGroupCopy" style="">
    <hr>
    <div class="form-group row">
        <label for="internship_department" class="col-4 col-form-label">Təcrübə keçdiyiniz
            müəssisə</label>
        <div class="col-8">
            {{ Form::text('internship_department[]', null, ['class' => 'form-control here', 'placeholder' => 'Təcrübə keçdiyiniz müəssisə', 'id' => 'internship_department', "data-required-error"=>'Bu sahəni boş buraxmayın']) }}
        </div>
    </div>

    <div class="form-group row">
        <label for="internship_date" class="col-4 col-form-label">Təcrübə keçdiyiniz
            tarix</label>
        <div class="col-8">
            {{ Form::date('internship_date[]', null, ['class' => 'form-control here', 'placeholder' => now(), 'id' => 'internship_date', "data-required-error"=>'Bu sahəni boş buraxmayın']) }}
        </div>
    </div>
    <div class="input-group-addon">
        <a href="javascript:void(0)" class="btn btn-danger remove"><span class="glyphicon glyphicon glyphicon-remove"
                                                                         aria-hidden="true"></span> Ləğv et</a>
    </div>

</div>
{{-- end fieldGroup for previous internships --}}


{{-- fieldGroup for previous internships --}}
<div class="card card-body previousScholarshipFieldGroupCopy" id="previousScholarshipFieldGroupCopy" style="">
    <hr>
    <div class="row form-group">
        <label for="previous_scholarship_type" class="col-4 col-form-label">Təqaüd növü</label>
        {{--        <div class="col-8">--}}
        {{--            {{ Form::select('previous_scholarship_type[]', $programTypes,--}}
        {{--             null,--}}
        {{--              ['class' => 'form-control']) }}--}}
        {{--        </div>--}}
    </div>
    <div class="row form-group">
        <label for="previous_scholarship_date" class="col-4 col-form-label">Təqaüd tarixi</label>
        <div class="col-8">
            {{ Form::date('previous_scholarship_date[]', null, ['class' => 'form-control']) }}
        </div>
    </div>
    <hr>
    <div class="input-group-addon">
        <a href="javascript:void(0)" class="btn btn-danger remove"><span class="glyphicon glyphicon glyphicon-remove"
                                                                         aria-hidden="true"></span> Ləğv et</a>
    </div>
</div>
{{-- end fieldGroup for previous internships --}}


{{-- fieldGroup for previous internships --}}
<div class="card card-body previousWorkFieldGroupCopy" id="previousWorkFieldGroupCopy" style="">
    <hr>
    <div class="form-group row required">
        <label for="previous_education_level" class="col-4 col-form-label">Müəssisə</label>
        <div class="col-8">

            <select class="form-control" id="companies">
                @foreach($companies as $company)
                    <option value="{{$company -> Id}}">{{$company -> Name}}</option>
                @endforeach
                <option>Digər</option>
            </select>
            <input type="text" class="form-control" name="otherCompany" style="display: none"
                   placeholder="Digər müəssisənin adını bura yazın"/>

            <span class="badge badge-danger">Birgə müəssisələrdə işləyənlər proqrama müraciət edə bilməzlər</span>

            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="form-group row required">
        <label for="previous_education_level" class="col-4 col-form-label">Təşkilat</label>
        <div class="col-8">

            <input class="form-control" type="text" name="" id="">


            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="form-group row ">
        <label for="previous_education_level" class="col-4 col-form-label">Struktur Bölmə</label>
        <div class="col-8">

            <input class="form-control" type="text" name="" id="">


            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="form-group row required">
        <label for="previous_education_level" class="col-4 col-form-label">Vəzifə</label>
        <div class="col-8">

            <input class="form-control" type="text" name="" id="">


            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="form-group row required">
        <label for="previous_education_level" class="col-4 col-form-label">İşə qəbul tarixi</label>
        <div class="col-8">

            <input class="form-control" type="date" name="" id="">


            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="form-group row required">
        <label for="previous_education_level" class="col-4 col-form-label">İşdən ayrılma tarixi</label>
        <div class="col-8">

            <input class="form-control" type="date" name="" id="">


            <div class="help-block with-errors"></div>
        </div>
    </div>

    <div class="form-group row required">
        <label for="previous_education_level" class="col-4 col-form-label">Tabel nömrəniz</label>
        <div class="col-8">

            <input class="form-control" type="text" name="" id="">

            <div class="help-block with-errors"></div>
        </div>
    </div>

    <div class="input-group-addon">
        <a href="javascript:void(0)" class="btn btn-danger removeWork"><span
                    class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span> Ləğv et</a>
    </div>

</div>
{{-- end fieldGroup for previous internships --}}

{{--Form--}}



