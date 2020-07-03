<?php

namespace App\Http\ViewComposers;

use App\Program;
use App\ProgramType;
use App\TermType;
use Illuminate\View\View;


class LeftNavigationComposer
{
    /**
     * @var $ProgramTypes
     */
    protected $ProgramTypes;


    public function __construct(ProgramType $programTypes)
    {
        $this->ProgramTypes = $programTypes;
    }

    /**
     * Bind data to the view.
     *
     * @param  View $view
     *
     * @return void
     */
    public function compose(View $view)
    {
//        $currentExternalProgram   =
//            Program::where('program_type_id', 2)->where('BeginDate', '<=', now())->where('EndDate', '>=', now())
//                   ->orderBy('id', 'desc')->first()
//        ;
//        $currentInternalProgram   =
//            Program::where('program_type_id', 1)->where('BeginDate', '<=', now())->where('EndDate', '>=', now())
//                   ->orderBy('id', 'desc')->first()
//        ;
//        $currentInternshipProgram =
//            Program::where('program_type_id', 3)->where('BeginDate', '<=', now())->where('EndDate', '>=', now())
//                   ->orderBy('id', 'desc')->first()
//        ;
        $programTypes             = ProgramType::where('id', '<', 3)->get();
        $termTypes                = TermType::all();
        $view->with([
            'navProgramTypes'          => $programTypes,
            'navTermTypes'             => $termTypes,
//            'currentExternalProgram'   => $currentExternalProgram,
//            'currentInternalProgram'   => $currentInternalProgram,
//            'currentInternshipProgram' => $currentInternshipProgram,
        ]);
    }
}