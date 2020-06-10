<div class="row form-group">
    <label for="is-working" class="col-4 col-form-label">Əvvəlki illərdə təqaüd müsabiqəsində iştirak
        etmisinizmi?</label>
    <div class="col-8">
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="hasAppliedToScholarship1" value="1"
                   name="hasAppliedToScholarship" id="test1" required
                   data-error="Lütfən birini seçin" {{ ($user->exists && $user->hasAppliedToScholarship == 1) ? 'checked' : null  }}>
            <label class="form-check-label" for="hasAppliedToScholarship1">Bəli</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="hasAppliedToScholarship2" value="0"
                   name="hasAppliedToScholarship"
                   id="test2" {{ ($user->exists && $user->hasAppliedToScholarship != 1 ) ? 'checked' : null  }}>
            <label class="form-check-label"
                   for="hasAppliedToScholarship2">Xeyr</label>
        </div>
        <div class="help-block with-errors radio-errors"></div>
    </div>
</div>


<div id="scholarshipFieldGroup"
     style="{{ $user->exists && $user->hasAppliedToScholarship == 1 ? '' : 'display: none' }}">
    <div class="row form-group">
        <label for="haveBeenScholar" class="col-4 col-form-label">Təqaüdçü olmusunuzmu?</label>
        <div class="col-8">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="haveBeenScholar1" value="1"
                       name="haveBeenScholar" {{ ($user->exists && count($user->previousScholarships)) ? 'checked' : null }}>
                <label class="form-check-label" for="haveBeenScholar1">Bəli</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="haveBeenScholar2" value="0"
                       name="haveBeenScholar" {{ ($user->exists && !count($user->previousScholarships)) ? 'checked' : null }}>
                <label class="form-check-label" for="haveBeenScholar2">Xeyr</label>
            </div>
        </div>
    </div>

    <div class="scholarshipSection" id="scholarshipSection"
         style="{{ $user->exists && count($user->previousInternships) ? '' : 'display: none' }}">
        @if($user->exists && count($user->previousScholarships))
            @foreach($user->previousScholarships as $previousScholarship)
                <div class="previousScholarshipFieldGroup" id="previousScholarshipFieldGroup"
                     style="{{ $user->exists && count($user->previousScholarships) ? '' : 'display: none' }}">
                    {{ Form::hidden('previous_scholarship_id[]', $previousScholarship->id) }}
                    <div class="row form-group">
                        <label for="previous_scholarship_type" class="col-4 col-form-label">Təqaüd növü</label>
                        <div class="col-8">
                            {{ Form::select('previous_scholarship_type[]', $programTypes,
                             $previousScholarship->program_type_id,
                              ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="previous_scholarship_date" class="col-4 col-form-label">Təqaüd tarixi</label>
                        <div class="col-8">
                            {{ Form::date('previous_scholarship_date[]', $previousScholarship->scholarship_date->format('Y-m-d'), ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <br>
                    <div class="input-group-addon">
                        <a href="javascript:void(0)" class="btn btn-danger delete-scholarship"
                           id="delete-scholarship"><span
                                    class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span> Ləğv et</a>
                    </div>
                </div>
                <hr>
            @endforeach
            {{--@else
                <div class="previousScholarshipFieldGroup" id="previousScholarshipFieldGroup"
                     style="display: none">
                    <div class="row form-group">
                        <label for="previous_scholarship_type" class="col-4 col-form-label">Təqaüd növü</label>
                        <div class="col-8">
                            {{ Form::select('previous_scholarship_type[]', [2 => 'XTP', 1 => 'DTP'],
                             null,
                              ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="previous_scholarship_date" class="col-4 col-form-label">Təqaüd tarixi</label>
                        <div class="col-8">
                            {{ Form::date('previous_scholarship_date[]', null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <hr>
                    <div class="input-group-addon">
                        <a href="javascript:void(0)" class="btn btn-danger" id="delete-scholarship"><span
                                    class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span> Ləğv et</a>
                    </div>
                </div>--}}
        @endif
        <hr>
        <div class="form-group row" id="addMoreScholarshipGroup">
            <div class="col-8 offset-sm-2">
                <button href="javascript:void(0)" class="btn btn-primary" type="button" aria-hidden="true"
                        id="addMoreScholarship">
                    + Təqaüd əlavə et
                </button>
            </div>
        </div>
        <hr>
    </div>
</div> {{--div#scholarshipFieldGroup--}}