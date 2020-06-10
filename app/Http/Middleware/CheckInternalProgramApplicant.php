<?php

namespace App\Http\Middleware;

use App\InternalProgramApplication;
use App\User;
use Closure;
use DB;

class CheckInternalProgramApplicant
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {


        $user = User::with('finalEducation.university')->findOrFail(\Auth::user()->id);
        // if user is already applied to this program return back
        $program =
            InternalProgramApplication::where('program_id', $request->segment(4))->where('user_id', $user->id)->first();
        if (isset($program)) {
            flash('Siz artıq bu proqrama müraciət etmisiniz!')->info();

            return back();
        }

        if (isset($program->HasScholarshipFromOtherCompany) && $program->HasScholarshipFromOtherCompany == 1) {
            flash('Siz digər kommersiya təşkilatlarından təqaüd aldığınıza görə müraciət edə bilməzsiniz!')->info();

            return back();
        }


        /*
         * country_id = 5 Azerbaijan
         * IsCurrentlyWorkAtSocar == true
         * finalEducation->university_id == 34 Banm
         * finalEducation->education_level_id == 3 Orta tehsil
         * $user->finalEducation->university->country_id != 5 Azerbaycanda tehsil almirsa
         * $user->finalEducation->education_level_id == 1 && $user->finalEducation->education_form_id == 2 Bakalavr Qiyabi
         */
        if ($user->country_id != 5) {
            flash('Əfsuslar olsun ki, siz Azərbaycan Respublikası vətəndaşı olmadığınız üçün qeyd edilmiş proqrama müraciət edə bilməzsiniz!')->error();

            return back();
        } elseif ($user->IsCurrentlyWorkAtSocar == 1) {
            flash('Əfsuslar olsun ki, siz SOCAR əməkdaşı olduğunuz üçün qeyd edilmiş proqrama müraciət edə bilməzsiniz!')->error();

            return back();
        } elseif ($user->finalEducation->university_id == 34) {
            flash('Əfsuslar olsun ki, siz BANM -ın tələbəsi olduğunuz üçün qeyd edilmiş proqrama müraciət edə bilməzsiniz!')->error();

            return back();
        } elseif ($user->finalEducation->education_level_id == 1 && $user->finalEducation->CurrentEduYear < 2) {
            flash('Əfsuslar olsun ki, siz bakalavr 1-ci kurs tələbəsi olduğunuz üçün qeyd edilmiş proqrama müraciət edə bilməzsiniz!')->error();

            return back();
        } elseif ($user->finalEducation->education_level_id == 3) {
            flash('Əfsuslar olsun ki, siz universitet tələbəsi olmadığınız üçün qeyd edilmiş proqrama müraciət edə bilməzsiniz!')->error();

            return back();
        } elseif ($user->finalEducation->university->country_id != 5) {
            flash('Əfsuslar olsun ki, siz hal-hazırda xaricdə təhsil aldığınız üçün qeyd edilmiş proqrama müraciət edə bilməzsiniz!')->error();

            return back();
        } elseif ($user->finalEducation->education_level_id == 1 && $user->finalEducation->education_form_id == 2) {
            flash('Əfsuslar olsun ki, siz bakalavriatı qiyabi oxuduğunuz üçün qeyd edilmiş proqrama müraciət edə bilməzsiniz!')->error();

            return back();
        }

        $currentUser = \Auth::user();

        $checkUserWinProgram = DB::select('  select *
          from internal_program_application ia
          left join [FinalEducationSnapshots] fes on fes.InternalProgramApplicationId = ia.id
          where ia.id = (select  max(id) from internal_program_application
          where user_id = ' . $currentUser->id . ' and program_id != ' . $request->segment(4) . ' and InterviewStageResultId = 16) -- hemin user , cari proqramdan bashqa, interview neticesi kecdi olan
          and (
          (fes.[EducationLevelId] = 1 and [CurrentEduYear] = 3) -- bakalavr olub kursu 3 olub
           or  -- ve ya
          (fes.[EducationLevelId] = 2 and [CurrentEduYear] = 1) -- magistr olub kursu 1 olub
          ) ');

        if ($currentUser->finalEducation->education_level_id == 1) {
            if ($currentUser->finalEducation->CurrentEduYear == 4 && empty($checkUserWinProgram)) {
                flash('Siz bakalavr 4-cü kurs olduğunuz üçün yalnız əvvəki il üçün (bakalavr 3) təqaüd proqramının qalibi (təqaüdçü) olduqda müraciət edə bilərsiniz. ')->error();
                return back();
            }

        } elseif ($currentUser->finalEducation->education_level_id == 2) {
            if ($currentUser->finalEducation->CurrentEduYear == 2 && empty($checkUserWinProgram)) {
                flash('Siz magistr 2-ci kurs olduğunuz üçün yalnız əvvəki il üçün (magistr 1) təqaüd proqramının qalibi (təqaüdçü) olduqda müraciət edə bilərsiniz. ')->error();
                return back();
            }
        }


        /*if ($user->country_id !== 5 || $user->IsCurrentlyWorkAtSocar == 1 ||
            $user->finalEducation->university_id == 34 || $user->finalEducation->CurrentEduYear <= 2 ||
            $user->finalEducation->education_level_id == 3 || $user->finalEducation->university->country_id !== 5 ||
            ( $user->finalEducation->education_level_id == 1 && $user->finalEducation->education_form_id == 2 )) {
            flash('Əfsuslar olsun ki, siz qeyd edilmiş proqrama müraciət edə bilməzsiniz!')->error();

            return back();
        }*/

        return $next($request);
    }
}
