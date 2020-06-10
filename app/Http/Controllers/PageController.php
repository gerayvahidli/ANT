<?php

namespace App\Http\Controllers;

use App\Article;
use App\ProgramType;
use App\Speciality;
use App\Term;
use Illuminate\Http\Request;

class PageController extends Controller
{
	public function show ( $slug = null )
	{
		$page = ProgramType::with( [ 'articles' => function ( $query ) {
			$query->where( 'published_at', '<=', date( 'Y-m-d' ) )->orderBy( 'published_at', 'desc' )->take( 6 );
		}, 'terms.termType' ] )->where( 'ShortName', $slug )->firstOrFail();
		if ( !isset( $page ) && !count( $page->id ) ) {
			abort( 404 );
		}

		return view( 'frontend.pages.index', compact( 'page' ) );
	}

	public function newsArchive ( $slug = null )
	{
		$page = ProgramType::with( [ 'articles' => function ( $query ) {
			$query->where( 'published_at', '<=', date( 'Y-m-d' ) )->orderBy( 'published_at', 'desc' )->simplePaginate( 10 );
		} ] )->where( 'ShortName', $slug )->firstOrFail();
		if ( !isset( $page ) && !count( $page->id ) ) {
			abort( 404 );
		}
		return view( 'frontend.pages.news', compact( 'page' ) );
	}

	public function faq ( $slug = null )
	{
		$page = ProgramType::with( 'faq' )->where( 'ShortName', $slug )->firstOrFail();
		if ( !isset( $page ) && !count( $page->id ) ) {
			abort( 404 );
		}
		return view( 'frontend.pages.faq', compact( 'page' ) );
	}

	public function showPost ( $termType, $post )
	{
		$post = Article::with( 'programType' )->findOrFail( $post );
		$page = ProgramType::with( 'articles', 'terms.termType' )->findOrFail( $post->program_type_id );
		if ( !isset( $page ) && !count( $page->id ) ) {
			abort( 404 );
		}
		return view( 'frontend.pages.blogPost', compact( 'post', 'page' ) );
	}

	public function terms ( $programType = null, $termType = null )
	{
//        dd($termType);
		$page  = ProgramType::with( 'terms.termType' )->where( 'ShortName', $programType )->firstOrFail();
		$terms = Term::whereHas(
			'programType', function ( $query ) use ( $programType ) {
			$query->where( 'ShortName', $programType );
		} )
			->whereHas( 'termType', function ( $query ) use ( $termType ) {
				$query->where( 'slug', $termType );
			} )->get();

		if ( !isset( $terms ) && !count( $terms ) ) {
			abort( 404 );
		}

		return view( 'frontend.pages.terms', compact( 'terms', 'page' ) );
	}

	public function showTerm ( $term )
	{
		$term = Term::with( [
			'programType',
			'termType',
		] )->findOrFail( $term );
		$page = ProgramType::with( 'articles', 'terms.termType' )->findOrFail( $term->program_type_id );
		if ( !isset( $page ) && !count( $page->id ) ) {
			abort( 404 );
		}

		return view( 'frontend.pages.term', compact( 'term', 'page' ) );
	}

	public function specialities ( $slug )
	{
		$page = ProgramType::with( 'specialities' )->where( 'ShortName', $slug )->firstOrFail();
		$speciality = Speciality::with( [
			'programType',
		] )->where('program_type_id', $page->id)->firstOrFail();
//		$page       = ProgramType::with( 'articles', 'specialities' )->findOrFail( $speciality->program_type_id );
		if ( !isset( $page ) && !count( $page->id ) ) {
			abort( 404 );
		}
		return view( 'frontend.pages.speciality', compact( 'speciality', 'page' ) );
	}

	public function DownloadExtFile ( Request $req )
	{

		return new \App\Http\Resources\External( \App\ExternalProgramApplication::find( $req->app_id ) );
		/// return new \App\Http\Resources\FileDownload(\App\ExternalProgramApplication::find($req->app_id));
		//     return Storage::disk('public')->path('app/file.txt');

	}


}
