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
                               data-required-error='İxtisaslaşma sahəsini boş burxamayın'
                               type="text" class="form-control {{$errors->has('specialization_name')?'errorInput':''}}"
                               name="specialization_name" value="{{old('specialization_name')}}">
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
                               value="{{old('city_name')}}" name="city_name" id="city_name">
                        <span class="error text-danger"> {{$errors->first('city_name')}}</span>
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


                    <div class="form-group required">
                        <label for="main_modules" class="col-form-label">Əsas modullar</label>
                        <textarea class="form-control {{$errors->has('main_modules')?'errorInput':''}}"
                                  name="main_modules">{{old('main_modules')}}</textarea>
                        <span class="error text-danger"> {{$errors->first('main_modules')}}</span>
                    </div>

                    <div class="form-group required">
                        <label for="additional_modules" class="col-form-label">Əlavə (seçmə) modullar</label>
                        <textarea class="form-control {{$errors->has('additional_modules')?'errorInput':''}}"
                                  name="additional_modules">{{old('additional_modules')}}</textarea>
                        <span class="error text-danger"> {{$errors->first('additional_modules')}}</span>
                    </div>


                    <div class="form-group required">
                        <label for="exampleInputEmail1" class="col-form-label">Təhsil müddəti</label>
                        <div class="form-row align-items-center">

                            <div class="col-sm-6 my-1">
                                <label class="sr-only col-form-label" for="EducationBeginDate">Başlama tarixi</label>
                                <input type="number" value="{{old('EducationBeginDate')}}"
                                       name="EducationBeginDate"
                                       class="form-control  {{$errors->has('EducationBeginDate')?'errorInput':''}}">
                                <span class="error text-danger"> {{$errors->first('EducationBeginDate')}}</span>
                            </div>
                            <div class="col-sm-6 my-1">
                                <label class="sr-only" for="EducationEndDate">Bitmə tarixi</label>
                                <input type="number"  value="{{old('EducationEndDate')}}"
                                       name="EducationEndDate"
                                       class="form-control {{$errors->has('EducationEndDate')?'errorInput':''}}">

                                <span class="error text-danger"> {{$errors->first('EducationEndDate')}}</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group required">
                        <label for="education_start_date" class="col-form-label">Təhsilin başlama tarixi</label>
                        <input type="text" value="{{old('education_start_date')}}" id="datepicker3"
                               name="education_start_date"
                               class="form-control  {{$errors->has('education_start_date')?'errorInput':''}}">
                        <span class="error text-danger"> {{$errors->first('education_start_date')}}</span>
                    </div>

                    <div class="form-row required">
                        <div class="form-group col-8">
                            <label for="education_fee[amount]" class="col-form-label">Təhsil haqqı</label>
                            <input type="number"
                                   class="form-control col-4 {{$errors->has('education_fee[amount]')?'errorInput':''}}"
                                   value="{{old('education_fee[amount]')}}" name="education_fee[amount]"
                                   id="education_fee">
                        </div>
                        <div class="form-group col-4">
                            <label for="education_fee[currency]" class="col-form-label">Məzənnə</label>
                            <select class="form-control" name="education_fee[currency]" id="education_fee_currency">
                                @foreach($currencies as $currency)
                                    <option value="{{$currency -> Id}}">{{ $currency -> Name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <span class="error text-danger"> {{$errors->first('education_fee')}}</span>
                    </div>

                    <div class="certificates" id="certificates">
                        <div class="form-row required test">
                            <div class="form-group col-12 required">
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
                                <span class="error text-danger"> {{$errors->first('language_education_certificate_id')}}</span>
                            </div>

                        </div>
                        <div class="form-group required languageLevel" style="display: none">
                            <label for="" class="col-form-label">Dil bilmə səviyyəsi</label>
                            <div class="form-row align-items-center">
                                <div class="col-sm-3 ">
                                    <input type="number" step="any" min="0" id="" value="0"
                                           name="language_education_certificate_id[0][reading]"
                                           onkeydown=""
                                           class="form-control ">
                                    <small>oxuma</small>
                                    <span class="error text-danger"></span>
                                </div>

                                <div class="col-sm-3 ">
                                    <input type="number" step="any" min="0" id="" value="0"
                                           id=""
                                           name="language_education_certificate_id[0][writing]"
                                           class="form-control">
                                    <small>yazma</small>
                                    <span class="error text-danger"> </span>
                                </div>

                                <div class="col-sm-3 ">
                                    <input type="number" step="any" min="0" id="" value="0"
                                           name="language_education_certificate_id[0][speaking]"
                                           class="form-control ">
                                    <small>danışıq</small>
                                    <span class="error text-danger"></span>
                                </div>

                                <div class="col-sm-3 ">
                                    <input type="number" step="any" min="0" id="" value="0"
                                           id=""
                                           name="language_education_certificate_id[0][listening]"
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
                        <input name="realEstate" type="checkbox" class="realEstate" data-target="realEstateDiv"/>Daşınmaz
                        əmlak
                        <span class="error text-danger"> {{$errors->first('education_language')}}</span>
                    </div>


                    <div id="realEstateDiv">

                        <div class="form-group required">
                            <label for="deposit_object_id" class="col-form-label">Girov predmeti
                            </label>
                            {{ Form::select('realEstate_deposit_object_id', [''=>'---------']+\App\Deposit::pluck('Name','id')->toArray() ,null,['class'=>($errors->has('realEstate_deposit_object_id'))?'errorInput form-control':'form-control','id'=>'realEstate_deposit_object_id']) }}

                        </div>


                        <div class="form-group required">
                            <label for="realEstate_located_city" class="col-form-label required">Ünvan
                            </label>
                            <input type="text"
                                   class="form-control {{$errors->has('realEstate_located_city')?'errorInput':''}}"
                                   name="realEstate_located_city" value="{{old('realEstate_located_city')}}"
                                   id="realEstate_located_city">
                            <span class="error text-danger"> {{$errors->first('realEstate_located_city')}}</span>
                        </div>

                        <div class="form-group required">
                            <label for="realEstate_owner" class="col-form-label required">Mülkiyyətçi
                            </label>
                            <input type="text" class="form-control "
                                   name="realEstate_owner" value="" id="realEstate_owner">
                            <span class="error text-danger"> </span>
                        </div>

                        <div class="form-group required">
                            <label for="realEstate_owner_contact" class="col-form-label required">Mülkiyyətçinin əlaqə
                                nömrəsi
                            </label>
                            <input type="text" class="form-control "
                                   name="realEstate_owner_contact" value="" id="realEstate_owner_contact">
                            <span class="error text-danger"> </span>
                        </div>

                        <div class="form-group ">
                            <label for="realEstate_owner_email" class="col-form-label required">Mülkiyyətçinin poçt
                                ünvanı
                            </label>
                            <input type="email" class="form-control "
                                   name="realEstate_owner_email" value="" id="realEstate_owner_email">
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
                                           class="form-control  {{$errors->has('realEstateSNO[serial]')?'errorInput':''}}">
                                    <small>Seria</small>
                                    <span class="error text-danger"> {{$errors->first('realEstateSNO[serial]')}}</span>
                                </div>
                                <div class="col-sm-9     my-1">
                                    <input type="text" value="{{old('realEstateSNO[number]')}}"
                                           name="realEstateSNO[number]"
                                           class="form-control {{$errors->has('realEstateSNO[number]')?'errorInput':''}}">
                                    <small>Nömrə</small>

                                    <span class="error text-danger"> {{$errors->first('EducationEndDate')}}</span>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="realEstate_reyester" class="col-form-label required">Reyester nömrəsi
                                </label>
                                <input type="text" class="form-control "
                                       name="realEstate_reyester" value="" id="realEstate_reyester">
                                <span class="error text-danger"> </span>
                            </div>
                            <div class="form-group ">
                                <label for="realEstate_registry" class="col-form-label required">Qeydiyyat nömrəsi
                                </label>
                                <input type="text" class="form-control "
                                       name="realEstate_registry" value="" id="realEstate_registry">
                                <span class="error text-danger"> </span>
                            </div>
                            <div class="form-group ">
                                <label for="realEstate_registry_date" class="col-form-label required">Qeydiyyat tarixi
                                </label>
                                <input type="date" class="form-control "
                                       name="realEstate_registry_date" value="" id="realEstate_registry_date">
                                <span class="error text-danger"> </span>
                            </div>
                        </div>
                    </div>


                    <div class="form-group required">
                        <input type="checkbox" class="bankGuarantee" name="bank_guarantee"
                               data-target="bankGuaranteeDiv" id="bank_guarantee"/>Bank zəmanəti
                        <span class="error text-danger"> {{$errors->first('education_language')}}</span>
                    </div>


                    <div id="bankGuaranteeDiv">

                        <div class="form-group required">
                            <label for="bank_id" class="col-form-label">Bank
                            </label>
                            {{ Form::select('bank_id',\App\Bank::pluck('Name','Id')->toArray() ,null,['class'=>($errors->has('bank_id'))?'errorInput form-control':'form-control','id'=>'bank_id']) }}

                        </div>

                        <div class="form-row required">
                            <div class="form-group col-8">
                                <label for="bank_fee[amount]" class="col-form-label">Məbləğ</label>
                                <input type="number"
                                       class="form-control col-4 {{$errors->has('bank_fee[amount]')?'errorInput':''}}"
                                       value="{{old('bank_fee[amount]')}}" name="bank_fee[amount]" id="bank_fee">
                                <small>Məbləğ</small>
                            </div>
                            <div class="form-group col-4">
                                <label for="bank_fee[currency]" class="col-form-label">Məzənnə</label>
                                <select class="form-control" name="bank_fee[currency]" id="bank_fee[currency]">
                                    @foreach($currencies as $currency)
                                        <option value="{{$currency -> Id}}">{{ $currency -> Name}}</option>
                                    @endforeach
                                </select>
                                <small>Məzənnə</small>
                            </div>
                            <span class="error text-danger"> {{$errors->first('bank_fee[currency]')}}</span>
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


                    {{--                    <input type="hidden" id="dropzone_filezone" value="{{old('dropzone_filezone')}}"--}}
                    {{--                           name="dropzone_filezone">--}}

                    <label for="exampleInputEmail1" class="col-form-label">Sənədinizi əlavə edin <a
                                class="btn btn-primary btn-xs" style="padding:0.05em 0.32rem;" href="#"
                                data-toggle="tooltip" rel="tooltip" data-placement="top"
                                title="Ümumi həcm 10MB-dan çox olmamalıdır."> ? </a></label>


                    <div class="form-group required">
                        <label for="passport_copy" class="col-form-label required">
                            Şəxsiyyət vəsiqəsinin surəti
                        </label>
                        <input type="file" class="form-control "
                               name="passport_copy" value="" id="passport_copy">
                        <span class="error text-danger"> </span>
                    </div>
                    <div class="form-group required">
                        <label for="certificate_document" class="col-form-label required">
                            Müvafiq xarici dili bilmə səviyyəsini təsdiq edən sənəd (TOEFL və ya IELTS sertifikatı)
                        </label>
                        <input type="file" class="form-control "
                               name="certificate_document" value="" id="certificate_document">
                        <span class="error text-danger"> </span>
                    </div>
                    <div class="form-group required">
                        <label for="university_document" class="col-form-label required">
                            Xarici universitetə qəbulu təsdiq edən rəsmi sənəd
                        </label>
                        <input type="file" class="form-control "
                               name="university_document" value="" id="university_document">
                        <span class="error text-danger"> </span>
                    </div>
                    <div class="form-group required">
                        <label for="biography" class="col-form-label required">
                            Tərcümeyi-hal
                        </label>
                        <input type="file" class="form-control "
                               name="biography" value="" id="biography">
                        <span class="error text-danger"> </span>
                    </div>
                    <div class="form-group required">
                        <label for="medical_certificate" class="col-form-label required">
                            Poliklinikadan 086 No-li tibbi arayış
                        </label>
                        <input type="file" class="form-control "
                               name="medical_certificate" value="" id="medical_certificate">
                        <span class="error text-danger"> </span>
                    </div>
                    <div class="form-group required">
                        <label for="psychological_dispensary" class="col-form-label required">
                            Psixoloji dispanserdən arayış
                        </label>
                        <input type="file" class="form-control "
                               name="psychological_dispensary" value="" id="psychological_dispensary">
                        <span class="error text-danger"> </span>
                    </div>
                    <div class="form-group required">
                        <label for="academic_transcript" class="col-form-label required">
                            Ali təhsil dövründə qiymətləri barədə rəsmi sənəd (transkript)
                        </label>
                        <input type="file" class="form-control "
                               name="academic_transcript" value="" id="academic_transcript">
                        <span class="error text-danger"> </span>
                    </div>
                    <div class="form-group required">
                        <label for="realEstate_document" class="col-form-label required">
                            Girov qoyulacaq daşınmaz əmlak üzərində mülkiyyət hüququnu təsdiq edən dövlət reyestrindən
                            çıxarışın və həmin əmlakın texniki pasportunun surəti vəya Qarantiya
                        </label>
                        <input type="file" class="form-control "
                               name="realEstate_document" value="" id="realEstate_document">
                        <span class="error text-danger"> </span>
                    </div>
                    <div class="form-group required">
                        <label for="testimonial" class="col-form-label required">
                            Birbaşa rəhbərindən müsbət xasiyyətnamə
                        </label>
                        <input type="file" class="form-control "
                               name="testimonial" value="" id="testimonial">
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
                    <input value="Müraciət et" type="submit" class="btn btn-primary">
                </div>
            </div>
        </form>

        <div class="modal fade" id="bsModal3" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
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


            $('body').on('change', '.language_education_certificate_id', function () {
                let val = $('option:selected', this).text();
                console.log(val);
                if (val == "IELTS" || val == "TOEFL IBT") {
                    $(this).parents('.certificates').children().last().show()
                } else {
                    $(this).parents('.certificates').children().last().hide()
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
            var wrapper = $('#certificates'); //Input field wrapper

            // var fieldHTML = '<div class="form-group row required" id="mobilePhones">' + $("#phones").html() + '<div class="col-1"><a href="javascript:void(0);" class="remove_button"><span class="fa fa-minus"></span></a></div></div>'; //New input field html
            var x = 1; //Initial field counter is 1
            var y = 1; //Initial email field counter is 1


            //Once add button is clicked
            $(addButton).click(function () {
                //Check maximum number of input fields
                var fieldHtml = ("  <div class=\"certificates\" id=\"certificates\">\n" +
                    "                        <div class=\"form-row required test\">\n" +
                    "                            <div class=\"form-group col-12 required\">\n" +
                    "                                <label for=\"inputCity\" class=\"col-form-label\">Dil sertifikatı</label>\n" +
                    "                                <div class=\"d-flex\">\n" +
                    "                                <select name=\"language_education_certificate_id["+x+"][certificate]\" id=\"\"\n" +
                    "                                        class=\"form-control language_education_certificate_id {{($errors->has('language_education_certificate_id'))? 'errorInput' : ''}} \"\n" +
                    "                                        id=\"language_education_certificate_id\">\n" +
                    "                                    @foreach($certificates as $certificate)\n" +
                    "                                        <option value=\"{{$certificate -> Id}}\">{{$certificate -> Name}}</option>\n" +
                    "                                    @endforeach\n" +
                    "                                </select>\n" +
                    "                                    <input type=\"button\" class=\"btn btn-danger remove_button\" value=\"Sil\" />\n" +
                    "                                </div>\n" +
                    "\n" +
                    "                                <span class=\"error text-danger\"> {{$errors->first('language_education_certificate_id')}}</span>\n" +
                    "                            </div>\n" +
                    "\n" +
                    "                        </div>\n" +
                    "                        <div class=\"form-group required languageLevel\" style=\"display: none\">\n" +
                    "                            <label for=\"\" class=\"col-form-label\">Dil bilmə səviyyəsi</label>\n" +
                    "                            <div class=\"form-row align-items-center\">\n" +
                    "                                <div class=\"col-sm-3 \">\n" +
                    "                                    <input type=\"number\" step=\"any\" min=\"0\" id=\"\" value=\"0\"\n" +
                    "                                           name=\"language_education_certificate_id["+x+"][reading]\"\n" +
                    "                                           onkeydown=\"\"\n" +
                    "                                           class=\"form-control \">\n" +
                    "                                    <small>oxuma</small>\n" +
                    "                                    <span class=\"error text-danger\"></span>\n" +
                    "                                </div>\n" +
                    "\n" +
                    "                                <div class=\"col-sm-3 \">\n" +
                    "                                    <input type=\"number\" step=\"any\" min=\"0\" id=\"\" value=\"0\"\n" +
                    "                                           id=\"\"\n" +
                    "                                           name=\"language_education_certificate_id["+x+"][writing]\"\n" +
                    "                                           class=\"form-control\">\n" +
                    "                                    <small>yazma</small>\n" +
                    "                                    <span class=\"error text-danger\"> </span>\n" +
                    "                                </div>\n" +
                    "\n" +
                    "                                <div class=\"col-sm-3 \">\n" +
                    "                                    <input type=\"number\" step=\"any\" min=\"0\" id=\"\" value=\"0\"\n" +
                    "                                           name=\"language_education_certificate_id["+x+"][speaking]\"\n" +
                    "                                           class=\"form-control \">\n" +
                    "                                    <small>danışıq</small>\n" +
                    "                                    <span class=\"error text-danger\"></span>\n" +
                    "                                </div>\n" +
                    "\n" +
                    "                                <div class=\"col-sm-3 \">\n" +
                    "                                    <input type=\"number\" step=\"any\" min=\"0\" id=\"\" value=\"0\"\n" +
                    "                                           id=\"\"\n" +
                    "                                           name=\"language_education_certificate_id["+x+"][listening]\"\n" +
                    "                                           class=\"form-control\">\n" +
                    "                                    <small>dinləmə</small>\n" +
                    "                                    <span class=\"error text-danger\"></span>\n" +
                    "                                </div>\n" +
                    "\n" +
                    "                            </div>\n" +
                    "                        </div>\n" +
                    "\n" +
                    "\n" +
                    "                    </div>");
                $('body').find('.certificates:last').after(fieldHtml); //Add field html\

                x++; //Increment field counter


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
                                $('#specialization_name').show();
                                $('.specialization_select').remove();
                                $.each(data.universitiesWithCountry.universities, function (key, value) {

                                    if (limit != value.country.Id) {
                                        $('select[id="country_id"]').append('<option value="' + value.country.Id + '">' + value.country.Name + '</option>');
                                    }
                                    limit = value.country.Id;

                                });
                                setTimeout(function () {
                                    $('#country_id').trigger('change');
                                }, 1000);

                            } else {

                                $('.specialization_div').append(data.specializations_select)
                                $('#specialization_name').hide();

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
                        specialization_id: $('select[name="specialization"]').val()
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
                            }, 1000);

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

                    if(data.status=="success")
                    {
                    $("#bsModal3").modal('show');
                    setTimeout(function () {
                        window.location.href = '{{ url('/') }}';
                    }, 2000);
                    }
                },
                error: function (data) {
                    console.log("error");
                    // console.log(data);
                }
            });


        });


    </script>
@endsection