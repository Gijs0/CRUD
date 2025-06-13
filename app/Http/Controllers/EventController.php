<?php

namespace App\Http\Controllers;

use App\Models\Festival; // Of hoe jouw model heet
use Illuminate\Http\Request;

class EventController extends Controller
{
    // GET /festivals
    public function index()
    {
        $festivals = Festival::all();
        return view('festivals.index', compact('festivals'));
    }

    // GET /festivals/{festival}
    public function show(Festival $festival)
    {
        return view('festivals.show', compact('festival'));
    }

    // (andere resource-methodes kun je laten staan of verwijderen)
}
