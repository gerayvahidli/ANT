<?php

namespace App\Http\Middleware;

use App\ExternalProgramApplication;
use App\User;
use Closure;

class CheckExternalProgramApplicant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = User::findOrFail(\Auth::user()->id);
        /*
         * country_id = 5 Azerbaijan
         */
        $program = ExternalProgramApplication::where('program_id', $request->segment(4))->where('user_id', $user->id)->first();
        if (isset($program)) {
            flash('Siz artıq bu proqrama müraciət etmisiniz!')->info();
            return back();
        }

        if ($user->country_id != 5) {
            flash('Əfsuslar olsun ki, siz qeyd edilmiş proqrama müraciət edə bilməzsiniz!')->error();
            return back();
        }

        return $next($request);
    }
}
