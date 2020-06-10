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
                    <a href="{{$home}}">{{ $name}}</a>
                    <li>
                        >><a href="javascript:void(0)" style="color: #6f42c1">Xəbər arxivi</a>
                    </li>
                    <li>
                        <button style="margin-left: 131px;" class="btn-sm btn-primary" onclick="window.history.back()">Əvvəlki səhifəyə qayıt</button>
                    </li>
                </ol>

                </section>

                @if(isset($page->articles) && count($page->articles) )
                    @foreach($page->articles as $article)
                        <article class="card">
                            <div class="card-body">
                                <h5 class="card-title"><a href="{{ url($page->ShortName .'/news/' .  $article->id) }}">{{ $article->title }}</a> </h5>
                                <h5><small>{{ $article->published_at->formatLocalized('%d %B %Y') }}</small></h5>
                                <p class="card-text">
                                    {!!  str_limit(strip_tags($article->body), 250)  !!}
                                </p>
                            </div>
                        </article>
                        <br>
                    @endforeach
                    <hr>
                        {{--{{ $page->articles->links() }}--}}
                    @else
                    <h5> Heç bir xəbər yoxdur </h5>
                @endif
            </div>

            <div class="col-md-4">
                @include('frontend.components.rightMenu')
            </div>
        </div>
    </section>
@endsection