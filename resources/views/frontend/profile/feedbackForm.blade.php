@extends('layouts.app')

@section('mainSection')

    <section class="profile">
        <div class="row">
            <h3 class="mx-auto">
                Müraciət
            </h3>
            <br>
        </div>
        {{ Form::open([
            'route' => ['profile.feedback.send'],
            'method' => 'post',
            'files' => true,
        ]) }}
        <div class="row">

            <div class="col-12 col-sm-7 container-fluid">

                @if(isset($user->phones->first()->PhoneNumber))
                    {{ Form::hidden('phone_number', $user->phones->where('PhoneTypeId',2) ->first()->operatorCode->Name . $user->phones->first()->PhoneNumber) }}
                @else
                    <div class="form-group row ">
                        <label for="phone_number" class="col-md-4 col-form-label">Telefon Nömrəsi</label>

                        <div class="col-8">
                            <input id="phone_number" type="text"
                                   class="form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}"
                                   name="phone_number"
                                   required>

                            @if ($errors->has('phone_number'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('phone_number') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <div class="form-group row required">
                    <label for="message" class="col-md-4 col-form-label">Müraciətin mətni</label>

                    <div class="col-8">
                        {{ Form::textarea('message', null, ['class' => ($errors->first('message')) ? 'form-control is-invalid': 'form-control']) }}

                        @if ($errors->has('message'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('message') }}</strong>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="file" class="col-md-4 col-form-label">Fayl</label>

                    <div class="col-8">
                        {{ Form::file('file', ['class' => 'form-control']) }}

                        @if ($errors->has('file'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('file') }}</strong>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <div class="offset-4 col-8">
                        {{ Form::submit('Göndər', ['class' => 'btn btn-primary']) }}
                        <button type="button" onclick="window.history.back();" class="btn btn-danger">Geri</button>
                    </div>
                </div>

            </div>
        </div>
        {{ Form::close() }}
    </section>
@endsection