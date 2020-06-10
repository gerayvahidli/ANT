<?php

namespace App\Http\Controllers\Admin;

use App\ProgramType;
use App\Slide;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SlidesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slides = Slide::with('programType')->get();

        return view('backend.slides.index', compact('slides'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \App\Slide $slide
     *
     * @return void
     */
    public function create(Slide $slide)
    {
        $programTypes = ProgramType::all()->pluck('Name', 'id');

        return view('backend.slides.form', compact('slide', 'programTypes'));
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
        $slide                    = new Slide;
        $slide->title             = $request->title;
        $slide->image             = $request->slug;
        $slide->thumbnail         = $request->body;
        $slide->show_in_home_page = $request->show_in_home_page;
        $slide->program_type_id   = $request->program_type_id;
        $slide->save();
        flash('Yeni slayd müvəffəqiyyətlə yaradıldı')->success();

        return redirect(route('admin.slides.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Slide $slide
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Slide $slide)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Slide $slide
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Slide $slide)
    {
        $programTypes = ProgramType::all()->pluck('Name', 'id');

        return view('backend.slides.form', compact('slide', 'programTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Slide               $slide
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slide $slide)
    {
        $slide                    = new Slide;
        $slide->title             = $request->title;
        $slide->image             = $request->slug;
        $slide->thumbnail         = $request->body;
        $slide->show_in_home_page = $request->show_in_home_page;
        $slide->program_type_id   = $request->program_type_id;
        $slide->save();
        flash('Slayd müvəffəqiyyətlə dəyişdirildi')->success();

        return redirect(route('admin.slides.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Slide $slide
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Slide $slide)
    {
        $slide->delete();
        flash('Slayd müvəffəqiyyətlə silindi')->success();

        return redirect(route('admin.slides.index'));
    }
}
