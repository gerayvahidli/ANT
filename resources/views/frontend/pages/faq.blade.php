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

                <ol class="breadcrumb">

                    <a href="{{url('/')}}">Xarici təqaüd proqramı</a>
                    <li>
                        >><a href="javascript:void(0)" style="color: #6f42c1">Faq</a>
                    </li>
                    <li>
                        <button style="margin-left: 131px;" class="btn-sm btn-primary" onclick="window.history.back()">
                            Əvvəlki səhifəyə qayıt
                        </button>
                    </li>
                </ol>



                @if(isset($page->faq) && count($page->faq) )
                    @foreach($page->faq as $faq)
                        <div class="d-flex p-2" >
                        <a data-toggle="collapse" href="#faq{{ $faq->id }}" role="button" aria-expanded="false" aria-controls="collapseExample">
                            {{ $faq->title }}
                        </a>
                        </div>

                        <div class="collapse" id="faq{{ $faq->id }}">
                            <div class="card card-body">
                                {!! $faq->answer  !!}
                            </div>
                        </div>
                        <hr>
                    @endforeach
                @else
                    <h5> Heç bir sual yoxdur </h5>
                @endif
            <
        </div>
            <div class="col-md-4">
                @include('frontend.components.rightMenu')
            </div>
        </div>
    </section>
@endsection