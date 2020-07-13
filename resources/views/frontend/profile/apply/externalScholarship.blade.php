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
        <form name="applyForm" id="applyForm" action="" method="post" enctype="multipart/form-data" data-toggle="validator" role="form">

            <div class="row">
                <div class="col-md-10 " style="margin:0 auto;">
                    <div class="form-group required">


                        <label for="specialty_id" class="col-form-label">İxtisas qrupu</label><br>
                        {{ Form::select('specialty_id', \App\SpecialityGroup::pluck('Name','Id')->toArray() ,null,['class'=>($errors->has('specialty_id'))?'errorInput form-control':'form-control','id' => 'specialty_id']) }}
                        <span class="error text-danger"> {{$errors->first('specialty_id')}}</span>


                    </div>

                    <div class="form-group required specialization_div">
                        <label for="specialty_name" class="col-form-label">İxtisaslaşma</label>
{{--                        <select class="form-control" name="specialization_id" id="specialization_id"></select>--}}
                        <input id="specialty_name"
{{--                               style="display: none"--}}
                               data-required-error='Şəxsiyyət vəsiqəsinin FİN kodu sahəsini boş buraxmayın'
                               type="text" class="form-control {{$errors->has('specialty_name')?'errorInput':''}}"
                               name="specialty_name" value="{{old('specialty_name')}}">
                        <span class="error text-danger"> {{$errors->first('specialty_name')}}</span>
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
                               value="{{old('city_name')}}" name="city_name" id="city_name">
                        <span class="error text-danger"> {{$errors->first('city_name')}}</span>
                    </div>
                    <div class="form-group required">

                        <label for="unibuversity_id" class="col-form-label">Təhsil müəssisəsi</label>
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


                    <div class="form-group required">
                        <label for="main_modules" class="col-form-label">Əsas modullar</label>
                        <textarea class="form-control {{$errors->has('main_modules')?'errorInput':''}}"
                                  name="main_modules">{{old('main_modules')}}</textarea>
                        <span class="error text-danger"> {{$errors->first('main_modules')}}</span>
                    </div>

                    <div class="form-group required">
                        <label for="main_modules" class="col-form-label">Əlavə (seçmə) modullar</label>
                        <textarea class="form-control {{$errors->has('main_modules')?'errorInput':''}}"
                                  name="main_modules">{{old('main_modules')}}</textarea>
                        <span class="error text-danger"> {{$errors->first('main_modules')}}</span>
                    </div>


                    <div class="form-group required">
                        <label for="exampleInputEmail1" class="col-form-label">Təhsil müddəti</label>
                        <div class="form-row align-items-center">

                            <div class="col-sm-6 my-1">
                                <label class="sr-only col-form-label" for="EducationBeginDate">Başlama tarixi</label>
                                <input type="text" value="{{old('EducationBeginDate')}}" id="datepicker1"
                                       name="EducationBeginDate"
                                       class="form-control  {{$errors->has('EducationBeginDate')?'errorInput':''}}">
                                <span class="error text-danger"> {{$errors->first('EducationBeginDate')}}</span>
                            </div>
                            <div class="col-sm-6 my-1">
                                <label class="sr-only" for="EducationEndDate">Bitmə tarixi</label>
                                <input type="text" id="datepicker2" value="{{old('EducationEndDate')}}"
                                       name="EducationEndDate"
                                       class="form-control {{$errors->has('EducationEndDate')?'errorInput':''}}">

                                <span class="error text-danger"> {{$errors->first('EducationEndDate')}}</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group required">
                        <label for="education_start_date" class="col-form-label">Təhsilin başlama tarixi</label>
                        <input type="text" value="{{old('EducationBeginDate')}}" id="datepicker3"
                               name="education_start_date"
                               class="form-control  {{$errors->has('EducationBeginDate')?'errorInput':''}}">
                        <span class="error text-danger"> {{$errors->first('EducationBeginDate')}}</span>
                    </div>

                    <div class="form-row required">
                        <div class="form-group col-8">
                            <label for="education_fee" class="col-form-label">Təhsil haqqı</label>
                            <input type="number"
                                   class="form-control col-4 {{$errors->has('education_fee')?'errorInput':''}}"
                                   value="{{old('education_fee')}}" name="education_fee" id="education_fee">
                        </div>
                        <div class="form-group col-4">
                            <label for="education_fee_currency" class="col-form-label">Məzənnə</label>
                            <select class="form-control" name="education_fee_currency" id="education_fee_currency">
                                @foreach($currencies as $currency)
                                    <option value="{{$currency -> Id}}">{{ $currency -> Name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <span class="error text-danger"> {{$errors->first('education_fee')}}</span>
                    </div>

                    <div class="certificates">
                        <div class="form-row required test">
                            <div class="form-group col-md-12 required">
                                <label for="inputCity" class="col-form-label">Dil sertifikatı</label>
                                {{ Form::select('language_education_certificate_id', [''=>'---------']+\App\Certificate::pluck('Name','Id')->toArray() ,null,['class'=>($errors->has('language_education_certificate_id'))?'errorInput form-control language_education_certificate_id':'form-control language_education_certificate_id','id'=>'language_education_certificate_id']) }}
                                <span class="error text-danger"> {{$errors->first('language_education_certificate_id')}}</span>
                            </div>
                        </div>
                        <div class="form-group required languageLevel" style="display: none">
                            <label for="" class="col-form-label">Dil bilmə səviyyəsi</label>
                            <div class="form-row align-items-center">
                                <div class="col-sm-3 ">
                                    <input type="number" step="any" min="0" id="" value="00000"
                                           name=""
                                           onkeydown="return ValidateInput(this);"
                                           class="form-control ">
                                    <small>oxuma</small>
                                    <span class="error text-danger"></span>
                                </div>

                                <div class="col-sm-3 ">
                                    <input type="number" step="any" min="0" id="" value="0"
                                           id=""
                                           name=""
                                           class="form-control">
                                    <small>yazma</small>
                                    <span class="error text-danger"> </span>
                                </div>

                                <div class="col-sm-3 ">
                                    <input type="number" step="any" min="0" id="" value="0"
                                           name=""
                                           class="form-control ">
                                    <small>danışıq</small>
                                    <span class="error text-danger"></span>
                                </div>

                                <div class="col-sm-3 ">
                                    <input type="number" step="any" min="0" id="" value="0"
                                           id=""
                                           name=""
                                           class="form-control">
                                    <small>dinləmə</small>
                                    <span class="error text-danger"></span>
                                </div>

                            </div>
                        </div>

                    </div>
                    <button id="addCertificate" type="button" class="form-control btn btn-primary">Əlavə et</button>

                    <div class="form-group required">
                        <label for="education_language" class="col-form-label">Təhsil dili</label>
                        <input type="text" class="form-control {{$errors->has('education_language')?'errorInput':''}}"
                               value="{{old('education_language')}}" name="education_language" id="education_language">
                        <span class="error text-danger"> {{$errors->first('education_language')}}</span>
                    </div>
                    <div class="form-group required">
                        <input type="checkbox" class="realEstate" data-target="realEstateDiv"/>Daşınmaz əmlak
                        <span class="error text-danger"> {{$errors->first('education_language')}}</span>
                    </div>


                    <div id="realEstateDiv">

                        <div class="form-group required">
                            <label for="deposit_object_id" class="col-form-label">Girov predmeti
                            </label>
                            {{ Form::select('deposit_object_id', [''=>'---------']+\App\Deposit::pluck('Name','id')->toArray() ,null,['class'=>($errors->has('deposit_object_id'))?'errorInput form-control':'form-control','id'=>'deposit_object_id']) }}

                        </div>


                        <div class="form-group required">
                            <label for="located_city" class="col-form-label required">Ünvan
                            </label>
                            <input type="text" class="form-control {{$errors->has('located_city')?'errorInput':''}}"
                                   name="located_city" value="{{old('located_city')}}" id="exampleInputEmail1">
                            <span class="error text-danger"> {{$errors->first('located_city')}}</span>
                        </div>

                        <div class="form-group required">
                            <label for="Owner" class="col-form-label required">Mülkiyyətçi
                            </label>
                            <input type="text" class="form-control "
                                   name="Owner" value="" id="Owner">
                            <span class="error text-danger"> </span>
                        </div>

                        <div class="form-group required">
                            <label for="Owner" class="col-form-label required">Mülkiyyətçinin əlaqə nömrəsi
                            </label>
                            <input type="text" class="form-control "
                                   name="Owner" value="" id="Owner">
                            <span class="error text-danger"> </span>
                        </div>

                        <div class="form-group ">
                            <label for="Owner" class="col-form-label required">Mülkiyyətçinin poçt ünvanı
                            </label>
                            <input type="email" class="form-control "
                                   name="Owner" value="" id="Owner">
                            <span class="error text-danger"> </span>
                        </div>

                        <p class="lead required">Daşınmaz əmlakın dövlət reyestrindən çıxarışının</p>

                        <div class="form-group required">
                            <label for="exampleInputEmail1" class="col-form-label">Seriya nömrəsi</label>
                            <div class="form-row align-items-center">

                                <div class="col-sm-3 my-1">
                                    <label class="sr-only col-form-label" for="EducationBeginDate">Seriya</label>
                                    <input type="text" value=""
                                           name="EducationBeginDate"
                                           class="form-control  {{$errors->has('EducationBeginDate')?'errorInput':''}}">
                                    <small>Seria</small>
                                    <span class="error text-danger"> {{$errors->first('EducationBeginDate')}}</span>
                                </div>
                                <div class="col-sm-9     my-1">
                                    <input type="text" value="{{old('EducationEndDate')}}"
                                           name="EducationEndDate"
                                           class="form-control {{$errors->has('EducationEndDate')?'errorInput':''}}">
                                    <small>Nömrə</small>

                                    <span class="error text-danger"> {{$errors->first('EducationEndDate')}}</span>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="Owner" class="col-form-label required">Reyester nömrəsi
                                </label>
                                <input type="email" class="form-control "
                                       name="Owner" value="" id="Owner">
                                <span class="error text-danger"> </span>
                            </div>
                            <div class="form-group ">
                                <label for="Owner" class="col-form-label required">Qeydiyyat nömrəsi
                                </label>
                                <input type="email" class="form-control "
                                       name="Owner" value="" id="Owner">
                                <span class="error text-danger"> </span>
                            </div>
                            <div class="form-group ">
                                <label for="Owner" class="col-form-label required">Qeydiyyat tarixi
                                </label>
                                <input type="date" class="form-control "
                                       name="Owner" value="" id="Owner">
                                <span class="error text-danger"> </span>
                            </div>
                        </div>
                    </div>


                    <div class="form-group required">
                        <input type="checkbox" class="bankGuarantee" data-target="bankGuaranteeDiv"/>Bank zəmanəti
                        <span class="error text-danger"> {{$errors->first('education_language')}}</span>
                    </div>


                    <div id="bankGuaranteeDiv">

                        <div class="form-group required">
                            <label for="deposit_object_id" class="col-form-label">Bank
                            </label>
                            {{ Form::select('deposit_object_id',\App\Bank::pluck('Name','Id')->toArray() ,null,['class'=>($errors->has('deposit_object_id'))?'errorInput form-control':'form-control','id'=>'deposit_object_id']) }}

                        </div>

                        <div class="form-row required">
                            <div class="form-group col-8">
                                <label for="education_fee" class="col-form-label">Məbləğ</label>
                                <input type="number"
                                       class="form-control col-4 {{$errors->has('education_fee')?'errorInput':''}}"
                                       value="{{old('education_fee')}}" name="bank_fee" id="education_fee">
                                <small>Məbləğ</small>
                            </div>
                            <div class="form-group col-4">
                                <label for="bank_currency" class="col-form-label">Məzənnə</label>
                                <select class="form-control" name="bank_currency" id="bank_currency">
                                    @foreach($currencies as $currency)
                                        <option value="{{$currency -> Id}}">{{ $currency -> Name}}</option>
                                    @endforeach
                                </select>
                                <small>Məzənnə</small>
                            </div>
                            <span class="error text-danger"> {{$errors->first('education_fee')}}</span>
                        </div>

                    </div>

                    <div class="form-group required">
                        <label for="achievements" class="col-form-label">Nəaliyyətləri</label>
                        <textarea class="form-control {{$errors->has('achievements')?'errorInput':''}}"
                                  name="achievements">{{old('achievements')}}</textarea>
                        <small>Bu məlumat CV-nizə əlavə ediləcəkdir və komissiya iclasında baxılması üçündür</small>
                        <span class="error text-danger"> {{$errors->first('achievements')}}</span>
                    </div>
                    <div class="form-group required">
                        <label for="about_family" class="col-form-label required">Ailəsi haqqında</label>
                        <textarea class="form-control {{$errors->has('about_family')?'errorInput':''}}"
                                  name="about_family">{{old('about_family')}}</textarea>
                        <small>Ailə üzvü, ad, soyad, təvəllüd, doğum yeri, iş yeri, vəzifəsi (Bu məlumat CV-nizə əlavə
                            ediləcəkdir və komissiya iclasında baxılması üçündür)</small>
                        <span class="error text-danger"> {{$errors->first('about_family')}}</span>


                    </div>

                    <input type="hidden" id="filename" value="{{old('filename')}}" name="filename">


                    <input type="hidden" id="dropzone_filezone" value="{{old('dropzone_filezone')}}"
                           name="dropzone_filezone">

                    <label for="exampleInputEmail1" class="col-form-label">Sənədinizi əlavə edin <a
                                class="btn btn-primary btn-xs" style="padding:0.05em 0.32rem;" href="#"
                                data-toggle="tooltip" rel="tooltip" data-placement="top"
                                title="Ümumi həcm 10MB-dan çox olmamalıdır."> ? </a></label>


                    <div class="form-group required">
                        <label for="Owner" class="col-form-label required">
                            Şəxsiyyət vəsiqəsinin surəti
                        </label>
                        <input type="file" class="form-control "
                               name="passport" value="" id="passport">
                        <span class="error text-danger"> </span>
                    </div>
                    <div class="form-group required">
                        <label for="Owner" class="col-form-label required">
                            Müvafiq xarici dili bilmə səviyyəsini təsdiq edən sənəd (TOEFL və ya IELTS sertifikatı)
                        </label>
                        <input type="file" class="form-control "
                               name="Owner" value="" id="Owner">
                        <span class="error text-danger"> </span>
                    </div>
                    <div class="form-group required">
                        <label for="Owner" class="col-form-label required">
                            Xarici universitetə qəbulu təsdiq edən rəsmi sənəd
                        </label>
                        <input type="file" class="form-control "
                               name="Owner" value="" id="Owner">
                        <span class="error text-danger"> </span>
                    </div>
                    <div class="form-group required">
                        <label for="Owner" class="col-form-label required">
                            Tərcümeyi-hal
                        </label>
                        <input type="file" class="form-control "
                               name="Owner" value="" id="Owner">
                        <span class="error text-danger"> </span>
                    </div>
                    <div class="form-group required">
                        <label for="Owner" class="col-form-label required">
                            Poliklinikadan 086 No-li tibbi arayış
                        </label>
                        <input type="file" class="form-control "
                               name="Owner" value="" id="Owner">
                        <span class="error text-danger"> </span>
                    </div>
                    <div class="form-group required">
                        <label for="Owner" class="col-form-label required">
                            Psixoloji dispanserdən arayış
                        </label>
                        <input type="file" class="form-control "
                               name="Owner" value="" id="Owner">
                        <span class="error text-danger"> </span>
                    </div>
                    <div class="form-group required">
                        <label for="Owner" class="col-form-label required">
                            Ali təhsil dövründə qiymətləri barədə rəsmi sənəd (transkript)
                        </label>
                        <input type="file" class="form-control "
                               name="Owner" value="" id="Owner">
                        <span class="error text-danger"> </span>
                    </div>
                    <div class="form-group required">
                        <label for="Owner" class="col-form-label required">
                            Girov qoyulacaq daşınmaz əmlak üzərində mülkiyyət hüququnu təsdiq edən dövlət reyestrindən
                            çıxarışın və həmin əmlakın texniki pasportunun surəti vəya Qarantiya
                        </label>
                        <input type="file" class="form-control "
                               name="Owner" value="" id="Owner">
                        <span class="error text-danger"> </span>
                    </div>
                    <div class="form-group required">
                        <label for="Owner" class="col-form-label required">
                            Birbaşa rəhbərindən müsbət xasiyyətnamə
                        </label>
                        <input type="file" class="form-control "
                               name="Owner" value="" id="Owner">
                        <span class="error text-danger"> </span>
                    </div>
                    <div class="form-group required">
                        <input type="checkbox" class="realEstate" data-target="realEstateDiv"/>
                        <span style="font-weight:bold;">
                        Daxil etdiyim məlumatların doğruluğuna zəmanət verirəm
                    </span>
                        <span class="error text-danger"> {{$errors->first('education_language')}}</span>
                    </div>


                    {{--                <div class="dropzone {{$errors->has('filename')?'errorInput':''}}" id="myDropzone">--}}
                    {{--                    <div class="dz-message" data-dz-message><span style="font-weight: bold"><i><u>.zip</u></i> və ya <i><u>.rar</u> </i>formatında olan sənədinizi dartıb bura atın və ya klik edib həmin sənədi seçin</span>--}}
                    {{--                    </div>--}}
                    {{--                </div>--}}
                    {{--                <small id="emailHelp" class="form-text text-muted"><i><b>Yalnız .rar və ya .zip formatında fayllar qəbul--}}
                    {{--                            olunur.</b></i></small>--}}
                    {{--                <span class="error text-danger"> {{$errors->first('filename')}}</span>--}}
                    <br><br>
                    <input value="Müraciət et" type="submit" class="btn btn-primary">
                </div>
            </div>
        </form>


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


            $('body').on('change', '.language_education_certificate_id', function () {
                let val = $('option:selected', this).text();
                if (val == "IELTS" || val == "TOEFL IBT") {
                    $(this).parents('.certificates').children().last().show()
                } else {
                    $(this).parents('.certificates').children().last().hide()
                }
            });

            $(".realEstate").change(function () {
                if (this.checked) {
                    $('#realEstateDiv *').prop('disabled', false);
                } else {
                    $('#realEstateDiv *').prop('disabled', true);
                }
            });

            $(".bankGuarantee").change(function () {
                if (this.checked) {
                    $('#bankGuaranteeDiv *').prop('disabled', false);
                } else {
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
            var wrapper = $('.certificates'); //Input field wrapper

            // var fieldHTML = '<div class="form-group row required" id="mobilePhones">' + $("#phones").html() + '<div class="col-1"><a href="javascript:void(0);" class="remove_button"><span class="fa fa-minus"></span></a></div></div>'; //New input field html
            var x = 1; //Initial field counter is 1
            var y = 1; //Initial email field counter is 1


            //Once add button is clicked
            $(addButton).click(function () {
                //Check maximum number of input fields
                var fieldHtml = ('<div id="certificates" class="certificates"> <div class="form-row required">\n' +
                    '                        <div class="form-group col-md-10 required">\n' +
                    '                            <label for="inputCity" class="col-form-label">Dil sertifikatı</label>\n' +
                    '                            {{ Form::select('language_education_certificate_id', [''=>'---------']+\App\Certificate::pluck('Name','Id')->toArray() ,null,['class'=>($errors->has('language_education_certificate_id'))?'errorInput form-control language_education_certificate_id':'form-control language_education_certificate_id','id'=>'language_education_certificate_id']) }}' +
                    '                            <span class="error text-danger"> {{$errors->first('language_education_certificate_id')}}</span>\n' +
                    '                        </div>                        <div class="form-group col-md-2 ">\n' +
                    '                            <label for="inputCity" class="col-form-label">&nbsp</label>\n' +
                    '                            <a href="javascript:void(0);" class="form-control remove_button btn btn-danger btn-sm"><span\n' +
                    '                                        class="fa fa-times"></span></a>\n' +
                    '                        </div>' +
                    '                    </div>' +
                    '                    <div class="form-group required languageLevel" style="display: none">\n' +
                    '                        <label for="" class="col-form-label">Dil bilmə səviyyəsi</label>\n' +
                    '                        <div class="form-row align-items-center">\n' +
                    '                            <div class="col-sm-3 ">\n' +
                    '                                <input type="number" step="any" min="0" id="" value="0"\n' +
                    '                                       name=""\n' +
                    '                                       class="form-control ">\n' +
                    '                                <small>oxuma</small>\n' +
                    '                                <span class="error text-danger"></span>\n' +
                    '                            </div>\n' +
                    '\n' +
                    '                            <div class="col-sm-3 ">\n' +
                    '                                <input type="number" sstep="any" min="0" id="" value="0"\n' +
                    '                                       name=""\n' +
                    '                                       class="form-control">\n' +
                    '                                <small>yazma</small>\n' +
                    '                                <span class="error text-danger"> </span>\n' +
                    '                            </div>\n' +
                    '\n' +
                    '                            <div class="col-sm-3 ">\n' +
                    '                                <input type="number" sstep="any" min="0" id="" value="0"\n' +
                    '                                       name=""\n' +
                    '                                       class="form-control ">\n' +
                    '                                <small>danışıq</small>\n' +
                    '                                <span class="error text-danger"></span>\n' +
                    '                            </div>\n' +
                    '\n' +
                    '                            <div class="col-sm-3 ">\n' +
                    '                                <input type="number" step="any" min="0" id="" value="0"\n' +
                    '                                       name=""\n' +
                    '                                       class="form-control">\n' +
                    '                                <small>dinləmə</small>\n' +
                    '                                <span class="error text-danger"></span>\n' +
                    '                            </div>\n' +
                    '\n' +
                    '                        </div>\n' +
                    '                    </div></div> ' +
                    '                            ' +
                    '                                ');
                x++; //Increment field counter
                $(wrapper).after(fieldHtml); //Add field html\


            });
            //Once remove button is clicked
            $('body').on('click', '.remove_button', function (e) {
                e.preventDefault();
                $(this).parents('.certificates').remove(); //Remove field html
                x--; //Decrement field counter
            });

            // $( "#specialty_id" ).change(function() {
            $(document).on('change', '#specialty_id', function () {
                $('select[id="country_id"]').empty()
                $.ajax({

                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{url('rel_specialization')}}",
                    data: {specialty_id: $('select[name="specialty_id"]').val()},
                    cache: true,
                    success:
                        function (data) {
                        var limit = 0;

                        if(data.count < 2)
                        {
                            $('#specialty_name').show();
                            $('.specialization_select').remove();
                            $.each(data.universitiesWithCountry.universities, function (key, value) {

                                if(limit != value.country.Id ){
                                $('select[id="country_id"]').append('<option value="' + value.country.Id + '">' + value.country.Name + '</option>');
                                }
                                limit = value.country.Id;

                            });
                            setTimeout(function () {
                                $('#country_id').trigger('change');
                            }, 1000);

                        }else{

                           $('.specialization_div').append(data.specializations_select)
                            $('#specialty_name').hide();

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
                        specialty_id: $('select[name="specialty_id"]').val()  ? $('select[name="specialty_id"]').val() : null ,
                        specialization_id: $('select[name="specialization"]').val() ? $('select[name="specialization"]').val() : null
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

                                if(limit !=value.country.Id ){

                                $('select[id="country_id"]').append('<option value="' + value.country.Id + '">' + value.country.Name + '</option>');
                                }
                                limit = value.country.Id;

                            });

                            setTimeout(function () {
                                $('#country_id').trigger('change');
                            }, 1000);

                        }
                });
            });





            $("#specialty_id").trigger('change');
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

                    console.log("success");


                },
                error: function (data) {
                    console.log("error");
                    // console.log(data);
                }
            });


        });

    </script>
@endsection