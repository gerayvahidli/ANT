@extends('layouts.app')

@section('mainSection')
    <section class="slider-section">
        <header>
            <H3>Xarici təqaüd proqramı</H3>
        </header>
        @include('frontend.components.slider')
    </section> {{--slider-section--}}

    <section>
        <div class="row">
            <div class="col-12 col-md-8">
                <section>

                    <ol class="breadcrumb">
                        @if(Request::segment(1)=="DTP")
                            @php
                                $home=route('DTP');
                            $name='Daxili təqaüd proqramı';
                            @endphp
                        @else
                            @php
                                $home= url('XTP') ;
                                $name='Xarici təqaüd proqramı';
                            @endphp

                        @endif
                        <a href="{{$home}}">{{$name}}</a>
                        <li>
                            >><a href="javascript:void(0)" style="color: #6f42c1">Müraciət et</a>
                        </li>
                        <li>
                            <button style="margin-left: 145px;" class="btn-sm btn-primary" onclick="window.history.back() ">
                                Əvvəlki səhifəyə qayıt
                            </button>
                        </li>
                    </ol>

                </section>

                <article class="card">
                    <div class="card-body">


                        <h2>Müraciət et</h2>
                        Xarici Təqaüd Proqramına müraciət üçün <a href="http://new.socar.az/khs/xarici-teqaud-2018/form.php%20">bu keçiddən</a> istifadə etmək lazımdır.
                    </div>
                </article>

            </div>

            <div class="col-md-4">
                @include('frontend.components.rightMenu')
            </div>
        </div>
    </section>
@endsection