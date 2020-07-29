@extends('layouts.app')
@section('head')
    <style>
        .dpic .datepicker-days td:not(.disabled) {
            background-color: lightskyblue;
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
                        <button style="margin-left: 131px;" class="btn-sm btn-primary" onclick="window.history.back()">Əvvəlki səhifəyə qayıt</button>
                    </li>
                </ol>

                <div class = "news">

                    Bu ay xeber yoxdur

                </div>

            </div>

            <div class="col-md-4">
                <div align="center"  class="dpic"></div>
                <hr>
                @include('frontend.components.rightMenu')

            </div>

        </div>
    </section>
@endsection

@section('footerScripts')
    <script>

     var aviable_dates=[];
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });
        $.ajax({
            async: false,
            url: "{{url('get_available_dates')}}" ,
            method: "POST",
            dataType: "json",
            success: function (data) {

                aviable_dates = data;

            }
        });

      var dp= $('.dpic').datepicker({
            dateFormat: 'mm-dd-yy',

            beforeShowDay: function(date)
            {
                if ($.inArray(date.getFullYear() + '-' + (date.getMonth() + 1) + '-' + date.getDate(), aviable_dates) !== -1)
                {
                    return;
                }

                return false;
            },
            // todayBtn: "linked",
            // autoclose: true,
            // todayHighlight: true
        });


            dp.on('changeMonth', function (e) {
                $('.news').empty();
                var month = e.date.getMonth() + 1;
                var year = e.date.getFullYear();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    }
                });

                $.ajax({
                    url: "{{url('get_news_by_month')}}" ,
                    method: "POST",
                    dataType: "json",
                    data: {
                        year,
                        month
                    },
                    success: function (data) {
                        $.each(data, function (key,article) {
                            var body = article.body;
                            var short_body = body.slice(0, 250)+'...'
                            var date    = new Date(article.published_at),
                                yr      = date.getFullYear(),
                                month   = date.getMonth() < 10 ? '0' + date.getMonth() : date.getMonth(),
                                day     = date.getDate()  < 10 ? '0' + date.getDate()  : date.getDate(),
                                publish_date = day + '-' + month + '-' + yr;


                            $('.news').append(' ' +
                            '<article class="card">\n' +
                            ' <div class="card-body">\n' +
                            '  <h5 class="card-title"><a href="{{url('news')}}'+'/'+article.id+'">'+article.title+'</a> </h5>\n' +
                            '  <h5><small>'+publish_date+'</small></h5>\n' +
                            '  <p class="card-text">'+short_body+'</p><a href="{{url('news')}}'+'/'+article.id+'">Ardını oxu</a>' +
                            '  </div>\n' +
                            '   </article> ' +
                            '<hr>');

                    })
                    }
                });

            });




     dp.on('changeDate', function (e) {
         $('.news').empty();
         var month = e.date.getMonth() + 1;
         var year = e.date.getFullYear();
         var day = e.date.getDate();
         $.ajax({
             url: "{{url('get_news_by_day')}}" ,
             method: "POST",
             dataType: "json",
             data: {
                 month,
                 year,
                 day,
                 _token: "{{csrf_token()}}"
             },
             success: function (data) {
                 $.each(data, function (key,article) {
                     $.each(data, function (key,article) {
                         var body = article.body;
                         var short_body = body.slice(0, 250)+'...'
                         var date    = new Date(article.published_at),
                             yr      = date.getFullYear(),
                             month   = date.getMonth() < 10 ? '0' + date.getMonth() : date.getMonth(),
                             day     = date.getDate()  < 10 ? '0' + date.getDate()  : date.getDate(),
                             publish_date = day + '-' + month + '-' + yr;


                         $('.news').append(' ' +
                             '<article class="card">\n' +
                             ' <div class="card-body">\n' +
                             '  <h5 class="card-title"><a href="{{url('news')}}'+'/'+article.id+'">'+article.title+'</a> </h5>\n' +
                             '  <h5><small>'+publish_date+'</small></h5>\n' +
                             '  <p class="card-text">'+short_body+'</p><a href="{{url('news')}}'+'/'+article.id+'">Ardını oxu</a>' +
                             '  </div>\n' +
                             '   </article> ' +
                             '<hr>');

                     })
                 });

             },
         });
     });




    </script>

    @endsection