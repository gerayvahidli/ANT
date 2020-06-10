<?php

namespace App\Http\Controllers\Admin;

use App\ProgramType;
use App\Speciality;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SpecialityController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index ()
	{
		$specialities = Speciality::with( 'programType' )->get();
		return view( 'backend.specialities.index', compact( 'specialities' ) );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create ( Speciality $speciality )
	{
		$programTypes = ProgramType::all()->pluck( 'Name', 'id' );

		return view( 'backend.specialities.form', compact( 'speciality', 'programTypes' ) );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store ( Request $request )
	{
		$request->validate( [
			'title'           => 'bail|required|max:255',
			'slug'            => 'required|max:200',
			'body'            => 'nullable',
			'program_type_id' => 'required'
		] );

		$speciality                  = new Speciality;
		$speciality->title           = $request->title;
		$speciality->slug            = $request->slug;
		$speciality->body            = $request->body;
		$speciality->program_type_id = $request->program_type_id;
		$speciality->save();
		flash( 'Yeni ixtisas müvəffəqiyyətlə yaradıldı' )->success();

		return redirect( route( 'admin.specialities.index' ) );
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Speciality $speciality
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show ( Speciality $speciality )
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Speciality $speciality
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit ( Speciality $speciality )
	{
		$programTypes = ProgramType::all()->pluck( 'Name', 'id' );

		return view( 'backend.specialities.form', compact( 'speciality', 'programTypes' ) );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \App\Speciality          $speciality
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update ( Request $request, Speciality $speciality )
	{
		$request->validate( [
			'title'           => 'bail|required|max:255',
			'slug'            => 'required|max:200',
			'body'            => 'nullable',
			'program_type_id' => 'required'
		] );
		
		$speciality->title           = $request->title;
		$speciality->slug            = $request->slug;
		$speciality->body            = $request->body;
		$speciality->program_type_id = $request->program_type_id;
		$speciality->save();
		flash( 'Ixtisas müvəffəqiyyətlə dəyişdirildi' )->success();

		return redirect( route( 'admin.specialities.index' ) );
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Speciality $speciality
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy ( Speciality $speciality )
	{
		$speciality->delete();
		flash( 'Ixtisas müvəffəqiyyətlə silindi' )->success();

		return redirect( route( 'admin.specialities.index' ) );
	}
}
