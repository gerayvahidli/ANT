@extends('layouts.app')

@section('mainSection')
    <section class="slider-section">
        <header>
            <H3>{{ $speciality->title }}</H3>
        </header>
        @include('frontend.components.slider')
    </section> {{--slider-section--}}

    <section>
        <div class="row">
            <div class="col-12 col-md-8">
                <section>

                    <ol class="breadcrumb">
                        <a href="{{url('/')}}">Xarici təqaüd proqramı</a>
                        <li>
                            >><a href="javascript:void(0)" style="color: #6f42c1">İxtisaslar</a>
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
                        <h5 class="card-title">{{ $speciality->title }}</h5>
                        <p class="card-text">
                            {!! $speciality->body  !!}
                        </p>
                    </div>
                </article>
            </div>

            <div class="col-md-4">
                @include('frontend.components.rightMenu')
            </div>
        </div>
    </section>
@endsection