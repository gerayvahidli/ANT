{{--work history fields--}}
<p class="lead">
    İş yeri
</p>
<div class="row form-group required">

{{--    <label for="is-working" class="col-4 col-form-label">Hazırda işləyirsinizmi?</label>--}}
    <div class="col-8">
{{--        <div class="form-check form-check-inline">--}}
{{--            <input class="form-check-input" type="radio" id="isCurrentlyWorking1" value="1"--}}
{{--                   name="is_currently_working"--}}
{{--                   {{ ($user->exists && $user->IsCurrentlyWorking == 1) ? 'checked' : (old('is_currently_working') == 1  ? 'checked' : '' ) }} required--}}
{{--                   data-error="Lütfən birini seçin">--}}
{{--            <label class="form-check-label" for="is_currently_working">Bəli</label>--}}
{{--        </div>--}}
{{--        <div class="form-check form-check-inline">--}}
{{--            <input class="form-check-input" type="radio" id="isCurrentlyWorking2" value="0"--}}
{{--                   name="is_currently_working"--}}
{{--                   {{ ($user->exists && $user->IsCurrentlyWorking == 0) ? 'checked' : '' }} required>--}}
{{--            <label class="form-check-label" for="is_currently_working">Xeyr</label>--}}
{{--        </div>--}}
{{--        @if ($errors->has('isCurrentlyWorking'))--}}
{{--            <div class="invalid-feedback">--}}
{{--                <strong>{{ $errors->first('isCurrentlyWorking') }}</strong>--}}
{{--            </div>--}}
{{--        @endif--}}

{{--        <div class="help-block with-errors radio-errors"></div>--}}
    </div>
</div>

<div id="workFieldGroup" style="{{ $user->exists && $user->IsCurrentlyWorking == 1 ? '' : '' }}">

    <div class="row form-group">
{{--        <label for="is-working" class="col-4 col-form-label">SOCAR əməkdaşısınızmı?</label>--}}
        <div class="col-8">
{{--            <div class="form-check form-check-inline">--}}
{{--                <input class="form-check-input" type="radio" id="isWorkingAtSocar1" value="1"--}}
{{--                       name="is_currently_working_at_socar" {{ ($user->exists && $user->IsCurrentlyWorkAtSocar == 1) ? 'checked' : ( old('is_currently_working_at_socar') ? old('is_currently_working_at_socar') : '' ) }}>--}}
{{--                <label class="form-check-label" for="inlineRadio1">Bəli</label>--}}
{{--            </div>--}}
{{--            <div class="form-check form-check-inline">--}}
{{--                <input class="form-check-input" type="radio" id="isWorkingAtSocar2" value="0"--}}
{{--                       name="is_currently_working_at_socar" {{ ($user->exists && $user->IsCurrentlyWorkAtSocar == 0) ? 'checked' : ( old('is_currently_working_at_socar') ? old('is_currently_working_at_socar') : '' ) }}>--}}
{{--                <label class="form-check-label" for="inlineRadio2">Xeyr</label>--}}
{{--            </div>--}}

        </div>
    </div>
    <div class="workFieldGroup" id="workFieldGroup">

    <div class="form-group row required ">
        <label for="company_id" class="col-4 col-form-label">Müəssisə</label>
        <div class="col-8">
            <select name="company_id" id="company_id" class="form-control">
                @foreach($companies as $company)
                    <option {{ $user->exists && $user -> currentJob ->first() -> CompanyId == $company -> Id ? 'selected' :''   }} value="{{$company -> Id}}">{{$company -> Name}}</option>
                @endforeach
            </select>

            <span class="badge badge-danger">Birgə müəssisələrdə işləyənlər proqrama müraciət edə bilməzlər</span>
            @if ($errors->has('company_id'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('company_id') }}</strong>
                </div>
            @endif
        </div>
    </div>
    <div class="form-group row ">
        <label for="organization" class="col-4 col-form-label">Təşkilat</label>
        <div class="col-8">
            {{ Form::text('organization',
            ($user->exists && isset($user -> currentJob -> first() -> Organization)) ? $user -> currentJob -> first() -> Organization : null,
             ['class' => ($errors->has('organization')) ? 'form-control is-invalid' :'form-control']) }}
            @if ($errors->has('organization'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('organization') }}</strong>
                </div>
            @endif
        </div>
    </div>
    <div class="form-group row required ">
        <label for="department" class="col-4 col-form-label">Struktur Bölmə</label>
        <div class="col-8">
            {{ Form::text('department',
            ($user->exists && isset($user->currentJob)) ? $user -> currentJob -> first() -> Department : null,
             ['class' => ($errors->has('department')) ? 'form-control is-invalid' :'form-control', 'required',"data-required-error"=>'Struktur Bölmə sahəsini boş buraxmayın'  ]) }}
            @if ($errors->has('department'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('department') }}</strong>
                </div>
            @endif

            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="form-group row required">
        <label for="position" class="col-4 col-form-label">Vəzifə</label>
        <div class="col-8">
            {{ Form::text('position',
            ($user->exists && isset($user -> currentJob)) ? $user -> currentJob -> first() -> Position : null,
             ['class' => ($errors->has('position')) ? 'form-control is-invalid' :'form-control', 'required',"data-required-error"=>'Vəzifə sahəsini boş buraxmayın','id' => 'position']) }}
            @if ($errors->has('position'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('position') }}</strong>
                </div>
            @endif

            <div class="help-block with-errors"></div>
        </div>
    </div>

    <div class="form-group row required">
        <label for="StartDate" class="col-4 col-form-label">İşə qəbul tarixi</label>
        <div class="col-8">
            {{ Form::date('StartDate', ($user->exists && isset($user -> currentJob)) ? $user -> currentJob -> first() -> StartDate : old('StartDate'), ['class' => ($errors->has('StartDate')) ? 'form-control is-invalid' :'form-control', 'required','data-required-error'=>'İşə qəbul tarixi sahəsini boş buraxmayın','id' => 'StartDate']) }}
            @if ($errors->has('StartDate'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('StartDate') }}</strong>
                </div>
            @endif
            <div class="help-block with-errors"></div>
        </div>
    </div>

    <div id="socarWorkField" style="{{ $user->exists && $user->IsCurrentlyWorkAtSocar == 1 ? '' : '' }}" >
        <div class="form-group row required">
            <label for="tabel_number" class="col-4 col-form-label">Tabel nömrəniz</label>
            <div class="col-8">
                {{ Form::text('tabel_number',
                    ( $user->exists && isset($user -> currentJob) ) ? $user -> currentJob -> first() -> TabelNo : ( old('tabel_number')  ? old('tabel_number') : null ),
                     ['class' => ($errors->has('tabel_number')) ? 'form-control is-invalid' :'form-control','required',"data-required-error"=>'Tabel nömrəniz sahəsini boş buraxmayın','id' =>'tabel_number']
                ) }}
                @if ($errors->has('tabel_number'))
                    <div class="invalid-feedback">
                        <strong>{{ $errors->first('tabel_number') }}</strong>
                    </div>
                @endif

                <div class="help-block with-errors"></div>
            </div>
        </div>
    </div> {{--div#socarWorkField--}}


</div>
    <hr>
</div>


{{--div#workFieldGroup--}}
 {{--work history field group--}}

 {{--Scholarship section--}}
@include('frontend.profile.partials.scholarshipFields')
 {{--Scholarship history section--}}
 {{--Internship history section--}}
@include('frontend.profile.partials.internshipFields')
{{--Internship history section--}}
