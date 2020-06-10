<div class="row form-group">
    <label for="haveBeenIntern" class="col-4 col-form-label">Ödənişli təcrübə proqramı
        çərçivəsində SOCAR-da təcrübə keçmisinizmi?</label>
    <div class="col-8">
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="haveBeenIntern1" value="1"
                   name="haveBeenIntern" required
                   data-error="Lütfən birini seçin" {{ ($user->exists && count($user->previousInternships)) ? 'checked' : null }}>
            <label class="form-check-label" for="haveBeenIntern1">Bəli</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="haveBeenIntern2" value="0"
                   name="haveBeenIntern" {{ ($user->exists && !count($user->previousInternships)) ? 'checked' : null }}>
            <label class="form-check-label" for="haveBeenIntern2">Xeyr</label>
        </div>
        <div class="help-block with-errors"></div>
    </div>
</div>

<div class="internshipSection" id="internshipSection" style="{{ $user->exists && count($user->previousInternships) ? '' : 'display: none' }}">

    @if($user->exists && count($user->previousInternships))
        @foreach($user->previousInternships as $previousInternship)
            <div class="previousInternshipFieldGroup" id="previousInternshipFieldGroup"
                 style="{{ ($user->exists && count($user->previousInternships)) ? '' : 'display: none' }}">
                {{ Form::hidden('internship_id[]', $previousInternship->id) }}
                <div class="form-group row">
                    <label for="internship_department" class="col-4 col-form-label">Təcrübə keçdiyiniz
                        müəssisə</label>
                    <div class="col-8">
                        {{ Form::text('internship_department[]',
                         $previousInternship->department,
                          ['class' => 'form-control here', 'placeholder' => 'Təcrübə keçdiyiniz müəssisə', 'id' => 'internship_department']) }}
                    </div>
                </div>

                <div class="form-group row">
                    <label for="internship_date" class="col-4 col-form-label">Təcrübə keçdiyiniz
                        tarix</label>
                    <div class="col-8">
                        {{ Form::date('internship_date[]',
                        $previousInternship->internship_date,
                         ['class' => 'form-control here', 'id' => 'internship_date']) }}
                    </div>
                </div>
                <hr>
                <div class="input-group-addon">
                    <a href="javascript:void(0)" class="btn btn-danger delete-internship" id="delete-internship"><span
                                class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span> Ləğv et</a>
                </div>
                <br>
            </div>
        @endforeach
    @endif
    {{--<div class="form-group row">--}}
    {{--<label for="internship_department" class="col-4 col-form-label">Təcrübə keçdiyiniz--}}
    {{--müəssisə</label>--}}
    {{--<div class="col-8">--}}
    {{--{{ Form::text('internship_department[]', null, ['class' => 'form-control here', 'placeholder' => 'Təcrübə keçdiyiniz müəssisə', 'id' => 'internship_department']) }}--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--<div class="form-group row">--}}
    {{--<label for="internship_date" class="col-4 col-form-label">Təcrübə keçdiyiniz--}}
    {{--tarix</label>--}}
    {{--<div class="col-8">--}}
    {{--{{ Form::date('internship_date[]', null, ['class' => 'form-control here', 'placeholder' => now(), 'id' => 'internship_date']) }}--}}
    {{--</div>--}}
    {{--</div>--}}
    <hr>
    <div class="form-group row" id="addMoreInternshipGroup">
        <div class="col-8 offset-sm-2">
            <button href="javascript:void(0)" class="btn btn-primary" type="button" aria-hidden="true"
                    id="addMoreInternship">
                + Təcrübə əlavə et
            </button>
        </div>
    </div>
</div>