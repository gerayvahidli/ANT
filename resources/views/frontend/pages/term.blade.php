@extends('layouts.app')

@section('mainSection')
    <section class="slider-section">
        <header>
            <H3>{{ $term->title }}</H3>
        </header>
        @include('frontend.components.slider')
    </section> {{--slider-section--}}

    <section>
        <div class="row">
            <div class="col-12 col-md-8">
                <article class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $term->title }}</h5>
                        <p class="card-text">
                            {!! $term->body  !!}
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