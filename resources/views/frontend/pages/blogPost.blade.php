@extends('layouts.app')

@section('mainSection')
    <section class="slider-section">
        <header>
            <H3>{{ $post->title }}</H3>
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
                                $home='DTP';
                            $name='Daxili təqaüd proqramı';
                            @endphp
                        @else
                            @php
                                $home= 'XTP' ;
                                $name='Xarici təqaüd proqramı';
                            @endphp

                        @endif
                        <a href="{{$home}}">{{$name}}</a>
                        <li>
                            >><a href="{{route('page.news.archive',['slug' => $home])}}">Xəbər arxivi</a>>><a
                                    href="javascript:void(0)" style="color: #6f42c1">Xəbər</a>
                        </li>
                        <li>
                            <button style="margin-left: 85px;" class="btn-sm btn-primary"
                                    onclick="window.history.back() ">
                                Əvvəlki səhifəyə qayıt
                            </button>
                        </li>
                    </ol>

                </section>

                <article class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">
                            {!! $post->body !!}
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