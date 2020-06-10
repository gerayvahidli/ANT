@extends('layouts.app')

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
                <section>
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
                <ol class="breadcrumb">
                    <a href="{{$home}}">{{$name}}</a>
                    <li>
                        >><a href="javascript:void(0)"  >Şərtlər</a>>><a href="javascript:void(0)"  style="color: #6f42c1">Şərt</a>
                    </li>
                    <li>
                        <button style="margin-left: 130px;" class="btn-sm btn-primary" onclick="window.history.back()">Əvvəlki səhifəyə qayıt</button>
                    </li>
                </ol>

                </section>
                @if(isset($terms) )
                    @foreach($terms as $term)
                        <article class="card">
                            <div class="card-body">
{{--                                <h5 class="card-title"><a href="{{ url('terms/' . $term->id) }}">{{ $term->title }} </a></h5>--}}
                                <h5 class="card-title">{{ $term->title }}</h5>
                                <p class="card-text">
                                    {!! $term->body !!}

                                </p>
                            </div>
                        </article>
                        <br>
                    @endforeach
                @endif
            </div>

            <div class="col-md-4">
                @include('frontend.components.rightMenu')
            </div>
        </div>
    </section>
@endsection