@extends('layouts.app')
<style type="text/css">
    .error {
        font-weight: bold;
        font-size: 11px;
    }

    .errorInput {
        background-color: #ffffcc;
        border-color: transparent;
        border: 1px solid #dc3545;
        padding-top: 8px;
        padding-left: 5px;
    }
</style>


@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip({'placement': 'right'});

            $('input:radio[name="HasScholarshipFromOtherCompany"]').change(
                function () {
                    if ($(this).val() == 0) {
                        alert('Təqaüd aldığınıza görə təəssüf ki müraciət edə bilməzsiniz!');
                        $('#apply').hide()

                    }
                    else {
                        $('#apply').show()
                    }
                });


        });
    </script>

    <script src="{{asset('js/dropzone.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/dropzone.css')}}">

    <style type="text/css">
        .error {
            font-weight: bold;
            font-size: 11px;
        }

        .errorInput {
            background-color: #fff07f;
            border-color: transparent;
            border: 1px solid #dc3545;
        }

        .required-asterisk {
            color: red;
        }
    </style>


@endsection




@section('mainSection')

    <div class="container">
        <hr>
        <h3 style="text-align: center;">Daxili təqaüd proqramına müraciət</h3>
        <hr>
        {{Form::open(['url'=>'apply/internal/scholarship/'.Request::segment(4),'class'=>'form-horizontal'])}}
        <div class="row">
            <div class="col-md-10 " style="margin:0 auto;">
                <div class="form-group">
                    <input type="hidden" name="program_id" value="{{Request::segment(4)}}">


                    <label for="exampleInputPassword1">Digər kommersiya təşkilatından təqaüd alırsınızmı? <span
                                class="required-asterisk"> *</span></label><br>
                    <div class="{{$errors->has('HasScholarshipFromOtherCompany')?'errorInput':''}}"><label
                                class="radio-inline">
                            {{ Form::radio('HasScholarshipFromOtherCompany', '0' , false) }}
                            Bəli
                        </label>
                        <label class="radio-inline">
                            {{ Form::radio('HasScholarshipFromOtherCompany', '1' , true) }} Xeyr
                        </label></div>

                    <span class="error text-danger"> {{$errors->first('HasScholarshipFromOtherCompany')}}</span>


                </div>
                <div id='apply'>
                    <input type="hidden" id="filename" value="{{old('filename')}}" name="filename">


                    <input type="hidden" id="dropzone_filezone" value="{{old('dropzone_filezone')}}"
                           name="dropzone_filezone">


                    <div class="form-group documentadd">
                        <label for="exampleInputEmail1">Sənədinizi əlavə edin <a class="btn btn-primary btn-xs"
                                                                                 style="padding:0.05em 0.32rem;"
                                                                                 href="#" data-toggle="tooltip"
                                                                                 rel="tooltip" data-placement="top"
                                                                                 title="Ümumi həcm 10MB-dan çox olmamalıdır.">
                                ? </a> <span class="required-asterisk"> *</span></label>
                        <div class="dropzone {{$errors->has('filename')?'errorInput':''}}" id="myDropzone">
                            <div class="dz-message" data-dz-message>
                                <span style="font-weight: bold">
                                    <p class="text-left">
                                    Sənədinizi dartıb bura atın və ya klik edib həmin sənədi seçin.
                                    <br>
                                    Aşağıdakı sənədləri bir fayl şəklində (<i><u>.zip</u></i> və ya <i><u>.rar</u> </i>) yükləməyiniz tələb olunur:
                                    <br>
                                    <ul class="text-left">
                                        <li>Şəxsiyyət vəsiqəsi (hər iki üzü)</li>
                                        <li>Tələbə bileti</li>
                                        <li>Rəsmi transkript (möhürlü və imzalı).</li>
                                    </ul>
                                    </p>
                                </span>
                            </div>
                        </div>
                        <span class="error text-danger"> {{$errors->first('filename')}}</span>
                    </div>


                    <button type="submit" class="btn btn-primary">Müraciət et</button>

                </div>


            </div>
        </div>
        </form>
    </div>
    <br>
    <br>

@endsection

@section('bottom')
    @include('frontend.profile.apply.dropzone', ['folder' => 'internal'])

@endsection