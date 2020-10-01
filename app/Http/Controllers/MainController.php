<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function editorial_staff()
    {
        return view('user.editorial-staff');
    }

    public function founders()
    {
        return view('user.founders');
    }

    public function archive()
    {
        return view('user.journal.archive');
    }

    public function from_editor_in_chief()
    {
        return view('user.from_editor_in_chief');
    }


    public function search()
    {
        return view('user.search.search');
    }


}
