<nav class="nav flex-column">
    {{--{{ dd($page) }}--}}

    <div id="accordion">
        <div class="card" style="margin-bottom: 0.5rem;">
            <div class="card-header" id="headingOne" style="padding:  0px 0px 0px 7px;;">
                <button id="termsButton" ondblclick="return false;" style="padding-left:-4px "
                        class="btn btn-link accord" data-toggle="collapse" data-target="#collapseOne"
                        aria-expanded="true" aria-controls="collapseOne">
                    Şərtlər
                </button>
            </div>

            <div id="collapseOne" class="collapse rightMenuCollapse" aria-labelledby="headingOne"
                 data-parent="#accordion">
                <div id="bottom" class="card-body" style="padding-top: 10px;">
                    <nav class="nav flex-column rightMenu">
                        @forelse($navTermTypes as $navTermType)
                            @if($navTermType->title == "Ümumi məlumat" && Request::segment(1) == "XTP"  )
                                @continue;
                            @endif
                            @if($navTermType->title == "İxtisaslar" && Request::segment(1) == "XTP"  )
                                @continue;
                            @endif
                            <a class="nav-link menu {{ Request::is('terms/'.$navTermType->slug) ? 'activeElement' : '' }} "
                               href="{{ url('/terms/' . $navTermType->slug) }}"
                            >
                                {!!  Request::is('terms/'.$navTermType->slug) ? '<i class="fas fa-angle-right menu-icon" ></i>' : '' !!}
                                {{ $navTermType->title }}
                            </a>
                        @empty
                        @endforelse
                    </nav>
                </div>
            </div>
        </div>


        {{--
             is temporary for externl program
        --}}

            <div id="bottom" class="card" style="margin-bottom: 0.5rem;">
                <div class="card-header" id="headingTwo" style="padding: 0 0.5rem;">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo"
                                aria-expanded="false" aria-controls="collapseTwo">
                            <a class="{{ Request::is( Request::segment(1).'/specialities') ? 'activeElement' : '' }}"
                               href="{{ url('/specialities') }}">
                                {!!  Request::is( Request::segment(1).'/specialities') ? '<i class="fas fa-angle-right menu-icon" ></i>' : '' !!}
                                İxtisaslar
                            </a>
                        </button>
                    </h5>
                </div>
            </div>



            <div class="card" style="margin-bottom: 0.5rem;">
                <div class="card-header" id="headingThree" style="padding: 0 0.5rem;">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo"
                                aria-expanded="false" aria-controls="collapseTwo">
                            <a class="{{ Request::is('universitylist') ? 'activeElement' : '' }}"
                               href="{{ url('/universitylist') }}">
                                {!!  Request::is('universitylist') ? '<i class="fas fa-angle-right menu-icon" ></i>' : '' !!}
                                Universitetlərin siyahısı
                            </a>
                        </button>
                    </h5>
                </div>
            </div>
            <div class="card" style="margin-bottom: 0.5rem;">
                <div class="card-header" id="headingFour" style="padding: 0 0.5rem;">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo"
                                aria-expanded="false" aria-controls="collapseTwo">
                            <a class="{{ Request::is('requestforExternal') ? 'activeElement' : '' }}"
                               href="{{ url('/requestforExternal') }}">
                                {!!  Request::is('requestforExternal') ? '<i class="fas fa-angle-right menu-icon" ></i>' : '' !!}
                                Müraciət et
                            </a>
                        </button>
                    </h5>
                </div>
            </div>
        <div class="card" style="margin-bottom: 0.5rem;">
            <div class="card-header" id="headingFive" style="padding: 0 0.5rem;">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo"
                            aria-expanded="false" aria-controls="collapseTwo">
                        <a class="{{ Request::is('news') ? 'activeElement' : '' }}"
                           href="{{ url('/news') }}">
                            {!!  Request::is( Request::segment(1).'/news') ? '<i class="fas fa-angle-right menu-icon" ></i>' : '' !!}
                            Xəbər Arxivi</a>
                    </button>
                </h5>
            </div>
        </div>
        <div class="card" style="margin-bottom: 0.5rem;">
            <div class="card-header" id="headingSix" style="padding: 0 0.5rem;">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo"
                            aria-expanded="false" aria-controls="collapseTwo">
                        <a class="{{ Request::is('faq') ? 'activeElement' : '' }}"
                           href="{{ url('faq') }}">
                            {!!  Request::is('faq') ? '<i class="fas fa-angle-right menu-icon" ></i>' : '' !!}
                            FAQ
                        </a>
                    </button>
                </h5>
            </div>
        </div>
    </div>
</nav>
@if(isset($currentInternalProgram ))
    <hr>
    <a href="{{ url('/apply/internal/scholarship/'.$currentInternalProgram->id) }}"
       class="btn btn-outline-primary btn-block">
        <i class="fa fa-hand-pointer-o"></i> Daxili Təqaüd Proqramına <br> müraciət et
    </a>
@endif


<!--    <a class="nav-link" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Şərtlər</a>
    <div class="collapse" id="collapseExample">
        <nav class="nav flex-column">
            @forelse($navTermTypes as $navTermType)
    @if($navTermType->title == "Ümumi məlumat" && Request::segment(1) == "XTP"  )
        @continue;
                @endif
            <a style="color: #0000ff" class="nav-link active" href="{{ url('/' . $page->ShortName . '/terms/' . $navTermType->slug) }}">
                &nbsp&nbsp<i>{{ $navTermType->title }}</i>
            </a>
                @empty
@endforelse
        </nav>
    </div>
{{--    <a class="nav-link" href="{{ url('/' . $page->ShortName . '/specialities') }}">İxtisaslar</a>--}}

{{--
     is temporary for externl program
--}}


    <a class="nav-link" href="{{ url('/universitylist') }}">Universitetlərin siyahısı</a>
        <a class="nav-link" href="{{ url('/' . $page->ShortName . '/requestforExternal') }}">Müraciət et</a>

        <a class="nav-link active" href="{{ url('/' . $page->ShortName . '/news') }}">Xəbər Arxivi</a>
    <a class="nav-link" href="{{ url('/' . $page->ShortName . '/faq') }}">FAQ</a>
</nav>
@if(isset($currentInternalProgram ))
    <hr>
    <a href="{{ url('/apply/internal/scholarship/'.$currentInternalProgram->id) }}"
       class="btn btn-outline-primary btn-block">
        <i class="fa fa-hand-pointer-o"></i> Daxili Təqaüd Proqramına <br> müraciət et
    </a>
@endif
        -->