@if($user->exists && count($user->previousEducations))
    @foreach($user->previousEducations as $previousEducation)
        <div class="fieldGroup" id="fieldGroup{{ $loop->iteration }}">
            {{ Form::hidden('previous_education_id[]', $previousEducation->id) }}

        <div class="form-group row">
            <label for="country" class="col-4 col-form-label">Ölkə seç</label>
            <div class="col-8">
                {{ Form::select('previous_education_country_id[]', $countries, null,
                    ['class' => 'form-control here', 'placeholder'=>'---- Ölkə seç ----', 'id' => 'previous_education_country_id']
                ) }}
            </div>
        </div>

        <div class="form-group row">
            <label for="university_id" class="col-4 col-form-label">Universitet</label>
            <div class="col-8">
                {{ Form::select('previous_education_university_id[]', ['' => '---- Universitet seç ----'], null,
                    ['class' => 'form-control here', 'id' => 'previous_education_university_id'])
                }}
            </div>
        </div>

        <div class="form-group row">
            <label for="edu_date" class="col-4 col-form-label">Təhsil müddəti</label>
            <div class="col-4">
                {{ Form::date('previous_education_BeginDate[]', $previousEducation->BeginDate, ['class' => 'form-control here']) }}
            </div>
            <div class="col-4">
                {{ Form::date('previous_education_EndDate[]', $previousEducation->EndDate, ['class' => 'form-control here']) }}
            </div>
        </div>

        <div class="form-group row">
            <label for="speciality" class="col-4 col-form-label">İxtisas</label>
            <div class="col-8">
                {{ Form::text('previous_education_speciality[]', $previousEducation->Speciality, ['class' => 'form-control here']) }}
            </div>
        </div>

        <div class="form-group row">
            <label for="admission_score" class="col-4 col-form-label">Qəbul balı</label>
            <div class="col-8">
                {{ Form::text('previous_education_admission_score[]', $previousEducation->AdmissionScore, ['class' => 'form-control here']) }}
            </div>
        </div>
        <hr>
    </div> {{--fieldGroup--}}

        <div class="card card-body fieldGroupCopy" id="fieldGroupCopy" style="display: none">

            <div class="form-group row">
                <label for="country" class="col-4 col-form-label">Ölkə seç</label>
                <div class="col-8">
                    {{ Form::select('previous_education_country_id[]', $countries, null,
                        ['class' => 'form-control here', 'placeholder'=>'---- Ölkə seç ----', 'id' => 'previous_education_country_id']
                    ) }}
                </div>
            </div>

            <div class="form-group row">
                <label for="university_id" class="col-4 col-form-label">Universitet</label>
                <div class="col-8">
                    {{ Form::select('previous_education_university_id[]', ['' => '---- Universitet seç ----'], null,
                        ['class' => 'form-control here', 'id' => 'previous_education_university_id'])
                    }}
                </div>
            </div>

            <div class="form-group row">
                <label for="edu_date" class="col-4 col-form-label">Təhsil müddəti</label>
                <div class="col-4">
                    {{ Form::date('previous_education_BeginDate[]', now(), ['class' => 'form-control here']) }}
                </div>
                <div class="col-4">
                    {{ Form::date('previous_education_EndDate[]', now(), ['class' => 'form-control here']) }}
                </div>
            </div>

            <div class="form-group row">
                <label for="speciality" class="col-4 col-form-label">İxtisas</label>
                <div class="col-8">
                    {{ Form::text('previous_education_speciality[]', null, ['class' => 'form-control here']) }}
                </div>
            </div>

            <div class="form-group row">
                <label for="admission_score" class="col-4 col-form-label">Qəbul balı</label>
                <div class="col-8">
                    {{ Form::text('previous_education_admission_score[]', null, ['class' => 'form-control here']) }}
                </div>
            </div>
            <hr>
        </div> {{--fieldGroup--}}
    @endforeach
@else
    <div class="card card-body fieldGroupCopy" id="fieldGroupCopy" style="display: none">

        <div class="form-group row">
            <label for="country" class="col-4 col-form-label">Ölkə seç</label>
            <div class="col-8">
                {{ Form::select('previous_education_country_id[]', $countries, null,
                    ['class' => 'form-control here', 'placeholder'=>'---- Ölkə seç ----', 'id' => 'previous_education_country_id']
                ) }}
            </div>
        </div>

        <div class="form-group row">
            <label for="university_id" class="col-4 col-form-label">Universitet</label>
            <div class="col-8">
                {{ Form::select('previous_education_university_id[]', ['' => '---- Universitet seç ----'], null,
                    ['class' => 'form-control here', 'id' => 'previous_education_university_id'])
                }}
            </div>
        </div>

        <div class="form-group row">
            <label for="edu_date" class="col-4 col-form-label">Təhsil müddəti</label>
            <div class="col-4">
                {{ Form::date('previous_education_BeginDate[]', now(), ['class' => 'form-control here']) }}
            </div>
            <div class="col-4">
                {{ Form::date('previous_education_EndDate[]', now(), ['class' => 'form-control here']) }}
            </div>
        </div>

        <div class="form-group row">
            <label for="speciality" class="col-4 col-form-label">İxtisas</label>
            <div class="col-8">
                {{ Form::text('previous_education_speciality[]', null, ['class' => 'form-control here']) }}
            </div>
        </div>

        <div class="form-group row">
            <label for="admission_score" class="col-4 col-form-label">Qəbul balı</label>
            <div class="col-8">
                {{ Form::text('previous_education_admission_score[]', null, ['class' => 'form-control here']) }}
            </div>
        </div>
        <hr>
    </div> {{--fieldGroup--}}
@endif
