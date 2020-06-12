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
@endsection

@section('mainSection')

    <div class="container">
        <hr>

        <h3 style="text-align: center;">Xarici təqaüd proqramına müraciət</h3>
        <hr>
        {{Form::open(['url'=>'apply/external/scholarship/'.Request::segment(4),'class'=>'form-horizontal'])}}
        <input type="hidden" name="program_id" value="{{Request::segment(4)}}">
        <div class="row">
            <div class="col-md-10 " style="margin:0 auto;">
                <div class="form-group required">


                    <label for="specialty_id" class="col-form-label">İxtisas qrupu</label><br>
                    {{ Form::select('specialty_id', [''=>'---------']+\App\ExternalProgramApplicationSpecialities::pluck('Name','id')->toArray() ,null,['class'=>($errors->has('specialty_id'))?'errorInput form-control':'form-control']) }}
                    <span class="error text-danger"> {{$errors->first('specialty_id')}}</span>


                </div>

                <div class="form-group required">
                    <label for="specialty_name" class="col-form-label">İxtisas</label>
                    <input type="text" class="form-control {{$errors->has('specialty_name')?'errorInput':''}}"
                           name="specialty_name" value="{{old('specialty_name')}}">
                    <span class="error text-danger"> {{$errors->first('specialty_name')}}</span>

                </div>


                <div class="form-group required">
                    <label for="country_id" class="col-form-label">Ölkə</label>
                    {{ Form::select('country_id', [''=>'---------']+\App\Country::pluck('Name','id')->toArray() ,null,['class'=>($errors->has('country_id'))?'errorInput form-control':'form-control','id'=>'category_id','onchange'=>'related_city()']) }}
                    <span class="error text-danger"> {{$errors->first('country_id')}}</span>
                </div>
                <div class="form-group required">
                    <label for="city_name" class="col-form-label">Şəhər</label>
                    <input type="text" class="form-control {{$errors->has('city_name')?'errorInput':''}}"
                           value="{{old('city_name')}}" name="city_name" id="city_name">
                    <span class="error text-danger"> {{$errors->first('city_name')}}</span>
                </div>
                <div class="form-group required">

                    <label for="category_id" class="col-form-label">Təhsil müəssisəsi</label>
                    <div id="related_city">


                        @if(old('university_id')!=null)
                            {{ Form::select('university_id', \App\University::where('country_id',old('country_id'))->pluck('Name','id')->toArray() ,null,['class'=>'form-control','id'=>'university_id']) }}

                        @else

                            {{ Form::select('university_id', [''=>'---------'],null,['class'=>($errors->has('university_id'))?'errorInput form-control':'form-control','id'=>'category_id']) }}
                            <span class="error text-danger"> {{$errors->first('university_id')}}</span>
                            <small id="emailHelp" class="form-text text-muted"><i><b>İlk öncə ölkə seçilməlidir.</b></i></small>
                        @endif


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
                        <label for="education_fee" class="col-form-label">Məzənnə</label>
                        <select class="form-control" name="" id="">
                            <option value="">AZN</option>
                            <option value="">EUR</option>
                            <option value="">DOL</option>
                        </select>
                    </div>
                    <span class="error text-danger"> {{$errors->first('education_fee')}}</span>
                </div>

                <div class="certificates">
                    <div class="form-row required test">
                        <div class="form-group col-md-12 required">
                            <label for="inputCity" class="col-form-label">Dil sertifikatı</label>
                            {{ Form::select('language_education_certificate_id', [''=>'---------']+\App\LanguageEducationCertificate::pluck('Name','id')->toArray() ,null,['class'=>($errors->has('language_education_certificate_id'))?'errorInput form-control language_education_certificate_id':'form-control language_education_certificate_id','id'=>'language_education_certificate_id']) }}
                            <span class="error text-danger"> {{$errors->first('language_education_certificate_id')}}</span>
                        </div>
                    </div>
                    <div class="form-group required languageLevel" style="display: none">
                        <label for="" class="col-form-label">Dil bilmə səviyyəsi</label>
                        <div class="form-row align-items-center">
                            <div class="col-sm-3 ">
                                <input type="text" value=""
                                       name=""
                                       class="form-control ">
                                <small>oxuma</small>
                                <span class="error text-danger"></span>
                            </div>

                            <div class="col-sm-3 ">
                                <input type="text" id="" value=""
                                       name=""
                                       class="form-control">
                                <small>yazma</small>
                                <span class="error text-danger"> </span>
                            </div>

                            <div class="col-sm-3 ">
                                <input type="text" value=""
                                       name=""
                                       class="form-control ">
                                <small>danışıq</small>
                                <span class="error text-danger"></span>
                            </div>

                            <div class="col-sm-3 ">
                                <input type="text" id="" value=""
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
                    <input type="checkbox" class="realEstate" data-target="realEstateDiv" />Daşınmaz əmlak
                    <span class="error text-danger"> {{$errors->first('education_language')}}</span>
                </div>



                <div id="realEstateDiv">

                <div class="form-group required">
                    <label for="deposit_object_id" class="col-form-label">Girov predmeti
                    </label>
                    {{ Form::select('deposit_object_id', [''=>'---------']+\App\DepositObject::pluck('Name','id')->toArray() ,null,['class'=>($errors->has('deposit_object_id'))?'errorInput form-control':'form-control','id'=>'deposit_object_id']) }}

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


                </div>


                <div class="form-group required">
                    <label for="work_experience_details" class="col-form-label">İş təcrübəsi</label>
                    <textarea class="form-control {{$errors->has('work_experience_details')?'errorInput':''}}"
                              name="work_experience_details">{{old('work_experience_details')}}</textarea>
                    <span class="error text-danger"> {{$errors->first('work_experience_details')}}</span>
                    <small id="work_experience_details" class="form-text text-muted"><i><b>Müəssisə, vəzifə və
                                müddət.</b></i></small>

                </div>
                <div class="form-group required">
                    <label for="achievements" class="col-form-label">Nəaliyyətləri</label>
                    <textarea class="form-control {{$errors->has('achievements')?'errorInput':''}}"
                              name="achievements">{{old('achievements')}}</textarea>
                    <span class="error text-danger"> {{$errors->first('achievements')}}</span>
                </div>
                <div class="form-group required">
                    <label for="about_family" class="col-form-label required">Ailəsi haqqında</label>
                    <textarea class="form-control {{$errors->has('about_family')?'errorInput':''}}"
                              name="about_family">{{old('about_family')}}</textarea>
                    <span class="error text-danger"> {{$errors->first('about_family')}}</span>
                    <small id="emailHelp" class="form-text text-muted"><i><b>Ailə üzvü, ad, soyad, təvəllüd, doğum yeri,
                                iş yeri, vəzifəsi</b></i></small>

                </div>

                <input type="hidden" id="filename" value="{{old('filename')}}" name="filename">


                <input type="hidden" id="dropzone_filezone" value="{{old('dropzone_filezone')}}"
                       name="dropzone_filezone">

                <label for="exampleInputEmail1" class="col-form-label">Sənədinizi əlavə edin <a
                            class="btn btn-primary btn-xs" style="padding:0.05em 0.32rem;" href="#"
                            data-toggle="tooltip" rel="tooltip" data-placement="top"
                            title="Ümumi həcm 10MB-dan çox olmamalıdır."> ? </a></label>
                <div class="dropzone {{$errors->has('filename')?'errorInput':''}}" id="myDropzone">
                    <div class="dz-message" data-dz-message><span style="font-weight: bold"><i><u>.zip</u></i> və ya <i><u>.rar</u> </i>formatında olan sənədinizi dartıb bura atın və ya klik edib həmin sənədi seçin</span>
                    </div>
                </div>
                <small id="emailHelp" class="form-text text-muted"><i><b>Yalnız .rar və ya .zip formatında fayllar qəbul
                            olunur.</b></i></small>
                <span class="error text-danger"> {{$errors->first('filename')}}</span>
                <br><br>
                <button type="submit" class="btn btn-primary">Müraciət et</button>
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



    @include('frontend.profile.apply.dropzone', ['folder' => 'external'])


    <script>
        $('#realEstateDiv *').prop('disabled', true);



        $('body').on('change', '.language_education_certificate_id', function () {
            let val = $('option:selected', this).text();
            if (val == "IELTS" || val == "TOEFL IBT") {
                $(this).parents('.certificates').children().last().show()
            } else {
                $(this).parents('.certificates').children().last().hide()
            }
        });

        $(".realEstate").change(function() {
            if(this.checked) {
                $('#realEstateDiv *').prop('disabled', false);
            }else{
                $('#realEstateDiv *').prop('disabled', true);
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
                '                            {{ Form::select('language_education_certificate_id', [''=>'---------']+\App\LanguageEducationCertificate::pluck('Name','id')->toArray() ,null,['class'=>($errors->has('language_education_certificate_id'))?'errorInput form-control language_education_certificate_id':'form-control language_education_certificate_id','id'=>'language_education_certificate_id']) }}' +
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
                '                                <input type="text" value=""\n' +
                '                                       name=""\n' +
                '                                       class="form-control ">\n' +
                '                                <small>oxuma</small>\n' +
                '                                <span class="error text-danger"></span>\n' +
                '                            </div>\n' +
                '\n' +
                '                            <div class="col-sm-3 ">\n' +
                '                                <input type="text" id="" value=""\n' +
                '                                       name=""\n' +
                '                                       class="form-control">\n' +
                '                                <small>yazma</small>\n' +
                '                                <span class="error text-danger"> </span>\n' +
                '                            </div>\n' +
                '\n' +
                '                            <div class="col-sm-3 ">\n' +
                '                                <input type="text" value=""\n' +
                '                                       name=""\n' +
                '                                       class="form-control ">\n' +
                '                                <small>danışıq</small>\n' +
                '                                <span class="error text-danger"></span>\n' +
                '                            </div>\n' +
                '\n' +
                '                            <div class="col-sm-3 ">\n' +
                '                                <input type="text" id="" value=""\n' +
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
            $(wrapper).after(fieldHtml); //Add field html
        });
        //Once remove button is clicked
        $('body').on('click', '.remove_button', function (e) {
            e.preventDefault();
            $(this).parents('.certificates').remove(); //Remove field html
            x--; //Decrement field counter
        });


    </script>
@endsection