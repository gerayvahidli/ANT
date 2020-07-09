@if($user->exists && count($user->previousJobs))
    @foreach($user->previousJobs as $previousJob)
        <div class="workFieldGroup" id="workFieldGroup">
            <p class="lead"> Əvvəlki iş yerləri</p>
            <hr>
            <div class="form-group row required">
                <label for="previous_company_id" class="col-4 col-form-label">Müəssisə</label>
                <div class="col-8">

                    <select class="form-control" id="previous_company_id" name="previous_company_id[]">
                        @if($user -> exists && $previousJob -> Company -> IsSocar== 0)

                            @foreach($companies as $company)
                                <option value="{{$company -> Id}}">{{$company -> Name}}</option>
                            @endforeach
                            <option value="other" selected>Digər</option>

                        @else
                            @foreach($companies as $company)
                                <option {{$user -> exists && $previousJob ->  CompanyId == $company -> Id ? 'selected' : ''}} value="{{$company -> Id}}">{{$company -> Name}}</option>
                            @endforeach
                            <option value="other">Digər</option>
                        @endif
                    </select>
                    <input type="text" class="form-control" name="otherCompany[]" style="display: none"
                           value="{{$user -> exists && $previousJob -> Company -> IsSocar == 0 ? $previousJob -> Company -> Name :''  }}"
                           placeholder="Digər müəssisənin adını bura yazın"/>

                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="form-group row ">
                <label for="previous_organization" class="col-4 col-form-label">Təşkilat</label>
                <div class="col-8">
                    <input value="{{  $user -> exists && isset($previousJob -> Organization) ? $previousJob -> Organization : null }}"
                           class="form-control" type="text" name="previous_organization[]" id="previous_organization">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="form-group row required ">
                <label for="previous_department" class="col-4 col-form-label">Struktur Bölmə</label>
                <div class="col-8">
                    <input value="{{  $user -> exists  ? $previousJob -> Department : null }}" class="form-control"
                           type="text" name="previous_department[]" id="">
                    <div class="help-block with-errors"></div>
                </div>
            </div>

            <div class="form-group row required">
                <label for="previous_position" class="col-4 col-form-label">Vəzifə</label>
                <div class="col-8">
                    <input value="{{  $user -> exists  ? $previousJob -> Position : null }}" class="form-control"
                           type="text" name="previous_position[]" id="previous_position">
                    <div class="help-block with-errors"></div>
                </div>
            </div>

            <div class="form-group row required">
                <label for="previous_StartDate" class="col-4 col-form-label">İşə qəbul tarixi</label>
                <div class="col-8">
                    <input value="{{  $user -> exists  ? $previousJob -> StartDate : null }}" class="form-control"
                           type="date" name="previous_StartDate[]" id="previous_StartDate">
                    <div class="help-block with-errors"></div>
                </div>
            </div>

            <div class="form-group row required">
                <label for="previous_EndDate" class="col-4 col-form-label">İşdən ayrılma tarixi</label>
                <div class="col-8">
                    <input value="{{  $user -> exists  ? $previousJob -> EndDate : null }}" class="form-control"
                           type="date" name="previous_EndDate[]" id="previous_EndDate">
                    <div class="help-block with-errors"></div>
                </div>
            </div>

        </div>
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
