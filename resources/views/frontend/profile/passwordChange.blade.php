@extends('layouts.app')

@section('mainSection')
    <section class="profile">
        <div class="row">
            <h3 class="mx-auto">
                Şifrə dəyiş
            </h3>
            <br>
        </div>
        {{ Form::open([
            'route' => ['profile.password.change', $user],
            'method' => 'put',
        ]) }}
        <div class="row">
            <div class="col-12 col-sm-5 right-dotted-line">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="{{ asset((isset($user->image)) ? $user->image :'img/l60Hf.png') }}" height="160" alt="Card image cap">
                    <div class="card-body">
                        <p class="card-text">{{ $user->FirstName . ' ' . $user->LastName }}</p>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <tbody>
                        <tr>
                            <td>Vətəndaşlığı</td>
                            <td>{{ $user->country->Name }}</td>
                        </tr>
                        <tr>
                            <td>Təvəllüd</td>
                            <td>{{ $user->Dob->formatLocalized('%d %B %Y') }}</td>
                        </tr>
                        <tr>
                            <td>Anadan olduğu yer</td>
                            <td>{{ $user->city->Name }}</td>
                        </tr>
                        <tr>
                            <td>Ünvan</td>
                            <td>{{ $user->Address }}</td>
                        </tr>
                        <tr>
                            <td>E-mail</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <td>Telefon</td>
                            <td>
                                @foreach($user->phones as $phoneNumber)
                                    {{ $phoneNumber->operatorCode->Code . $phoneNumber->PhoneNumber }}
                                    <br>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td>Şəxsiyyət vəsiqəsinin nömrəsi</td>
                            <td>{{ $user->IdentityCardNumber }}</td>
                        </tr>
                        <tr>
                            <td>Şəxsiyyət vəsiqəsinin FİN kodu</td>
                            <td>{{ $user->IdentityCardCode }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-12 col-sm-7">
                <div class="form-group row">
                    <label for="current_password" class="col-md-4 col-form-label">Cari Şifrə</label>

                    <div class="col-8">
                        <input id="current_password" type="password"
                               class="form-control{{ $errors->has('current_password') ? ' is-invalid' : '' }}" name="current_password"
                               required>

                        @if ($errors->has('current_password'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('current_password') }}</strong>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label">Şifrə</label>

                    <div class="col-8">
                        <input id="password" type="password"
                               class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                               required>

                        @if ($errors->has('password'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('password') }}</strong>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 col-form-label">Şifrəni təkrarla</label>

                    <div class="col-8">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                               required>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="offset-4 col-8">
                        {{ Form::submit('Yadda saxla', ['class' => 'btn btn-primary']) }}
                    </div>
                </div>

            </div>
        </div>
        {{ Form::close() }}
    </section>
@endsection