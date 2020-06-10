<?php

namespace App\Http\Controllers\Auth;

use App\Admin;
use GuzzleHttp\Client;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\ValidationException;

class AdminAuthController extends Controller
{
	use AuthenticatesUsers;

//	protected $redirectTo = '/teacher/home';
	protected $redirectTo = '/admin';
	protected $guard      = 'admin';

	public function __construct ()
	{
		$this->middleware( 'guest:admin' )->except( 'logout' );
	}

	protected function guard ()
	{
		return Auth::guard( 'admin' );
	}

	public function showLoginForm ()
	{
		/*if (view()->exists('auth.login')) {
			return view('auth.login');
		}*/
//	    dd(phpinfo());
		return view( 'auth.adminLogin' );
	}

	/**
	 * @param \Illuminate\Http\Request $request
	 */
	public function login ( Request $request )
	{
		// Validate the form data
		$this->validate( $request, [
			'email'    => 'required|email',
			'password' => 'required|min:6'
		] );

		$admin = Admin::where( 'email', $request->email )->first();

		if ( isset( $admin ) ) {
			$ldapUser = $this->connectToLdap( $admin, $request->password );
			if (isset($ldapUser)){
				$user = $this->syncPassword($admin, $request->password);
				if (isset($user)) {
//					dd($user);
					// Attempt to log the user in
//					dd(\Auth::guard('admin')->login($user));
//dd($request);
//dd(Auth::guard( 'admin' )->attempt( [ 'email' => $request->email, 'password' => $request->password ]));
					if ( Auth::guard( 'admin' )->attempt( [ 'email' => $request->email, 'password' => $request->password ], $request->remember ) ) {
						// if successful, then redirect to their intended location
						return redirect()->intended( route( 'admin.dashboard' ) );
					}
				}
			}
//			dd( $ldapUser[ 0 ][ "samaccountname" ][ 0 ] );
//			dd( Auth::guard( 'admin' )->attempt( [ 'email' => $request->email, 'password' => $request->password ] ) );
		}
			// if unsuccessful, then redirect back to the login with the form data
			return redirect()->back()->withInput( $request->only( 'email', 'remember' ) );
	}

	protected function syncPassword ( $user, $password )
	{
		if (hash_equals($user->password, $password)){
			return $user;
		}
		$user->update(['password' => \Hash::make($password)]);
		$user->save();
		return $user;
	}

	public function showRegistrationForm ()
	{
		return view( 'admin.auth.register' );
	}

	protected function sendFailedLoginResponse ( Request $request )
	{
		throw ValidationException::withMessages( [
			'email' => [ trans( 'auth.failed' ) ],
		] );
	}

	protected function connectToLdap ( $user, $password )
	{
		$adServer = "ldap://192.168.1.114";

		$ldap     = ldap_connect( $adServer );
		$username = $user->user_name;
		$password = $password;

		$ldaprdn = 'socar' . "\\" . $username;

		ldap_set_option( $ldap, LDAP_OPT_PROTOCOL_VERSION, 3 );
		ldap_set_option( $ldap, LDAP_OPT_REFERRALS, 0 );

		$bind = @ldap_bind( $ldap, $ldaprdn, $password );


		if ( $bind ) {
			$filter = "(sAMAccountName=$username)";
			$result = ldap_search( $ldap, "dc=socar,dc=local", $filter );
//		        ldap_sort($ldap,$result,"sn");
			$info = ldap_get_entries( $ldap, $result );
			if ( $info[ 'count' ] == 1 ) {
				return $info;
			}
			/*for ( $i = 0; $i < $info[ "count" ]; $i++ ) {
				if ( $info[ 'count' ] > 1 )
					break;
				echo "<p>You are accessing <strong> " . $info[ $i ][ "sn" ][ 0 ] . ", " . $info[ $i ][ "givenname" ][ 0 ] . "</strong><br /> (" . $info[ $i ][ "samaccountname" ][ 0 ] . ")</p>\n";
				echo '<pre>';
				var_dump( $info );
				echo '</pre>';
				$userDn = $info[ $i ][ "distinguishedname" ][ 0 ];
			}
			dd($info);*/
			@ldap_close( $ldap );
		}
		return false;

	}
}
