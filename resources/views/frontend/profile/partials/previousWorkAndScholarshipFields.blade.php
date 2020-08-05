@if($user->exists && count($user->previousJobs))
    <p class="lead"> ƏVVƏLKİ İŞ YERLƏRİ</p>
    @foreach($user->previousJobs as $previousJob)
        <div class="workFieldGroup" id="workFieldGroup{{ $loop->iteration }}">
            <p class="lead"> Əvvəlki iş yeri {{$loop -> iteration}}</p>
            <hr>
            <div class="form-group row required">
                <label for="previous_company_id" class="col-4 col-form-label">Müəssisə</label>
                <div class="col-8">
                        {{ Form::hidden('previous_job_id['.$loop->iteration.']', $previousJob->Id) }}
                        {{ Form::hidden('hidden_company_id['.$loop->iteration.']', $previousJob->Id,['class' => 'hidden_company_id']) }}

                    <select class="form-control ex_previous_company" id="ex_previous_company_id-{{ $loop->iteration }}" name="previous_company_id[{{ $loop->iteration }}]">
                        @if($user -> exists && $previousJob -> Company -> IsSocar== 0)

                            @foreach($companies as $company)
                                <option value="{{$company -> Id}}">{{$company -> Name}}</option>
                            @endforeach
                            <option value="other" selected>Digər</option>

                        @else
                            @foreach($companies as $company)
                                <option {{$user -> exists && $previousJob ->  CompanyId == $company -> Id ? 'selected' : ''}} value="{{$company -> Id}}">{{$company -> Name}}</option>
                            @endforeach
                            <option value="other">Digər</option>
                        @endif
                    </select>

                    @if($user -> exists && $previousJob -> Company -> IsSocar== 0)
                        <input type="hidden" value="{{$previousJob -> Company -> Name}}">
                    @endif

                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="form-group row ">
                <label for="previous_organization" class="col-4 col-form-label">Təşkilat</label>
                <div class="col-8">
                    <input value="{{  $user -> exists && isset($previousJob -> Organization) ? $previousJob -> Organization : null }}"
                           class="form-control"
                           type="text"
                           name="previous_organization[{{ $loop->iteration }}]"
                           id="previous_organization-{{ $loop->iteration }}"
                           maxlength="500"
                    >
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="form-group row required ">
                <label for="previous_department" class="col-4 col-form-label">Struktur Bölmə</label>
                <div class="col-8">
                    <input value="{{  $user -> exists  ? $previousJob -> Department : null }}"
                           class="form-control"
                           type="text"
                           name="previous_department[{{ $loop->iteration }}]"
                           id="previous_department-{{$loop->iteration }}"
                           required
                           maxlength="500"
                           data-msg-required = "Struktur Bölmə sahəsini boş buraxmayın"
                    >
                    <div class="help-block with-errors"></div>
                </div>
            </div>

            <div class="form-group row required">
                <label for="previous_position" class="col-4 col-form-label">Vəzifə</label>
                <div class="col-8">
                    <input value="{{  $user -> exists  ? $previousJob -> Position : null }}"
                           class="form-control"
                           type="text"
                           name="previous_position[{{$loop->iteration }}]"
                           id="previous_position-{{$loop->iteration }}"
                           required
                           maxlength="500"
                           data-msg-required = "Vəzifə sahəsini boş buraxmayın"
                    >
                    <div class="help-block with-errors"></div>
                </div>
            </div>

            <div class="form-group row required">
                <label for="previous_StartDate" class="col-4 col-form-label">İşə qəbul tarixi</label>
                <div class="col-8">
                    <input value="{{  $user -> exists  ? $previousJob -> StartDate : null }}" class="form-control"
                           type="date"
                           name="previous_StartDate[{{$loop->iteration }}]"
                           id="previous_StartDate-{{$loop->iteration }}"
                           required
                           data-msg-required = "İşə qəbul tarixi sahəsini boş buraxmayın"
                    >
                    <div class="help-block with-errors"></div>
                </div>
            </div>

            <div class="form-group row required">
                <label for="previous_EndDate" class="col-4 col-form-label">İşdən ayrılma tarixi</label>
                <div class="col-8">
                    <input value="{{  $user -> exists  ? $previousJob -> EndDate : null }}"
                           class="form-control"
                           type="date"
                           name="previous_EndDate[{{$loop->iteration }}]"
                           id="previous_EndDate-{{$loop->iteration }}"
                           required
                           data-msg-required = "İşə qəbul tarixi sahəsini boş buraxmayın"
                    >
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <hr>
            <div class="input-group-addon">
                <a href="javascript:void(0)" class="btn btn-danger removeWork" id="delete-previous-job"><span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span> Ləğv et</a>
            </div>
            <br>

        </div>
    @endforeach
@else

@endif
