{{--work history fields--}}
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

    <div id="socarWorkField" style="{{ $user->exists && $user->IsCurrentlyWorkAtSocar == 1 ? '' : '' }}">
        <div class="form-group row">
            <label for="personal_number" class="col-4 col-form-label">Tabel nömrəniz</label>
            <div class="col-8">
                {{ Form::text('personal_number',
                    ( $user->exists && $user->IsCurrentlyWorkAtSocar == 1 && isset($user->PersonalNumber) ) ? $user->PersonalNumber : ( old('personal_number')  ? old('personal_number') : null ),
                     ['class' => ($errors->has('personal_number')) ? 'form-control is-invalid' :'form-control']
                ) }}
                @if ($errors->has('personal_number'))
                    <div class="invalid-feedback">
                        <strong>{{ $errors->first('personal_number') }}</strong>
                    </div>
                @endif
            </div>
        </div>
    </div> {{--div#socarWorkField--}}

    <div class="form-group row">
        <label for="work_company" class="col-4 col-form-label">Müəssisə</label>
        <div class="col-8">
            <select class="form-control">
                <option>Default select</option>
            </select>
            @if ($errors->has('work_company'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('work_company') }}</strong>
                </div>
            @endif
        </div>
    </div>

    <div class="form-group row">
        <label for="work_experience" class="col-4 col-form-label">Təşkilat/Struktur bölmə</label>
        <div class="col-8">
            {{ Form::text('work_experience',
            ($user->exists && isset($user->WorkExperienceYears)) ? $user->WorkExperienceYears : null,
             ['class' => ($errors->has('work_experience')) ? 'form-control is-invalid' :'form-control']) }}
            @if ($errors->has('work_experience'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('work_experience') }}</strong>
                </div>
            @endif
        </div>
    </div>

    <div class="form-group row">
        <label for="work_experience" class="col-4 col-form-label">Vəzifə</label>
        <div class="col-8">
            {{ Form::text('work_experience',
            ($user->exists && isset($user->WorkExperienceYears)) ? $user->WorkExperienceYears : null,
             ['class' => ($errors->has('work_experience')) ? 'form-control is-invalid' :'form-control']) }}
            @if ($errors->has('work_experience'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('work_experience') }}</strong>
                </div>
            @endif
        </div>
    </div>

</div> {{--div#workFieldGroup--}}
 {{--work history field group--}}
<hr>

 {{--Scholarship section--}}
@include('frontend.profile.partials.scholarshipFields')
 {{--Scholarship history section--}}
<hr>
 {{--Internship history section--}}
@include('frontend.profile.partials.internshipFields')
{{--Internship history section--}}
<hr>
