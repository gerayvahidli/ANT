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
{{--            <div class="col-12 col-sm-5 right-dotted-line">--}}
{{--                <div class="card" style="width: 18rem;">--}}
{{--                    <img class="card-img-top" src="{{ asset((isset($user->image)) ? $user->image :'img/l60Hf.png') }}"--}}
{{--                         height="160" alt="Card image cap">--}}
{{--                    <div class="card-body">--}}
{{--                        <p class="card-text">{{ $user->FirstName . ' ' . $user->LastName }}</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="table-responsive">--}}
{{--                    <table class="table table-borderless">--}}
{{--                        <tbody>--}}
{{--                        <tr>--}}
{{--                            <td>Vətəndaşlığı</td>--}}
{{--                            <td>{{ $user->country->Name }}</td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td>Təvəllüd</td>--}}
{{--                            <td>{{ $user->Dob->formatLocalized('%d %B %Y') }}</td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td>Anadan olduğu yer</td>--}}
{{--                            <td>{{ $user->city->Name }}</td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td>Ünvan</td>--}}
{{--                            <td>{{ $user->Address }}</td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td>E-mail</td>--}}
{{--                            <td>{{ $user->email }}</td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td>Telefon</td>--}}
{{--                            <td>--}}
{{--                                @foreach($user->phones as $phoneNumber)--}}
{{--                                    {{ $phoneNumber->operatorCode->Code . $phoneNumber->PhoneNumber }}--}}
{{--                                    <br>--}}
{{--                                @endforeach--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td>Şəxsiyyət vəsiqəsinin nömrəsi</td>--}}
{{--                            <td>{{ $user->IdentityCardNumber }}</td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td>Şəxsiyyət vəsiqəsinin FİN kodu</td>--}}
{{--                            <td>{{ $user->IdentityCardCode }}</td>--}}
{{--                        </tr>--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                </div>--}}
{{--            </div>--}}

            <div class="col-12 col-sm-7 container-fluid">
                @if(isset($user->phones->first()->PhoneNumber))
                    {{ Form::hidden('phone_number', $user->phones->first()->operatorCode->Code . $user->phones->first()->PhoneNumber) }}
                    {{--{{ Form::hidden('full_name', Auth::user()->LastName . ' ' . Auth::user()->FirstName . ' ' . Auth::user()->FatherName) }}--}}
                    {{--{{ Form::hidden('phone_number', $user->phones->first()->operatorCode->Code . $user->phones->first()->PhoneNumber) }}--}}
                    {{--{{ Form::hidden('phone_number', $user->phones->first()->operatorCode->Code . $user->phones->first()->PhoneNumber) }}--}}
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