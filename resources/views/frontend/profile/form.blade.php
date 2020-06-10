@extends('layouts.app')

@section('mainSection')

    <style type="text/css">
        .hint > div {
            display: none;
        }

        .hint:hover > div {
            display: block;
        }

        .has-error .checkbox, .has-error .checkbox-inline, .has-error .control-label, .has-error .help-block, .has-error .radio, .has-error .radio-inline, .has-error.checkbox label, .has-error.checkbox-inline label, .has-error.radio label, .has-error.radio-inline label {
            color: #a94442;
            font-size: 12px;
        }

        .has-error .form-control {
            border-color: #a94442;
            -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);

        }
    </style>


    <section class="profile">
        <div class="row">
            <h3 class="mx-auto">
                {{ ($user->exists) ? 'Profil dəyiş' : 'Qeydiyyat'}}
            </h3>
        </div>
        {{ Form::open([
            'route' => $user->exists ? ['profile.update', $user] : ['register'],
            'method' => $user->exists ? 'put' : 'post',
            'files' => true,
            'data-toggle'=>"validator",
            'role'=>"form",
            'id' => 'profile-form'
        ]) }}
{{--        <div class="alert alert-danger" id="form-errors" style="display: none">--}}
{{--            <ul id="form-error-list">--}}

{{--            </ul>--}}
{{--        </div>--}}
        @if ($errors->any())
            <div class="alert alert-danger" id="form-errors">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
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

                <div class="form-group row required">
                    <label for="image" class="col-4 col-form-label">Şəkil</label>
                    <div class="col-8">
                        {{ Form::file('image', ['class' => ($errors->has('image')) ? 'form-control is-invalid' :'form-control', ($user->exists) ? '' : 'required','data-error'=>'Şəkil sahəsini boş buraxmayın']) }}
                        @if ($errors->has('image'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('image') }}</strong>
                            </div>
                        @endif
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

                <div class="form-group row required">
                    <label for="FirstName" class="col-4 col-form-label">Ad</label>
                    <div class="col-8">
                        {{ Form::text('FirstName', ($user->exists) ? $user->FirstName : old('FirstName'),
                        ['class' => ($errors->has('FirstName')) ? 'form-control is-invalid' :'form-control', 'placeholder' => 'Ad', 'id' => 'FirstName', 'required','data-error'=>'Adınız sahəsini boş buraxmayın']) }}
                        @if ($errors->has('FirstName'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('FirstName') }}</strong>
                            </div>
                        @endif
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

                <div class="form-group row required">
                    <label for="LastName" class="col-4 col-form-label">Soyad</label>
                    <div class="col-8">
                        <input id="LastName" name="LastName"
                               value="{{ ($user->exists) ? $user->LastName : old('LastName') }}" placeholder="Soyad"
                               type="text"
                               class="{{ ($errors->has('LastName')) ? 'form-control is-invalid' :'form-control here' }}"
                               required="required" data-error='Soyadınız sahəsini boş buraxmayın'>
                        @if ($errors->has('LastName'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('LastName') }}</strong>
                            </div>
                        @endif
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

                <div class="form-group row required">
                    <label for="FatherName" class="col-4 col-form-label">Ata adı</label>
                    <div class="col-8">
                        <input id="FatherName" name="FatherName"
                               value="{{ ($user->exists) ? $user->FatherName : old('FatherName') }}"
                               placeholder="Ata adı" type="text"
                               class="{{ ($errors->has('FatherName')) ? 'form-control is-invalid' :'form-control' }}"
                               required="required" data-error='Ata adı sahəsini boş buraxmayın'>
                        @if ($errors->has('FatherName'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('FatherName') }}</strong>
                            </div>
                        @endif
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

                    <div class="form-group row required">
                        <label for="FatherName" class="col-4 col-form-label">Cins</label>
                        <div class="col-8">
{{--                            <select  class="form-control here" name="gender" id="">--}}
{{--                                @foreach($genders as $id => $gender)--}}
{{--                                    <option value="{{$id }}">{{$gender}}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}


                            {!!  Form::select('gender', $genders, ($user->exists) ? $user->gender_id : old('gender'),
                            ['class' => ($errors->has('gender')) ? 'form-control is-invalid' :'form-control', 'placeholder' => '---- Cins seç ----', 'required','data-required-error'=>'Cins sahəsini boş buraxmayın']
                            ) !!}

                            @if ($errors->has('gender'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('gender') }}</strong>
                                </div>
                            @endif
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>



                <div id="phoneFieldGroup">
                    @if($user->exists && count($user->phones))
                        @foreach($user->phones as $phone)
                            <div class="form-group row required" id="mobilePhones">
                                <label for="phone" class="col-md-4 col-form-label">Telefon</label>

                                <div class="col-3">
                                    {{ Form::select('mobilePhone[' . $loop->index . '][operatorCode]', $mobilePhoneOperatorCodes, ( isset($phone->PhoneNumber) ) ? $phone->mobile_operator_code_id : old('mobilePhoneOperatorCode'), ['class' => 'form-control here', 'id' => 'mobilePhoneOperatorCode']) }}
                                    @if ($errors->has('mobilePhoneOperatorCode'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('mobilePhoneOperatorCode') }}</strong>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-4">
                                    <input id="phoneNumber" type="text"
                                           class="form-control{{ $errors->has('phoneNumber') ? ' is-invalid' : '' }}"
                                           name='mobilePhone[{{ $loop->index }}][number]'
                                           value="{{ ($user->exists && isset($phone->PhoneNumber)) ? $phone->PhoneNumber : old('phoneNumber') }}"
                                           required
                                           maxlength="7"
                                           data-required-error='Telefon nömrəsi sahəsini boş buraxmayın' pattern="\d*"
                                           data-pattern-error="Yalnız rəqəm daxil edin">

                                    @if ($errors->has('phoneNumber'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('phoneNumber') }}</strong>
                                        </div>
                                    @endif
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="col-1">
                                    <a href="javascript:void(0);" class="remove_button btn btn-danger btn-sm"><span
                                                class="fa fa-times"></span></a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="form-group row required" id="mobilePhones">
                            <label for="phone" class="col-md-4 col-form-label">Telefon</label>

                            <div class="col-3">
                                {{ Form::select('mobilePhone[0][operatorCode]', $mobilePhoneOperatorCodes, ($user->exists) ? null : old('mobilePhoneOperatorCode'), ['class' => 'form-control here', 'id' => 'mobilePhoneOperatorCode']) }}
                                @if ($errors->has('mobilePhoneOperatorCode'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('mobilePhoneOperatorCode') }}</strong>
                                    </div>
                                @endif
                            </div>

                            <div class="col-5">
                                <input id="phoneNumber" type="text"
                                       class="form-control{{ $errors->has('phoneNumber') ? ' is-invalid' : '' }}"
                                       name="mobilePhone[0][number]"
                                       value="{{ ($user->exists && isset($user->phones->first()->PhoneNumber)) ? $user->phones->first()->PhoneNumber : old('phoneNumber') }}"
                                       required
                                       maxlength="7"
                                       data-required-error='Telefon nömrəsi sahəsini boş buraxmayın' pattern="\d*"
                                       data-pattern-error="Yalnız rəqəm daxil edin">

                                @if ($errors->has('phoneNumber'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('phoneNumber') }}</strong>
                                    </div>
                                @endif
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="form-group row">
                    <div class="col-6">
                        <a href="javascript:void(0);" id="addPhoneField">
                            <span class="fa fa-plus"></span> Telefon əlavə et
                        </a>
                    </div>
                </div>

                <div class="form-group row required">
                    <label for="email" class="col-md-4 col-form-label">{{ __('E-Mail Address') }}</label>

                    <div class="col-8">
                        <input id="email" type="email"
                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                               value="{{ ($user->exists) ? $user->email : old('email') }}" required
                               data-error='E-Mail ünvanı düzgün qeyd edin'
                               data-required-error='E-Mail Address sahəsini boş buraxmayın'
                                {{ ($user->exists) ? 'disabled': '' }}
                        >

                        @if ($errors->has('email'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </div>
                        @endif
                        <div class="help-block with-errors" id="emailErrorText"></div>
                    </div>
                </div>


                @if(!$user->exists)
                    <div class="form-group row required">
                        <label for="email-confirm" class="col-md-4 col-form-label">E-mail təkrar</label>

                        <div class="col-8">
                            <input id="email-confirm" type="email"
                                   class="form-control " name="email_confirmation"
                                   value="{{ ($user->exists) ? $user->email : old('email') }}" required
                                   data-required-error='E-Mail təkrar sahəsini boş buraxmayın'
                                   data-match="#email" data-error="Email və email təkrarı sahələri eyni olmalıdır">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                @endif

                @if($user->exists)
                    <div class="form-group row">
                        <div class="col-8">
                            <a href="{{ url('/profile/' . $user->id . '/password') }}" class="btn">Şifrəni dəyiş</a>
                        </div>
                    </div>
                @else

                    <div class="form-group row required">
                        <label for="password" class="col-md-4 col-form-label">Şifrə</label>

                        <div class="col-8">
                            <input type="password"
                                   class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                   name="password"
                                   required data-required-error='Şifrə sahəsini boş buraxmayın' minlength="6"
                                   data-error='Şifrə minimum 6 simvoldan ibarət olmalıdır' id="inputPassword">

                            @if ($errors->has('password'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </div>
                            @endif
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="form-group row required">
                        <label for="password-confirm" class="col-md-4 col-form-label">Şifrəni təkrarla</label>

                        <div class="col-8">
                            <input id="inputPasswordConfirm" type="password" data-match="#inputPassword"
                                   class="form-control" name="password_confirmation"
                                   data-required-error='Şifrə təkrarla boş buraxmayın'
                                   data-error="Şifrə və şifrə təkrarı sahələri eyni olmalıdır"
                                   required>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                @endif

                <div class="form-group row required">
                    <label for="nationality" class="col-4 col-form-label">Vətəndaşlığı</label>
                    <div class="col-8">
                        {{ Form::select('nationality', $countries, ($user->exists) ? $user->country_id : old('nationality'),
                            ['class' => ($errors->has('nationality')) ? 'form-control is-invalid' :'form-control', 'placeholder' => '---- Vətəndaşlığı seç ----', 'required','data-required-error'=>'Vətəndaşlığı sahəsini boş buraxmayın']
                        ) }}
                        @if ($errors->has('nationality'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('nationality') }}</strong>
                            </div>
                        @endif
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="form-group row required">
                    <label for="dateOfBirth" class="col-4 col-form-label">Təvəllüd</label>
                    <div class="col-8">
                        {{ Form::date('dateOfBirth', ($user->exists) ? $user->Dob->format('Y-m-d') : old('dateOfBirth'), ['class' => ($errors->has('dateOfBirth')) ? 'form-control is-invalid' :'form-control', 'required','data-required-error'=>'Təvvəllüd sahəsini boş buraxmayın']) }}
                        @if ($errors->has('dateOfBirth'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('dateOfBirth') }}</strong>
                            </div>
                        @endif
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="form-group row required">
                    <label for="City" class="col-4 col-form-label">Anadan olduğu yer</label>
                    <div class="col-8">
                        {{ Form::select('City_id', $cities, ($user->exists) ? $user->city_id : old('City_id'),
                            ['class' => ($errors->has('City_id')) ? 'form-control is-invalid' :'form-control', 'placeholder' => '---- Anadan olduğu yeri seç ----', 'required','data-required-error'=>'Anadan olduğu yer sahəsini boş buraxmayın', 'id' => 'City_id']
                        ) }}
                        @if ($errors->has('City_id'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('City_id') }}</strong>
                            </div>
                        @endif
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

                <div class="form-group row" style="display: none" id="customCity">
                    <label for="customCity" class="col-4 col-form-label">Şəhəri daxil edin</label>
                    <div class="col-8">
                        {{ Form::text('customCity', ($user->exists) ? $user->city->Name : old('customCity'), ['class' => 'form-control here', 'id' => 'customCity'] ) }}
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

                <div class="form-group row required">
                    <label for="Address" class="col-4 col-form-label">Ünvan</label>
                    <div class="col-8">
                        <input id="Address" name="Address"
                               value="{{ ($user->exists) ? $user->Address : old('Address') }}" placeholder="Ünvan"
                               type="text"
                               class="{{ ($errors->has('Address')) ? 'form-control is-invalid' :'form-control' }}"
                               required="required" data-required-error='Ünvan sahəsini boş buraxmayın'>
                        <div class="help-block with-errors"></div>
                        <small id="addressHelpBlock" class="form-text text-muted">
                            şəxsiyyəti təsdiq edən sənədə əsasən qeydiyyatda olduğu ünvan
                        </small>
                        @if ($errors->has('Address'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('Address') }}</strong>
                            </div>
                        @endif

                    </div>
                </div>
                <div class="form-group row required">
                    <label for="idCardNumber" class="col-4 col-form-label">Şəxsiyyət vəsiqəsinin nömrəsi</label>
                    <div class="col-8">
                        <input id="idCardNumber" name="idCardNumber"
                               value="{{ ($user->exists) ? $user->IdentityCardNumber : old('idCardNumber') }}"
                               placeholder="Şəxsiyyət vəsiqəsinin nömrəsi" type="text"
                               class="{{ ($errors->has('idCardNumber')) ? 'form-control is-invalid' :'form-control' }}"
                               required="required" maxlength="15"
                               data-required-error='Şəxsiyyət vəsiqəsinin nömrəsi sahəsini boş buraxmayın' minlength="6"
                               pattern="\d*" data-pattern-error="Yalnız rəqəm daxil edin"
                               data-error='Şəxsiyyət vəsiqəsinin nömrəsi sahəsi minimum 6 simvoldan ibarət olmalidir'
                        >

                        <a class="hint" style="cursor: pointer;color:blue; font-size:11px;">Nümunə
                            <div><img src="{{ asset('img/nomresi.png') }}"/></div>
                        </a>
                        @if ($errors->has('idCardNumber'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('idCardNumber') }}</strong>
                            </div>
                        @endif
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="form-group row required">
                    <label for="idCardPin" class="col-4 col-form-label">Şəxsiyyət vəsiqəsinin FİN kodu</label>
                    <div class="col-8">
                        <input id="idCardPin" name="idCardPin"
                               value="{{ ($user->exists) ? $user->IdentityCardCode : old('idCardPin') }}"
                               placeholder="Şəxsiyyət vəsiqəsinin FİN kodu" type="text"
                               class="{{ ($errors->has('idCardPin')) ? 'form-control is-invalid' :'form-control' }}"
                               required="required"
                               data-required-error='Şəxsiyyət vəsiqəsinin FİN kodu sahəsini boş buraxmayın'
                               maxlength="7" minlength="7"
                               data-error='Şəxsiyyət vəsiqəsinin FİN kodu minimum 7 simvoldan ibarət olmalidir'
                                {{ ($user->exists) ? 'disabled' : '' }}
                        >
                        <a class="hint" style="cursor: pointer;color:blue; font-size:11px;">FİN kod nədir?
                            <div><img src="{{ asset('img/finkod.png') }}"/></div>
                        </a>
                        @if ($errors->has('idCardPin'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('idCardPin') }}</strong>
                            </div>
                        @endif
                        <div class="help-block with-errors invalid-feedback" id="idCardPinErrorText"></div>
                    </div>
                </div>
                <div class="form-group row required">
                    <label for="MaidenSurname" class="col-4 col-form-label">Anasının qızlıq soyadı</label>
                    <div class="col-8">
                        <input id="MaidenSurname" name="MaidenSurname"
                               value="{{ ($user->exists) ? $user->MaidenSurname : old('MaidenSurname') }}"
                               placeholder="Anasının qızlıq soyadı" type="text"
                               class="{{ ($errors->has('MaidenSurname')) ? 'form-control is-invalid' :'form-control' }}"
                               required="required"
                               data-required-error='Anasının qızlıq soyadı sahəsini boş buraxmayın'>

                        @if ($errors->has('MaidenSurname'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('MaidenSurname') }}</strong>
                            </div>
                        @endif
                        <div class="help-block with-errors"></div>
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

                @include('frontend.profile.partials.workAndScholarshipFields')


                <div class="form-group row required">
                    <label for="exam_language_id" class="col-4 col-form-label">İmtahanı hansı dildə verə
                        bilərsiniz</label>
                    <div class="col-8">
                        {{ Form::select('exam_language_id', $examLanguages, ($user->exists) ? $user->exam_language_id : old('exam_language_id'),
                            ['class' => ($errors->has('exam_language_id')) ? 'form-control is-invalid' :'form-control', 'placeholder' => '---- Dili seç ----', 'id' => 'exam_language_id', 'required','data-required-error'=>'İmtahan dili sahəsini boş buraxmayın']
                        ) }}
                        <div class="help-block with-errors"></div>
                        @if ($errors->has('exam_language_id'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('exam_language_id') }}</strong>
                            </div>
                        @endif
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

        <div id="special-div">
            @include('frontend.profile.partials.dynamicFormElements')
        </div>
    </section>

    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/validator.js')}}"></script>
@endsection

@section('footerScripts')
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        $(document).ready(function () {
            var token = $("input[name='_token']").val();
            // console.log(token);
            // profile submit - axios
            $('#profile-form').submit(function (stay) {
                stay.preventDefault();
                $('.alert-danger').hide();
                $('#form-error-list').html('');
                // form data
                var form = $(this),
                    formData = new FormData(),
                    formParams = form.serializeArray();

                // find file type inputs and add to form data
                $.each(form.find('input[type="file"]'), function (i, tag) {
                    $.each($(tag)[0].files, function (i, file) {
                        formData.append(tag.name, file);
                    });
                });

                // add other fields to form data
                $.each(formParams, function (i, val) {
                    // console.log('i:' + i);
                    // console.log('val:');
                    // console.log(val);
                    formData.append(val.name, val.value);
                    $("input[name='" + val.name + "']").removeClass('is-invalid');
                    $("input[name='" + val.name + "']").closest('.form-group ').find('.invalid-feedback').remove();
                });

                // Add a request interceptor
                // axios.interceptors.request.use(function (config) {
                //     // Do something before request is sent
                //     console.log('before sent');
                //     $('#loaderModal').modal('show');
                //     return config;
                // }, function (error) {
                //     // Do something with request error
                //     return Promise.reject(error);
                // });

// Add a response interceptor
                axios.interceptors.response.use(function (response) {
                    // Do something with response data
                    console.log('after sent');
                    $('#loaderModal').modal('hide');
                    return response;
                }, function (error) {
                    // Do something with response error
                    $('#loaderModal').modal('hide');
                    console.log('after sent - error');
                    return Promise.reject(error);
                });

                axios.post($(this).attr('action'), formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    })
                    .then((response) => {
                        // console.log('correct');
                        console.log(response);
                        window.location.href = '{{ route('profile.index') }}';
                    }).catch((error) => {
                        if(error.response) {
                            // The request was made and the server responded with a status code
                            // that falls out of the range of 2xx
                            console.log(error.response.data);
                            console.log(error.response.status);
                            console.log(error.response.headers);
                            $('#loaderModal').modal('hide');
                            $('.alert-danger').show();
                            $.each(error.response.data.errors, function (key, value) {
                                console.log('key:' + key);
                                console.log('value:' + value);
                                // add invalid classes to input fields with error
                                $("input[name='" + key + "']").addClass('is-invalid');
                                current_input = $("input[name='" + key + "']");
                                console.log('closest tag:' + current_input.closest('.form-group').find('.radio-errors ').length);
                                if(current_input.closest('.form-group').find('.radio-errors ').length) {
                                    current_input.closest('.form-group').find('.radio-errors ').append('<strong>' + value + '</strong>\n');
                                } else {
                                    $("input[name='" + key + "']").closest('.form-group ').find('.invalid-feedback').remove();
                                    $("input[name='" + key + "']").after('<div class="invalid-feedback">\n' +
                                        '<strong>' + value + '</strong>\n' +
                                        '</div>');
                                }

                                // add errors to error box
                                $('#form-error-list').append('<li>' + value + '</li>');
                            });
                            // scroll to error list
                            $([document.documentElement, document.body]).animate({
                                scrollTop: $('.alert-danger').offset().top
                            }, 2000);
                        } else if (error.request) {
                            // The request was made but no response was received
                            // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
                            // http.ClientRequest in node.js
                            console.log(error.request);
                        } else {
                            // Something happened in setting up the request that triggered an Error
                            console.log('Error', error.message);
                        }
                    });
                stay.preventDefault();
            });
            // end of profile submit - axios

            //delete previous education
            $('#delete-previous-education').click(function() {
                var previous_education_id = $(this).closest('.fieldGroup').find('input[name="previous_education_id[]"]').val();
                console.log(previous_education_id);
                axios.post('{{ route('deletePreviousEducation') }}', {
                    previous_education_id: previous_education_id,
                    _token: token
                })
                    .then(function (response) {
                        console.log(response);

                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            });
            // end of delete previous education

            //delete Internship
            $('.delete-internship').click(function(e) {
                e.preventDefault();
                var parentField = $(this).closest('.previousInternshipFieldGroup');
                // console.log(parentField);
                var internship_id = $(this).closest('.previousInternshipFieldGroup').find('input[name="internship_id[]"]').val();
                // console.log(internship_id);
                axios.post('{{ route('deleteInternship') }}', {
                    internship_id: internship_id,
                    _token: token
                })
                    .then(function (response) {
                        parentField.remove();
                        // console.log(response);
                    })
                    .catch(function (error) {
                        // console.log(error);
                    });
            });
            // end of delete Internship

            //delete Scholarship
            $('.delete-scholarship').click(function(e) {
                e.preventDefault();
                var parentField = $(this).closest('.previousScholarshipFieldGroup');
                var scholarship_id = $(this).closest('.previousScholarshipFieldGroup').find('input[name="previous_scholarship_id[]"]').val();
                // console.log(scholarship_id);
                axios.post('{{ route('deleteScholarship') }}', {
                    scholarship_id: scholarship_id,
                    _token: token
                })
                    .then(function (response) {
                        parentField.remove();
                        // console.log(response);

                    })
                    .catch(function (error) {
                        // console.log(error);
                    });
            });
            // end of delete Scholarship









        });
    </script>
    <script>
        $.fn.datepicker.noConflict;
        $('#datePicker*').datepicker({
            format: "yyyy-mm-dd",
            maxViewMode: 2,
            todayBtn: "linked",
            language: "az",
            autoclose: true,
            todayHighlight: true
        });

        $('#BeginDate').datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years"
        });
        $('#EndDate').datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years"
        });

        $('#previous_education_BeginDate').datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years"
        });
        $('#previous_education_EndDate').datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years"
        });


        $('#previous_education_BeginDate').datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years"
        });
        $('#previous_education_EndDate').datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years"
        });


        $(document).ready(function () {

            $('#idCardPin').change(function () {
                var idCardPin = $(this).val();
                var token = $("input[name='_token']").val();
                if (idCardPin) {
                    $.ajax({
                        url: '{{ url('/checkUniquePinCode') }}',
                        type: "post",
                        dataType: "json",
                        data: {idCardPin: idCardPin, _token: token},
                        beforeSend: function () {
                            // $('#loader').css("visibility", "visible");
                            $('#idCardPin').removeClass('is-invalid');
                            $('div#idCardPinErrorText').empty();
                            $('#loaderModal').modal('show');
                            $('.alert-danger').hide();
                        },
                        success: function (data) {
                            $('#loaderModal').modal('hide');
                            $('#idCardPin').removeClass('is-invalid');
                            $('div#idCardPinErrorText').empty();
                            $('#idCardPin').addClass('is-valid');
                            // console.log(data.responseJSON);
                        },
                        error: function (data) {
                            $('#loaderModal').modal('hide');
                            $('div#idCardPinErrorText').append(data.responseJSON.msg);
                            // console.log(data.responseJSON.msg);
                            $('#idCardPin').addClass('is-invalid');
                            $('.alert-danger').show();
                            $('#form-error-list').append('<li>' + data.responseJSON.msg + '</li>');
                            // scroll to error list
                            $([document.documentElement, document.body]).animate({
                                scrollTop: $('.alert-danger').offset().top
                            }, 2000);
                        },
                        complete: function () {
                            $('#loaderModal').modal('hide');
                            // $('#loader').css("visibility", "hidden");
                        }
                    });
                }
            });

            $('#email').change(function () {

                var email = $(this).val();
                var token = $("input[name='_token']").val();
                if (email) {
                    $.ajax({
                        url: '{{ url('/checkUniqueEmail') }}',
                        type: "post",
                        dataType: "json",
                        data: {email: email, _token: token},
                        beforeSend: function () {
                            // $('#loader').css("visibility", "visible");
                            $('#email').removeClass('is-invalid');
                            $('div#emailErrorText').empty();
                        },
                        success: function (data) {
                            $('#email').removeClass('is-invalid');
                            $('div#emailErrorText').empty();
                            $('#email').addClass('is-valid');
                            // console.log(data.responseJSON);
                        },
                        error: function (data) {
                            $('div#emailErrorText').append(data.responseJSON.msg);
                            // console.log(data.responseJSON.msg);
                            $('#email').addClass('is-invalid');
                        },
                        complete: function () {
                            // $('#loader').css("visibility", "hidden");
                        }
                    });
                }

            });

            // add fields to form - profile

            var maxField = 3; //Input fields increment limitation
            var addButton = $('#addPhoneField'); //Add button selector
            var wrapper = $('#phoneFieldGroup'); //Input field wrapper
            // var fieldHTML = '<div class="form-group row required" id="mobilePhones">' + $("#phones").html() + '<div class="col-1"><a href="javascript:void(0);" class="remove_button"><span class="fa fa-minus"></span></a></div></div>'; //New input field html
            var x = 1; //Initial field counter is 1

            //Once add button is clicked
            $(addButton).click(function () {
                //Check maximum number of input fields
                if (x < maxField) {
                    var fieldHtml = ('<div class="form-group row required" id="mobilePhones">' +
                        '<label for="phone" class="col-md-4 col-form-label">Telefon</label>\n' +
                        '    <div class="col-3" id="">\n' +
                        '       <selec t name="mobilePhone[' + x + '][operatorCode]" id="mobilePhoneOperatorCode" class="form-control here"> ' +
                        '@foreach($mobilePhoneOperatorCodes as $mobilePhoneOperatorCode => $code)' +
                        '        <option value="{{ $mobilePhoneOperatorCode }}">{{ $code }}</option>' +
                        '@endforeach' +
                        '       </select>' +
                        '        @if ($errors->has('mobilePhoneOperatorCode'))\n' +
                        '            <div class="invalid-feedback">\n' +
                        '                <strong>{{ $errors->first('mobilePhoneOperatorCode') }}</strong>\n' +
                        '            </div>\n' +
                        '        @endif\n' +
                        '    </div>\n' +
                        '\n' +
                        '    <div class="col-4">\n' +
                        '        <input id="phoneNumber" type="text"\n' +
                        '               class="form-control{{ $errors->has('phoneNumber') ? ' is-invalid' : '' }}"\n' +
                        '               name="mobilePhone[' + x + '][number]"\n' +
                        '               value="{{ ($user->exists && isset($user->phones->first()->PhoneNumber)) ? $user->phones->first()->PhoneNumber : old('phoneNumber') }}"\n' +
                        '               maxlength="7"\n' +
                        '               pattern="\\d*" data-pattern-error="Yalnız rəqəm daxil edin">\n' +
                        '\n' +
                        '        @if ($errors->has('phoneNumber'))\n' +
                        '            <div class="invalid-feedback">\n' +
                        '                <strong>{{ $errors->first('phoneNumber') }}</strong>\n' +
                        '            </div>\n' +
                        '        @endif\n' +
                        '        <div class="help-block with-errors"></div>\n' +
                        '    </div>' +
                        '<div class="col-1">' +
                        '<a href="javascript:void(0);" class="remove_button btn btn-danger btn-sm"><span class="fa fa-times"></span></a>' +
                        '</div>' +
                        '</div>');
                    x++; //Increment field counter
                    $(wrapper).append(fieldHtml); //Add field html
                }
            });

            //Once remove button is clicked
            $(wrapper).on('click', '.remove_button', function (e) {
                e.preventDefault();
                $(this).parents('#mobilePhones').remove(); //Remove field html
                x--; //Decrement field counter
            });


            //group add limit
            var maxGroup = 4;
            // previousEducationCount = 1;
            //add more fields group
            $("#addMore").click(function () {
                if ($('body').find('.fieldGroup').length < maxGroup) {
                    $('#addMore').attr('disabled', false);
                    previousEducationCount = $('body').find('.fieldGroup').length;
                    // console.log(previousEducationCount);
                    var fieldHTML = '<div class="fieldGroup" id="fieldGroup' + previousEducationCount + '">' + $(".fieldGroupCopy").html() + '</div>';
                    $('body').find('.fieldGroup:last').after(fieldHTML);
                    var countryId = $('select[id="previous_education_country_id"]');
                    // var universityId = $('select[id="previous_education_university_id"]');
                    countryId.change(changeUniversity(previousEducationCount));
                } else {
                    $('#addMore').attr('disabled', true);
                    alert('Maximum ' + maxGroup + ' education field group are allowed.');
                }
            });
            //remove fields group
            $("body").on("click", ".remove", function () {
                $(this).parents(".fieldGroup").remove();
                $('#addMore').attr('disabled', false);
            });


            // Select university by country
            $('select[id="country_id"]').on('change', function () {
                var countryId = $(this).val();
                var token = $("input[name='_token']").val();
                if (countryId) {
                    $.ajax({
                        url: '{{ url('/getUniversitiesByCountry') }}',
                        type: "post",
                        dataType: "json",
                        data: {country_id: countryId, _token: token},
                        beforeSend: function () {
                            $('#loader').css("visibility", "visible");
                        },
                        success: function (data) {
                            $('#admission_score').attr('required', true);
                            $('#admission_score').attr("disabled", false);
                            if (countryId != 5) {
                                console.log($('input[id="admission_score"]'));
                                // $('#admission_score').removeProp('required');
                                $('#admission_score').attr('required', false);
                                $('#admission_score').attr("disabled", "disabled");
                                $('#admission_score').val(0);
                            }
                            $('select[id="university_id"]').empty();
                            $('select[id="university_id"]').append('<option>---- Universitet seç ----</option>');

                            $.each(data, function (key, value) {

                                $('select[id="university_id"]').append('<option value="' + key + '">' + value + '</option>');

                            });
                        },
                        complete: function () {
                            $('#loader').css("visibility", "hidden");
                        }
                    });
                } else {
                    $('select[id="university_id"]').empty();
                }

            });//end select University by Country


            function changeUniversity(count) {
                // Select university by country  for Previous Education 1
                $('#fieldGroup' + count + ' select[id="previous_education_country_id"]').on('change', function () {
                    // console.log( $( this ).val() );
                    var countryId = $(this).val();
                    // alert(countryId);
                    var token = $("input[name='_token']").val();
                    if (countryId) {
                        $.ajax({
                            url: '{{ url('/getUniversitiesByCountry') }}',
                            type: "post",
                            dataType: "json",
                            data: {country_id: countryId, _token: token},
                            beforeSend: function () {
                                $('#loader').css("visibility", "visible");
                            },

                            success: function (data) {
                                $('#fieldGroup' + count + ' input[id="previous_education_admission_score"]').attr('required', true);
                                $('#fieldGroup' + count + ' input[id="previous_education_admission_score"]').attr("disabled", false);
                                if (countryId != 5) {
                                    // console.log('country id: ' + countryId);
                                    $('#fieldGroup' + count + ' input[id="previous_education_admission_score"]').attr('required', false);
                                    $('#fieldGroup' + count + ' input[id="previous_education_admission_score"]').attr("disabled", "disabled");
                                }
                                $('#fieldGroup' + count + ' select[id="previous_education_university_id"]').empty();
                                // console.log('count:' + count);
                                $('#fieldGroup' + count + ' select[id="previous_education_university_id"]').append('<option>---- Universitet seç ----</option>');
                                $.each(data, function (key, value) {
                                    // console.log('count each : ' + count);

                                    $('#fieldGroup' + count + ' select[id="previous_education_university_id"]').append('<option value="' + key + '">' + value + '</option>');

                                });
                            },
                            complete: function () {
                                $('#loader').css("visibility", "hidden");
                            }
                        });
                    } else {
                        $('#fieldGroup' + count + ' select[id="previous_education_university_id"]').empty();
                    }

                });//end select University by Country for Previous Education 1
            }

            // Select university by country  for Previous Education 1
            $('select#ex_previous_education_country_id').on('change', function () {
                // console.log( $( this ).val() );
                var countryId = $(this).val();
                // alert(countryId);
                var token = $("input[name='_token']").val();
                if (countryId) {
                    $.ajax({
                        url: '{{ url('/getUniversitiesByCountry') }}',
                        type: "post",
                        dataType: "json",
                        data: {country_id: countryId, _token: token},
                        beforeSend: function () {
                            $('#loader').css("visibility", "visible");
                        },

                        success: function (data) {
                            $('select#ex_previous_education_country_id').parents('.fieldGroup').find('#previous_education_admission_score');
                            if (countryId != 5) {
                                // $( 'select#ex_previous_education_country_id' ).parents( '.fieldGroup' ).find( '#previous_education_admission_score' ).attr("disabled", "disabled");
                                $('select#ex_previous_education_country_id').parents('.fieldGroup').find('#previous_education_admission_score').remove();
                            }
                            $('select#ex_previous_education_country_id').parents('.fieldGroup').find('#ex_previous_education_university_id').empty();
                            $('select#ex_previous_education_country_id').parents('.fieldGroup').find('select#ex_previous_education_university_id').append('<option>---- Universitet seç ----</option>');
                            $.each(data, function (key, value) {
                                $('select#ex_previous_education_country_id').parents('.fieldGroup').find('select#ex_previous_education_university_id').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },
                        complete: function () {
                            $('#loader').css("visibility", "hidden");
                        }
                    });
                } else {
                    $('select#ex_previous_education_country_id').parents('.fieldGroup').find('#ex_previous_education_university_id').empty();
                    // $('select[id="ex_previous_education_country_id"]').closest('select[id="ex_previous_education_university_id"]').empty();
                }

            });//end select University by Country for Previous Education 1

            //change education section
            // run on change for the select box
            $("#education_section_id").change(function () {
                showCustomSectionInput();
            });

            // handle the updating of the edu section
            function showCustomSectionInput() {
                // hide all edu section
                $('#customEducationSection').hide();

                var divKey = $("#education_section_id option:selected").val();
                if (divKey == 4) {
                    $('#customEducationSection').show();
                }
            }

            // run at load, for the currently selected div to show up
            showCustomSectionInput();

            //change city section
            // run on change for the selectbox
            $("#City_id").change(function () {
                showCustomCityInput();
            });

            // handle the updating of the cit input divs
            function showCustomCityInput() {
                // hide all city input
                $('#customCity').hide();

                var divKey = $("#City_id option:selected").val();
                if (divKey == 52) {
                    $('#customCity').show();
                }
            }

            // run at load, for the currently selected div to show up
            showCustomCityInput();

            // previous internship dynamic form

            //group add limit
            // var maxGroup = 4;

            //add more fields group
            $("#addMoreInternship").click(function () {
                if ($('body').find('.previousInternshipFieldGroup').length < maxGroup) {
                    console.log($('body').find('.previousInternshipFieldGroup').length);
                    $('#addMoreInternship').attr('disabled', false);
                    previousInternshipCount = $('body').find('.previousInternshipFieldGroup').length;
                    var fieldHTML = '<div class="previousInternshipFieldGroup" id="previousInternshipFieldGroup' + previousInternshipCount + '">' + $(".previousInternshipFieldGroupCopy").html() + '</div>';
                    if (previousInternshipCount < 1) {
                        $('body').find('.internshipSection').append(fieldHTML);
                    } else {
                        $('body').find('.previousInternshipFieldGroup:last').after(fieldHTML);
                    }

                } else {
                    $('#addMoreInternship').attr('disabled', true);
                    alert('Maximum ' + maxGroup + ' education field group are allowed.');
                }
            });
            //remove fields group
            $("body").on("click", ".remove", function () {
                $(this).parents(".previousInternshipFieldGroup").remove();
                $('#addMoreInternship').attr('disabled', false);
            });


            //add more scholarship fields group
            $("#addMoreScholarship").click(function () {
                if ($('body').find('.previousScholarshipFieldGroup').length < maxGroup) {
                    $('#addMoreScholarship').attr('disabled', false);
                    previousScholarshipCount = $('body').find('.previousScholarshipFieldGroup').length;
                    var fieldHTML = '<div class="previousScholarshipFieldGroup" id="previousScholarshipFieldGroup' + previousScholarshipCount + '">' + $(".previousScholarshipFieldGroupCopy").html() + '</div>';
                    if (previousScholarshipCount < 1 ) {
                        $('body').find('.scholarshipSection').append(fieldHTML);
                    } else {
                        $('body').find('.previousScholarshipFieldGroup:last').after(fieldHTML);
                    }

                } else {
                    $('#addMoreScholarship').attr('disabled', true);
                    alert('Maximum ' + maxGroup + ' education field group are allowed.');
                }
            });
            //remove fields group
            $("body").on("click", ".remove", function () {
                $(this).parents(".previousScholarshipFieldGroup").remove();
                $('#addMoreScholarship').attr('disabled', false);
            });


            $('#special-div').hide();

        });

    </script>


{{--    <script !src="">--}}

{{--        $( document ).ready(function() {--}}
{{--            var val = $(".education_level").val();--}}
{{--            if (val == "1") {--}}
{{--                $('[id="c1"]').css("display", "block");--}}
{{--                $('[id="c2"]').css("display", "none");--}}

{{--            } else if (val == "2") {--}}
{{--                $('[id="c1"]').css("display", "none");--}}
{{--                $('[id="c2"]').css("display", "block");--}}

{{--            }--}}
{{--            else{--}}
{{--                $('[id="c1"]').css("display", "none");--}}
{{--                $('[id="c2"]').css("display", "none");--}}
{{--            }--}}

{{--            $(".education_level").change(function () {--}}
{{--                var val = $(this).val();--}}

{{--                if (val == "1") {--}}
{{--                    $('[id="c1"]').css("display", "block");--}}
{{--                    $('[id="c2"]').css("display", "none");;--}}

{{--                } else if (val == "2") {--}}
{{--                    $('[id="c1"]').css("display", "none");--}}
{{--                    $('[id="c2"]').css("display", "block");--}}

{{--                }--}}
{{--                else  {--}}
{{--                    $('[id="c1"]').css("display", "none");--}}
{{--                    $('[id="c2"]').css("display", "none");--}}

{{--                }--}}
{{--            });        });--}}
{{--    </script>--}}


    <script>
        $(document).ready(function () {
            var val = $(".education_level").val();
            if (val == "2") {
                $(".bac option[value='3']").remove();
                $(".bac option[value='4']").remove();
            }

            $(".education_level").change(function () {
                var val = $(this).val();
                if (val == "2") {
                    $(".bac option[value='3']").remove();
                    $(".bac option[value='4']").remove();
                }  else if (val == "1") {
                    if ($(".bac option[value='3']").length === 0 || $(".bac option[value='4']").length === 0 ) {
                        // code to run if it isn't there
                        $(".bac").append(new Option("3", "3"));
                        $(".bac").append(new Option("4", "4"));
                    }
                }

            });
        });
    </script>
@endsection