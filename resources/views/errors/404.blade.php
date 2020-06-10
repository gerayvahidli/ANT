@extends('layouts.app')

@section('mainSection')
    <section class="slider-section">
        <header>
            <H3>Səhifə tapılmadı</H3>
        </header>
        @include('frontend.components.slider')
    </section> {{--slider-section--}}

    <section>
        <div class="row">
            <div class="col-12 col-md-12">
                <article class="card">
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <h1 class="mx-auto">404</h1>
                        </div>
                        <div class="row justify-content-center">
                            <h3 class="mx-auto">Səhifə tapılmadı</h3>
                        </div>
                    </div>
                </article>
            </div>

            <div class="col-md-4">
                {{--@include('frontend.components.rightMenu')--}}
            </div>
        </div>
    </section>
@endsection