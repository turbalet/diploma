<?php

namespace App\Http\Controllers;

use App\Models\Type;

class TypeController extends Controller
{
    public function create()
    {
        dd('Creating type');
    }

    public function showAll()
    {
        return Type::all();
    }
}
