<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ProgramType;
use App\Term;
use App\TermType;
use Illuminate\Http\Request;

class TermsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $terms = Term::with('programType', 'termType')->get();

        return view('backend.terms.index', compact('terms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \App\Term $term
     *
     * @return void
     */
    public function create(Term $term)
    {
        $programTypes = ProgramType::all()->pluck('Name', 'id');
        $termTypes    = TermType::all()->pluck('title', 'id');

        return view('backend.terms.form', compact('term', 'programTypes', 'termTypes'));
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
	    $request->validate( [
		    'title'           => 'bail|required|max:255',
		    'slug'            => 'required|max:200',
		    'body'            => 'nullable',
		    'term_type_id'    => 'required',
		    'program_type_id' => 'required'
	    ] );

        $term                  = new Term;
        $term->title           = $request->title;
        $term->slug            = $request->slug;
        $term->body            = $request->body;
        $term->program_type_id = $request->program_type_id;
        $term->term_type_id    = $request->term_type_id;
        $term->save();

        return redirect(route('admin.terms.index'));
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
     * @param \App\Term $term
     *
     * @return void
     */
    public function edit(Term $term)
    {
        $programTypes = ProgramType::all()->pluck('Name', 'id');
        $termTypes    = TermType::all()->pluck('title', 'id');

        return view('backend.terms.form', compact('term', 'programTypes', 'termTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param \App\Term                 $term
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Term $term)
    {
	    $request->validate( [
		    'title'           => 'bail|required|max:255',
		    'slug'            => 'required|max:200',
		    'body'            => 'nullable',
		    'term_type_id'    => 'required',
		    'program_type_id' => 'required'
	    ] );
        $term->title           = $request->title;
        $term->slug            = $request->slug;
        $term->body            = $request->body;
        $term->program_type_id = $request->program_type_id;
        $term->term_type_id    = $request->term_type_id;
        $term->save();

        return redirect(route('admin.terms.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Term $term
     *
     * @return void
     * @throws \Exception
     */
    public function destroy(Term $term)
    {
        $term->delete();
        return redirect(route('admin.terms.index'));
    }
}
