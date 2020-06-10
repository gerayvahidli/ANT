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

                @if( Request::segment(1)=="DTP" &&  isset($page->articles) )
                    @foreach($page->articles as $article)
                        <article class="card">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="{{ url($page->ShortName .'/news/' .  $article->id) }}">{{ $article->title }}</a>
                                </h5>
                                <h5><small>{{ $article->published_at->formatLocalized('%d %B %Y') }}</small></h5>
                                <p class="card-text">
                                    {!! str_limit(strip_tags($article->body), 250)  !!}
                                </p>
                            </div>
                        </article>
                        <br>
                    @endforeach

                @endif

                    @if(Request::segment(1)=="XTP")
                        <article class="card">
                            <div class="card-body">


                            <h2>Ümumi məlumat</h2>
                        <p>İstedadlı və perspektivli gənclərin xarici ölkələrin qabaqcıl ali təhsil ocaqlarında (universitetlərində) təhsilini təşkil etmək məqsədi ilə 2006-cı ildə SOCAR-ın Xarici Təqaüd Proqramı (XTP) təsis edilmiş və bu proqram uğurla həyata keçirilməkdədir. Proqram başlıca olaraq neft sənayesinin tələbatına uyğun ixtisaslar üzrə kadrların hazırlanmasına xidmət edir.</p>
                        <p>Müsabiqədə iştirak edərək SOCAR-ın təqaüdünə layiq görülmək istəyən SOCAR əməkdaşları üçün başlıca şərt təhsil alacağı universitetin tələblərinə cavab verməsidir. Proqrama qoşulmaq üçün isə “Şərtlər” bölməsində göstərilmiş tələblərə cavab vermək lazımdır.</p>
                       <p> Təqaüdə təhsil haqqı, visa və sığorta xərci, yaşayış, qidalanma və nəqliyyat xərcləri daxildir.</p>
                            </div>
                        </article>

                    @endif
            </div>

            <div class="col-md-4">
                @include('frontend.components.rightMenu')
            </div>
        </div>
    </section>
@endsection