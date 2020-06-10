@extends('layouts.app')

@section('mainSection')
    <section class="slider-section">
        <header>
            <H3>DTP</H3>
        </header>
        <section class="main-slider">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="{{ asset('img/backgrounds/001.jpg') }}" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('img/slides/slide-xtp.jpg') }}" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('img/slides/slide-dtp.jpg') }}" alt="Third slide">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </section> {{--main-slider--}}
    </section> {{--slider-section--}}

    <section>
        <div class="row">
            <div class="col-12 col-md-8">
                <article class="card">
                    <div class="card-body">
                        <h5 class="card-title"> Article 1 </h5>
                        <p class="card-text">
                            ARDNŞ-də karyeranın idarə edilməsi dedikdə müəssisənin və işçinin inkişafına xidmət edən, işçinin xidməti və fərdi keyfiyyət göstəricilərinə uyğun olaraq xidməti irəliləyiş sisteminin planlaşdırılması və həyata keçirilməsi üzrə kompleks tədbirlər başa düşülür.

                            03.09.2013-cü il tarixində ARDNŞ rəhbərliyinin iştirakı ilə sistemin pilot layihəsinin tətbiqinin nəticələri ilə bağlı keçirilmiş təqdimatda ARDNŞ prezidenti sistemin ARDNŞ-nin strukturunda yer alan digər müəssisələrində (təşkilatlarında) tətbiqinə göstəriş vermişdir. Bununla bağlı olaraq 09.09.2013-cü il tarixindən etibarən Heydər Əliyev Adına Bakı Neft Emalı Zavodu, “Azərikimya” İstehsalat Birliyi, “Azərneftyağ” Neft Emalı Zavodu, Qaz Emalı Zavodu, Əmək Şəraiti Normalarının İşlənməsi İdarəsi, Təlim Tədris və Sertifikatlaşdırma idarəsi, “Neftqazelmitətqiqatlayihə” İnstitutunuda sistemin tətbiqinə start verilmişdir.

                            Layihə çərçivəsində artıq aşağıdakı işlər yekunlaşdırılmışdır:
                            * Sistemin tətbiqi üçün SAP BRP sistemi ilə inteqrasiya edilmiş yeni proqram təminatı hazırlanmışdır;
                            * Ümumiyyətlə sistem haqqında məlumat vermək və proqram təminatından istifadəni rahatlaşdırmaq məqsədilə “yaddaş kitabçası” hazırlanaraq işçilərə təqdim edilmişdir;
                            * Mövcud olan bütün vəzifələr üzrə əmək funksiyaları SAP-BRP sisteminə daxil edilmişdir;
                            * Mövcud olan bütün vəzifələr oxşar fəaliyyət sahələri üzrə qruplaşdırılmışdır;
                            * Mövcud olan bütün vəzifələr üzrə staj tələbləri işlənərək SAP BRP sisteminə yüklənilmişdir;
                            * SAP BRP sistemində işçilərin şəxsi məlumatları, təhsil məlumatları, əmək fəaliyyəti (staj) məlumatları və digər zəruri olan məlumatların tamlığı və düzgünlüyü təmin edilmişdir;
                            * İşçilərin təhsil istiqamətləri fəaliyyət sahələri üzrə qruplaşdırılaraq SAP BRP sisteminə yüklənilmişdir;
                            * Müəssisə və təşkilatların Kadrlar şöbələrinin rəisləri və əməkdaşlarına hər birinə sistemin tətbiqi ilə bağlı İRD-nin inzibati binasında marifləndirici təlimlər (2 günlük) keçirilmişdir;
                            * Müəssisələr üzrə 700-dən çox struktur bölmənin rəhbərinə müəssisələrin (təşkilatların) inzibati binasında 27 çağrışda marifləndirici təlimlər təşkil edilərək sistemdən istifadə qaydaları visual olaraq göstərilmiş və sistemin gözlənilən nəticəsi ilə bağlı ətraflı məlumat verilmişdir.
                        </p>
                    </div>
                </article>
            </div>
            <div class="col-md-4">
                <div class="accordion" id="accordion">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Collapsible Group Item #1
                                </button>
                            </h5>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Collapsible Group Item #2
                                </button>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Collapsible Group Item #3
                                </button>
                            </h5>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                            <div class="card-body">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection