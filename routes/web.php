<?php


Route::get('/', function () {
    return view('layouts.app');
});

use App\ProgramType;

Route::get('/abc', function () {
//    echo 'test';exit;
    Artisan::call('config:cache');
});




Route::get('/backend/login', function () {
        return redirect(Config::get('app.url').'/DTP/backend/login');
    });

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.', 'middleware' => 'auth:admin'], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::resource('/articles', 'ArticlesController');
    Route::resource('/terms', 'TermsController');
    Route::resource('/termTypes', 'TermTypesController');
    Route::resource('/faq', 'FAQController');
    Route::resource('/slides', 'SlidesController');
    Route::resource('/specialities', 'SpecialityController');
});



Route::post('/get_news_by_month', 'PageController@getNewsByMonth');//Ajax
Route::post('/get_news_by_day', 'PageController@getNewsByDay');//Ajax
Route::post('/get_current_month_news_and_available_dates', 'PageController@getCurrentMonthNewsAndAvailableDates');//Ajax

Route::group(['middleware' => 'auth'], function () {
    Route::get('/profile', 'UserController@index')->name('profile.index');
    Route::get('/profile/{user}/edit', 'UserController@edit')->name('profile.edit');
    Route::match(['post', 'put'], '/profile/store', 'UserController@store')->name('profile.store');
    Route::match(['patch', 'put'], '/profile/{user}/update', 'UserController@update')->name('profile.update');
    Route::get('/profile/password', 'UserController@editPassword')->name('profile.password.edit');
    Route::match(['patch', 'put'], '/profile/changePassword', 'UserController@changePassword')->name('profile.password.change');
    Route::get('/profile/feedback', 'UserController@showFeedbackForm')->name('profile.feedback.show');
    Route::post('/profile/feedback', 'UserController@sendFeedbackMailToTis')->name('profile.feedback.send');

    Route::get('/apply', 'UserController@showApplyScholarshipForm')->name('showApplyScholarshipForm');
    Route::post('apply', 'UserController@applyScholarship')->name('applyScholarship');//Ajax

    Route::post('/rel_city', 'UserController@relCity');//Ajax
    Route::post('/rel_country', 'UserController@relCountry');//Ajax
    Route::post('/rel_university', 'UserController@relUniversity');//Ajax
    Route::post('/rel_specialization', 'UserController@relSpecialization');//Ajax

});

// ajax query routes
Route::post('getUniversitiesByCountry', 'UserController@getUniversitiesByCountry')->name('getUniversityByCountry');
Route::post('deletePreviousEducation', 'UserController@deletePreviousEducation')->name('deletePreviousEducation');
Route::post('deletePreviousJob', 'UserController@deletePreviousJob')->name('deletePreviousJob');
Route::post('getPrametersByFin', 'Auth\RegisterController@getPrametersByFin')->name('getPrametersByFin');


//salam



// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
$this->post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');;



/* Api resources start*/
Route::get('/download/external/file/{app_id}', 'UserController@DownloadExtFile');
Route::get('/download/internal/file/{app_id}', 'UserController@DownloadIntFile');
Route::get('/download/paid/file/{app_id}', 'UserController@DownloadPaidFile');

/*Api resources*/


Route::get('/', 'PageController@show')->name('page.show');
Route::get('/news', 'PageController@newsArchive')->name('page.news.archive');
Route::get('/faq', 'PageController@faq')->name('page.faq');
Route::get('/news/{post}', 'PageController@showPost')->name('page.news.show');
Route::get('/terms/{termType}', 'PageController@terms')->name('page.terms');
Route::get('/specialities', 'PageController@specialities')->name('page.specialities');
Route::get('terms/{term}', 'PageController@showTerm')->name('page.terms.show');


Route::get('/home', 'HomeController@index')->name('home');


//for xtp (it is temporary)
Route::get('/universitylist', function () {
    $page = ProgramType::with('specialities')->where('ShortName', 'XTP')->firstOrFail();
    return view('frontend.pages.externalProgram.unilist')->with(compact('page'));
}

)->name('XTPunilist');






