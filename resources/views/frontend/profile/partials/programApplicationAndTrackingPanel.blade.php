<style type="text/css">
    .label {
        display: inline;
        font-size: 12px;
        font-weight: 700;
        line-height: 1;
        color: black;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: .25em;
        background-color: #ffe8e8;
    }
</style>
@inject('user', '\App\Http\Controllers\UserController')

<hr>


@if(isset($currentInternalProgram))
    <a href="{{ url('/apply/external/scholarship/'.$currentInternalProgram->id) }}"
       class="btn btn-outline-primary btn-block">
        <i class="fa fa-hand-pointer-o"></i> Xarici Təqaüd Proqramı
    </a>
@endif



{{--<nav class="nav flex-column nav-pills" aria-orientation="vertical">--}}
{{--    @if(isset($currentInternalProgram ))--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" href="{{ url('/apply/internal/scholarship/'.$currentInternalProgram->id) }}">--}}
{{--                Daxili Təqaüd Proqramı--}}
{{--            </a>--}}
{{--        </li>--}}
{{--    @endif--}}
{{--    @if(isset($currentExternalProgram))--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" href="{{ url('/apply/external/scholarship/'.$currentExternalProgram->id) }}">--}}
{{--                Xarici Təqaüd Proqramı--}}
{{--            </a>--}}
{{--        </li>--}}
{{--    @endif--}}
{{--    @if(isset($currentInternshipProgram))--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" href="{{ url('/apply/paid/scholarship/' . $currentInternshipProgram->id) }}">--}}
{{--                Ödənişli Təcrübə Proqramı--}}
{{--            </a>--}}
{{--        </li>--}}
{{--    @endif--}}
{{--    --}}{{----}}{{--@forelse($navProgramTypes as $ProgramType)--}}
{{--        <li class="nav-item">--}}
{{--        <a class="nav-link {{ (Request::is($ProgramType->ShortName)) ? 'active' : '' }}" href="{{ url('/' . $ProgramType->ShortName) }}">--}}
{{--            {{ $ProgramType->Name }}--}}
{{--        </a>--}}
{{--        </li>--}}
{{--    @empty--}}
{{--    @endforelse--}}{{----}}{{----}}
{{--</nav>--}}
<hr>

@if(isset($internalProgramApplication) && count($internalProgramApplication))
    <div class="table-responsive">
        <table class="table table-borderless">
            <tbody>
            <tr>
                <td>Status</td>
				
                <td>{{ (isset($internalProgramApplication->first()->interviewStageResult->Id) && $internalProgramApplication->first()->interviewStageResult->Id == 16) ? 'Təqaüdçü' : ''  }}</td>
            </tr>
            <tr>
                <td>Layihə</td>
                <td>Daxili Təqaüd Proqramı</td>
            </tr>
            <tr>
                <td>İlkin seçim:</td>
                <td>
                    {{--{{ dd($internalProgramApplication) }}--}}
                    @if($internalProgramApplication->first()->ShowFirstSelStageResults == 1)
                        {{--{{dd($user::dot_color('firstStageResult',$internalProgramApplication))}}--}}
                        <span style="float: left;"
                              class="{{ $user::dot_color('firstStageResult',$internalProgramApplication) }}"></span>
                        <div style="font-size:12px; float:left; font-weight: bold">
                            &nbsp;&nbsp;
                            <span class="label">{{ ($internalProgramApplication->first()->firstStageResult->Name) ?? ''  }} </span>
                            &nbsp;&nbsp;
                            {{ isset($internalProgramApplication->first()->first_stage_note->Name ) ? $internalProgramApplication->first()->first_stage_note->Name : '' }}
                        </div>
                    @endif
                </td>
            </tr>
            <tr>
                <td>Test:</td>
                <td>
                    @if($internalProgramApplication->first()->ShowTestExamResults == 1)
                        {{-- <span class="{{ ( isset($internalProgramApplication->first()->TestStageResultId ) ) ? 'green-dot' : 'red-dot' }}"></span> --}}
                        <span style="float: left;"
                              class="{{$user::dot_color('testStageResult',$internalProgramApplication) }}"></span>
                        &nbsp;&nbsp;
                        <span class="label">{{ ($internalProgramApplication->first()->testStageResult->Name) ?? ''  }} </span>
                    @endif
                </td>
            </tr>
            <tr>
                <td>Müsahibə:</td>
                <td>
                @if($internalProgramApplication->first()->ShowInterviewResults == 1)
                        <span style="float: left;"
                              class="{{$user::dot_color('interviewStageResult',$internalProgramApplication) }}"></span>
                        &nbsp;&nbsp;
                        <span class="label">{{ ($internalProgramApplication->first()->interviewStageResult->Name) ?? ''  }}  </span>
                @endif
                </td>
            </tr>
            @if(isset($internalProgramApplication->first()->TestExamDateTime) and !isset($internalProgramApplication->first()->FirstSelStageResultId))
                <tr>
                    <td colspan="2">
                        <div class="alert alert-info" role="alert">
                            Siz test mərhələsi üçün {{ $internalProgramApplication->first()->TestExamDateTime->formatLocalized('%d %B %Y') }} tarixində saat {{ $internalProgramApplication->first()->TestExamDateTime->format('H:i') }} -da(də) SOCAR-ın İnsan Resursları Departamentinə (Nizami r-u, Ş. Mirzəyev 26) dəvət olunursunuz.
                            <br>
                            İmtahan FİN kodunuz: {{ (isset($internalProgramApplication->first()->TestExamUserId)) ? $internalProgramApplication->first()->TestExamUserId : '' }}
                        </div>
                    </td>
                </tr>
            @elseif(isset($internalProgramApplication->first()->FirstSelStageResultId))
                <tr>
                    <td colspan="2">
                        <div class="alert alert-success" role="alert">
                            @if(isset($internalProgramApplication->first()->TestExamScore))
                                Test imtahan balınız: {{ $internalProgramApplication->first()->TestExamScore }}
                            @endif
                            <br>
                            @if(isset($internalProgramApplication->first()->InterviewDateTime))
                                Siz müsahibə mərhələsi üçün {{ $internalProgramApplication->first()->InterviewDateTime->formatLocalized('%d %B %Y') }} tarixində saat {{ $internalProgramApplication->first()->InterviewDateTime->format('H:i') }} -da(də) SOCAR Tower-a (Bakı şəhəri, N.Nərimanov rayonu, Heydər Əliyev prospekti 121) dəvət olunursunuz.
								<br>
								Qeyd: Müsahibələrə gələrkən aşağıdakı sənədlərin gətirilməsi vacibdir:
								<br>
								- şəxsiyyət vəsiqəsi
								<br>
								- rəsmi transkriptin əsli (surəti, şəkli və.s formalar qəbul edilmir).
                            @endif
                        </div>
                    </td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
    <hr>
@endif
@if(isset($externalProgramApplication) && count($externalProgramApplication))
    <div class="table-responsive">
        <table class="table table-borderless">
            <tbody>
            <tr>
                <td>Status</td>
                <td>{{ ($externalProgramApplication->first()->placementStatus->Name) ?? ''  }}</td>
            </tr>
            <tr>
                <td>Layihə</td>
                <td>Xarici Təqaüd Proqramı</td>
            </tr>
            <tr>
                <td>İlkin seçim:</td>
                <td>
                <!-- <span class="{{ ( isset($externalProgramApplication->first()->FirstSelStageResultId ) ) ? 'green-dot' : 'red-dot' }}"></span> -->
                    <span class="{{$user::dot_color('firstStageResult',$externalProgramApplication) }}"
                          style="float: left;"></span>
                    &nbsp;&nbsp;
                    <span class="label">{{ ($externalProgramApplication->first()->firstStageResult->Name) ?? ''  }} </span>
                    &nbsp;&nbsp;
                    <span style="font-size:12px; float:right; font-weight: bold; margin-top:3px">
                            {{isset($externalProgramApplication->first()->first_stage_note->Name )?$externalProgramApplication->first()->first_stage_note->Name:''}}
                        </span>
                </td>
            </tr>
            <tr>
                <td>Test:</td>
                <td>
                <!-- <span class="{{ ( isset($externalProgramApplication->first()->TestStageResultId ) ) ? 'green-dot' : 'red-dot' }}"></span> -->
                    <span class="{{$user::dot_color('testStageResult',$externalProgramApplication) }}"
                          style="float: left;"></span>
                    &nbsp;&nbsp;
                    <span class="label">{{ ($externalProgramApplication->first()->testStageResult->Name) ?? ''  }} </span>
                </td>
            </tr>
            <tr>
                <td>Müsahibə:</td>
                <td>
                    {{--   <span class="{{ ( isset($externalProgramApplication->first()->InterviewStageResultId ) ) ? 'green-dot' : 'red-dot' }}"></span> --}}
                    <span class="{{ $user::dot_color('interviewStageResult',$externalProgramApplication) }}"
                          style="float: left;"></span>&nbsp;&nbsp;
                    <span class="label">{{ ($externalProgramApplication->first()->interviewStageResult->Name) ?? ''  }} </span>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <hr>
@endif
@if(!isset($externalProgramApplication) || !isset($internalProgramApplication))
    <div class="alert alert-primary" role="alert">
        Siz heç bir proqrama müraciət etməmisiniz!
    </div>
@endif