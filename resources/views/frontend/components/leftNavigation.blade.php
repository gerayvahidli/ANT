<div class="col-md-3" id="accordion">
    <nav class="nav flex-column left-sidebar">
        {{--        @forelse($navProgramTypes as $ProgramType)--}}
        <div class="card" style="margin-bottom: 0.5rem;">
            <div class="card-header" id="headingThree" style="padding: 0 0.5rem;">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo"
                            aria-expanded="false" aria-controls="collapseTwo">
                        <a class=""
                           href="{{Config::get('app.url')."/DTP"}}">
                            Daxili təqaüd proqramı
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
                        <a class=""
                           href="{{route('page.show')}}">
                            {!! basename(base_path()) == 'XTP' ? '<i class="fas fa-angle-right menu-icon" ></i>' : '' !!}
                            Xarici təqaüd proqramı
                        </a>
                    </button>
                </h5>
            </div>
        </div>
        {{--        @empty--}}
        {{--        @endforelse--}}
    </nav>
</div>
