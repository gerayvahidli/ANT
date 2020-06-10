<?php

namespace App\Http\Middleware;

use App\InternalProgramApplication;
use App\User;
use Closure;

class CheckInternshipProgramApplicant
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
        $user = User::with('finalEducation')->findOrFail(\Auth::user()->id);
        // if user already applied to this program return with message
        $program = InternalProgramApplication::where('program_id', $request->segment(4))
                                             ->where('user_id', $user->id)->first()
        ;
        if (isset($program)) {
            flash('Siz artıq bu proqrama müraciət etmisiniz!')->info();

            return back();
        }
        /*
         * country_id = 5 Azerbaijan
         * IsCurrentlyWorkAtSocar == true
         * finalEducation->university_id == 34 Banm
         * finalEducation->education_level_id == 3 Orta tehsil
         * $user->finalEducation->education_level_id == 1 && $user->finalEducation->education_form_id == 2 Bakalavr Qiyabi
         */
        if ($user->country_id != 5) {
            flash('Əfsuslar olsun ki, siz Azərbaycan Respublikası vətəndaşı olmadığınız üçün qeyd edilmiş proqrama müraciət edə bilməzsiniz!')->error();

            return back();
        }
        elseif ($user->IsCurrentlyWorkAtSocar == 1) {
            flash('Əfsuslar olsun ki, siz SOCAR əməkdaşı olduğunuz üçün qeyd edilmiş proqrama müraciət edə bilməzsiniz!')->error();

            return back();
        }
        elseif ($user->finalEducation->university_id == 34) {
            flash('Əfsuslar olsun ki, siz BANM -ın tələbəsi olduğunuz üçün qeyd edilmiş proqrama müraciət edə bilməzsiniz!')->error();

            return back();
        }
        elseif ($user->finalEducation->CurrentEduYear <= 2) {
            flash('Əfsuslar olsun ki, siz 1-ci və ya 2-ci kurs tələbəsi olduğunuz üçün qeyd edilmiş proqrama müraciət edə bilməzsiniz!')->error();

            return back();
        }
        elseif ($user->finalEducation->education_level_id == 3) {
            flash('Əfsuslar olsun ki, siz universitet tələbəsi olmadığınız üçün qeyd edilmiş proqrama müraciət edə bilməzsiniz!')->error();

            return back();
        }
        elseif ($user->finalEducation->education_level_id == 1 && $user->finalEducation->education_form_id == 2) {
            flash('Əfsuslar olsun ki, siz bakalavriatı qiyabi oxuduğunuz üçün qeyd edilmiş proqrama müraciət edə bilməzsiniz!')->error();

            return back();
        }

        /*if ($user->country_id !== 5 || $user->IsCurrentlyWorkAtSocar == 1 ||
            $user->finalEducation->university_id == 34 || $user->finalEducation->CurrentEduYear <= 2 ||
            $user->finalEducation->education_level_id == 3 ||
            ( $user->finalEducation->education_level_id == 1 && $user->finalEducation->education_form_id == 2 )) {
            flash('Əfsuslar olsun ki, siz qeyd edilmiş proqrama müraciət edə bilməzsiniz!')->error();

            return back();
        }*/

        return $next($request);
    }
}
