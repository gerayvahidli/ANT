@extends('layouts.app')

@section('mainSection')
    <section class="profile">
        <div class="row">
            <h3 class='mx-auto'>
                {{--Profil - --}} {{ ($user->exists) ? $user->FirstName . ' ' . $user->LastName : '' }}
            </h3>
        </div>
        <div class="row">
            <h5 class="mx-auto">
                {{ (isset($finalEducation)) ? $finalEducation->educationLevel->Name : ''}}
            </h5>
        </div>
        <hr>
        <div class="row">
            <div class="col-12 col-sm-5 right-dotted-line">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="{{ asset((isset($user->image)) ? $user->image :'img/l60Hf.png') }}"
                         alt="Card image cap">
                    {{--<div class="card-body">--}}
                    {{--<p class="card-text">{{ $user->FirstName . ' ' . $user->LastName }}</p>--}}
                    {{--</div>--}}
                </div>
                <hr>
                <div class="row">
                    <div class="col-6">
                        <a href="{{ url('profile/' . $user->id . '/edit') }}" class="btn btn-outline-primary btn-block"><i
                                    class="fa fa-edit"></i> Dəyiş</a>
                    </div>
                    <div class="col-6">
                        @if($user->exists)
                            <a href="{{ route('profile.feedback.show') }}" class="btn btn-outline-primary btn-block"><i
                                        class="fa fa-envelope-o"></i> Email göndər</a>
                        @endif
                    </div>
                </div>

                <hr>

                {{--<a href="{{ route(['profile.edit', $user->id]) }}"></a>--}}
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <tbody>
                        <tr>
                            <th>Cins</th>
                            <td>

                                @if(isset( $user->gender->Name ))
                                    {{  $user->gender->Name }}
                                @endif

                                </td>
                        </tr>
                        <tr>
                            <th>Vətəndaşlığı</th>
                            <td>{{ $user->country->Name }}</td>
                        </tr>
                        <tr>
                            <th>Təvəllüd</th>
                            <td>{{ $user->Dob->formatLocalized('%d %B %Y') }}</td>
                        </tr>
                        <tr>
                            <th>Anadan olduğu yer</th>
                            <td>{{ $user->city->Name }}</td>
                        </tr>
                        <tr>
                            <th>Ünvan</th>
                            <td>{{ $user->Address }}</td>
                        </tr>
                        <tr>
                            <th>E-mail</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>Telefon</th>
                            <td>
                                @foreach($user->phones as $phoneNumber)
                                    {{ $phoneNumber->operatorCode->Code . $phoneNumber->PhoneNumber }}
                                    <br>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>Şəxsiyyət vəsiqəsinin nömrəsi</th>
                            <td>{{ $user->IdentityCardNumber }}</td>
                        </tr>
                        <tr>
                            <th>Şəxsiyyət vəsiqəsinin FİN kodu</th>
                            <td>{{ $user->IdentityCardCode }}</td>
                        </tr>
                        <tr>
                            <th>Anasının qızlıq soyadı</th>
                            <td>{{ $user->MaidenSurname }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                @include('frontend.profile.partials.programApplicationAndTrackingPanel')
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

                <div class="collapse" id="collapsePreviousEducation">
                    @forelse($previousEducations as $previousEducation)
                        <br>
                        <div class="card">
                            <h5 class="card-header">
                                Əvvəlki Təhsil {{ $loop->iteration }}
                            </h5>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-borderless">
                                        <tbody>
                                        <tr>
                                            <th>Ölkə</th>
                                            <td>{{ $previousEducation->university->country->Name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Universitet</th>
                                            <td>{{ $previousEducation->university->Name }}</td>
                                        </tr>
                                        @php($date = date_create_from_format('Y-m-d H:i:s', '1800-01-01 00:00:00'))
                                        @if(isset($previousEducation->BeginDate) && $previousEducation->BeginDate != $date)
                                            <tr>
                                                <th>Təhsil Müddəti</th>
                                                <td>{{ $previousEducation->BeginDate->formatLocalized('%d %B %Y') . ' - ' . $previousEducation->EndDate->formatLocalized('%d %B %Y') }}</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <th>İxtisas</th>
                                            <td>
                                                {{ $previousEducation->Speciality }}
                                            </td>
                                        </tr>
                                        @if(isset($previousEducation->AdmissionScore) && $previousEducation->AdmissionScore > 0)
                                            <tr>
                                                <th>Qəbul Balı</th>
                                                <td>{{ $previousEducation->AdmissionScore }}</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    @empty
                        Əvvəlki təhsil daxil edilməyib
                    @endforelse

                </div>
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
                                    <th>SOCAR əməkdaşısınızmı?</th>
                                    {{--{{ dd($user->IsCurrentlyWorkAtSocar) }}--}}
                                    <td>{{ ($user->IsCurrentlyWorkAtSocar) ? 'Bəli' : 'Xeyr' }}</td>
                                </tr>
                                @if($user->IsCurrentlyWorkAtSocar)
                                    <tr>
                                        <th>Tabel nömrəniz</th>
                                        <td>{{ $user->PersonalNumber }}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <th>İş yeriniz haqqında məlumat</th>
                                    <td>{{ $user->WorkCompany }}</td>
                                </tr>
                                <tr>
                                    <th>İş stajınız</th>
                                    <td>{{ $user->WorkExperienceYears }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <hr>

                <div class="card">
                    <h5 class="card-header">
                        Əvvəlki təqaüd haqqında məlumat
                    </h5>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                <tr>
                                    <th>Əvvəlki illərdə təqaüd müsabiqəsində iştirak etmisinizmi?</th>
                                    <td>{{  ($user->hasAppliedToScholarship) ? 'Bəli' : 'Xeyr' }}</td>
                                </tr>
                                <tr>
                                    <th>Təqaüdçü olmusunuzmu?</th>
                                    <td>
                                        {{ (isset($user->previousScholarships) && count($user->previousScholarships)) ? 'Bəli' : 'Xeyr' }}
                                    </td>
                                </tr>
                                @if(isset($user->previousScholarships) && count($user->previousScholarships))
                                    @foreach($user->previousScholarships as $previousScholarship)
                                        <tr>
                                            <th>Hansı ildə</th>
                                            <td>{{ (isset($previousScholarship->scholarship_date)) ? $previousScholarship->scholarship_date->formatLocalized('%d %B %Y') : '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Təqaüd növü</th>
                                            <td>{{ $previousScholarship->programType->Name }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <hr>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <br>
                <div class="card">
                    <h5 class="card-header">
                        Əvvəlki təcrübə haqqında məlumat
                    </h5>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                <tr>
                                    <th>Ödənişli Təcrübə proqramı çərçivəsində SOCAR-da təcrübə keçmisinizmi?</th>
                                    <td>{{ (isset($user->previousInternships) && count($user->previousInternships)) ? 'Bəli' : 'Xeyr' }}</td>
                                </tr>
                                @if(isset($user->previousInternships) && count($user->previousInternships))
                                    @foreach($user->previousInternships as $previousInternship)
                                        <tr>
                                            <th>Təcrübədə olduğunuz müəssisə</th>
                                            <td>{{ $previousInternship->department }}</td>
                                        </tr>
                                        <tr>
                                            <th>Təcrübədə olduğunuz tarix</th>
                                            <td>{{ $previousInternship->internship_date->formatLocalized('%d %B %Y') }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <hr>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection