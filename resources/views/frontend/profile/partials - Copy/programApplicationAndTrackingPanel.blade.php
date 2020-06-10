<hr>
<nav class="nav flex-column nav-pills">
    @if(isset($currentExternalProgram))
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/apply/internal/scholarship/' . $currentExternalProgram->id) }}">
            Daxili Təqaüd Proqramı
        </a>
    </li>
    @endif
    @if(isset($currentInternalProgram))
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/apply/external/scholarship/' . $currentInternalProgram->id) }}">
            Xarici Təqaüd Proqramı
        </a>
    </li>
    @endif
    @if(isset($currentInternshipProgram))
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/apply/paid/scholarship/' . $currentInternshipProgram->id) }}">
            Ödənişli Təcrübə Proqramı
        </a>
    </li>
    @endif
    {{--@forelse($navProgramTypes as $ProgramType)
        <li class="nav-item">
        <a class="nav-link {{ (Request::is($ProgramType->ShortName)) ? 'active' : '' }}" href="{{ url('/' . $ProgramType->ShortName) }}">
            {{ $ProgramType->Name }}
        </a>
        </li>
    @empty
    @endforelse--}}
</nav>
<hr>
@if(isset($internalProgramApplication) && count($internalProgramApplication))
<div class="table-responsive">
    <table class="table table-borderless">
        <tbody>
        <tr>
            <td>Status</td>
            <td>{{ ($internalProgramApplication->first()->placementStatus->Name) ?? '' }}</td>
        </tr>
        <tr>
            <td>Layihə</td>
            <td>Daxili Təqaüd Proqramı</td>
        </tr>
        <tr>
            <td>İlkin seçim:</td>
            <td>
                <span class="{{ ( isset($internalProgramApplication->first()->FirstStageResultId ) ) ? 'green-dot' : 'red-dot' }}"></span>
            </td>
        </tr>
        <tr>
            <td>Test:</td>
            <td>
                <span class="{{ ( isset($internalProgramApplication->first()->TestStageResultId ) ) ? 'green-dot' : 'red-dot' }}"></span>
            </td>
        </tr>
        <tr>
            <td>Müsahibə:</td>
            <td>
                <span class="{{ ( isset($internalProgramApplication->first()->InterviewStageResultId ) ) ? 'green-dot' : 'red-dot' }}"></span>
            </td>
        </tr>
        </tbody>
    </table>
</div>
    @elseif(isset($externalProgramApplication) && count($externalProgramApplication))
    <div class="table-responsive">
        <table class="table table-borderless">
            <tbody>
            <tr>
                <td>Status</td>
                <td>{{ ($externalProgramApplication->first()->placementStatus->Name) ?? '' }}</td>
            </tr>
            <tr>
                <td>Layihə</td>
                <td>Xarici Təqaüd Proqramı</td>
            </tr>
            <tr>
                <td>İlkin seçim:</td>
                <td>
                    <span class="{{ ( isset($externalProgramApplication->first()->FirstStageResultId ) ) ? 'green-dot' : 'red-dot' }}"></span>
                </td>
            </tr>
            <tr>
                <td>Test:</td>
                <td>
                    <span class="{{ ( isset($externalProgramApplication->first()->TestStageResultId ) ) ? 'green-dot' : 'red-dot' }}"></span>
                </td>
            </tr>
            <tr>
                <td>Müsahibə:</td>
                <td>
                    <span class="{{ ( isset($externalProgramApplication->first()->InterviewStageResultId ) ) ? 'green-dot' : 'red-dot' }}"></span>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
@else
    <div class="alert alert-primary important" role="alert">
        Siz heç bir proqrama müraciət etməmisiniz!
    </div>
@endif