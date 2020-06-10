<?php

namespace App\Http\Controllers\Admin;

use App\Faq;
use App\ProgramType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FAQController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Faq::with('programType')->get();

        return view('backend.faq.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \App\Faq $faq
     *
     * @return void
     */
    public function create(Faq $faq)
    {
        $programTypes = ProgramType::all()->pluck('Name', 'id');

        return view('backend.faq.form', compact('faq', 'programTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $question                  = new Faq;
        $question->title           = $request->title;
        $question->slug            = $request->slug;
        $question->answer          = $request->answer;
        $question->program_type_id = $request->program_type_id;
        $question->save();

        return redirect(route('admin.faq.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Faq $faq
     *
     * @return void
     */
    public function edit(Faq $faq)
    {
        $programTypes = ProgramType::all()->pluck('Name', 'id');

        return view('backend.faq.form', compact('faq', 'programTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param \App\Faq                  $faq
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Faq $faq)
    {
        $faq->title           = $request->title;
        $faq->slug            = $request->slug;
        $faq->answer          = $request->answer;
        $faq->program_type_id = $request->program_type_id;
        $faq->save();

        return redirect(route('admin.faq.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Faq $faq
     *
     * @return void
     * * @throws \Exception
     */
    public function destroy(Faq $faq)
    {
        $faq->delete();

        return redirect(route('admin.faq.index'));
    }
}
