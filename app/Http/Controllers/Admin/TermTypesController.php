<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\TermType;
use Illuminate\Http\Request;

class TermTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $termTypes = TermType::all();
        return view('backend.termTypes.index', compact('termTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \App\TermType $termType
     *
     * @return void
     */
    public function create(TermType $termType)
    {
        return view('backend.termTypes.form', compact('termType'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
	    $request->validate( [
		    'title'           => 'bail|required|max:255',
		    'slug'            => 'required|max:200',
	    ] );
        $termType = new TermType;
        $termType->title = $request->title;
        $termType->slug = $request->slug;
        $termType->save();
        return redirect(route('admin.termTypes.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TermType  $termType
     * @return \Illuminate\Http\Response
     */
    public function show(TermType $termType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TermType  $termType
     * @return \Illuminate\Http\Response
     */
    public function edit(TermType $termType)
    {
        return view('backend.termTypes.form', compact('termType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TermType  $termType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TermType $termType)
    {
	    $request->validate( [
		    'title'           => 'bail|required|max:255',
		    'slug'            => 'required|max:200',
	    ] );
        $termType->title = $request->title;
        $termType->slug = $request->slug;
        $termType->save();
        return redirect(route('admin.termTypes.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TermType $termType
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(TermType $termType)
    {
        $termType->delete();
        return redirect(route('admin.termTypes.index'));
    }
}
