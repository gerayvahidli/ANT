@extends('layouts.app')

@section('mainSection')
    <section class="profile">

        <div class="row">
            <h5 class="mx-auto">
                PROFİL
            </h5>
        </div>
        <hr>
        <div class="row">
            <div class="col-12 col-sm-5 right-dotted-line">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="{{ asset((isset($user->ImagePath)) ? $user->ImagePath :'img/l60Hf.png') }}"
                         alt="Card image cap">
                    {{--<div class="card-body">--}}
                    {{--<p class="card-text">{{ $user->FirstName . ' ' . $user->LastName }}</p>--}}
                    {{--</div>--}}
                </div>
                <div class="row">
                    <h3 class='mx-auto'>
                        {{--Profil - --}} {{ ($user->exists) ? $user->FirstName . ' ' . $user->LastName. ' ' . $user->FatherName : '' }}
                    </h3>
                </div>
{{--                <hr>--}}
{{--                <div class="row">--}}
{{--                    <div class="col-6">--}}
{{--                        <a href="{{ url('profile/' . $user->id . '/edit') }}" class="btn btn-outline-primary btn-block"><i--}}
{{--                                    class="fa fa-edit"></i> Dəyiş</a>--}}
{{--                    </div>--}}
{{--                    <div class="col-6">--}}
{{--                        @if($user->exists)--}}
{{--                            <a href="{{ route('profile.feedback.show') }}" class="btn btn-outline-primary btn-block"><i--}}
{{--                                        class="fa fa-envelope-o"></i> Email göndər</a>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                </div>--}}

                <hr>

                {{--<a href="{{ route(['profile.edit', $user->id]) }}"></a>--}}
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <tbody>
                        <tr>
                            <th>Cins</th>
                            <td>

                                @if(isset( $user->GenderId ))
                                    @if($user->GenderId == 1)
                                        Kişi
                                    @elseif($user->GenderId == 1)
                                        Qadın
                                    @endif
                                @endif

                            </td>
                        </tr>
                        <tr>
                            <th>Vətəndaşlığı</th>
                            <td>{{ $user->country->Name }}</td>
                        </tr>
                        <tr>
                            <th>Təvəllüd</th>
                            <td>{{ date('d-m-Y', strtotime($user->Dob)) }}</td>
                        </tr>
                        <tr>
                            <th>Doğum yeri</th>
                            <td>{{ $user-> BirthCity -> Name }}</td>
                        </tr>
                        <tr>
                            <th>Qeydiyyat ünvanı</th>
                            <td>{{ $user -> AddressMain }}</td>
                        </tr>
                        <tr>
                            <th>Faktiki yaşayış ünvanı</th>
                            <td>{{ $user->Address2 }}</td>
                        </tr>
                        <tr>
                            <th>Şəhər telefon nömrəsi</th>
                            <td>{{$homePhone->operatorCode->Name . $homePhone -> PhoneNumber}}</td>
                        </tr>
                        <tr>
                            <th>Mobil telefon nömrəsi(daim işlək olan nömrə)</th>
                            <td>
                                @foreach($user->phones -> where('PhoneTypeId',1) as $phoneNumber)
                                    {{$phoneNumber->operatorCode->Name .  $phoneNumber->PhoneNumber }}
                                    <br>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>İşçinin korparativ emaili</th>
                            <td>{{ $user -> email }}</td>
                        </tr>
                        <tr>
                            <th>Elektron poçt ünvanı(şəxsi)</th>
                            <td>
                                @foreach($user->emails as $email)
                                    {{  $email->email }}
                                    <br>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>Şəxsiyyət vəsiqəsinin nömrəsi</th>
                            <td>{{ $user->PassportNo }}</td>
                        </tr>
                        <tr>
                            <th>Şəxsiyyət vəsiqəsinin FİN kodu</th>
                            <td>{{ $user->Fin }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
{{--                @include('frontend.profile.partials.programApplicationAndTrackingPanel')--}}
                <div class="row">
                    <div class="col-4">
                        <a href="{{ url('profile/' . $user->id . '/edit') }}" class="btn btn-outline-primary btn-block"><i
                                    class="fa fa-edit"></i>Profili dəyiş</a>
                        @if($user->exists)
                                    <a href="{{ url('/profile/' . $user->id . '/password') }}" class="btn btn-outline-primary btn-block">Şifrəni dəyiş</a>
                        @endif
                    </div>

                    <div class="col-4">
                        @if($user->exists)
                            <a href="{{ route('profile.feedback.show') }}" class="btn btn-outline-primary btn-block"><i
                                        class="fa fa-envelope-o"></i> Email göndər</a>
                        @endif
                    </div>

                    <div class="col-4">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="">
                            @csrf
                            <button type="submit" class="btn btn-outline-primary btn-block">Çıxış</button>
                        </form>
                    </div>

                </div>
            </div>
            <div class="col-12 col-sm-7">
                @if (isset($finalEducation))
                    <div class="card">
                        <h5 class="card-header">Cari Təhsiliniz Haqqında Məlumat</h5>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <tbody>

                                    {{--<center><p class="lead">Son Təhsil Haqqında Məlumat </p></center>--}}

                                    <tr>
                                        <th>Təhsil pilləsi</th>
                                        <td>Magistr</td>
                                    </tr>

                                    <tr>
                                        <th>Ölkə</th>
{{--                                        <td>{{ $finalEducation->university->country->Name }}</td>--}}
                                    </tr>
                                    <tr>
                                        <th>Universitet</th>
{{--                                        <td>{{ $finalEducation->university->Name }}</td>--}}
                                    </tr>
                                    <tr>
                                        <th>Təhsil Müddəti</th>
                                        <td>2015-2019</td>
                                    </tr>
                                    <tr>
                                        <th>Orta bal</th>
                                        <td>65.2</td>
                                    </tr>
                                    <tr>
                                        <th>Fakültə</th>
                                        <td>{{ $finalEducation->Faculty }}</td>
                                    </tr>
                                    <tr>
                                        <th>İxtisas</th>
                                        <td>
                                            {{ $finalEducation->Speciality }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Qəbul Balı</th>
                                        <td>{{ $finalEducation->AdmissionScore }}</td>
                                    </tr>
                                    <tr>
                                        <th>Bölmə</th>
                                        <td>{{ $finalEducation->educationSection }}</td>
                                    </tr>
                                    <tr>
                                        <th>Təhsil forması</th>
                                        <td>{{ $finalEducation->educationForm }}</td>
                                    </tr>
                                    <tr>
                                        <th>Təhsil Qrupu</th>
                                        <td>{{ $finalEducation->educationPaymentForm }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{--<div class="table-responsive">
                        <table class="table table-borderless">
                            <tbody>

                            <center><p class="lead">Son Təhsil Haqqında Məlumat </p></center>

                            <tr>
                                <th>Ölkə</th>
                                <td>{{ $finalEducation->university->country->Name }}</td>
                            </tr>
                            <tr>
                                <th>Universitet</th>
                                <td>{{ $finalEducation->university->Name }}</td>
                            </tr>
                            <tr>
                                <th>Təhsil Müddəti</th>
                                <td>{{ $finalEducation->BeginDate->formatLocalized('%d %B %Y') . ' - ' . $finalEducation->EndDate->formatLocalized('%d %B %Y') }}</td>
                            </tr>
                            <tr>
                                <th>Kurs</th>
                                <td>{{ $finalEducation->CurrentEduYear }}</td>
                            </tr>
                            <tr>
                                <th>Fakültə</th>
                                <td>{{ $finalEducation->Faculty }}</td>
                            </tr>
                            <tr>
                                <th>İxtisas</th>
                                <td>
                                    {{ $finalEducation->Speciality }}
                                </td>
                            </tr>
                            <tr>
                                <th>Qəbul Balı</th>
                                <td>{{ $finalEducation->AdmissionScore }}</td>
                            </tr>
                            <tr>
                                <th>Bölmə</th>
                                <td>{{ $finalEducation->educationSection->Name }}</td>
                            </tr>
                            <tr>
                                <th>Təhsil forması</th>
                                <td>{{ $finalEducation->educationForm->Name }}</td>
                            </tr>
                            <tr>
                                <th>Təhsil Qrupu</th>
                                <td>{{ $finalEducation->educationPaymentForm->Name }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>--}}
                    <br>
                @endif

                <button class="btn btn-primary col-6" type="button" data-toggle="collapse"
                        data-target="#collapsePreviousEducation" aria-expanded="false"
                        aria-controls="collapsePreviousEducation">
                    Əvvəlki təhsil
                </button>

{{--                <div class="collapse" id="collapsePreviousEducation">--}}
{{--                    @forelse($previousEducations as $previousEducation)--}}
{{--                        <br>--}}
{{--                        <div class="card">--}}
{{--                            <h5 class="card-header">--}}
{{--                                Əvvəlki Təhsil {{ $loop->iteration }}--}}
{{--                            </h5>--}}
{{--                            <div class="card-body p-0">--}}
{{--                                <div class="table-responsive">--}}
{{--                                    <table class="table table-borderless">--}}
{{--                                        <tbody>--}}
{{--                                        <tr>--}}
{{--                                            <th>Təhsil pilləsi</th>--}}
{{--                                            <td>Bakalavr</td>--}}
{{--                                        </tr>--}}
{{--                                        <tr>--}}
{{--                                            <th>Ölkə</th>--}}
{{--                                            <td>{{ $previousEducation->university->country->Name }}</td>--}}
{{--                                        </tr>--}}
{{--                                        <tr>--}}
{{--                                            <th>Universitet</th>--}}
{{--                                            <td>{{ $previousEducation->university->Name }}</td>--}}
{{--                                        </tr>--}}
{{--                                        @php($date = date_create_from_format('Y-m-d H:i:s', '1800-01-01 00:00:00'))--}}
{{--                                        @if(isset($previousEducation->BeginDate) && $previousEducation->BeginDate != $date)--}}
{{--                                            <tr>--}}
{{--                                                <th>Təhsil Müddəti</th>--}}
{{--                                                <td>1998-2020</td>--}}
{{--                                            </tr>--}}
{{--                                        @endif--}}
{{--                                        <tr>--}}
{{--                                            <th>İxtisas</th>--}}
{{--                                            <td>--}}
{{--                                                {{ $previousEducation->Speciality }}--}}
{{--                                            </td>--}}
{{--                                        </tr>--}}
{{--                                        @if(isset($previousEducation->AdmissionScore) && $previousEducation->AdmissionScore > 0)--}}
{{--                                            <tr>--}}
{{--                                                <th>Qəbul Balı</th>--}}
{{--                                                <td>{{ $previousEducation->AdmissionScore }}</td>--}}
{{--                                            </tr>--}}
{{--                                        @endif--}}
{{--                                        </tbody>--}}
{{--                                    </table>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                    @empty--}}
{{--                        Əvvəlki təhsil daxil edilməyib--}}
{{--                    @endforelse--}}

{{--                </div>--}}
                <hr>

                <div class="card">
                    <h5 class="card-header">
                        İş yeri haqqında məlumat
                    </h5>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                <tr>
                                    <th colspan="2">İş yeri haqqında məlumat</th>
                                </tr>
                                <tr>
                                    <th>Müəssisə</th>
                                    {{--{{ dd($user->IsCurrentlyWorkAtSocar) }}--}}
                                    <td>"Azneft" İstehsalat Birliyi</td>
                                </tr>
                                <tr>
                                    <th>Təşkilat</th>
                                    <td>Neft Kəmərləri İdarəsi</td>
                                </tr>
                                <tr>
                                    <th>Struktur Bölmə</th>
                                    <td>Texniki istehsalat şöbəsi</td>
                                </tr>
                                <tr>
                                    <th>Vəzifə</th>
                                    <td>Şöbə rəisinin müavini</td>
                                </tr>
                                <tr>
                                    <th>İşə qəbul tarixi</th>
                                    <td>23 sentyabr 1998</td>
                                </tr>
                                <tr>
                                    <th>Tabel nömrəniz</th>
                                    <td>4039896</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <br>
                <button class="btn btn-primary col-6" type="button" data-toggle="collapse"
                        data-target="#collapsePreviousWork" aria-expanded="false"
                        aria-controls="collapsePreviousWork">
                    Əvvəlki iş yeri
                </button>
                <hr>
                <div class="collapse" id="collapsePreviousWork">
                    <br>
                    <div class="card">
                        <h5 class="card-header">
                            Əvvəlki iş yeri 1
                        </h5>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <tbody>
                                    <tr>
                                        <th colspan="2">İş yeri haqqında məlumat</th>
                                    </tr>
                                    <tr>
                                        <th>Müəssisə</th>
                                        {{--{{ dd($user->IsCurrentlyWorkAtSocar) }}--}}
                                        <td>"Azneft" İstehsalat Birliyi</td>
                                    </tr>
                                    <tr>
                                        <th>Təşkilat</th>
                                        <td>Neft Kəmərləri İdarəsi</td>
                                    </tr>
                                    <tr>
                                        <th>Struktur Bölmə</th>
                                        <td>Texniki istehsalat şöbəsi</td>
                                    </tr>
                                    <tr>
                                        <th>Vəzifə</th>
                                        <td>Şöbə rəisinin müavini</td>
                                    </tr>
                                    <tr>
                                        <th>İşə qəbul tarixi</th>
                                        <td>23 sentyabr 1998</td>
                                    </tr>
                                    <tr>
                                        <th>İşdən ayrılma tarixi</th>
                                        <td>21 sentyabr 2010</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
@endsection