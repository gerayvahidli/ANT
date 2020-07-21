@extends('layouts.app')



@section('head')


    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip({'placement': 'right'});
        });
    </script>
    <script src="{{asset('js/dropzone.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/dropzone.css')}}">
    <link rel="stylesheet" href="https://dbushell.com/Pikaday/css/pikaday.css">
    <style type="text/css">
        .error {
            font-weight: bold;
            font-size: 11px;
        }

        .errorInput {
            background-color: #ffffcc;
            border-color: transparent;
            border: 1px solid #dc3545;
        }
    </style>

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

@endsection

@section('mainSection')

    <div class="container">
        <hr>

        <h3 style="text-align: center;">Xarici təqaüd proqramına müraciət</h3>
        <hr>
        <form name="applyForm" id="applyForm" action="" method="post" enctype="multipart/form-data"
              data-toggle="validator" role="form">

            <div class="row">
                <div class="col-md-10 " style="margin:0 auto;">
                    <div class="form-group required">


                        <label for="speciality_id" class="col-form-label">İxtisas qrupu</label><br>
                        {{ Form::select('speciality_id', \App\SpecialityGroup::pluck('Name','Id')->toArray() ,null,['class'=>($errors->has('speciality_id'))?'errorInput form-control':'form-control','id' => 'speciality_id']) }}
                        <span class="error text-danger"> {{$errors->first('speciality_id')}}</span>


                    </div>

                    <div class="form-group required specialization_div">
                        <label for="specialization_name" class="col-form-label">İxtisaslaşma</label>
                        {{--                        <select class="form-control" name="specialization_id" id="specialization_id"></select>--}}
                        <input id="specialization_name"
                               {{--                               style="display: none"--}}
                               required
                               data-required-error='İxtisaslaşma sahəsini boş burxamayın'
                               maxlength="500"
                               data-error='İxtisaslaşma maksimum 500 simvoldan ibarət olmalidir'
                               type="text"
                               class="form-control  {{$errors->has('specialization_name')?'errorInput':''}}"
                               name="specialization_name"
                               value="{{old('specialization_name')}}">
                        <span class="error text-danger"> {{$errors->first('specialization_name')}}</span>
                        <div class="help-block with-errors"></div>

                    </div>


                    <div class="form-group required">
                        <label for="country_id" class="col-form-label">Ölkə</label>
                        <select class="form-control" name="country_id" id="country_id"></select>
                        {{--                    {{ Form::select('country_id', [''=>'---------']+\App\Country::pluck('Name','id')->toArray() ,null,['class'=>($errors->has('country_id'))?'errorInput form-control':'form-control','id'=>'category_id','onchange'=>'related_city()']) }}--}}
                        <span class="error text-danger"> {{$errors->first('country_id')}}</span>
                    </div>
                    <div class="form-group required">
                        <label for="city_name" class="col-form-label">Şəhər</label>
                        <input type="text" class="form-control {{$errors->has('city_name')?'errorInput':''}}"
                               required
                               data-required-error='Şəhər sahəsini boş burxamayın'
                               maxlength="100"
                               data-error='Şəhər maksimum 100 simvoldan ibarət olmalidir'
                               value="{{old('city_name')}}" name="city_name" id="city_name">
                        <span class="error text-danger"> {{$errors->first('city_name')}}</span>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group required">

                        <label for="university_id" class="col-form-label">Təhsil müəssisəsi</label>
                        <div id="related_city">
                            <select class="form-control" name="university_id" id="university_id"></select>


                            {{--                        @if(old('university_id')!=null)--}}
                            {{--                            {{ Form::select('university_id', \App\University::where('country_id',old('country_id'))->pluck('Name','id')->toArray() ,null,['class'=>'form-control','id'=>'university_id']) }}--}}

                            {{--                        @else--}}

                            {{--                            {{ Form::select('university_id', [''=>'---------'],null,['class'=>($errors->has('university_id'))?'errorInput form-control':'form-control','id'=>'category_id']) }}--}}
                            {{--                            <span class="error text-danger"> {{$errors->first('university_id')}}</span>--}}
                            {{--                            <small id="emailHelp" class="form-text text-muted"><i><b>İlk öncə ölkə seçilməlidir.</b></i></small>--}}
                            {{--                        @endif--}}


                        </div>
                    </div>


                    <div class="form-group ">
                        <label for="main_modules" class="col-form-label">Əsas modullar</label>
                        <textarea class="form-control {{$errors->has('main_modules')?'errorInput':''}}"
                                  name="main_modules">{{old('main_modules')}}</textarea>
                        <span class="error text-danger"> {{$errors->first('main_modules')}}</span>
                    </div>

                    <div class="form-group ">
                        <label for="additional_modules" class="col-form-label">Əlavə (seçmə) modullar</label>
                        <textarea class="form-control {{$errors->has('additional_modules')?'errorInput':''}}"
                                  name="additional_modules">{{old('additional_modules')}}</textarea>
                        <span class="error text-danger"> {{$errors->first('additional_modules')}}</span>
                    </div>


                    <div class="form-group required">
                        <label for="exampleInputEmail1" class="col-form-label">Təhsil müddəti</label>
                        <div class="form-row align-items-center">

                            <div class="col-sm-6 my-1">
                                <input type="text"
                                       value="{{old('EducationBeginDate')}}"
                                       autocomplete="off"
                                       name="EducationBeginDate"
                                       maxlength="4"
                                       class="form-control  {{$errors->has('EducationBeginDate')?'errorInput':''}}"
                                       required
                                       data-required-error='Təhsil müddəti sahəsini boş burxamayın'
                                       max="{{date("Y")}}"
                                       data-error='Təhsilin başlama ili cari ildən böyük ola bilməz'
                                       onkeydown="return event.keyCode === 8 || event.keyCode === 46 ? true : !isNaN(Number(event.key))"
                                >
                                <small>Başlama ili</small>
                                <span class="error text-danger"> {{$errors->first('EducationBeginDate')}}</span>
                            </div>
                            <div class="col-sm-6 my-1">
                                <label class="sr-only" for="EducationEndDate">Bitmə tarixi</label>
                                <input type="text"
                                       value="{{old('EducationEndDate')}}"
                                       autocomplete="off"
                                       maxlength="4"
                                       name="EducationEndDate"
                                       class="form-control {{$errors->has('EducationEndDate')?'errorInput':''}}"
                                       required
                                       data-required-error='Təhsil müddəti sahəsini boş burxamayın'
                                       max="{{date("Y")}}"
                                       data-error='Təhsilin bitmə ili cari ildən böyük ola bilməz'
                                       onkeydown="return event.keyCode === 8 || event.keyCode === 46 ? true : !isNaN(Number(event.key))"
                                <small>Bitmə ili</small>
                                <span class="error text-danger"> {{$errors->first('EducationEndDate')}}</span>
                            </div>
                        </div>
                        <div class="help-block with-errors"></div>
                    </div>

                    <div class="form-group ">
                        <label for="education_start_date" class="col-form-label">Təhsilin başlama tarixi</label>
                        <input type="date" value="{{old('education_start_date')}}"
                               name="education_start_date"
                               class="form-control  {{$errors->has('education_start_date')?'errorInput':''}}">
                        <div class="help-block with-errors"></div>
                        <span class="error text-danger"> {{$errors->first('education_start_date')}}</span>
                    </div>

                    <div class="form-row ">
                        <div class="form-group col-8 required">
                            <label for="education_fee[amount]" class="col-form-label">Təhsil haqqı</label>
                            <input type="number"
                                   required
                                   data-required-error='Təhsil haqqı sahəsini boş burxamayın'
                                   class="form-control col-4 {{$errors->has('education_fee[amount]')?'errorInput':''}}"
                                   value="{{old('education_fee[amount]')}}" name="education_fee[amount]"
                                   id="education_fee"
                                   min="0"
                                   onkeydown="return event.keyCode !== 69 && event.keyCode !== 189"
                            >
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group col-4">
                            <label for="education_fee[currency]" class="col-form-label">Məzənnə</label>
                            <select class="form-control" name="education_fee[currency]" id="education_fee_currency">
                                @foreach($currencies as $currency)
                                    <option value="{{$currency -> Id}}">{{ $currency -> Name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="help-block with-errors"></div>
                        <span class="error text-danger"> {{$errors->first('education_fee')}}</span>
                    </div>

                    <div class="certificates" id="certificates">
                        <div class="form-row  test">
                            <div class="form-group col-12 ">
                                <label for="inputCity" class="col-form-label">Dil sertifikatı</label>
                                <div class="d-flex">
                                    <select name="language_education_certificate_id[0][certificate]" id=""
                                            class="form-control language_education_certificate_id {{($errors->has('language_education_certificate_id'))? 'errorInput' : ''}} "
                                            id="language_education_certificate_id">
                                        @foreach($certificates as $certificate)
                                            <option value="{{$certificate -> Id}}">{{$certificate -> Name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="help-block with-errors"></div>
                                <span class="error text-danger"> {{$errors->first('language_education_certificate_id')}}</span>
                            </div>

                        </div>
                        <div class="form-group  languageLevel" style="display: none">
                            <label for="" class="col-form-label">Dil bilmə səviyyəsi</label>
                            <div class="form-row align-items-center">
                                <div class="col-sm-3 ">
                                    <input type="number"
                                           step="any"
                                           min="0"
                                           id=""
                                           name="language_education_certificate_id[0][reading]"
                                           class="form-control"
                                           placeholder="0"
                                           onkeydown="return event.keyCode !== 69 && event.keyCode !== 189"
                                    >
                                    <small>oxuma</small>
                                    <span class="error text-danger"></span>
                                </div>

                                <div class="col-sm-3 ">
                                    <input type="number"
                                           step="any"
                                           min="0"
                                           id=""
                                           name="language_education_certificate_id[0][writing]"
                                           class="form-control"
                                           placeholder="0"
                                           onkeydown="return event.keyCode !== 69 && event.keyCode !== 189"
                                    >
                                    <small>yazma</small>
                                    <span class="error text-danger"> </span>
                                </div>

                                <div class="col-sm-3 ">
                                    <input type="number"
                                           step="any"
                                           min="0"
                                           id=""
                                           name="language_education_certificate_id[0][speaking]"
                                           class="form-control "
                                           placeholder="0"
                                           onkeydown="return event.keyCode !== 69 && event.keyCode !== 189"
                                    >
                                    <small>danışıq</small>
                                    <span class="error text-danger"></span>
                                </div>

                                <div class="col-sm-3 ">
                                    <input type="number"
                                           step="any"
                                           min="0"
                                           id=""
                                           name="language_education_certificate_id[0][listening]"
                                           class="form-control"
                                           placeholder="0"
                                           onkeydown="return event.keyCode !== 69 && event.keyCode !== 189"
                                    >
                                    <small>dinləmə</small>
                                    <span class="error text-danger"></span>
                                </div>

                                <div class="col-sm-3 offset-4 ">
                                    <input type="number"
                                           step="any"
                                           min="0"
                                           id=""
                                           name="language_education_certificate_id[0][general]"
                                           class="form-control"
                                           placeholder="0"
                                           onkeydown="return event.keyCode !== 69 && event.keyCode !== 189"
                                    >
                                    <small>ümumi</small>
                                    <span class="error text-danger"></span>
                                </div>

                            </div>
                        </div>

                        <div class="form-group row otherCertificate ">
                            <div class="col-sm-6 form-group">
                                <input id="otherCertificate_name"
                                       class="form-control input-group-lg reg_name"
                                       data-required-error = "Serifikatın adı sahəsini boş buraxmayın"
                                       maxlength="50"
                                       type="text"
                                       name="language_education_certificate_id[0][otherCertificate_name]">
                                <small>Serifikatın adı</small>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="col-sm-6 form-group">
                                <input id="otherCertificate_point"
                                       min="0"
                                       step="any"
                                       class="form-control input-group-lg reg_name"
                                       type="number"
                                       name="language_education_certificate_id[0][otherCertificate_point]"
                                       placeholder="0"
                                       onkeydown="return event.keyCode !== 69 && event.keyCode !== 189">
                                <small>Bal</small>
                            </div>
                        </div>

                    </div>


                    <button id="addCertificate" type="button" class="form-control btn btn-primary">Əlavə et</button>

                    <div class="form-group ">
                        <label for="education_language" class="col-form-label">Təhsil dili</label>
                        <input type="text" class="form-control {{$errors->has('education_language')?'errorInput':''}}"
                               value="{{old('education_language')}}"
                               name="education_language"
                               id="education_language"
                               {{--                               required--}}
                               data-required-error='Təhsil dili sahəsini boş burxamayın'
                               maxlength="20"
                               data-error='İxtisaslaşma maksimum 20 simvoldan ibarət olmalidir'
                        >
                        <div class="help-block with-errors"></div>
                        <span class="error text-danger"> {{$errors->first('education_language')}}</span>
                    </div>
                    <div class="form-group required">
                        <input name="realEstate"
                               type="checkbox"
                               class="realEstate"
                               data-target="realEstateDiv"
                               required
                               data-required-error="Davam etmək üçün  daşınmaz əmlak və ya bank zəmanəti (və ya hər ikisi) seçin"
                        />Daşınmaz
                        əmlak
                        <div class="help-block with-errors"></div>
                        <span class="error text-danger"> {{$errors->first('education_language')}}</span>
                    </div>


                    <div id="realEstateDiv">

                        <div class="form-group required">
                            <label for="deposit_object_id" class="col-form-label">Girov predmeti
                            </label>
                            <select name="realEstate_deposit_object_id" id="realEstate_deposit_object_id"
                                    class="form-control {{($errors->has('realEstate_deposit_object_id'))?'errorInput' : ''}} ">
                                @foreach($deposites as $deposite)
                                    <option value="{{$deposite -> Id}}">{{$deposite -> Name}}</option>
                                @endforeach
                            </select>
                            {{--                            {{ Form::select('realEstate_deposit_object_id',\App\Deposit::pluck('Name','id')->toArray() ,null,['class'=>($errors->has('realEstate_deposit_object_id'))?'errorInput form-control':'form-control','id'=>'realEstate_deposit_object_id']) }}--}}

                        </div>


                        <div class="form-group required">
                            <label for="realEstate_located_city" class="col-form-label required">Ünvan
                            </label>
                            <input type="text"
                                   class="form-control {{$errors->has('realEstate_located_city')?'errorInput':''}}"
                                   name="realEstate_located_city" value="{{old('realEstate_located_city')}}"
                                   id="realEstate_located_city"
                                   required
                                   data-required-error='Ünvan sahəsini boş burxamayın'
                                   maxlength="20"
                                   data-error='Ünvan maksimum 20 simvoldan ibarət olmalidir'
                            >
                            <div class="help-block with-errors"></div>
                            <span class="error text-danger"> {{$errors->first('realEstate_located_city')}}</span>
                        </div>

                        <div class="form-group required">
                            <label for="realEstate_owner" class="col-form-label required">Mülkiyyətçi
                            </label>
                            <input type="text" class="form-control "
                                   name="realEstate_owner"
                                   value=""
                                   id="realEstate_owner"
                                   required
                                   data-required-error='Mülkiyyətçi sahəsini boş burxamayın'
                                   maxlength="100"
                                   data-error='Mülkiyyətçi maksimum 100 simvoldan ibarət olmalidir'
                            >
                            <div class="help-block with-errors"></div>
                            <span class="error text-danger"> </span>
                        </div>

                        <div class="form-group required">
                            <label for="realEstate_owner_contact" class="col-form-label required">Mülkiyyətçinin əlaqə
                                nömrəsi
                            </label>
                            <input type="text" class="form-control "
                                   name="realEstate_owner_contact"
                                   value=""
                                   id="realEstate_owner_contact"
                                   required
                                   data-required-error='Mülkiyyətçinin əlaqə
                                   nömrəsi sahəsini boş burxamayın'
                                   maxlength="50"
                                   data-error='Mülkiyyətçinin əlaqə
                                   nömrəsi maksimum 50 simvoldan ibarət olmalidir'
                                   pattern="\d*"
                                   data-pattern-error="Yalnız rəqəm daxil edin"
                            >
                            <div class="help-block with-errors"></div>
                            <span class="error text-danger"> </span>
                        </div>

                        <div class="form-group ">
                            <label for="realEstate_owner_email" class="col-form-label required">Mülkiyyətçinin poçt
                                ünvanı
                            </label>
                            <input type="email" class="form-control "
                                   name="realEstate_owner_email"
                                   value=""
                                   id="realEstate_owner_email"
                                   {{--                                   required--}}
                                   data-required-error='Mülkiyyətçinin poçt
                                   ünvanı  sahəsini boş burxamayın'
                                   maxlength="100"
                                   data-error='Email formatını düzgün daxil edin'
                            >
                            <div class="help-block with-errors"></div>
                            <span class="error text-danger"> </span>
                        </div>

                        <p class="lead required">Daşınmaz əmlakın dövlət reyestrindən çıxarışının</p>

                        <div class="form-group required">
                            <label for="realEstate" class="col-form-label">Seriya nömrəsi</label>
                            <div class="form-row align-items-center">

                                <div class="col-sm-3 my-1">
                                    <label class="sr-only col-form-label" for="realEstateSNO[serial]">Seriya</label>
                                    <input type="text" value=""
                                           name="realEstateSNO[serial]"
                                           class="form-control  {{$errors->has('realEstateSNO[serial]')?'errorInput':''}}"
                                           id="realEstate_owner_email"
                                           required
                                           data-required-error='Seria sahəsini boş burxamayın'
                                           maxlength="50"

                                    >
                                    <small>Seria</small>
                                    <div class="help-block with-errors"></div>
                                    <span class="error text-danger"> {{$errors->first('realEstateSNO[serial]')}}</span>
                                </div>
                                <div class="col-sm-9     my-1">
                                    <input type="text" value="{{old('realEstateSNO[number]')}}"
                                           name="realEstateSNO[number]"
                                           class="form-control {{$errors->has('realEstateSNO[number]')?'errorInput':''}}"
                                           required
                                           data-required-error='Nömrə sahəsini boş burxamayın'
                                           maxlength="50"
                                    >
                                    <small>Nömrə</small>
                                    <div class="help-block with-errors"></div>
                                    <span class="error text-danger"> {{$errors->first('EducationEndDate')}}</span>
                                </div>

                            </div>
                            <div class="form-group ">
                                <label for="realEstate_reyester" class="col-form-label required">Reyester nömrəsi
                                </label>
                                <input type="text" class="form-control "
                                       name="realEstate_reyester" value=""
                                       id="realEstate_reyester"
                                       required
                                       data-required-error='Reyester nömrəsi sahəsini boş burxamayın'
                                       maxlength="100"
                                       data-error='Reyester nömrəsi maksimum 100 simvoldan ibarət olmalidir'
                                >
                                <div class="help-block with-errors"></div>
                                <span class="error text-danger"> </span>
                            </div>
                            <div class="form-group ">
                                <label for="realEstate_registry" class="col-form-label required">Qeydiyyat nömrəsi
                                </label>
                                <input type="text" class="form-control "
                                       name="realEstate_registry"
                                       value=""
                                       id="realEstate_registry"
                                       required
                                       data-required-error='Qeydiyyat nömrəsi sahəsini boş burxamayın'
                                       maxlength="100"
                                       data-error='Qeydiyyat nömrəsi maksimum 100 simvoldan ibarət olmalidir'
                                >
                                <div class="help-block with-errors"></div>
                                <span class="error text-danger"> </span>
                            </div>
                            <div class="form-group ">
                                <label for="realEstate_registry_date" class="col-form-label required">Qeydiyyat tarixi
                                </label>
                                <input type="date" class="form-control "
                                       name="realEstate_registry_date"
                                       value=""
                                       id="realEstate_registry_date"
                                       required
                                       data-required-error='Qeydiyyat tarixi sahəsini boş burxamayın'
                                >
                                <div class="help-block with-errors"></div>
                                <span class="error text-danger"> </span>
                            </div>
                        </div>
                    </div>


                    <div class="form-group required">
                        <input type="checkbox"
                               class="bankGuarantee"
                               name="bank_guarantee"
                               data-target="bankGuaranteeDiv"
                               id="bank_guarantee"
                        />Bank zəmanəti
                        <span class="error text-danger"> {{$errors->first('education_language')}}</span>
                    </div>


                    <div id="bankGuaranteeDiv">

                        <div class="form-group required">
                            <label for="bank_id" class="col-form-label">Bank
                            </label>
                            <select name="bank_id" id="bank_id"
                                    class="form-control {{$errors->has('bank_id') ? 'errorInput' : '' }} ">
                                @foreach($banks as $bank)
                                    <option value="{{$bank->Id}}">{{$bank -> Name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-row required">
                            <div class="form-group col-8">
                                <label for="bank_fee[amount]" class="col-form-label">Məbləğ</label>
                                <input type="number"
                                       class="form-control col-4 {{$errors->has('bank_fee[amount]')?'errorInput':''}}"
                                       value="{{old('bank_fee[amount]')}}"
                                       name="bank_fee[amount]"
                                       id="bank_fee"
                                       required
                                       data-required-error='Məbləğ sahəsini boş burxamayın'
                                       onkeydown="return event.keyCode === 8 || event.keyCode === 46 ? true : !isNaN(Number(event.key))"
                                >
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group col-4">
                                <label for="bank_fee[currency]" class="col-form-label">Məzənnə</label>
                                <select class="form-control" name="bank_fee[currency]" id="bank_fee[currency]">
                                    @foreach($currencies as $currency)
                                        <option value="{{$currency -> Id}}">{{ $currency -> Name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="error text-danger"> {{$errors->first('bank_fee[currency]')}}</span>
                        </div>

                    </div>

                    <div class="form-group required">
                        <label for="achievements" class="col-form-label">Nəaliyyətləri</label>
                        <textarea class="form-control {{$errors->has('achievements')?'errorInput':''}}"
                                  name="achievements"
                                  required
                                  data-required-error='Nəaliyyətləri sahəsini boş burxamayın'
                        >{{old('achievements')}}</textarea>
                        <div class="help-block with-errors"></div>
                        <small>Bu məlumat CV-nizə əlavə ediləcəkdir və komissiya iclasında baxılması üçündür</small>
                        <span class="error text-danger"> {{$errors->first('achievements')}}</span>
                    </div>
                    <div class="form-group required">
                        <label for="about_family" class="col-form-label required">Ailəsi haqqında</label>
                        <textarea class="form-control {{$errors->has('about_family')?'errorInput':''}}"
                                  name="about_family"
                                  required
                                  data-required-error='Ailəsi haqqında sahəsini boş burxamayın'
                        >{{old('about_family')}}</textarea>
                        <div class="help-block with-errors"></div>
                        <small>Ailə üzvü, ad, soyad, təvəllüd, doğum yeri, iş yeri, vəzifəsi (Bu məlumat CV-nizə əlavə
                            ediləcəkdir və komissiya iclasında baxılması üçündür)</small>
                        <span class="error text-danger"> {{$errors->first('about_family')}}</span>


                    </div>

                    <input type="hidden" id="filename" value="{{old('filename')}}" name="filename">


                    {{--                    <input type="hidden" id="dropzone_filezone" value="{{old('dropzone_filezone')}}"--}}
                    {{--                           name="dropzone_filezone">--}}

                    <p for="exampleInputEmail1" class="lead">Sənədlərinizi əlavə edin
                        <a class="btn btn-primary btn-xs" style="padding:0.05em 0.32rem;" href="#"
                           data-toggle="tooltip" rel="tooltip" data-placement="top"
                           title="Birdən çox sənəd daxil etmək üçün lazımi sənədləri zip-ə əlavə edib daxil edin. Nəzərə alın ki əlavə ediləcək fayl həm ayrı ayrılıqda həm də zip-in içində pdf və jpg formatından fərqli ola bilməz! ">Qeyd</a>
                    </p>


                    <div class="form-group required">
                        <label for="passport_copy" class="col-form-label required">
                            Şəxsiyyət vəsiqəsinin surəti
                        </label>
                        <input type="file" class="form-control "
                               name="passport_copy"
                               value=""
                               id="passport_copy"
                               required
                               data-required-error='Şəxsiyyət vəsiqəsinin surəti sahəsini boş burxamayın' ,
                               accept=".jpg,.pdf,.zip"
                        >
                        <div class="help-block with-errors"></div>
                        <span class="error text-danger"> </span>
                    </div>
                    <div class="form-group required">
                        <label for="certificate_document" class="col-form-label required">
                            Müvafiq xarici dili bilmə səviyyəsini təsdiq edən sənəd (TOEFL və ya IELTS sertifikatı)
                        </label>
                        <input type="file" class="form-control "
                               name="certificate_document"
                               value=""
                               id="certificate_document"
                               required
                               data-required-error='Müvafiq xarici dili bilmə səviyyəsini təsdiq edən sənəd (TOEFL və ya IELTS sertifikatı) sahəsini boş burxamayın'
                               accept=".jpg,.pdf,.zip"
                        >
                        <div class="help-block with-errors"></div>
                        <span class="error text-danger"> </span>
                    </div>
                    <div class="form-group required">
                        <label for="university_document" class="col-form-label required">
                            Xarici universitetə qəbulu təsdiq edən rəsmi sənəd
                        </label>
                        <input type="file" class="form-control "
                               name="university_document"
                               value=""
                               id="university_document"
                               required
                               data-required-error='Xarici universitetə qəbulu təsdiq edən rəsmi sənəd sahəsini boş burxamayın'
                               accept=".jpg,.pdf,.zip"
                        >
                        <div class="help-block with-errors"></div>
                        <span class="error text-danger"> </span>
                    </div>
                    <div class="form-group required">
                        <label for="biography" class="col-form-label required">
                            Tərcümeyi-hal
                        </label>
                        <input type="file"
                               class="form-control "
                               name="biography"
                               value=""
                               id="biography"
                               required
                               data-required-error='Tərcümeyi-hal sahəsini boş burxamayın'
                               accept=".jpg,.pdf,.zip"
                        >
                        <div class="help-block with-errors"></div>
                        <span class="error text-danger"> </span>
                    </div>
                    <div class="form-group required">
                        <label for="medical_certificate" class="col-form-label required">
                            Poliklinikadan 086 No-li tibbi arayış
                        </label>
                        <input type="file"
                               class="form-control "
                               name="medical_certificate"
                               value=""
                               id="medical_certificate"
                               required
                               data-required-error='Poliklinikadan 086 No-li tibbi arayış sahəsini boş burxamayın'
                               accept=".jpg,.pdf,.zip"
                        >
                        <div class="help-block with-errors"></div>
                        <span class="error text-danger"> </span>
                    </div>
                    <div class="form-group required">
                        <label for="psychological_dispensary" class="col-form-label required">
                            Psixoloji dispanserdən arayış
                        </label>
                        <input type="file"
                               class="form-control "
                               name="psychological_dispensary"
                               value=""
                               id="psychological_dispensary"
                               required
                               data-required-error='Psixoloji dispanserdən arayış sahəsini boş burxamayın'
                               accept=".jpg,.pdf,.zip"
                        >
                        <div class="help-block with-errors"></div>
                        <span class="error text-danger"> </span>
                    </div>
                    <div class="form-group required">
                        <label for="academic_transcript" class="col-form-label required">
                            Ali təhsil dövründə qiymətləri barədə rəsmi sənəd (transkript)
                        </label>
                        <input type="file"
                               class="form-control "
                               name="academic_transcript"
                               value=""
                               id="academic_transcript"
                               required
                               data-required-error='Ali təhsil dövründə qiymətləri barədə rəsmi sənəd (transkript) sahəsini boş burxamayın'
                               accept=".jpg,.pdf,.zip"
                        >
                        <div class="help-block with-errors"></div>
                        <span class="error text-danger"> </span>
                    </div>
                    <div class="form-group required">
                        <label for="realEstate_document" class="col-form-label required">
                            Girov qoyulacaq daşınmaz əmlak üzərində mülkiyyət hüququnu təsdiq edən dövlət reyestrindən
                            çıxarışın və həmin əmlakın texniki pasportunun surəti vəya Qarantiya
                        </label>
                        <input type="file"
                               class="form-control "
                               name="realEstate_document"
                               value=""
                               id="realEstate_document"
                               required
                               data-required-error='Girov qoyulacaq daşınmaz əmlak üzərində mülkiyyət hüququnu təsdiq edən dövlət reyestrindən
                            çıxarışın və həmin əmlakın texniki pasportunun surəti vəya Qarantiya sahəsini boş burxamayın'
                               accept=".jpg,.pdf,.zip"
                        >
                        <div class="help-block with-errors"></div>
                        <span class="error text-danger"> </span>
                    </div>
                    <div class="form-group ">
                        <label for="owner_passport" class="col-form-label required">
                            Girov sahibinin şəxsiyyət vəsiqəsi
                        </label>
                        <input type="file"
                               class="form-control myfile"
                               name="owner_passport"
                               value=""
                               id="owner_passport"
                               {{--                               required--}}
                               data-required-error='Girov sahibinin şəxsiyyət vəsiqəsi  sahəsini boş burxamayın'
                               accept=".jpg,.pdf,.zip"
                        >
                        <div class="help-block with-errors"></div>
                        <span class="error text-danger"> </span>
                    </div>

                    <div class="form-group required">
                        <label for="testimonial" class="col-form-label required">
                            Birbaşa rəhbərindən müsbət xasiyyətnamə
                        </label>
                        <input type="file"
                               class="form-control "
                               name="testimonial"
                               value=""
                               id="testimonial"
                               required
                               data-required-error='Birbaşa rəhbərindən müsbət xasiyyətnamə sahəsini boş burxamayın'
                               accept=".jpg,.pdf,.zip"
                        >
                        <div class="help-block with-errors"></div>
                        <span class="error text-danger"> </span>
                    </div>
                    <div class="form-group required">
                        <input type="checkbox" name="i_accept" id="i_accept"/>
                        <span style="font-weight:bold;">
                        Daxil etdiyim məlumatların doğruluğuna zəmanət verirəm
                        </span>
                    </div>


                    {{--                <div class="dropzone {{$errors->has('filename')?'errorInput':''}}" id="myDropzone">--}}
                    {{--                    <div class="dz-message" data-dz-message><span style="font-weight: bold"><i><u>.zip</u></i> və ya <i><u>.rar</u> </i>formatında olan sənədinizi dartıb bura atın və ya klik edib həmin sənədi seçin</span>--}}
                    {{--                    </div>--}}
                    {{--                </div>--}}
                    {{--                <small id="emailHelp" class="form-text text-muted"><i><b>Yalnız .rar və ya .zip formatında fayllar qəbul--}}
                    {{--                            olunur.</b></i></small>--}}
                    {{--                <span class="error text-danger"> {{$errors->first('filename')}}</span>--}}
                    <br><br>
                    <button onclick="window.history.back();" type="button" class="btn btn-danger" data-dismiss="modal">
                        Geri
                    </button>
                    <input value="Müraciət et" type="submit" class="btn" id="apply_it" disabled>
                </div>
            </div>
        </form>

        <div class="modal fade" id="bsModal3" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body" style="text-align: center">
                        <img width="50" src="{{asset('images/success-icon-png-6.jpg')}}" alt="">
                        <h2>MÜRACİƏTİNİZ UĞURLA TAMAMLANDI.</h2>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"> Bağla</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <br>
    <br>

@endsection

@section('bottom')



    <script src="{{asset('js/moment.min.js')}}"></script>
    <script src="{{asset('js/pikaday.js')}}"></script>
    <script src="{{asset('js/validator.js')}}"></script>



    @include('frontend.profile.apply.dropzone', ['folder' => 'external'])


    <script>


        $(document).ready(function () {

            $('#realEstateDiv *').prop('disabled', true);
            $('#bankGuaranteeDiv *').prop('disabled', true);

            $("#i_accept").click(function () {
                var checked_status = this.checked;
                if (checked_status == true) {
                    $("#apply_it").attr("disabled", false);
                } else {
                    $("#apply_it").attr("disabled", true);
                }
            });


            $('body').on('change', '.language_education_certificate_id', function () {
                let val = $('option:selected', this).text();
                console.log(val);
                if (val == "IELTS" || val == "TOEFL IBT") {
                    $(this).parents('.certificates').children('.languageLevel').show();
                    $(this).parents('.certificates').children('.otherCertificate').hide();
                    $('#otherCertificate_name').attr('required',false);
                } else if (val == "Digər") {
                    $(this).parents('.certificates').children('.otherCertificate').show()
                    $(this).parents('.certificates').children('.languageLevel').hide()
                    $('#otherCertificate_name').attr('required',true);
                } else {
                    $(this).parents('.certificates').children('.languageLevel').hide()
                    $(this).parents('.certificates').children('.otherCertificate').hide();
                    $('#otherCertificate_name').attr('required',false);
                }

            });

            $('.language_education_certificate_id').trigger('change');


            $(".realEstate").change(function () {
                if (this.checked) {
                    $('#realEstateDiv *').prop('disabled', false);
                } else {
                    $('#realEstateDiv *').prop('disabled', true);
                }
            });

            $(".bankGuarantee").change(function () {
                if (this.checked) {
                    $(".realEstate").attr('required', false)
                    $('#bankGuaranteeDiv *').prop('disabled', false);
                } else {
                    $(".realEstate").attr('required', true)
                    $('#bankGuaranteeDiv *').prop('disabled', true);
                }
            });


            function related_city() {


                $.ajax({

                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{url('rel_city')}}",
                    data: {related_city: $('select[name="country_id"]').val()},
                    cache: true,
                    success:
                        function (data) {
                            $("#related_city").html(data).slideDown('slow');
                        }
                });

                // alert('asdsad');
                return false;
            }


            var picker1 = new Pikaday(
                {
                    field: document.getElementById('datepicker1'),
                    format: 'DD.MM.YYYY',
                    firstDay: 1,


                    yearRange: [1905, 2050]
                });

            var picker2 = new Pikaday(
                {
                    field: document.getElementById('datepicker2'),
                    format: 'DD.MM.YYYY',
                    firstDay: 1,


                    yearRange: [2017, 2050]
                });

            var picker3 = new Pikaday(
                {
                    field: document.getElementById('datepicker3'),
                    format: 'DD.MM.YYYY',
                    firstDay: 1,


                    yearRange: [2017, 2050]
                });


            var addButton = $('#addCertificate'); //Add button selector
            var wrapper = $('#certificates'); //Input field wrapper

            // var fieldHTML = '<div class="form-group row required" id="mobilePhones">' + $("#phones").html() + '<div class="col-1"><a href="javascript:void(0);" class="remove_button"><span class="fa fa-minus"></span></a></div></div>'; //New input field html
            var x = 1; //Initial field counter is 1
            var y = 1; //Initial email field counter is 1


            //Once add button is clicked
            $(addButton).click(function () {
                //Check maximum number of input fields
                var fieldHtml = ("<div class=\"certificates\" id=\"certificates\">\n" +
                    "                        <div class=\"form-row  test\">\n" +
                    "                            <div class=\"form-group col-12 required\">\n" +
                    "                                <label for=\"inputCity\" class=\"col-form-label\">Dil sertifikatı</label>\n" +
                    "                                <div class=\"d-flex\">\n" +
                    "                                    <select name=\"language_education_certificate_id[" + x + "][certificate]\" id=\"\"\n" +
                    "                                            class=\"form-control language_education_certificate_id {{($errors->has('language_education_certificate_id'))? 'errorInput' : ''}} \"\n" +
                    "                                            id=\"language_education_certificate_id\">\n" +
                    "                                        @foreach($certificates as $certificate)\n" +
                    "                                            <option value=\"{{$certificate -> Id}}\">{{$certificate -> Name}}</option>\n" +
                    "                                        @endforeach\n" +
                    "                                    </select>\n" +
                    "<input type=\"button\" class=\"btn btn-danger remove_button\" value=\"Sil\" />\n" +
                    "                                </div>\n" +
                    "                                <div class=\"help-block with-errors\"></div>\n" +
                    "                                <span class=\"error text-danger\"> {{$errors->first('language_education_certificate_id')}}</span>\n" +
                    "                            </div>\n" +
                    "\n" +
                    "                        </div>\n" +
                    "                        <div class=\"form-group  languageLevel\" style=\"display: none\">\n" +
                    "                            <label for=\"\" class=\"col-form-label\">Dil bilmə səviyyəsi</label>\n" +
                    "                            <div class=\"form-row align-items-center\">\n" +
                    "                                <div class=\"col-sm-3 \">\n" +
                    "                                    <input type=\"number\"\n" +
                    "                                           step=\"any\"\n" +
                    "                                           min=\"0\"\n" +
                    "                                           id=\"\"\n" +
                    "                                           name=\"language_education_certificate_id[" + x + "][reading]\"\n" +
                    "                                           onkeydown=\"\"\n" +
                    "                                           class=\"form-control\"\n" +
                    "                                           placeholder=\"0\"\n" +
                    "                                           onkeydown=\"return event.keyCode !== 69 && event.keyCode !== 189\"\n" +
                    "                                    >\n" +
                    "                                    <small>oxuma</small>\n" +
                    "                                    <span class=\"error text-danger\"></span>\n" +
                    "                                </div>\n" +
                    "\n" +
                    "                                <div class=\"col-sm-3 \">\n" +
                    "                                    <input type=\"number\"\n" +
                    "                                           step=\"any\"\n" +
                    "                                           min=\"0\"\n" +
                    "                                           id=\"\"\n" +
                    "                                           name=\"language_education_certificate_id[" + x + "][writing]\"\n" +
                    "                                           class=\"form-control\"\n" +
                    "                                           placeholder=\"0\"\n" +
                    "                                           onkeydown=\"return event.keyCode !== 69 && event.keyCode !== 189\"\n" +
                    "                                    >\n" +
                    "                                    <small>yazma</small>\n" +
                    "                                    <span class=\"error text-danger\"> </span>\n" +
                    "                                </div>\n" +
                    "\n" +
                    "                                <div class=\"col-sm-3 \">\n" +
                    "                                    <input type=\"number\"\n" +
                    "                                           step=\"any\"\n" +
                    "                                           min=\"0\"\n" +
                    "                                           id=\"\"\n" +
                    "                                           name=\"language_education_certificate_id[" + x + "][speaking]\"\n" +
                    "                                           class=\"form-control \"\n" +
                    "                                           placeholder=\"0\"\n" +
                    "                                           onkeydown=\"return event.keyCode !== 69 && event.keyCode !== 189\"\n" +
                    "                                    >\n" +
                    "                                    <small>danışıq</small>\n" +
                    "                                    <span class=\"error text-danger\"></span>\n" +
                    "                                </div>\n" +
                    "\n" +
                    "                                <div class=\"col-sm-3 \">\n" +
                    "                                    <input type=\"number\"\n" +
                    "                                           step=\"any\"\n" +
                    "                                           min=\"0\"\n" +
                    "                                           id=\"\"\n" +
                    "                                           name=\"language_education_certificate_id[" + x + "][listening]\"\n" +
                    "                                           class=\"form-control\"\n" +
                    "                                           placeholder=\"0\"\n" +
                    "                                           onkeydown=\"return event.keyCode !== 69 && event.keyCode !== 189\"\n" +
                    "                                    >\n" +
                    "                                    <small>dinləmə</small>\n" +
                    "                                    <span class=\"error text-danger\"></span>\n" +
                    "                                </div>\n" +
                    "\n" +
                    "                                <div class=\"col-sm-3 offset-4 \">\n" +
                    "                                    <input type=\"number\"\n" +
                    "                                           step=\"any\"\n" +
                    "                                           min=\"0\"\n" +
                    "                                           id=\"\"\n" +
                    "                                           name=\"language_education_certificate_id[" + x + "][general]\"\n" +
                    "                                           class=\"form-control\"\n" +
                    "                                           placeholder=\"0\"\n" +
                    "                                           onkeydown=\"return event.keyCode !== 69 && event.keyCode !== 189\"\n" +
                    "                                    >\n" +
                    "                                    <small>ümumi</small>\n" +
                    "                                    <span class=\"error text-danger\"></span>\n" +
                    "                                </div>\n" +
                    "\n" +
                    "                            </div>\n" +
                    "                        </div>\n" +
                    "\n" +
                    "                        <div class=\"form-group row otherCertificate \" >\n" +
                    "                            <div class=\"col-sm-6\">\n" +
                    "                                <input id=\"otherCertificate_name\" class=\"form-control input-group-lg reg_name\" type=\"text\" name=\"language_education_certificate_id[" + x + "][otherCertificate_name]\">\n" +
                    "                                <small>Serifikatın adı</small>\n" +
                    "                            </div>\n" +
                    "                            <div class=\"col-sm-6\">\n" +
                    "                                <input id=\"otherCertificate_point\"\n" +
                    "                                       min=\"0\"\n" +
                    "                                       step=\"any\"\n" +
                    "                                       class=\"form-control input-group-lg reg_name\"\n" +
                    "                                       type=\"number\"\n" +
                    "                                       name=\"language_education_certificate_id[" + x + "][otherCertificate_point]\"\n" +
                    "                                       placeholder=\"0\"\n" +
                    "                                       onkeydown=\"return event.keyCode !== 69 && event.keyCode !== 189\">"+
                    "                                <small>Bal</small>\n" +
                    "                            </div>\n" +
                    "                        </div>\n" +
                    "\n" +
                    "                        </div>\n");
                $('body').find('.certificates:last').after(fieldHtml); //Add field html\

                x++; //Increment field counter
                $('.language_education_certificate_id').trigger('change');


            });
            //Once remove button is clicked
            $('body').on('click', '.remove_button', function (e) {
                e.preventDefault();
                $(this).parents('.certificates').remove(); //Remove field html
                x--; //Decrement field counter
            });

            // $( "#speciality_id" ).change(function() {
            $(document).on('change', '#speciality_id', function () {
                $('select[id="country_id"]').empty()
                $.ajax({

                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{url('rel_specialization')}}",
                    data: {speciality_id: $('select[name="speciality_id"]').val()},
                    cache: true,
                    success:
                        function (data) {
                            var limit = 0;

                            if (data.count < 2) {
                                $('.specialization_select').remove();
                                $.each(data.universitiesWithCountry.universities, function (key, value) {

                                    if (limit != value.country.Id) {
                                        $('select[id="country_id"]').append('<option value="' + value.country.Id + '">' + value.country.Name + '</option>');
                                    }
                                    limit = value.country.Id;

                                });
                                setTimeout(function () {
                                    $('#country_id').trigger('change');
                                }, 500);

                            } else {

                                $('#specialization_name').before(data.specializations_select)

                                $('#specialization_id').trigger('change');

                            }


                        }
                });

            });

            $(document).on('change', '#country_id', function () {

                $('select[id="university_id"]').empty()
                $.ajax({

                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{url('rel_university')}}",
                    data: {
                        country_id: $('#country_id').val(),
                        speciality_id: $('select[name="speciality_id"]').val(),
                        specialization_id: $('select[name="specialization_id"]').val()
                    },
                    cache: true,
                    success:
                        function (data) {

                            $.each(data, function (key, value) {

                                $('select[id="university_id"]').append('<option value="' + value.Id + '">' + value.Name + '</option>');

                            });

                        }
                });
            });


            // $( "#country_id" ).change(function() {
            $(document).on('change', '#specialization_id', function () {

                $('select[id="country_id"]').empty()
                $.ajax({

                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{url('rel_country')}}",
                    data: {
                        specialization_id: $('#specialization_id').val(),
                    },
                    cache: true,
                    success:
                        function (data) {
                            var limit = 0;

                            $.each(data, function (key, value) {

                                if (limit != value.country.Id) {

                                    $('select[id="country_id"]').append('<option value="' + value.country.Id + '">' + value.country.Name + '</option>');
                                }
                                limit = value.country.Id;

                            });

                            setTimeout(function () {
                                $('#country_id').trigger('change');
                            }, 500);

                        }
                });
            });


            $("#speciality_id").trigger('change');
        });


        $('form#applyForm').submit(function (event) {


            event.preventDefault();
            var formdata = new FormData(this); // high importance!;

            // console.log(formdata);
            // return false;

            $.ajax({
                url: '{{route('applyScholarship')}}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'JSON',
                type: 'POST',
                data: formdata,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {

                    if (data.status == "success") {
                        $("#bsModal3").modal('show');
                        setTimeout(function () {
                            window.location.href = '{{ route('profile.index') }}';
                        }, 2000);
                    }
                    (data.status == 'error' && data.code == "400") ?
                        alert("“SOCAR-ın Xarici Təqaüd Proqramı haqqında Əsasnamə”nin 2.2 yarımbəndinə əsasən Xarici dili bilmə səviyyəsi İELTS sertifikatı üzrə 6.0 (yazma və danışıq üzrə 6.5), TOEFL İBT sertifikatı üzrə 80 baldan az olmamalıdır (yazma və danışıq üzrə 23)”") :
                        (data.status == 'error' && data.code == "403") ?
                            alert("Yüklədiyiniz zip-in içində pdf və jpg tipindən başqa tipdə fayl olmadığından əmin olun") : '';


                },
                error: function (data) {
                    console.log("error");
                    // console.log(data);
                }
            });


        });


    </script>
@endsection