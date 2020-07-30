@extends('layouts.app')
@section('head')
    <style>
        .dpic .datepicker-days td:not(.disabled) {
            background-color: #007bff;
            color: white;
        }
    </style>
@endsection
@section('mainSection')
    <section class="slider-section">
        <header>
            <H3>{{ $page->Name }}</H3>
        </header>
        @include('frontend.components.slider')
    </section> {{--slider-section--}}

    <section>
        <div class="row">
            <div class="col-12 col-md-8">


                <ol class="breadcrumb">

                    <a href="{{url('/')}}">Xarici təqaüd proqramı</a>
                    <li>
                        >><a href="javascript:void(0)" style="color: #6f42c1">Xəbər arxivi</a>
                    </li>
                    <li>
                        <button style="margin-left: 131px;" class="btn-sm btn-primary" onclick="window.history.back()">
                            Əvvəlki səhifəyə qayıt
                        </button>
                    </li>
                </ol>

                <div class="news">


                </div>

            </div>

            <div class="col-md-4">
                <div align="center" class="dpic"></div>
                <hr>
                @include('frontend.components.rightMenu')

            </div>

        </div>
    </section>
@endsection

@section('footerScripts')
    <script>

        $( document ).ready(function() {

            var available_dates = [];

            $.ajax({
                async: false,
                url: "{{url('get_current_month_news_and_available_dates')}}",
                method: "POST",
                dataType: "json",
                data: {
                    _token: "{{csrf_token()}}"
                },
                success: function (data) {

                    available_dates = data.available_dates;
                    appendNews(data.current_month_news);

                }
            });

            var dp = $('.dpic').datepicker({
                dateFormat: 'mm-dd-yy',

                beforeShowDay: function (date) {
                    if ($.inArray(date.getFullYear() + '-' + (date.getMonth() + 1) + '-' + date.getDate(), available_dates) !== -1) {
                        return;
                    }

                    return false;
                },

                autoclose: true,
                todayHighlight: true,

            });


            dp.on('changeMonth', function (e) {
                var month = e.date.getMonth()+1 ;
                var year = e.date.getFullYear();

                $.ajax({
                    url: "{{url('get_news_by_month')}}",
                    method: "POST",
                    dataType: "json",
                    data: {
                        year,
                        month,
                        _token: "{{csrf_token()}}"
                    },
                    success: function (data) {
                        appendNews(data);
                    }
                });

            });


            dp.on('changeDate', function (e) {
                var month = e.date.getMonth() + 1;
                var year = e.date.getFullYear();
                var day = e.date.getDate();
                $.ajax({
                    url: "{{url('get_news_by_day')}}",
                    method: "POST",
                    dataType: "json",
                    data: {
                        month,
                        year,
                        day,
                        _token: "{{csrf_token()}}"
                    },
                    success: function (data) {
                        appendNews(data);
                    },
                });
            });


            function appendNews(data) {
                $('.news').empty();
                if (!$.trim(data)) {
                    $('.news').append('<p  style=" text-align: center;">Bu ay heç bir xəbər yoxdur.</br>Kalendardan istifadə edərək digər aylardaki xəbərlərlə tanış ola bilərsiniz</p>');
                }
                $.each(data, function (key, article) {
                    var body = article.body;
                    var short_body = body.slice(0, 250) + '...'
                    var date = new Date(article.published_at),
                        yr = date.getFullYear(),
                        month = date.getMonth() < 10 ? '0' + date.getMonth() : date.getMonth(),
                        day = date.getDate() < 10 ? '0' + date.getDate() : date.getDate(),
                        publish_date = day + '-' + month + '-' + yr;


                    $('.news').append(' ' +
                        '<article class="card">\n' +
                        ' <div class="card-body">\n' +
                        '  <h5 class="card-title"><a href="{{url('news')}}' + '/' + article.id + '">' + article.title + '</a> </h5>\n' +
                        '  <h5><small>' + publish_date + '</small></h5>\n' +
                        '  <p class="card-text">' + short_body + '</p><a href="{{url('news')}}' + '/' + article.id + '">Ardını oxu</a>' +
                        '  </div>\n' +
                        '   </article> ' +
                        '<hr>');

                })
            }


        });




    </script>

@endsection