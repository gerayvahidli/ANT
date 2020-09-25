{{--work history fields--}}
<p class="lead">
    İş yeri
</p>


<div id="workFieldGroup" style="{{ $user->exists && $user->IsCurrentlyWorking == 1 ? '' : '' }}">

    <div class="workFieldGroup" id="workFieldGroup">

        @if($user->exists && isset($user->currentJob))
            {{ Form::hidden('final_job_id', $user->currentJob->first()->Id) }}
        @endif

    <div class="form-group row required ">
        <label for="company_id" class="col-4 col-form-label">Müəssisə</label>
        <div class="col-8">
            <select name="company_id" id="company_id" class="form-control">
                @foreach($companies as $company)
                    <option {{ $user->exists && $user -> currentJob ->first() -> CompanyId == $company -> Id ? 'selected' :''   }} value="{{$company -> Id}}">{{$company -> Name}}</option>
                @endforeach
            </select>

            <span class="badge">Birgə müəssisələrdə işləyənlər proqrama müraciət edə bilməzlər</span>
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
             ['class' => ($errors->has('organization')) ? 'form-control is-invalid' :'form-control',
              'maxlength' => '500',
             ]) }}
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
             ['class' => ($errors->has('department')) ? 'form-control is-invalid' :'form-control',
             'id' => 'department',
             'required',
             'maxlength' => '500',
             "data-msg-required"=>'Struktur Bölmə sahəsini boş buraxmayın'  ]) }}
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
             ['class' => ($errors->has('position')) ? 'form-control is-invalid' :'form-control',
             'id' => 'position',
             'required',
             "data-msg-required"=>'Vəzifə sahəsini boş buraxmayın',
             'maxlength' => '500'
             ]) }}
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
            {{ Form::date('StartDate', ($user->exists && isset($user -> currentJob)) ? $user -> currentJob -> first() -> StartDate : old('StartDate'), ['class' => ($errors->has('StartDate')) ? 'form-control is-invalid' :'form-control', 'required','data-msg-required'=>'İşə qəbul tarixi sahəsini boş buraxmayın','id' => 'StartDate','max' => '2999-12-31']) }}
            @if ($errors->has('StartDate'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('StartDate') }}</strong>
                </div>
            @endif
            <div class="help-block with-errors"></div>
        </div>
    </div>



</div>
    <hr>
</div>



 {{--Scholarship section--}}
@include('frontend.profile.partials.scholarshipFields')
 {{--Scholarship history section--}}
 {{--Internship history section--}}
@include('frontend.profile.partials.internshipFields')
{{--Internship history section--}}
