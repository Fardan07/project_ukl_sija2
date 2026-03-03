<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Location;

class LandingController extends Controller
{
    public function index()
    {
        $facilities = Facility::all();
        $locations  = Location::all();

        return view('landing', compact('facilities','locations'));
    }
}