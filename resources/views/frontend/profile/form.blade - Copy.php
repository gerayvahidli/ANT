@extends('layouts.app')

@section('mainSection')
    <section class="profile">
        <div class="row">
            <h3 class="mx-auto">
                {{ ($user->exists) ? 'Profil dəyiş' : 'Qeydiyyat'}}
            </h3>
        </div>
        {{ Form::open([
            'route' => $user->exists ? ['profile.update', $user] : ['register'],
            'method' => $user->exists ? 'put' : 'post',
            'files' =>true,
        ]) }}
        <div class="row">
            <div class="col-12 col-sm-5 right-dotted-line">

                @if($user->exists && isset($user->image))
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top"
                             src="{{ asset((isset($user->image)) ? $user->image :'img/l60Hf.png') }}"
                             alt="Card image cap" height="50%">
                    </div>
                    <hr>
                @endif

                <div class="form-group row">
                    <label for="image" class="col-4 col-form-label">Şəkil</label>
                    <div class="col-8">
                        {{ Form::file('image', ['class' => 'form-control', ($user->exists) ? '' : 'required']) }}
                    </div>
                </div>

                <div class="form-group row">
                    <label for="FirstName" class="col-4 col-form-label">Ad</label>
                    <div class="col-8">
                        {{ Form::text('FirstName', ($user->exists) ? $user->FirstName : old('FirstName'), ['class' => 'form-control here', 'placeholder' => 'Ad', 'id' => 'FirstName', 'required']) }}
                    </div>
                </div>

                <div class="form-group row">
                    <label for="LastName" class="col-4 col-form-label">Soyad</label>
                    <div class="col-8">
                        <input id="LastName" name="LastName"
                               value="{{ ($user->exists) ? $user->LastName : old('LastName') }}" placeholder="Soyad"
                               type="text" class="form-control here" required="required">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="FatherName" class="col-4 col-form-label">Ata adı</label>
                    <div class="col-8">
                        <input id="FatherName" name="FatherName"
                               value="{{ ($user->exists) ? $user->FatherName : old('FatherName') }}"
                               placeholder="Ata adı" type="text" class="form-control here" required="required">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label">{{ __('E-Mail Address') }}</label>

                    <div class="col-8">
                        <input id="email" type="email"
                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                               value="{{ ($user->exists) ? $user->email : old('email') }}" required>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label">{{ __('Password') }}</label>

                    <div class="col-8">
                        <input id="password" type="password"
                               class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                               required>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 col-form-label">{{ __('Confirm Password') }}</label>

                    <div class="col-8">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                               required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nationality" class="col-4 col-form-label">Vətəndaşlığı</label>
                    <div class="col-8">
                        {{ Form::select('nationality', $countries, ($user->exists) ? $user->country_id : old('nationality'),
                            ['class' => 'form-control here', 'placeholder' => '---- Vətəndaşlığı seç ----', 'required']
                        ) }}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="dateOfBirth" class="col-4 col-form-label">Təvəllüd</label>
                    <div class="col-8">
                        {{ Form::date('dateOfBirth', ($user->exists) ? $user->Dob : old('dateOfBirth'), ['class' => 'form-control here', 'required']) }}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="City" class="col-4 col-form-label">Anadan olduğu yer</label>
                    <div class="col-8">
                        {{ Form::select('City_id', $cities, ($user->exists) ? $user->city_id : old('City_id'),
                            ['class' => 'form-control here', 'placeholder' => '---- Anadan olduğu yeri seç ----', 'required']
                        ) }}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Address" class="col-4 col-form-label">ünvan</label>
                    <div class="col-8">
                        <input id="Address" name="Address"
                               value="{{ ($user->exists) ? $user->Address : old('Address') }}" placeholder="Ünvan"
                               type="text" class="form-control here" required="required">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="idCardNumber" class="col-4 col-form-label">Şəxsiyyət vəsiqəsinin nömrəsi</label>
                    <div class="col-8">
                        <input id="idCardNumber" name="idCardNumber"
                               value="{{ ($user->exists) ? $user->IdentityCardNumber : old('idCardNumber') }}"
                               placeholder="Şəxsiyyət vəsiqəsinin nömrəsi" type="text" class="form-control here"
                               required="required">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="idCardPin" class="col-4 col-form-label">Şəxsiyyət vəsiqəsinin FİN kodu</label>
                    <div class="col-8">
                        <input id="idCardPin" name="idCardPin"
                               value="{{ ($user->exists) ? $user->IdentityCardCode : old('idCardPin') }}"
                               placeholder="Şəxsiyyət vəsiqəsinin FİN kodu" type="text" class="form-control here"
                               required="required">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="MaidenSurname" class="col-4 col-form-label">Anasının qızlıq soyadı</label>
                    <div class="col-8">
                        <input id="MaidenSurname" name="MaidenSurname"
                               value="{{ ($user->exists) ? $user->MaidenSurname : old('MaidenSurname') }}"
                               placeholder="Anasının qızlıq soyadı" type="text" class="form-control here"
                               required="required">
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-7">

                @include('frontend.profile.partials.finalEducationFields')

                @include('frontend.profile.partials.previousEducationFields')

                <div class="form-group row" id="addMoreGroup">
                    <div class="col-8 offset-sm-2">
                        <button href="javascript:void(0)" class="btn btn-primary" type="button" aria-hidden="true"
                                id="addMore">
                            + Əvvəlki Təhsil
                        </button>
                    </div>
                </div>
                <hr>

                {{--@include('frontend.profile.partials.previousEducationFields')--}}

                <div class="row form-group">
                    <label for="is-working" class="col-4 col-form-label">Hazırda işləyirsinizmi?</label>
                    <div class="col-8">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="isCurrentlyWorking1" value="1"
                                   name="is_currently_working" {{ ($user->exists && $user->IsCurrentlyWorking == 1) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_currently_working">Bəli</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="isCurrentlyWorking2" value="0"
                                   name="is_currently_working" {{ ($user->exists && $user->IsCurrentlyWorking == 0) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_currently_working">Yox</label>
                        </div>
                    </div>
                </div>

                <div id="workFieldGroup" style="display: none">

                    <div class="row form-group">
                        <label for="is-working" class="col-4 col-form-label">SOCAR əməkdaşısınızmı?</label>
                        <div class="col-8">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="isWorkingAtSocar1" value="1"
                                       name="is_currently_working_at_socar" {{ ($user->exists && $user->IsCurrentlyWorkAtSocar == 1) ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineRadio1">Bəli</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="isWorkingAtSocar2" value="0"
                                       name="is_currently_working_at_socar" {{ ($user->exists && $user->IsCurrentlyWorkAtSocar == 0) ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineRadio2">Yox</label>
                            </div>
                        </div>
                    </div>

                    <div id="socarWorkField" style="display: none">
                        <div class="form-group row">
                            <label for="personal_number" class="col-4 col-form-label">Tabel nömrəniz</label>
                            <div class="col-8">
                                {{ Form::text('personal_number', null, ['class' => 'form-control here']) }}
                            </div>
                        </div>
                    </div> {{--div#socarWorkField--}}

                    <div class="form-group row">
                        <label for="work_company" class="col-4 col-form-label">Müəssisə və ya təşkilat</label>
                        <div class="col-8">
                            {{ Form::text('work_company', null, ['class' => 'form-control here']) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="work_experience" class="col-4 col-form-label">İş stajınız</label>
                        <div class="col-8">
                            {{ Form::text('work_experience', null, ['class' => 'form-control here']) }}
                        </div>
                    </div>

                </div> {{--div#workFieldGroup--}}

                <hr>

                {{--<div class="row form-group">
                    <label for="is-working" class="col-4 col-form-label">Əvvəlki illərdə təqaüd müsabiqəsində iştirak etmisinizmi?</label>
                    <div class="col-8">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="isWorkingAtSocar1" value="1" name="is_currently_working_at_socar">
                            <label class="form-check-label" for="inlineRadio1">Bəli</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="isWorkingAtSocar2" value="0"  name="is_currently_working_at_socar" checked>
                            <label class="form-check-label" for="inlineRadio2">Yox</label>
                        </div>
                    </div>
                </div>--}}

                <div class="form-group row">
                    <label for="exam_language_id" class="col-4 col-form-label">İmtahanı hansı dildə verə
                        bilərsiniz</label>
                    <div class="col-8">
                        {{ Form::select('exam_language_id', $examLanguages, null,
                            ['class' => 'form-control here', 'placeholder' => '---- Dili seç ----', 'id' => 'exam_language_id']
                        ) }}
                    </div>
                </div>


                <div class="form-group row">
                    <div class="offset-4 col-8">
                        {{ Form::submit('Yadda saxla', ['class' => 'btn btn-primary']) }}
                    </div>
                </div>

            </div>
        </div>
        {{ Form::close() }}
    </section>
@endsection