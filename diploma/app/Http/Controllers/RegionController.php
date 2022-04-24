<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function create()
    {
        dd('Creating region');
    }

    public function showAll()
    {
        return Region::all();
    }
}
