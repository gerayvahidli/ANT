<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Http\Controllers\Controller;
use App\ProgramType;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index ()
	{
		$articles = Article::with( 'programType' )->get();

		return view( 'backend.articles.index', compact( 'articles' ) );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @param \App\Article $article
	 *
	 * @return void
	 */
	public function create ( Article $article )
	{
		$programTypes = ProgramType::all()->pluck( 'Name', 'id' );

		return view( 'backend.articles.form', compact( 'article', 'programTypes' ) );
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
			'published_at'    => 'required|date',
			'program_type_id' => 'required'
		] );

		$article                  = new Article;
		$article->title           = $request->title;
		$article->slug            = $request->slug;
		$article->body            = $request->body;
		$article->published_at    = $request->published_at;
		$article->program_type_id = $request->program_type_id;
		$article->save();
		flash( 'Yeni məqalə müvəffəqiyyətlə yaradıldı' )->success();

		return redirect( route( 'admin.articles.index' ) );
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show ( $id )
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param \App\Article $article
	 *
	 * @return void
	 */
	public function edit ( Article $article )
	{
		$programTypes = ProgramType::all()->pluck( 'Name', 'id' );

		return view( 'backend.articles.form', compact( 'programTypes', 'article' ) );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param Article                   $article
	 *
	 * @return void
	 */
	public function update ( Request $request, Article $article )
	{
		$request->validate( [
			'title'           => 'bail|required|max:255',
			'slug'            => 'required|max:200',
			'body'            => 'nullable',
			'published_at'    => 'required|date',
			'program_type_id' => 'required'
		] );
		$article->title           = $request->title;
		$article->slug            = $request->slug;
		$article->body            = $request->body;
		$article->published_at    = $request->published_at;
		$article->program_type_id = $request->program_type_id;
		$article->save();
		flash( 'Məqalə müvəffəqiyyətlə dəyişdirildi' )->success();

		return redirect( route( 'admin.articles.index' ) );
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param Article $article
	 *
	 * @return void
	 * @throws \Exception
	 */
	public function destroy ( Article $article )
	{
		$article->delete();
		flash( 'Məqalə müvəffəqiyyətlə silindi' )->success();

		return redirect( route( 'admin.articles.index' ) );
	}
}
