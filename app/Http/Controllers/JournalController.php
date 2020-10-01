<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JournalController extends Controller
{
    public function index()
    {
        return view('user.journal.about-journal');
    }

    public function last_number()
    {
        return view('user.journal.last-number');
    }


}
