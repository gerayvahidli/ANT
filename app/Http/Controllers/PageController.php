<?php

namespace App\Http\Controllers;

use App\Article;
use App\ProgramType;
use App\Speciality;
use App\Term;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show()
    {
        $page = ProgramType::with(['articles' => function ($query) {
            $query->where('published_at', '<=', date('Y-m-d'))->orderBy('published_at', 'desc')->take(6);
        }, 'terms.termType'])->where('ShortName', 'XTP')->firstOrFail();
        if (!isset($page) && !count($page->id)) {
            abort(404);
        }

        return view('frontend.pages.index', compact('page'));
    }

    public function newsArchive()
    {
        $page = ProgramType::with(['articles' => function ($query) {
            $query->where('published_at', '<=', date('Y-m-d'))->orderBy('published_at', 'desc')->simplePaginate(10);
        }])->where('ShortName', 'XTP')->firstOrFail();
        if (!isset($page) && !count($page->id)) {
            abort(404);
        }
        return view('frontend.pages.news', compact('page'));
    }

    public function faq()
    {
        $page = ProgramType::with('faq')->where('ShortName', 'XTP')->firstOrFail();
        if (!isset($page) && !count($page->id)) {
            abort(404);
        }
        return view('frontend.pages.faq', compact('page'));
    }

    public function showPost($post)
    {
        $post = Article::with('programType')->findOrFail($post);
        $page = ProgramType::with('articles', 'terms.termType')->findOrFail($post->program_type_id);
        if (!isset($page) && !count($page->id)) {
            abort(404);
        }
        return view('frontend.pages.blogPost', compact('post', 'page'));
    }

    public function terms($termType = null)
    {
//        dd($termType);
        $page = ProgramType::with('terms.termType')->where('ShortName', 'XTP')->firstOrFail();
        $terms = Term::whereHas(
            'programType', function ($query) {
            $query->where('ShortName', 'XTP');
        })
            ->whereHas('termType', function ($query) use ($termType) {
                $query->where('slug', $termType);
            })->get();
        if (!isset($terms) && !count($terms)) {
            abort(404);
        }

        return view('frontend.pages.terms', compact('terms', 'page'));
    }

    public function showTerm($term)
    {
        $term = Term::with([
            'programType',
            'termType',
        ])->findOrFail($term);
        $page = ProgramType::with('articles', 'terms.termType')->findOrFail($term->program_type_id);
        if (!isset($page) && !count($page->id)) {
            abort(404);
        }

        return view('frontend.pages.term', compact('term', 'page'));
    }

    public function specialities()
    {
        $page = ProgramType::with('specialities')->where('ShortName', 'XTP')->firstOrFail();
        $speciality = Speciality::with([
            'programType',
        ])->where('program_type_id', $page->id)->firstOrFail();
//		$page       = ProgramType::with( 'articles', 'specialities' )->findOrFail( $speciality->program_type_id );
        if (!isset($page) && !count($page->id)) {
            abort(404);
        }
        return view('frontend.pages.speciality', compact('speciality', 'page'));
    }

    public function DownloadExtFile(Request $req)
    {

        return new \App\Http\Resources\External(\App\ExternalProgramApplication::find($req->app_id));
        /// return new \App\Http\Resources\FileDownload(\App\ExternalProgramApplication::find($req->app_id));
        //     return Storage::disk('public')->path('app/file.txt');

    }


    public function getCurrentMonthNewsAndAvailableDates(Request $request)
    {
        $available_dates = Article::all()->map(function ($model) {
            return $model->published_at->format('Y-n-j');
        });


        $current_month_news = Article::whereYear('published_at',date('Y')) -> whereMonth('published_at',date('m')) ->get();

        return response(json_encode(
            [
                            'available_dates'  =>$available_dates,
                            'current_month_news'  =>   $current_month_news 
            ]


        ));
    }


    public function getNewsByMonth(Request $request)
    {
        
        $articles = Article::whereYear('published_at', $request->year)->whereMonth('published_at', sprintf("%02d", $request->month))->get();
        return response(json_encode($articles));
    }

    public function getNewsByDay(Request $request)
    {
        $date = $request->year."-".sprintf("%02d", $request->month)."-".sprintf("%02d", $request->day);
        $articles = Article::whereDate('published_at', $date) -> get();
        return response(json_encode($articles));
    }

}
