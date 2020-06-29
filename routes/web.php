<?php


Route::get('/', function () {
    return view('layouts.app');
});

use App\ProgramType;

Route::get('/abc', function () {
//    echo 'test';exit;
    Artisan::call('config:cache');
});


Route::group([], function () {
    //Login Routes...
    Route::get('/backend/login', 'Auth\AdminAuthController@showLoginForm')->name('admin.login.index');
    Route::post('/backend/login', 'Auth\AdminAuthController@login')->name('admin.login.post');
    Route::get('/backend/logout', 'Auth\AdminAuthController@logout')->name('admin.login.logout');
    Route::get('set-admin-pass', function () {
        $admin = \App\Admin::where('email', 'ilkin.fleydanli@socar.az')->first();
        $admin->update([

        ]);

        return $admin;
    });

    Route::get('create-admin', function () {
        $admin = \App\Admin::create([
            'full_name' => 'Ilkin Fleydanli',
            'user_name' => 'ilkin.fleydanli',
            'email' => 'ilkin.fleydanli@socar.az',

        ]);

        return $admin;
    });

//    Route::get('testservice', function () {
//
//
//    });

// Password reset link request routes...
    /*Route::get('password/email', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.email');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');

    // Password reset routes...
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.request');
    Route::post('password/reset', function())->name('password.reset')*/;

    // Registration Routes...
    /*Route::get('admin/register', 'Auth\AdminAuthController@showRegistrationForm');
    Route::post('admin/register', 'Auth\AdminAuthController@register');*/

//    Route::get( '/admin', 'Admin\DashboardController@index' )->name('admin.dashboard');

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

Route::post('/rel_city', 'UserController@relCity');//Ajax


Route::group(['middleware' => 'auth'], function () {
    Route::get('/profile', 'UserController@index')->name('profile.index');
    Route::get('/profile/{user}/edit', 'UserController@edit')->name('profile.edit');
    Route::match(['post', 'put'], '/profile/store', 'UserController@store')->name('profile.store');
    Route::match(['patch', 'put'], '/profile/{user}/update', 'UserController@update')->name('profile.update');
    Route::get('/profile/{user}/password', 'UserController@editPassword')->name('profile.password.edit');
    Route::match(['patch', 'put'], '/profile/{user}/changePassword', 'UserController@changePassword')->name('profile.password.change');
    Route::get('/profile/feedback', 'UserController@showFeedbackForm')->name('profile.feedback.show');
    Route::post('/profile/feedback', 'UserController@sendFeedbackMailToTis')->name('profile.feedback.send');

    //user program apply
    //Route::get('/apply/{slug}/scholarship', 'UserController@applyScholarship');
    Route::get('/apply/internal/scholarship/{program_id}', 'UserController@applyInternalScholarship')->middleware(\App\Http\Middleware\CheckInternalProgramApplicant::class);

    Route::get('/apply/external/scholarship/{program_id}', 'UserController@program_type')->middleware(\App\Http\Middleware\CheckExternalProgramApplicant::class);
    Route::get('/apply/paid/scholarship/{program_id}', 'UserController@applyPaidScholarship')->middleware(\App\Http\Middleware\CheckInternshipProgramApplicant::class);


    Route::post('/apply/external/scholarship/{program_id}', 'UserController@storeExternal');
    Route::post('/apply/internal/scholarship/{program_id}', 'UserController@storeInternal');
    Route::post('/apply/paid/scholarship/{program_id}', 'UserController@storePaid');


    Route::post('/upload/{slug}/uploadArchiveFile', 'UserController@uploadArchiveFile');//Dropzone issue
    Route::post('/remove/{slug}/file', 'UserController@removeFile');


});

// ajax query routes
Route::post('getUniversitiesByCountry', 'UserController@getUniversitiesByCountry')->name('getUniversityByCountry');
Route::post('checkUniqueEmail', 'UserController@checkUniqueEmail')->name('checkUniqueEmail');
Route::post('checkUniquePinCode', 'UserController@checkUniquePinCode')->name('checkUniquePinCode');
Route::post('deletePreviousEducation', 'UserController@deletePreviousEducation')->name('deletePreviousEducation');
Route::post('deleteInternship', 'UserController@deleteInternship')->name('deleteInternship');
Route::post('deleteScholarship', 'UserController@deleteScholarship')->name('deleteScholarship');
Route::post('getPrametersByFin', 'Auth\RegisterController@getPrametersByFin')->name('getPrametersByFin');

//Route::get('/profile', function () {
//    return view('frontend.profile.index');
//});

/*Route::get('/password/reset', function () {
   return view('auth.passwords.reset');
});
*/

//Route::get( 'change-pass', function () {
//	$user           = \App\User::where( 'email', 'ilkin.fleydanli@socar.az' )->first();
//	$user->password = Hash::make( 'i12345' );
//	$user->save();
//	$user1           = \App\User::where( 'email', 'i.fleydanli@hotmail.com' )->first();
//	$user1->password = Hash::make( 'i12345' );
//	$user1->save();
//	$user2           = \App\User::where( 'email', 'i.fleydanli@gmail.com' )->first();
//	$user2->password = Hash::make( 'i12345' );
//	$user2->save();
//	return [ $user ];
//} );

//Route::get( 'delete-ilkin', function () {
//	try {
//		$user = \App\User::with( 'finalEducation', 'phones', 'previousEducations', 'previousInternships', 'previousScholarships', 'externalProgramApplications', 'internalProgramApplications' )->where( 'email', 'ilkin.fleydanli@socar.az' )->first();
//		$user->finalEducation()->delete();
//		foreach ( $user->phones as $phone ) {
//			$phone->delete();
//		}
//		foreach ( $user->previousEducations as $previous_education ) {
//			$previous_education->delete();
//		}
//		foreach ( $user->previousInternships as $previous_internship ) {
//			$previous_internship->delete();
//		}
//		foreach ( $user->previousScholarships as $previous_scholarship ) {
//			$previous_scholarship->delete();
//		}
//		foreach ( $user->externalProgramApplications as $external_program_application ) {
//			$external_program_application->delete();
//		}
//		foreach ( $user->internalProgramApplications as $internal_program_application ) {
//			$internal_program_application->delete();
//		}
//		$user->delete();
//	} catch ( Exception $e ) {
//		return $e;
//	}
//
//} );

//Auth::routes();


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


//Route::get( 'register', 'UserController@registration' )->name( 'register' );
//Route::post( 'registernew', 'UserController@create' )->name( 'register' );


//Route::get( '/', function () {
//	return redirect( url( '/DTP' ) );
//} )->name('DTP');


/*Route::get('/password/reset', function () {
   return view('auth.passwords.reset');
});*/
//Route::get('/test', 'UserController@test');

/* Api resources start*/
Route::get('/download/external/file/{app_id}', 'UserController@DownloadExtFile');
Route::get('/download/internal/file/{app_id}', 'UserController@DownloadIntFile');
Route::get('/download/paid/file/{app_id}', 'UserController@DownloadPaidFile');

/*Api resources*/


Route::get('/{slug}', 'PageController@show')->name('page.show');
Route::get('/{slug}/news', 'PageController@newsArchive')->name('page.news.archive');
Route::get('/{slug}/faq', 'PageController@faq')->name('page.faq');
Route::get('/{slug}/news/{post}', 'PageController@showPost')->name('page.news.show');
Route::get('/{programType}/terms/{termType}', 'PageController@terms')->name('page.terms');
Route::get('/{programType}/specialities', 'PageController@specialities')->name('page.specialities');
Route::get('terms/{term}', 'PageController@showTerm')->name('page.terms.show');


Route::get('/home', 'HomeController@index')->name('home');


//for xtp (it is temporary)
Route::get('/{slug}/universitylist', function () {
    $page = ProgramType::with('specialities')->where('ShortName', 'XTP')->firstOrFail();
    return view('frontend.pages.externalProgram.unilist')->with(compact('page'));
}

)->name('XTPunilist');

Route::get('/{slug}/requestforExternal', function () {
    $page = ProgramType::with('specialities')->where('ShortName', 'XTP')->firstOrFail();
    return view('frontend.pages.externalProgram.requestExternal')->with(compact('page'));
})->name('XTPrequest');



